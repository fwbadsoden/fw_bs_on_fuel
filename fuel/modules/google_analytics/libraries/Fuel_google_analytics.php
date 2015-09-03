<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FUEL CMS
 * http://www.getfuelcms.com
 *
 * An open source Content Management System based on the 
 * Codeigniter framework (http://codeigniter.com)
 */

// ------------------------------------------------------------------------

/**
 * Fuel Google Analytics object 
 *
 * @package		FUEL CMS
 * @subpackage	Libraries
 * @category	Libraries
 */

// --------------------------------------------------------------------

// load in Analytics library
require_once('GoogleAnalyticsAPI.class.php');

class Fuel_google_analytics extends Fuel_advanced_module {
	
	public $name = "google_analytics"; // the folder name of the module
	public $start_date = 0; // the start date of what to display
	public $end_date = 0; // the start date of what to display
	protected $_analytics = NULL; // the analytics object
    protected $_authurl = NULL;


	/**
	 * Constructor - Sets preferences
	 *
	 * The constructor can be passed an array of config values
	 */
	function __construct($params = array())
	{ 
		parent::__construct();
		$this->initialize($params);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Initialize the analytics object
	 *
	 * Accepts an associative array as input, containing backup preferences.
	 * Also will set the values in the config as properties of this object
	 *
	 * @access	public
	 * @param	array	config preferences
	 * @return	void
	 */	
	function initialize($params)
	{ 
		parent::initialize($params);
		$this->set_params($this->_config);
        
        $this->_auth(); 
	}
    
    private function _auth() {
            
		$this->_analytics = new GoogleAnalyticsAPI();
        
        if(!$this->session->userdata('accessToken')) {
            
            $this->_analytics->auth->setClientId($this->config('client_id'));
            $this->_analytics->auth->setEmail($this->config('email'));
            $this->_analytics->auth->setPrivateKey($this->config('private_key'));
            
            $auth = $_analytics->auth->getAccessToken();
    
            // Try to get the AccessToken
            if ($auth['http_code'] == 200) {
                $session['accessToken'] = $accessToken = $auth['access_token'];
                $session['tokenExpires'] = $auth['expires_in'];
                $session['tokenCreated'] = time();
            } else {
                // error...
            }
        } else {
            
            // check if token is valid
            $accessToken = $this->session->userdata('accessToken');
            $tokenExpired = $this->session->userdata('tokenExpired');
            $tokenCreated = $this->session->userdata('tokenCreated');
            
            // Check if the accessToken is expired
            if ((time() - $tokenCreated) >= $tokenExpires) {
                $this->session->unset_userdata('accessToken', 'tokenExpired', 'tokenCreated');
                $this->_auth();
            }
        }
                
        // get Account ID
        $this->_analytics->setAccessToken($accessToken);
        $this->_analytics->setAccountId('ga:'.$this->config('profile_id'));
        
        // Load profiles
        $profiles = $_analytics->getProfiles();
        $accounts = array();
        
        foreach ($profiles['items'] as $item) {
            $id = "ga:{$item['id']}";
            $name = $item['name'];
            $accounts[$id] = $name;
        }
    }

	// --------------------------------------------------------------------
	
	/**
	 * Returns an array of visit plot points
	 *
	 * @access	public
	 * @return	array
	 */	
	function visits()
	{
		$visits = $this->_analytics->getVisitors();
		$points = $this->_create_plot_array($visits);
		return $points;
	}

	// --------------------------------------------------------------------
	
	/**
	 *Returns an array of view plot points
	 *
	 * @access	public
	 * @return	public
	 */
	function views()
	{
		$views = $this->_analytics->getPageviews();
		$points = $this->_create_plot_array($views);
		return $points;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Returns an array of plot points
	 *
	 * @access	protected
	 * @param	array	data to be converted to plot points
	 * @return	array
	 */	
	protected function _create_plot_array($data)
	{
		$views = $this->_analytics->getPageviews();
		$points = array();
		foreach ($data as $date => $visit)
		{
			$year = substr($date, 0, 4);
			$month = substr($date, 4, 2);
			$day = substr($date, 6, 2);
			$utc = mktime(date('h') + 1, NULL, NULL, $month, $day, $year) * 1000;
			$points[] = array($utc, $visit);
		}
		return $points;
	}

	// --------------------------------------------------------------------
	
	/**
	 * Returns the Analytics API object
	 *
	 * @access	public
	 * @return	object
	 */	
	function analytics()
	{
		return $this->_analytics();
	}

	// --------------------------------------------------------------------
	
	/**
	 * Magic method that simply calls the analytcs object
	 *
	 * @access	public
	 * @return	mixed
	 */	
	function __call($method, $params)
	{
		return call_user_func_array(array($this->_analytics, $method), $params);
	}
}