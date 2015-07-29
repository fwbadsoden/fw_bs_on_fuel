<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'libraries/Fuel_layouts.php');

class Main_layout extends Fuel_layout {
    
    /**y
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
        $stage = fuel_model('stages', array('find' => 'one', 'where' => array('id' => $stage_id)));

        $vars['stage'] = $stage;
               
        // Navigation
        $main_nav = main_navigation();
        $vars['main_nav'] = $main_nav;
        
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
}

?>