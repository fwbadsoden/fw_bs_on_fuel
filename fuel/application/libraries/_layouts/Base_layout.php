<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once(FUEL_PATH . 'libraries/Fuel_layouts.php');

class Base_layout extends Fuel_layout {

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
        $CI->load->model('Stages_model', 'stages_model');

        // 404
        $vars["is404"] = false;

        // Stage für Inhaltsseite laden   
        $stage_id = $this->fuel->page->properties('stage_id');
        $stage = $CI->stages_model->get_stage_for_frontend($stage_id, true);
        $vars['stage'] = $stage;

        // Navigation
        $vars['main_navigation'] = main_navigation();
        return $vars;
    }

    /**
     * Placeholder hook - used for processing the final output one last time
     *
     * @access	public
     * @param	string	final processed output
     * @return	string
     */
    public function post_process($output) {
        $output = parent::post_process($output);
        return $output;
    }

}

?>