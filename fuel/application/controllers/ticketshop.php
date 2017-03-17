<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ticketshop extends CI_Controller {

    private $max_tickets = 100;

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
        $this->fuel->pages->render("ticketshop", $data, array('render_mode' => 'cms'));
    }

    public function process() {

        $ticket["last_name"] = $this->CI()->input->post('last_name');
        $ticket["first_name"] = $this->CI()->input->post('first_name');
        $ticket["email"] = $this->CI()->input->post('email');
        $ticket["quantity"] = $this->CI()->input->post('quantity');
        $ticket["invoice_number"] = $this->tickets_model->generate_invoice_number();

        $return_url = ($this->input->get_post('return_url')) ? $this->input->get_post('return_url') : $form->get_return_url();

        if ($this->tickets_model->create($ticket)) {
            $sum_price = $this->price * $ticket["quantity"];

            $message = "Sehr geehrte(r) Frau/Herr " . $ticket["last_name"] . ",\n"
                    . "\n"
                    . "vielen Dank für Ihre Bestellung von " . $ticket["quantity"] . " Tickets für die Veranstaltung\n"
                    . "Tanz in den Mai am 30.04.2017 um 20 Uhr im Bürgerhaus Neuenhain, Hauptstraße 45, 65812 Bad Soden am Taunus - Neuenhain.\n"
                    . "\n"
                    . "Wir haben Ihre Bestellung unter der Bestellnummer " . $ticket["invoice_number"] . " aufgenommen.\n"
                    . "\n"
                    . "Bitte bezahlen Sie den Betrag von " . $sum_price . "€ innerhalb von " . $this->due_days . " Tagen unter Angabe der Bestellnummer auf folgendes Konto:\n"
                    . "IBAN: DE52 5019 0000 0000 0441 05\nBIC: FFVBDEFF\n"
                    . "Sollte Ihre Zahlung nicht innerhalb von " . $this->due_days . " Tagen erfolgen, verfällt die Reservierung der Karten.\n"
                    . "Nach Eingang der Zahlung auf unserem Konto erhalten Sie eine Bestätigungsmail mit weiteren Infos.";

            $params["to"] = $ticket["email"];
            $params["from"] = "noreply@feuerwehr-bs.de";
            $params["from_name"] = "Feuerwehr Bad Soden am Taunus e.V.";
            $params["subject"] = "Ihre Ticketbestellung für die Veranstaltung 'Tanz in den Mai'";
            $params["message"] = $message;
        }
    }
}

/* End of file ticketshop.php */
/* Location: ./application/controllers/ticketshop.php */
?>