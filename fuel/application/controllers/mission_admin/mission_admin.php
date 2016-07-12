<?php

/**
 * Mission Admin
 * Controller für die Verwaltung der Einsätze
 *
 * @author Habib Pleines <habib@familiepleines.de>
 * @copyright 
 * @version 2016
 * @access public
 */
class Mission_Admin extends CI_Controller {

    /**
     * Einsatz_Admin::json_get_einsatz_template()
     * JSON call get_template für Einsatzerstellung
     * 
     * @param integer $id
     * @return
     */
    public function json_get_einsatz_template($id) {
        
        $template = fuel_model('mission_templates', array('find' => 'one', 'where' => array('id' => $id)));
      //  internal_debug($template);
        //build the JSON array for return
        $vehicles = "";
        foreach($template->fahrzeuge as $fahrzeug) {
            if($vehicles == "") {
                $vehicles = $fahrzeug->id;
            } else {
                $vehicles.="|".$fahrzeug->id;
            }
        }       
        
        $json = array(array('field' => 'name',     'value' => $template->name),
                      array('field' => 'lage', 'value' => $template->lage),
                      array('field' => 'bericht', 'value' => $template->bericht),
                      array('field' => 'ort', 'value' => $template->ort),
                      array('field' => 'weitere_kraefte', 'value' => $template->weitere_kraefte),
                      array('field' => 'type_id',      'value' => $template->type_id),
                      array('field' => 'cue_id',      'value' => $template->cue_id),
                      array('field' => 'vehicles',  'value' => $vehicles)
        );
        echo json_encode($json);
    }

}

?>