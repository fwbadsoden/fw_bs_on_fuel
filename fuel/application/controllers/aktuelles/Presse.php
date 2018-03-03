<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Presse extends CI_Controller {
     
    public function index() {
        
        $this->load->helper('session');
        
        $data = array();
        $data["form_name"] = "presse";
        $data["success"] = session_flashdata("success");
        
        $this->fuel->pages->render("aktuelles/presse", $data, array('render_mode' => 'cms'));
        
       // $this->fuel->pages->render("aktuelles/presse");
    }
}

/* End of file presse.php */
/* Location: ./application/controllers/aktuelles/presse.php */
?>