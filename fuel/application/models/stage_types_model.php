<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Stage_Types_model extends Abstract_module_model {
    
    function __construct() {
        parent::__construct('fw_stage_types');
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
        
        $options = array('pictures', 'pictures small');
        $fields['css_outer_class'] = array('label' => lang('form_label_stagetype_css_outer_class'),
                                           'type'  => 'select', 'options' => $options);
        
        return $fields;
    }
}

class Stage_Type_model extends Abstract_module_record {
    
}

?>