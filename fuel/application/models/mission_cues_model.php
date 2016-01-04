<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Mission_Cues_model extends Abstract_module_model {
    public $unique = array('name');
    public $required = array('name', 'description');
    
    function __construct() {
        parent::__construct('fw_mission_cues');
    }
    
    public function get_mission_cue_list() {
        
        $this->db->order_by('name asc');
        $this->db->select('id, name');
        $this->db->where(array('published' => 'yes'));
        $query = $this->db->get('mission_cues');
        return $query->result_assoc_array('id');
    }
}

class Mission_Cue_model extends Abstract_module_record {
    
}

?>