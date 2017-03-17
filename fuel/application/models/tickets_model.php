<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Tickets_model extends Abstract_module_model {

    public $unique = array('invoice_number');
    // public $required = array('invoice_number', 'order_datetime', 'last_name', 'first_name', 'email');
    public $boolean_fields = array('bezahlt');

    function __construct() {
        parent::__construct('fw_tickets');
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->order_by('order_datetime', 'desc');
        $this->db->order_by('last_name', 'desc');
        $this->db->order_by('first_name', 'desc');
        $this->db->select('id, invoice_number as rechnungsnummer, order_datetime as bestelldatum, last_name as nachname, first_name as vorname, email, quantity as anzahl, payed as bezahlt');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        return $data;
    }

    public function form_fields($values = array(), $related = array()) {
        $fields = parent::form_fields($values, $related);

        $fields["invoice_number"]['label'] = "Rechnungsnummer";
        $fields["invoice_number"]['readonly'] = TRUE;
        $fields["invoice_number"]['order'] = 1;

        $fields["order_datetime"]['label'] = "Bestelldatum";
        $fields["order_datetime"]['readonly'] = TRUE;
        $fields["order_datetime"]['date_format'] = "d.m.Y";
        $fields["order_datetime"]['ampm'] = FALSE;
        $fields["order_datetime"]['order'] = 2;

        $fields["last_name"]['label'] = "Nachname";
        $fields["last_name"]['readonly'] = TRUE;
        $fields["last_name"]['order'] = 3;

        $fields["first_name"]['label'] = "Vorname";
        $fields["first_name"]['readonly'] = TRUE;
        $fields["first_name"]['order'] = 4;

        $fields["email"]['label'] = "Emailadresse";
        $fields["email"]['readonly'] = TRUE;
        $fields["email"]['order'] = 5;

        $fields["quantity"]['label'] = "Anzahl";
        $fields["quantity"]['readonly'] = TRUE;
        $fields["quantity"]['order'] = 6;

        $fields["payed"]['label'] = "Bezahlt";
        $fields["payed"]['options'] = array('yes' => 'ja', 'no' => 'nein');
        $fields["payed"]['order'] = 7;

        $fields["notified"]["type"] = "hidden";

        return $fields;
    }

    public function get_tickets_sold() {
        $this->db->select("SUM(quantity) as sum");
        $query = $this->db->get("tickets");
        if ($query->num_rows() == 1)
            return $query->row()->sum;
        else
            return 0;
    }

    public function generate_invoice_number() {
        $this->db->select("invoice_number");
        $query = $this->db->get("tickets");
        $numbers = array();
        foreach ($query->result() as $row) {
            $numbers[] = $row->invoice_number;
        }

        while (true) {
            $number = rand(1111111111, 9999999999);
            if (!in_array($number, $numbers))
                return $number;
        }
    }

    public function on_after_update($values) {
        if ($values["payed"] == "yes" && $values["notified"] == "no") {
            $message = "Sehr geehrte(r) Frau/Herr " . $values["last_name"] . ",\n"
                    . "\n"
                    . "vielen Dank, wir haben Ihre Bezahlung für die Bestellung unter der Bestellnummer ".$values["invoice_number"]." erhalten.\n" 
                    . "Ihre ". $values["quantity"] ." Tickets erhalten Sie unter Angabe der Bestellnummer an der Abendkasse. \nBitte halten Sie auch Ihren Personalausweis zur Verifikation bereit.\n\n"
                    . "Liebe Grüße\nIhre Feuerwehr Bad Soden am Taunus";

            $params["to"] = $values["email"];
            $params["from"] = "noreply@feuerwehr-bs.de";
            $params["from_name"] = "Feuerwehr Bad Soden am Taunus e.V.";
            $params["subject"] = "Ihre Tickets für die Veranstaltung 'Tanz in den Mai'";
            $params["message"] = $message;

            $this->fuel->notification->send($params);
            
            $data["notified"] = "yes";
            $this->db->where('id', $values["id"]);
            $this->db->update('tickets', $values);
        }
    }

}

class Ticket_model extends Abstract_module_record {
    
}

?>