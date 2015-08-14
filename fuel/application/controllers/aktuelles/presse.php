<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Presse extends CI_Controller {
     
    public function index() {
        
        $this->fuel->pages->render("aktuelles/presse");
    }
}

/* End of file presse.php */
/* Location: ./application/controllers/aktuelles/presse.php */
?>