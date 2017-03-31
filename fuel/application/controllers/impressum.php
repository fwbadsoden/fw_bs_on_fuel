<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Impressum extends CI_Controller {
     
    public function index() {
        
        $this->load->helper('session');
        
        $data = array();
        $data["form_name"] = "impressum";
        $data["success"] = session_flashdata("success");
        
        $this->fuel->pages->render("impressum", $data, array('render_mode' => 'cms'));
    }
}

/* End of file impressum.php */
/* Location: ./application/controllers/impressum.php */
?>