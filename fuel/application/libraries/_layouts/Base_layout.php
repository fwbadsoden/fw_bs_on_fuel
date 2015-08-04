<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'libraries/Fuel_layouts.php');

class Base_layout extends Fuel_layout {

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
        
        // Stage für Inhaltsseite laden   
        $stage_id = $this->fuel->page->properties('stage_id');
        $stage = $CI->stages_model->get_stage_for_frontend($stage_id);
        $vars['stage'] = $stage;
               
        // Navigation
        $vars['main_navigation'] = $this->get_main_navigation();
        return $vars;
    }    
    
    /**
	 * Placeholder hook - used for processing the final output one last time
	 *
	 * @access	public
	 * @param	string	final processed output
	 * @return	string
	 */	
	public function post_process($output)
	{
        $output = parent::post_process($output);       
        
		return $output;
	}
    
    private function get_main_navigation() {
        
        $CI =& get_instance();
        
        $CI->load->model('mannschaft_members_model', 'mannschaft');
        $CI->load->model('fahrzeuge_model', 'fahrzeuge');
      //  $CI->load->model('news_model', 'news');
      //  $CI->load->model('missions_model', 'missions');
        $CI->load->model('pressarticles_model', 'pressarticles');
        
        $nav["fahrzeuge"] = $CI->fahrzeuge->find_all(NULL, 'precedence asc');
        $nav["fahrzeuge_hasretired"] = $CI->fahrzeuge->has_retired();
        $nav["mannschaft_leader"] = $CI->mannschaft->find_fuehrung();
        $nav["mannschaft_team"] = $CI->mannschaft->find_team();
        
        return $nav;
    }
}

?>