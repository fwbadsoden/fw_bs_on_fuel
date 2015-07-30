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
	 * Lists the module's items
	 *
	 * @access	public
	 * @param	int The limit value for the list data (optional)
	 * @param	int The offset value for the list data (optional)
	 * @param	string The field name to order by (optional)
	 * @param	string The sorting order (optional)
	 * @param	boolean Determines whether the result is just an integer of the number of records or an array of data (optional)
	 * @return	mixed If $just_count is true it will return an integer value. Otherwise it will return an array of data (optional)
	 */	
	public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE)
	{
	   $this->db->join('mannschaft_teams', 'mannschaft_teams.id = mannschaft_members.team_id');
       $this->db->select('mannschaft_members.id as id, mannschaft_members.name as name, mannschaft_members.vorname as vorname, mannschaft_teams.name as bereich, published');
	   $data = parent::list_items($limit, $offset, $col, $order, $just_count);
       
       return $data;   
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
        
        $fields["section_id"]["label"] = lang("form_label_mannschaft_section");
        $fields["team_id"]["label"] = lang("form_label_mannschaft_team");
        $fields["grade_id"]["label"] = lang("form_label_mannschaft_grade");
        $fields["executive_id"]["label"] = lang("form_label_mannschaft_executive");

         
        $fields['image'] = array('label' => lang('form_label_image'), 
                                 'folder' => 'mannschaft',      
                                 'accept' => 'jpg|jpeg|png',
                                 'type' => 'asset',
                                 'hide_image_options' => false 
                                 ); 
        $options = array('yes' => 'ja', 'no' => 'nein');                                 
        $fields['show_image'] = array('label'   => lang('form_label_mannschaft_show_image'),
                                      'ignore_representative' => true,
                                      'type'    => 'enum',
                                      'options' => $options,
                                      'mode'    => 'radios'
                                     );
        $fields['show_beruf'] = array('label'   => lang('form_label_mannschaft_show_job'),
                                      'type'    => 'enum',
                                      'options' => $options
                                      );
        $fields['show_geburtstag'] = array('label'      => lang('form_label_mannschaft_show_birthday'),
                                           'type'       => 'enum',
                                           'options'    => $options
                                           );
        //internal_debug($fields);
        
        return $fields;
    }
}

class Mannschaft_Member_model extends Abstract_module_record {
    
}

?>