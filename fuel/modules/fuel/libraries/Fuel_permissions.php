<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FUEL CMS
 * http://www.getfuelcms.com
 *
 * An open source Content Management System based on the 
 * Codeigniter framework (http://codeigniter.com)
 *
 * @package		FUEL CMS
 * @author		David McReynolds @ Daylight Studio
 * @copyright	Copyright (c) 2012, Run for Daylight LLC.
 * @license		http://www.getfuelcms.com/user_guide/general/license
 * @link		http://www.getfuelcms.com
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * FUEL permissions object
 *
 * @package		FUEL CMS
 * @subpackage	Libraries
 * @category	Libraries
 * @author		David McReynolds @ Daylight Studio
 * @link		http://www.getfuelcms.com/user_guide/libraries/fuel_permissions
 */

// --------------------------------------------------------------------

class Fuel_permissions extends Fuel_module {
	
	protected $module = 'permissions';
	protected $_perms = array();
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * Accepts an associative array as input, containing preferences (optional)
	 *
	 * @access	public
	 * @param	array	config preferences
	 * @return	void
	 */	
	function __construct($params = array())
	{
		parent::__construct($params);
		$this->initialize($params);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Initialize the object and set object parameters
	 *
	 * Accepts an associative array as input, containing object preferences.
	 *
	 * @access	public
	 * @param	array	Array of initalization parameters  (optional)
	 * @return	void
	 */	
	function initialize($params = array())
	{
		parent::initialize($params);
		
		// can't use because contstructor hasn't initialized
		$this->_perms = $this->model()->find_all_array_assoc('name');
	}

	// --------------------------------------------------------------------

	/**
	 * Returns whether a permission exists or not
	 *
	 * @access	public
	 * @param	string
	 * @return	boolean
	 */
	function exists($perm)
	{
		return (isset($this->_perms[$perm]));
	}


	// --------------------------------------------------------------------

	/**
	 * Returns all permissions
	 *
	 * @access	public
	 * @return	array
	 */
	function list_all()
	{
		return $this->_perms;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns a user
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	string
	 */
	function get($perm_id, $return_type = NULL)
	{
		if (is_int($perm_id))
		{
			$perm = $this->model()->find_by_key($perm_id, $return_type);
		}
		else
		{
			$perm = $this->model()->find_one('name = "'.$perm_id.'"', $return_type);
		}
		return $perm;
	}


	// --------------------------------------------------------------------

	/**
	 * Returns a user
	 *
	 * @access	public
	 * @param	string	The name of the module to create permissions
	 * @param	array	An array of type of permissions to save with the module. If set to False then no extra permission types will be created
	 * @return	array
	 */
	function create_simple_module_permissions($module, $types = array('create', 'edit', 'publish', 'delete'))
	{
		$save = array();
		
		$save[] = array('name' => $module, 'description' => humanize($module));
		
		if (is_array($types))
		{
			foreach($types as $type)
			{
				$save[] = array('name' => $module.'/'.$type, 
								'description' => humanize($module).': '.ucfirst($type)
								);
			}
		}
		if (!$this->model()->save($save))
		{
			return FALSE;
		}
		return $save;
	}
	
	
	
	// --------------------------------------------------------------------

	/**
	 * Assigns a permission to a user
	 *
	 * @access	public
	 * @param	int
	 * @param	int
	 * @return	boolean
	 */
/*	function assign_to_user($user_id, $perm_id)
	{
		$this->fuel->load_model('permissions');
		$user = $this->get($user_id);
		
		if (!isset($user->id)) return FALSE;

		$permission = $this->fuel->permissions->get($perm_id);
		if (!isset($permission->id)) return FALSE;
		
		$perm_to_user = $this->CI->user_to_permissions_model->create();
		$perm_to_user->permission_id = $user->id;
		$perm_to_user->user_id = $user->id;
		return $perm_to_user->save();
	}*/

	


}

/* End of file Fuel_permissions.php */
/* Location: ./modules/fuel/libraries/Fuel_permissions.php */