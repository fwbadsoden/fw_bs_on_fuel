<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Kontakt extends CI_Controller {
     
    public function index() {
        
        $this->load->helper('session');
        
        $data = array();
        $data["form_name"] = "kontakt";
        $data["success"] = session_flashdata("success");
        
        $this->fuel->pages->render("kontakt", $data, array('render_mode' => 'cms'));
    }
}

/* End of file kontakt.php */
/* Location: ./application/controllers/kontakt.php */
?>