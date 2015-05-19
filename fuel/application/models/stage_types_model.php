<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');

class Stage_Types_model extends Base_module_model {
    
    function __construct() {
        parent::__construct('fw_stage_types');
    }
}

class Stage_Type_model extends Base_module_record {
    
}

?>