<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Kontakt extends CI_Controller {
     
    public function index() {
        
        $this->fuel->pages->render("kontakt", array(), array('render_mode' => 'cms'));
    }
}

/* End of file kontakt.php */
/* Location: ./application/controllers/kontakt.php */
?>