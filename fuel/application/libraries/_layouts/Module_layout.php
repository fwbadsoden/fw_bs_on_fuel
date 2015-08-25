<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('Base_layout.php');

class Module_layout extends Base_layout {

    /**
     * Hook used for processing variables specific to a layout
     *
     * @access  public
     * @param   array   variables for the view
     * @return  array
     */
    function pre_process($vars)
    { 
        $vars = parent::pre_process($vars);
        $CI =& get_instance();
        
        $vars["segment"] = 3;
        
        switch($vars["my_module"]) {
            case "homepage":  
                                $vars["external_data"] = true;
                                $vars["model"]      = NULL;
                                $vars["list_block"] = "modules/homepage";
                                $vars["item_block"] = NULL;
                                break;  
            case "fahrzeug":    $CI->load->model('fahrzeuge_model');
            
                                if(strpos(uri_string(), "fahrzeuge/ausserdienst")) {
                                    $vars["segment"] = 4;
                                    $vars["list_where"] = array("retired" => "yes", "published" => "yes");
                                    $vars["fahrzeugliste"] = $CI->fahrzeuge_model->get_fahrzeugliste(TRUE);
                                } else {
                                    $list_where = array("retired" => "no", "published" => "yes");
                                    $vars["fahrzeugliste"] = $CI->fahrzeuge_model->get_fahrzeugliste(FALSE);                                   
                                }
                                                                
                                if(is_numeric(uri_segment($vars["segment"]))) {
                                    $vars["stage_text"] = $CI->fahrzeuge_model->get_stage_text(uri_segment($vars["segment"]));
                                }
                                
                                $vars["model"]      = "fahrzeuge_model";
                                $vars["list_block"] = "modules/fahrzeuge_uebersicht";
                                $vars["item_block"] = "modules/fahrzeuge_detail";
                                break;
            case "einsatz":     
                                
                                $vars["model"]      = "missions_model";
                                $vars["list_block"] = "modules/einsatz_uebersicht";
                                $vars["item_block"] = "modules/einsatz_detail";
                                break;
            case "news":        
                                
                                $vars["model"]      = "news_model";
                                $vars["list_block"] = "modules/news_uebersicht";
                                $vars["item_block"] = "modules/news_detail";
                                break;
            case "presse":      
                                $vars["order"]      = "datum desc";
                                $vars["list_where"] = array("published" => "yes");
                                $vars["model"]      = "pressarticles_model";
                                $vars["list_block"] = "modules/presse_uebersicht";
                                $vars["item_block"] = NULL;
                                break;
            case "mannschaft":  $CI->load->model("mannschaft_members_model");
                                $vars["team"]       = $CI->mannschaft_members_model->find_team();
                                $vars["fuehrung"]   = $CI->mannschaft_members_model->find_fuehrung();
                                $vars["external_data"] = true;
                                $vars["model"]      = "mannschaft_members_model";
                                $vars["list_block"] = "modules/mannschaft_uebersicht";
                                $vars["item_block"] = NULL;
                                break;
            case "termin":      $CI->load->model("appointments_model");
                                $vars["termine"]    = $CI->appointments_model->get_appointments();
                                $vars["monate"]     = $CI->appointments_model->get_months_for_filter();
                                $vars["external_data"] = true;
                                $vars["model"]      = "appointments_model";
                                $vars["list_block"] = "modules/termin_uebersicht";
                                $vars["item_block"] = NULL;
                                break;
        }
        
        // wenn es sich um die Detailseite des Moduls handelt, die Stage überschreiben
        if(is_numeric(uri_segment($vars["segment"]))) {
        
            $CI =& get_instance();
            $CI->load->model('stages_model');
            $stage_id = $this->fuel->page->properties('stage_id_detail');
            $vars['stage'] = $CI->stages_model->get_stage_for_frontend($stage_id);
        }  
        
        return $vars;                         
    } 
}

?>