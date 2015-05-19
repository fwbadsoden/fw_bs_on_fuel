<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');

class Stages_model extends Base_module_model {
    
    public $required = array('name', 'typeID');
    public $unique = array('name');
    public $foreign_keys = array('typeID' => 'stage_types_model');
    public $hidden_fields = array('last_modified');
    
    function __construct() {
        parent::__construct('fw_stages');
    }
    
    public function form_fields($values = array(), $related = array()) {
        
        $fields = parent::form_fields($values, $related);  
		$fields['userfile'] = array('label' => lang('form_label_file'), 'type' => 'file', 'class' => 'multifile', 'accept' => 'jpg|jpeg|png'); // key is userfile because that is what CI looks for in Upload Class
        
        return $fields;
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

class Stage_model extends Base_module_record {
    
    public function save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL) {
        
        $this->last_modified = datetime_now();
        $saved = parent::save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL);
        return $saved;
    }
}

?>