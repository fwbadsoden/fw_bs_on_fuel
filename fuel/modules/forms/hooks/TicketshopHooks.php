<?php

class TicketshopHooks {

    private $price = "10";

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
        $ticket["title"] = $CI->input->post('title');
        $ticket["street"] = $CI->input->post('street');
        $ticket["postal_code"] = $CI->input->post('postal_code');
        $ticket["city"] = $CI->input->post('city');
        $ticket["quantity"] = $CI->input->post('quantity');
        $ticket["invoice_number"] = $CI->input->post('invoice_number');

        if ($CI->tickets_model->save($ticket)) {
            $price = number_format($ticket["quantity"] * $this->price, 2, ",", ".");
            if ($ticket["title"] == "Frau") {
                $message = "Liebe Frau " . $ticket["last_name"] . "!\n\n";
            } else {
                $message = "Lieber Herr " . $ticket["last_name"] . "!\n\n";
            }
            $message .= "Vielen Dank für Ihre Kartenbestellung bei dem Verein der Feuerwehr Bad Soden.\n"
                    . "Nachfolgend haben wir zur Kontrolle die von Ihnen aufgegebene Bestellung aufgelistet.\n\n"
                    . "Mit freundlichen Grüßen!\n"
                    . "Ihr Freiwillige Feuerwehr Bad Soden am Taunus e.V.\n\n"
                    . "Ihre bei uns gespeicherte Anschrift lautet:\n"
                    . $ticket["title"] . "\n"
                    . $ticket["first_name"] . " " . $ticket["last_name"] . "\n"
                    . $ticket["street"] . "\n"
                    . $ticket["postal_code"] . " " . $ticket["city"] . "\n\n"
                    . "Wir haben Ihre Bestellung wie folgt aufgenommen:\n"
                    . "Anzahl\t\tArtikelname\t\t\tPreis (EUR)\n"
                    . $ticket["quantity"] . "\t\tKarte(n) Tanz in den Mai\t\t\t" . $price . "\n\n"
                    . "Warenwert in EUR\t" . $price . "\n"
                    . "Alle Preise inkl. MwSt.\n\n"
                    . "Wir bitten Sie den oben genannten Betrag innerhalb von 7 Tagen auf das unten angegebene Konto zu überweisen.\n"
                    . "Sollte der Betrag nach 7 Tagen nicht eingegangen sein, wird die Bestellung automatisch storniert.\n"
                    . "Kontodaten:\n"
                    . "Freiwillige Feuerwehr Bad Soden am Taunus e.V.\n"
                    . "IBAN: DE27 5125 0000 0004 0124 45\n"
                    . "BIC: HELADEF1TSK\n\n"
                    . "Bitte verwenden Sie folgenden Verwendungszweck – " . $ticket["invoice_number"] . " –\n\n"
                    . "Vielen Dank für Ihre Bestellung wir freuen uns auf Sie.\n\n"
                    . "Ihre freiwillige Feuerwehr Bad Soden am Taunus e.V.";

            $params["to"] = $ticket["email"];
            $params["from"] = "noreply@feuerwehr-bs.de";
            $params["from_name"] = "Feuerwehr Bad Soden am Taunus e.V.";
            $params["subject"] = "Vielen Dank für Ihren Bestellung!";
            $params["message"] = $message;

            $CI->fuel->notification->send($params);
        }
    }

}
