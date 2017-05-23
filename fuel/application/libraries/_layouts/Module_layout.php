<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('Base_layout.php');

class Module_layout extends Base_layout {

    /**
     * Hook used for processing variables specific to a layout
     *
     * @access  public
     * @param   array   variables for the view
     * @return  array
     */
    function pre_process($vars) {
        $vars = parent::pre_process($vars);
        $CI = & get_instance();

        $vars["segment"] = 3;

        switch ($vars["my_module"]) {
            case "fahrzeug": 
                $CI->load->model('Fahrzeuge_model', 'fahrzeuge_model');
                
                if (strpos(uri_string(), "fahrzeuge/ausserdienst")) {
                    $vars["segment"] = 4;
                    $vars["list_where"] = array("retired" => "yes", "published" => "yes", "ist_abrollbehaelter" => "no");
                    $vars["order"] = "precedence asc";
                } else {
                    $vars["list_where"] = array("retired" => "no", "published" => "yes", "ist_abrollbehaelter" => "no");
                    $vars["order"] = "precedence asc";
                }

                if (is_numeric(uri_segment($vars["segment"]))) {
                    if ($CI->fahrzeuge_model->record_exists(array("id" => uri_segment($vars["segment"])))) {
                        $vars["stage_info"] = $CI->fahrzeuge_model->get_stage_info(uri_segment($vars["segment"]));
                        $vars["stage_info"]["stage"] = "fahrzeug";
                    } else {
                        $vars["is404"] = true;
                    }
                }

                $vars["model"] = "fahrzeuge_model";
                $vars["list_block"] = "modules/fahrzeuge_uebersicht";
                $vars["item_block"] = "modules/fahrzeuge_detail";
                break;
            case "einsatz": 
                $CI->load->model('Missions_model', 'missions_model');

                if (is_numeric(uri_segment($vars["segment"]))) {
                    if ($CI->missions_model->record_exists(array("id" => uri_segment($vars["segment"])))) {
                        $vars["stage_text"] = $CI->missions_model->get_stage_text(uri_segment($vars["segment"]));
                    } else {
                        $vars["is404"] = true;
                    }
                } else {
                    if ($CI->input->post('mission_year'))
                        $mission_year = $CI->input->post('mission_year');
                    else
                        $mission_year = date('Y');
                    if ($CI->input->post('mission_type') == 0)
                        $mission_type = "";
                    else
                        $mission_type = $CI->input->post('mission_type');

                    $vars["mission_types"] = fuel_model("mission_types_model", array('find' => 'all', 'order' => 'name asc'));
                    $vars["years"] = $CI->missions_model->get_years();
                    $vars["statistic"] = $CI->missions_model->get_statistic($vars["mission_types"], $mission_year, $mission_type);

                    if ($mission_type == "") {
                        $vars["list_where"] = array("published" => "yes", 'substring(datum_beginn,1,4)' => $mission_year);
                    } else {
                        $vars["list_where"] = array("published" => "yes", 'substring(datum_beginn,1,4)' => $mission_year, 'type_id' => $mission_type);
                    }

                    $vars["order"] = "datum_beginn desc, uhrzeit_beginn desc";
                }

                $vars["model"] = "missions_model";
                $vars["list_block"] = "modules/einsatz_uebersicht";
                $vars["item_block"] = "modules/einsatz_detail";
                break;
            case "news": 
                $CI->load->model('News_articles_model', 'news_articles_model');
                $CI->load->library('Weather', 'weather');

                if (is_numeric(uri_segment($vars["segment"]))) {
                    if ($CI->news_articles_model->record_exists(array("id" => uri_segment($vars["segment"])))) {
                        $vars["stage_text"] = $CI->news_articles_model->get_stage_text(uri_segment($vars["segment"]));
                        $vars["latest_news"] = fuel_model("news_articles_model", array('find' => 'all', 'limit' => 10, 'offset' => 0, 'where' => array('published' => 'yes', 'datum <=' => date('Y-m-d')), 'order' => 'datum desc, id desc'));
                        $vars["facebook_infos"][0] = $CI->news_articles_model->get_og_image(uri_segment($vars["segment"]));
                    } else {
                        $vars["is404"] = true;
                    }
                } else {
                    $vars["weather"] = $CI->weather->get_weather();
                    $vars["termine"] = fuel_model("appointments_model", array('find' => 'all', 'limit' => 3, 'offset' => 0, 'where' => array('published' => 'yes'), 'order' => 'datum asc, beginn asc'));
                }

                $vars["order"] = "datum desc, id desc";
                $vars["list_where"] = array('published' => 'yes', 'datum <=' => date('Y-m-d'));
                $vars["model"] = "news_articles_model";
                $vars["list_block"] = "modules/news_uebersicht";
                $vars["item_block"] = "modules/news_detail";
                break;
            case "presse":
                $vars["order"] = "datum desc";
                $vars["list_where"] = array("published" => "yes");
                $vars["model"] = "pressarticles_model";
                $vars["list_block"] = "modules/presse_uebersicht";
                $vars["item_block"] = NULL;
                break;
            case "mannschaft": 
                $CI->load->model('Mannschaft_members_model', 'mannschaft_members_model');
                $vars["team"] = $CI->mannschaft_members_model->find_team();
                $vars["fuehrung"] = $CI->mannschaft_members_model->find_fuehrung();
                $vars["external_data"] = true;
                $vars["model"] = "mannschaft_members_model";
                $vars["list_block"] = "modules/mannschaft_uebersicht";
                $vars["item_block"] = NULL;
                break;
            case "altersabteilung": 
                $CI->load->model('Mannschaft_members_model', 'mannschaft_members_model');
                $vars["alters"] = $CI->mannschaft_members_model->find_altersabteilung();
                $vars["ehren"] = $CI->mannschaft_members_model->find_ehrenabteilung();
                $vars["external_data"] = true;
                $vars["model"] = "mannschaft_members_model";
                $vars["list_block"] = "modules/altersabteilung_uebersicht";
                $vars["item_block"] = NULL;
                break;
            case "termin": 
                $CI->load->model('Appointments_model', 'appointments_model');
                $vars["termine"] = $CI->appointments_model->get_appointments();
                $vars["monate"] = $CI->appointments_model->get_months_for_filter();
                $vars["external_data"] = true;
                $vars["model"] = "appointments_model";
                $vars["list_block"] = "modules/termin_uebersicht";
                $vars["item_block"] = NULL;
                break;
            case "startseite":
                $vars["external_data"] = true;
                $vars["list_block"] = "modules/startseite";
                $vars["item_block"] = NULL;
                break;
        }

        // wenn es sich um die Detailseite des Moduls handelt, die Stage überschreiben
        if (is_numeric(uri_segment($vars["segment"])) && !$vars["is404"]) {

            // bei Fahrzeugdetailseite handle_images auf false setzen
            if ($vars["my_module"] == "fahrzeug")
                $handle_images = false;
            else
                $handle_images = true;

            $CI = & get_instance();
            $CI->load->model('Stages_model', 'stages_model');
            $stage_id = $this->fuel->page->properties('stage_id_detail');
            $vars['stage'] = $CI->stages_model->get_stage_for_frontend($stage_id, $handle_images);
        }

        return $vars;
    }

}

?>