<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Kontakt extends CI_Controller {
     
    public function index() {
        
        $data = array();
        $data["form_name"] = "kontakt";
        
        $this->fuel->pages->render("kontakt", $data, array('render_mode' => 'cms'));
    }
}

/* End of file kontakt.php */
/* Location: ./application/controllers/kontakt.php */
?>