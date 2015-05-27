<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Mannschaft_Members_model extends Abstract_module_model {
    public $required = array('section_id', 'grade_id', 'executive_id', 'team_id', 'name', 'vorname', 'geschlecht');
    public $foreign_keys = array('section_id' => 'mannschaft_sections_model',
                                 'grade_id' => 'mannschaft_grades_model',
                                 'executive_id' => 'mannschaft_executives_model',
                                 'team_id' => 'mannschaft_teams_model');
    
    function __construct() {
        parent::__construct('fw_mannschaft_members');
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
         
        $fields['image'] = array('label' => lang('form_label_image'), 
                                 'folder' => 'mannschaft',      
                                 'accept' => 'jpg|jpeg|png',
                                 'type' => 'asset',
                                 'hide_image_options' => false,
                                 'is_image' => true); 
        $fields['show_image']['label'] = lang('form_label_mannschaft_show_image');
        $fields['show_image']['type'] = 'enum';
        $fields['show_beruf']['label'] = lang('form_label_mannschaft_show_job');
        $fields['show_beruf']['type'] = 'enum';
        $fields['show_geburtstag']['label'] = lang('form_label_mannschaft_show_birthday');
        $fields['show_geburtstag']['type'] = 'enum';
        //internal_debug($fields);
        
        return $fields;
    }
}

class Mannschaft_Member_model extends Abstract_module_record {
    
}

?>