<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');

abstract class Abstract_module_model extends Base_module_model {
    
    function __construct($table = NULL, $params = NULL) {
        parent::__construct($table, $params);
    }
}

abstract class Abstract_module_record extends Base_module_record {
    
}

?>