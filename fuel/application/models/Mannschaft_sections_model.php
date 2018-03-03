<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Mannschaft_Sections_model extends Abstract_module_model {
    
    function __construct() {
        parent::__construct('fw_mannschaft_sections');
    }
}

class Mannschaft_Section_model extends Abstract_module_record {
    
}

?>