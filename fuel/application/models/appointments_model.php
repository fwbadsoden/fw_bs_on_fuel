<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Appointments_model extends Abstract_module_model {
    public $required = array('category_id', 'name', 'description', 'datum', 'published');
    public $foreign_keys = array('category_id' => array(FUEL_FOLDER => 'fuel_categories_model', 'where' => array('context' => 'termin')));
    
    function __construct() {
        parent::__construct('fw_appointments');
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
        
        $fields['category_id']['label'] = lang("form_label_category");
        $fields['ort_short']['label'] = lang("form_label_appointments_shortcity");
        $fields['beginn']['ampm'] = false;
        $fields['ende']['ampm'] = false;
        $fields['description'] = array('type' => 'textarea', 'class' => 'no_editor');
        $fields['ort'] = array('type' => 'textarea', 'rows' => 3, 'class' => 'no_editor');
        return $fields;
    }   

}

class Appointment_model extends Abstract_module_record {
    
}

?>