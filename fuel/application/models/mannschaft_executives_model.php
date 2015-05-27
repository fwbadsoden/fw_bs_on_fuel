<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Mannschaft_Executives_model extends Abstract_module_model {
    
    function __construct() {
        parent::__construct('fw_mannschaft_executives');
    }
}

class Mannschaft_Executive_model extends Abstract_module_record {
    
}

?>