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
        $CI->load->model('stages_model');
        
        switch($vars["my_module"]) {
            case "fahrzeug": break;
            case "einsatz": break;
            case "news": break;
            case "presse": break;
            case "mannschaft": break;
            case "termin": break;
        }
        
        // Stage für Modulseite laden   
        $stage_id = $this->fuel->page->properties('stage_id_detail');
        $stage = $CI->stages_model->get_stage_for_frontend($stage_id);
        $vars['stage_overview'] = $vars['stage'];
        $vars['stage_detail'] = $stage;       
        
               
    }
    
}

?>