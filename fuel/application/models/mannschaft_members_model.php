<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Mannschaft_Members_model extends Abstract_module_model {
    public $required = array('name', 'vorname', 'geschlecht');
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
                                 'folder' => 'images/mannschaft',      
                                 'accept' => 'jpg|jpeg|png',
                                 'encrypt_name' => true,
                                 'type' => 'file',
                                 'overwrite' => true,
                                 'ignore_representative' => true,
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
    
    public function find_fuehrung() {
        
        $this->db->join('mannschaft_grades', 'mannschaft_grades.id = mannschaft_members.grade_id');
        $this->db->join('mannschaft_executives', 'mannschaft_executives.id = mannschaft_members.executive_id');
        $this->db->where(array('published' => 'yes', 'team_id' => 1));
        $this->db->order_by('mannschaft_executives.precedence', 'ASC');
        $this->db->order_by('name', 'ASC'); 
        $this->db->order_by('vorname', 'ASC');  
        $this->db->select('mannschaft_members.id as id,
                           mannschaft_members.name as name, 
                           mannschaft_members.vorname as vorname, 
                           mannschaft_members.image as image, 
                           mannschaft_members.show_image as show_image,
                           mannschaft_members.geschlecht as geschlecht,
                           mannschaft_members.geburtstag as geburstag,
                           mannschaft_members.show_geburtstag as show_geburtstag,
                           mannschaft_members.show_beruf as show_beruf,
                           mannschaft_grades.name as grade_name,
                           mannschaft_grades.name_m as grade_name_m,
                           mannschaft_grades.name_w as grade_name_w,
                           mannschaft_grades.image as grade_image,
                           mannschaft_executives.name as executive_name');
        $query = $this->db->get("mannschaft_members");
        
        $mannschaft = array();
        foreach($query->result() as $row) {
            
            $m = array();
            $m["id"] = $row->id;
            $m["name"] = $row->name;
            $m["vorname"] = $row->vorname;
            $m["image"] = $row->image; 
            $m["show_image"] = $row->show_image; 
            $m["geschlecht"] = $row->geschlecht; 
            $m["geburstag"] = $row->geburstag; 
            $m["show_geburtstag"] = $row->show_geburtstag; 
            $m["show_beruf"] = $row->show_beruf; 
            $m["grade_name"] = $row->grade_name; 
            $m["grade_name_m"] = $row->grade_name_m; 
            $m["grade_name_w"] = $row->grade_name_w; 
            $m["grade_image"] = $row->grade_image; 
            $m["executive_name"] = $row->executive_name; 
            
            array_push($mannschaft, $m);
        }
        
        return $mannschaft;
    }
    
    public function find_team() {
        
        $this->db->join('mannschaft_grades', 'mannschaft_grades.id = mannschaft_members.grade_id');
        $this->db->where(array('published' => 'yes', 'team_id' => 2));
        $this->db->order_by('name', 'ASC'); 
        $this->db->order_by('vorname', 'ASC');  
        $this->db->select('mannschaft_members.id as id,
                           mannschaft_members.name as name, 
                           mannschaft_members.vorname as vorname, 
                           mannschaft_members.image as image, 
                           mannschaft_members.show_image as show_image,
                           mannschaft_members.geschlecht as geschlecht,
                           mannschaft_members.geburtstag as geburstag,
                           mannschaft_members.show_geburtstag as show_geburtstag,
                           mannschaft_members.show_beruf as show_beruf,
                           mannschaft_grades.name as grade_name,
                           mannschaft_grades.name_m as grade_name_m,
                           mannschaft_grades.name_w as grade_name_w,
                           mannschaft_grades.image as grade_image');
        $query = $this->db->get("mannschaft_members");
        
        $mannschaft = array();
        foreach($query->result() as $row) {
            
            $m = array();
            $m["id"] = $row->id;
            $m["name"] = $row->name;
            $m["vorname"] = $row->vorname;
            $m["image"] = $row->image; 
            $m["show_image"] = $row->show_image; 
            $m["geschlecht"] = $row->geschlecht; 
            $m["geburstag"] = $row->geburstag; 
            $m["show_geburtstag"] = $row->show_geburtstag; 
            $m["show_beruf"] = $row->show_beruf; 
            $m["grade_name"] = $row->grade_name; 
            $m["grade_name_m"] = $row->grade_name_m; 
            $m["grade_name_w"] = $row->grade_name_w; 
            $m["grade_image"] = $row->grade_image; 
            
            array_push($mannschaft, $m);
        }
        
        return $mannschaft;
    }
    
	/**
	 * Hook - right before saving of data
	 *
	 * @access	public
	 * @param	array	values to be saved
	 * @return	array
	 */	
	public function on_before_save($values)
	{
		return $values;
	}
    
    /**
	 * Placeholder hook - right before delete
	 *
	 * @access	public
	 * @param	array	where condition for deleting
	 * @return	void
	 */	
	public function on_before_delete($where)
	{
       // internal_debug($where);
		parent::on_before_delete($where);
        
        // delete asset
	}
}

class Mannschaft_Member_model extends Abstract_module_record {
    
}

?>