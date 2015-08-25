<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Homepage extends CI_Controller {
     
    public function index() {
        
        $missions = fuel_model("missions_model", array('find' => 'all', 'limit' => 10, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'datum_beginn desc, uhrzeit_beginn desc, einsatz_nr desc'));
        $news     = fuel_model("news_model", array('find' => 'all', 'limit' => 2, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'valid_from desc, valid_from_time desc'));
    }
}

/* End of file impressum.php */
/* Location: ./application/controllers/impressum.php */
?>