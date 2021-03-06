<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Homepage extends CI_Controller {

    /**
     * Homepage::__construct()
     * 
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('Weather', 'weather');
        $this->load->model('Missions_model', 'missions_model');
        $this->load->model('Fahrzeuge_model', 'fahrzeuge_model');
        $this->load->model('Mannschaft_members_model', 'mannschaft_members_model');
        $this->load->model("Fuel_sitevariables_model", "variables");
    }

    public function index() {

        $data["missions"] = fuel_model("missions_model", array('find' => 'all', 'limit' => 10, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'datum_beginn desc, uhrzeit_beginn desc, einsatz_nr desc'));
        $data["news"] = fuel_model("news_articles_model", array('find' => 'all', 'limit' => 2, 'offset' => 0, 'where' => array('published' => 'yes', 'datum <=' => date('Y-m-d')), 'order' => 'datum desc, id desc'));
        $data["appointments"] = fuel_model("appointments_model", array('find' => 'all', 'limit' => 3, 'offset' => 0, 'where' => array('datum >=' => date('Y-m-d'), 'published' => 'yes'), 'order' => 'datum asc, beginn asc'));
        $data["weather"] = $this->weather->get_weather();
        $data["mission_count"] = $this->missions_model->get_mission_count(date('Y'));
        $data["mission_count_last_year"] = $this->missions_model->get_mission_count(date('Y'));
        $data["vehicle_count"] = $this->fahrzeuge_model->get_fahrzeug_anzahl();
        $data["swapbody_count"] = $this->fahrzeuge_model->get_abroller_anzahl();
        $data["member_count"] = $this->mannschaft_members_model->get_mannschaft_members_anzahl_as_array();

        $show_prewarnings = $this->variables->retrieve_one('wetter_vorabwarnungen_anzeigen');
        $warning = $this->weather->get_weather_warning($show_prewarnings);
        if ($warning != null) {
            $data["warning"] = $warning;
        }

        $this->fuel->pages->render("startseite", $data, array('render_mode' => 'cms'));
    }

}

/* End of file homepage.php */
/* Location: ./application/controllers/homepage.php */
?>