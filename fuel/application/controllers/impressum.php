<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Impressum extends CI_Controller {
     
    public function index() {
        
        $this->fuel->pages->render("impressum", array(), array('render_mode' => 'cms'));
    }
}

/* End of file impressum.php */
/* Location: ./application/controllers/impressum.php */
?>