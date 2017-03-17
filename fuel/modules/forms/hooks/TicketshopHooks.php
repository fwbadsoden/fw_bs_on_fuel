<?php

class TicketshopHooks {

    private $price = "10", $due_days = 5;

    public function pre_process_forms() {
        $CI = & get_instance();
        $CI->load->model('tickets_model');
        $_POST['invoice_number'] = $CI->tickets_model->generate_invoice_number();
    }

    public function post_process_forms() {
        $CI = & get_instance();
        $CI->load->model('tickets_model');

        $ticket["order_datetime"] = date('Y-m-d H:i:s');
        $ticket["last_name"] = $CI->input->post('last_name');
        $ticket["first_name"] = $CI->input->post('first_name');
        $ticket["email"] = $CI->input->post('email');
        $ticket["quantity"] = $CI->input->post('quantity');
        $ticket["invoice_number"] = $CI->input->post('invoice_number');

        $CI->tickets_model->save($ticket);
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
                . "Nach Eingang der Zahlung auf unserem Konto erhalten Sie eine Bestätigungsmail mit weiteren Infos.\n\n"
                . "Liebe Grüße\nIhre Feuerwehr Bad Soden am Taunus";

        $params["to"] = $ticket["email"];
        $params["from"] = "noreply@feuerwehr-bs.de";
        $params["from_name"] = "Feuerwehr Bad Soden am Taunus e.V.";
        $params["subject"] = "Ihre Ticketbestellung für die Veranstaltung 'Tanz in den Mai'";
        $params["message"] = $message;

        $CI->fuel->notification->send($params);
    }

}
