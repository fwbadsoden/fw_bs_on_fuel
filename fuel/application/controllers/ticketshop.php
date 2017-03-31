<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ticketshop extends CI_Controller {

    private $max_tickets = 100;
    private $price = 10;

    public function __construct() {
        parent::__construct();
        $this->load->helper('ajax');
        $this->load->library('session');
        $this->load->model('tickets_model');
    }

    public function index() {

        $this->load->module_model(FUEL_FOLDER, 'fuel_sitevariables_model');
        $data = array();
        $data["form_name"] = "ticketshop";
        $data["tickets_sold"] = $this->tickets_model->get_tickets_sold();
        $data["max_tickets"] = $this->max_tickets;
        $data["success"] = session_flashdata("success");
        $this->fuel->pages->render("ticketshop", $data, array('render_mode' => 'cms'));
    }
}

/* End of file ticketshop.php */
/* Location: ./application/controllers/ticketshop.php */
?>