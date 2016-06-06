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
        
        $this->load->model('missions_model');
        $template = $this->missions_model->get_template($id);
        
        //build the JSON array for return
        $json = array(array('field' => 'title',     'value' => $template['title']),
                      array('field' => 'situation', 'value' => $template['situation']),
                      array('field' => 'type',      'value' => $template['type']),
                      array('field' => 'vehicles',  'value' => $template['vehicles'])
        );
        echo json_encode($json);
    }

}

?>