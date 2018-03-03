<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Mannschaft_Grades_model extends Abstract_module_model {
    
    function __construct() {
        parent::__construct('fw_mannschaft_grades');
    }
}

class Mannschaft_Grade_model extends Abstract_module_record {
    
}

?>