<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Mission_Cues_model extends Abstract_module_model {
    public $unique = array('name');
    public $required = array('name', 'description', 'aao');
    
    function __construct() {
        parent::__construct('fw_mission_cues');
    }
    
    /**
	 * Add specific changes to the form_fields method
	 *
	 * @access	public
	 * @param	array Values of the form fields (optional)
	 * @param	array An array of related fields. This has been deprecated in favor of using has_many and belongs to relationships (deprecated)
	 * @return	array An array to be used with the Form_builder class
	 */	
    public function form_fields($values = array(), $related = array()) {
        
        $fields = parent::form_fields($values, $related);  
        
        $fields['example'] = array('label' => lang('form_label_example'),'type' => 'textarea', 'rows' => 5, 'class' => 'no_editor');
        return $fields;
    }   

}

class Mission_Cue_model extends Abstract_module_record {
}

?>