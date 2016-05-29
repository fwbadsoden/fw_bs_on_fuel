<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Homepage extends CI_Controller {
    
	/**
	 * Homepage::__construct()
	 * 
	 * @return
	 */
	public function __construct()
	{ 
        parent::__construct();
        $this->load->library('weather');
        //$this->load->model('stages_model');
        $this->load->model('missions_model');
        $this->load->model('fahrzeuge_model');
        $this->load->model('mannschaft_members_model');
    }
     
    public function index() {        
        
        $data["missions"]         = fuel_model("missions_model", array('find' => 'all', 'limit' => 10, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'datum_beginn desc, uhrzeit_beginn desc, einsatz_nr desc'));
        $data["news"]             = fuel_model("news_articles_model", array('find' => 'all', 'limit' => 2, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'datum desc, id desc'));
        $data["appointments"]     = fuel_model("appointments_model", array('find' => 'all', 'limit' => 3, 'offset' => 0, 'where' => array('datum >=' => date('Y-m-d'), 'published' => 'yes'), 'order' => 'datum asc, beginn asc'));
        $data["weather"]          = $this->weather->get_weather();
        $data["mission_count"]    = $this->missions_model->get_mission_count(date('Y'));
        $data["vehicle_count"]    = $this->fahrzeuge_model->get_fahrzeug_anzahl();
        $data["member_count"]     = $this->mannschaft_members_model->get_mannschaft_members_anzahl_as_array();
      
        $this->fuel->pages->render("startseite", $data, array('render_mode' => 'cms'));
    }
}

/* End of file homepage.php */
/* Location: ./application/controllers/homepage.php */
?>