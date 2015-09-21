<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Mannschaft_Members_model extends Abstract_module_model {
    public $required = array('name', 'vorname', 'geschlecht', 'section_id');
    public $foreign_keys = array('section_id' => 'mannschaft_sections_model',
                                 'grade_id' => 'mannschaft_grades_model',
                                 'executive_id' => 'mannschaft_executives_model',
                                 'team_id' => 'mannschaft_teams_model');
    public $boolean_fields = array('beruf_zeigen', 'geburtsdatum_zeigen', 'eintritt_zeigen', 'bild_zeigen');
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
	   $this->db->join('mannschaft_sections', 'mannschaft_sections.id = mannschaft_members.section_id');
	   $this->db->join('mannschaft_teams', 'mannschaft_teams.id = mannschaft_members.team_id');
       $this->db->order_by('mannschaft_members.section_id asc, mannschaft_members.name asc, mannschaft_members.vorname asc');
       $this->db->select('mannschaft_members.id as id, mannschaft_sections.name as abteilung, mannschaft_members.name as name, mannschaft_members.vorname as vorname, mannschaft_members.show_image as bild_zeigen, mannschaft_members.show_beruf as beruf_zeigen, mannschaft_members.show_geburtstag as geburtsdatum_zeigen, mannschaft_members.show_eintrittsdatum as eintritt_zeigen, published');
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
        
        $fields["section_id"]["label"]      = lang("form_label_mannschaft_section");
        $fields["team_id"]["label"]         = lang("form_label_mannschaft_team");
        $fields["grade_id"]["label"]        = lang("form_label_mannschaft_grade");
        $fields["grade_id"]["after_html"]   = lang("form_label_mannschaft_grade_afterhtml");
        $fields["executive_id"]["label"]    = lang("form_label_mannschaft_executive");
        $fields["executive_id"]["after_html"] = lang("form_label_mannschaft_executive_afterhtml");

         
        $fields['image'] = array('label' => lang('form_label_image'), 
                                 'folder' => 'images/mannschaft',      
                                 'accept' => 'jpg|jpeg|png',
                                 'encrypt_name' => TRUE,
                                 'type' => 'file',
                                 'overwrite' => FALSE,
                                 'display_overwrite' => FALSE,
                                 'ignore_representative' => TRUE
                                 ); 
                                 
        $fields["geburtstag"]["after_html"] = lang('form_label_mannschaft_birthdate_afterhtml');
        $fields['geburtstag']['attributes'] = 'placeholder="tt-mm-jjjj"';
        $fields["beruf"]["after_html"] = lang('form_label_mannschaft_birthdate_afterhtml');
        $fields["eintrittsdatum"]["after_html"] = lang('form_label_mannschaft_entrydate_afterhtml');
        $fields['eintrittsdatum']['attributes'] = 'placeholder="tt-mm-jjjj"';
                                 
        $options = array('yes' => 'ja', 'no' => 'nein');                                 
        $fields['show_image'] = array('label'   => lang('form_label_mannschaft_show_image'),
                                      'ignore_representative' => TRUE,
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
                                           'options'    => $options,
                                           );
        $fields['show_eintrittsdatum'] = array('label'      => lang('form_label_mannschaft_show_entrydate'),
                                           'type'       => 'enum',
                                           'options'    => $options,
                                           );
        
        $fields["published"]["type"] = "hidden";
        
        return $fields;
    }
    
    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE)
    {
    	$this->db->order_by('name asc, vorname asc');
        $this->db->select('id, name, vorname');
        $query = $this->db->get('mannschaft_members');
        
        foreach($query->result() as $row) {
            $data[$row->id] = $row->name.", ".$row->vorname;
        }
        
    	return $data;
    }

	/**
	 * Placeholder hook - for right after posting. To be used outside of 
	 * the saving process and must be called manually from your own code
	 *
	 * @access	public
	 * @param	array	values to be saved
	 * @return	array
	 */	
	public function on_after_post($values)
	{
        $values = parent::on_after_post($values);
        
        $db_record = $this->find_by_key($values["id"]);
        
        if($values["image"] != "" && $values["image"] != "dummy.jpg" && $db_record->image != $values["image"]) {
            $this->load->model('fuel_assets_model');
            $this->fuel_assets_model->delete('images/mannschaft/'.$values["image"]); 
        }
       
		return $values;
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
        if($values["image"] == "" && $values["team_id"] != 4) {
            $values["image"] = "dummy.jpg";
        }
        if($values["team_id"] == 4) {
            $values["show_image"] = "no";
        }
        if($values["geburtstag"] == "0000-00-00") {
            $values["show_geburtstag"] = "no";
        }
        if($values["eintrittsdatum"] == "0000-00-00") {
            $values["show_eintrittsdatum"] = "no";
        }
        if($values["beruf"] == "") {
            $values["show_beruf"] = "no";
        }
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
        
		parent::on_before_delete($where);
        
        // delete asset
        $this->load->model('fuel_assets_model');
        $db_record = $this->find_by_key($where["id"]);        
        $this->fuel_assets_model->delete('images/mannschaft/'.$db_record->image);
	}
    
    public function find_fuehrung() {
        
        $this->db->join('mannschaft_grades', 'mannschaft_grades.id = mannschaft_members.grade_id');
        $this->db->join('mannschaft_executives', 'mannschaft_executives.id = mannschaft_members.executive_id');
        $this->db->where(array('published' => 'yes', 'team_id' => 1, 'section_id' => 1));
        $this->db->order_by('mannschaft_executives.precedence', 'ASC');
        $this->db->order_by('name', 'ASC'); 
        $this->db->order_by('vorname', 'ASC');  
        $this->db->select('mannschaft_members.id as id,
                           mannschaft_members.name as name, 
                           mannschaft_members.vorname as vorname, 
                           mannschaft_members.image as image, 
                           mannschaft_members.show_image as show_image,
                           mannschaft_members.geschlecht as geschlecht,
                           mannschaft_members.geburtstag as geburtstag,
                           mannschaft_members.show_geburtstag as show_geburtstag,
                           mannschaft_members.show_beruf as show_beruf,
                           mannschaft_members.beruf as beruf,
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
            $m["geburtstag"] = $row->geburtstag; 
            $m["show_geburtstag"] = $row->show_geburtstag; 
            $m["beruf"] = $row->beruf; 
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
        $this->db->where(array('published' => 'yes', 'team_id' => 2, 'section_id' => 1));
        $this->db->order_by('name', 'ASC'); 
        $this->db->order_by('vorname', 'ASC');  
        $this->db->select('mannschaft_members.id as id,
                           mannschaft_members.name as name, 
                           mannschaft_members.vorname as vorname, 
                           mannschaft_members.image as image, 
                           mannschaft_members.show_image as show_image,
                           mannschaft_members.geschlecht as geschlecht,
                           mannschaft_members.geburtstag as geburtstag,
                           mannschaft_members.show_geburtstag as show_geburtstag,
                           mannschaft_members.show_beruf as show_beruf,
                           mannschaft_members.beruf as beruf,
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
            $m["geburtstag"] = $row->geburtstag; 
            $m["show_geburtstag"] = $row->show_geburtstag;
            $m["beruf"] = $row->beruf; 
            $m["show_beruf"] = $row->show_beruf; 
            $m["grade_name"] = $row->grade_name; 
            $m["grade_name_m"] = $row->grade_name_m; 
            $m["grade_name_w"] = $row->grade_name_w; 
            $m["grade_image"] = $row->grade_image; 
            
            array_push($mannschaft, $m);
        }
        
        return $mannschaft;
    }
    
    public function find_altersabteilung() {
        
        $this->db->where(array('published' => 'yes', 'team_id' => 3, 'section_id' => 2));
        $this->db->order_by('name', 'ASC'); 
        $this->db->order_by('vorname', 'ASC');  
        $this->db->select('mannschaft_members.id as id,
                           mannschaft_members.name as name, 
                           mannschaft_members.vorname as vorname, 
                           mannschaft_members.image as image, 
                           mannschaft_members.show_image as show_image,
                           mannschaft_members.eintrittsdatum as eintrittsdatum,
                           mannschaft_members.show_eintrittsdatum as show_eintrittsdatum');
        $query = $this->db->get("mannschaft_members");
        
        $mannschaft = array();
        foreach($query->result() as $row) {
            
            $m = array();
            $m["id"] = $row->id;
            $m["name"] = $row->name;
            $m["vorname"] = $row->vorname;
            $m["image"] = $row->image; 
            $m["show_image"] = $row->show_image; 
            $m["eintrittsdatum"] = $row->eintrittsdatum; 
            $m["show_eintrittsdatum"] = $row->show_eintrittsdatum; 
            
            array_push($mannschaft, $m);
        }
        
        return $mannschaft;
    }
    
    public function find_ehrenabteilung() {
        
        $this->db->where(array('published' => 'yes', 'team_id' => 4, 'section_id' => 2));
        $this->db->order_by('name', 'ASC'); 
        $this->db->order_by('vorname', 'ASC');  
        $this->db->select('mannschaft_members.id as id,
                           mannschaft_members.name as name, 
                           mannschaft_members.vorname as vorname');
        $query = $this->db->get("mannschaft_members");
        
        $mannschaft = array();
        foreach($query->result() as $row) {
            
            $m = array();
            $m["id"] = $row->id;
            $m["name"] = $row->name;
            $m["vorname"] = $row->vorname;
            
            array_push($mannschaft, $m);
        }
        
        return $mannschaft;
    }
    
	public function find_photographers()
	{
        $this->db->where(array('published' => 'yes', 'section_id' => 1));
        $this->db->order_by('vorname asc, name asc');

		$query = $this->get(TRUE, NULL, NULL);
		$data = $query->result();

		return $data;
	}
    
    public function get_mannschaft_members_anzahl_as_array() {
        
        $this->db->select('geschlecht');
        $this->db->where('section_id', 1);
        $query = $this->db->get('mannschaft_members');    
        
        $member_count["anzahl"]   = 0;
        $member_count["anzahl_m"] = 0;
        $member_count["anzahl_w"] = 0;
        
        foreach($query->result() as $row)
        {
            if($row->geschlecht == 'w')
                $member_count["anzahl_w"]++;
            else
                $member_count["anzahl_m"]++;
            $member_count["anzahl"]++;
        }
        return $member_count;
    }
}

class Mannschaft_Member_model extends Abstract_module_record {
    
    public function show_image() {
        if($this->get_show_image() == "yes") return true;
        else return false;
    } 
    
    public function show_beruf() {
        if($this->get_show_beruf() == "yes") return true;
        else return false;
    } 
    
    public function show_geburtstag() {
        if($this->get_show_geburtstag() == "yes") return true;
        else return false;
    }  
    
    public function show_eintrittsdatum() {
        if($this->get_show_eintrittsdatum() == "yes") return true;
        else return false;
    } 
}

?>