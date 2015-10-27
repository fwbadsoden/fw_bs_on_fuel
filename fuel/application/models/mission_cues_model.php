<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Mission_Cues_model extends Abstract_module_model {
    public $unique = array('name');
    public $required = array('name', 'description');
    
    function __construct() {
        parent::__construct('fw_mission_cues');
    }
}

class Mission_Cue_model extends Abstract_module_record {
    
}

?>