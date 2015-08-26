<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Homepage extends CI_Controller {
    
	/**
	 * Homepage::__construct()
	 * 
	 * @return
	 */
	public function __construct()
	{
        $this->load->library('weather');
    }
     
    public function index() {
        
        $this->load->model('stages_model');
        $stage_id = fuel_model("fuel_sitevariables_model", array('find' => 'one', 'where' => array('name' => 'homepage_stage_id')));
        
        $head['main_navigation']  = main_navigation();
        $head["stage"]            = $this->stages_model->get_stage_for_frontend($stage_id->value);
        $data["missions"]         = fuel_model("missions_model", array('find' => 'all', 'limit' => 10, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'datum_beginn desc, uhrzeit_beginn desc, einsatz_nr desc'));
        $data["news"]             = fuel_model("news_model", array('find' => 'all', 'limit' => 2, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'valid_from desc, valid_from_time desc'));
        $data["termine"]          = fuel_model("appointments_model",array('find' => 'all', 'limit' => 3, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'datum desc, beginn desc'));
        $data["weather"]          = $this->weather->get_weather();
        
        $this->load->view('_blocks/header', $head);
        $this->load->view('home', $data);
        $this->load->view('_blocks/footer');
    }
}

/* End of file impressum.php */
/* Location: ./application/controllers/impressum.php */
?>