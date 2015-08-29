<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Impressum extends CI_Controller {
     
    public function index() {
        
        $data = array();
        
        $this->fuel->pages->render("impressum", $data, array('render_mode' => 'cms'));
    }
}

/* End of file impressum.php */
/* Location: ./application/controllers/impressum.php */
?>