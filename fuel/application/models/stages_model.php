<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Stages_model extends Abstract_module_model {
    
    public $required = array('name', 'typeID');
    public $unique = array('name');
    public $foreign_keys = array('typeID' => 'stage_types_model');
    public $hidden_fields = array('last_modified');
    
    function __construct() {
        parent::__construct('fw_stages');
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
		$fields['userfile'] = array('label' => lang('form_label_file'), 'type' => 'file', 'class' => 'multifile', 'accept' => 'jpg|jpeg|png'); // key is userfile because that is what CI looks for in Upload Class
        
        return $fields;
    }
    
    public function get_stage_from_page_id($id) {
        
        $this->db->select('t1.id as id, t1.name as stage_name, t1.randomize as randomize, t1.randomize_count as randomize_count,
                           t3.name as type_name, t3.file as file, t3.css_inner_class as css_inner_class, t3.css_outer_class as css_outer_class,
                           t3.css_wrapper_class as css_wrapper_class, t3.css_slidewrapper_class as css_slidewrapper_class');
        $this->db->from('stages as t1');
        $this->db->join('stage_mapping as t2', 't2.stage_id = t1.id');
        $this->db->join('stage_types as t3', 't1.typeID = t3.id');
        $this->db->where(array('t2.page_id' => $id, 't1.published' => 'yes'));
        $query = $this->db->get();
        $row = $query->row();
      
        $stage['id']                        = $row->id;
        $stage["stage_name"]                = $row->stage_name;
        $stage["randomize"]                 = $row->randomize;
        $stage["randomize_count"]           = $row->randomize_count;
        $stage["type_name"]                 = $row->type_name;
        $stage["file"]                      = $row->file;
        $stage["css_inner_class"]           = $row->css_inner_class;
        $stage["css_outer_class"]           = $row->css_outer_class;
        $stage["css_wrapper_class"]         = $row->css_wrapper_class;
        $stage["css_slidewrapper_class"]    = $row->css_slidewrapper_class;
        $stage["images"]                    = array();
        
        $this->db->where(array('stageID' => $row->id));
        $this->db->order_by('precedence', 'ascending');
        $query2 = $this->db->get('stage_images');
        foreach($query2->result() as $row2) {
            $image['file']              = $row2->file;
            $image['text_1']            = $row2->text_1;
            $image['text_2']            = $row2->text_2;
            $image['text_3']            = $row2->text_3;
            $image['link']              = $row2->link;
            $image['css_inner_class']   = $row2->css_inner_class;
            $image['css_outer_class']   = $row2->css_outer_class;
            $image['css_text_class_1']  = $row2->css_text_class_1;
            $image['css_text_class_2']  = $row2->css_text_class_2;
            $image['css_text_class_3']  = $row2->css_text_class_3;
            
            array_push($stage['images'], $image);
        }
        
        return $stage;
    }
    
    public function get_stage_options() {
        
        $this->db->where(array('published' => 'yes'));
        $query = $this->db->get('stages');
        $options = array();
        
        if($query->num_rows() == 0) {
            $options[0] = "Keine Bildbühnen vorhanden";
        }
        
        foreach($query->result() as $row) {
            $options[$row->id] = $row->name;
        }
        
        return $options;
    }
    
    public function create_update_stage_mapping($page_id, $stage_id) {
        
        $this->db->where(array('page_id' => $page_id));
        $query = $this->db->get('stage_mapping');
        if($query->num_rows() == 0)
            $this->db->insert('stage_mapping', array('page_id' => $page_id, 'stage_id' => $stage_id));
        else
            $this->db->update('stage_mapping', array('stage_id' => $stage_id), array('page_id' => $page_id));
    }
}

class Stage_model extends Abstract_module_record {
    
    public function save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL) {
        
        $this->last_modified = datetime_now();
        $saved = parent::save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL);
        return $saved;
    }
}

?>