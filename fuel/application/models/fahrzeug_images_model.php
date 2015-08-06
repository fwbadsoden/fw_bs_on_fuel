<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Fahrzeug_Images_model extends Abstract_module_model {
        
    function __construct() {
        parent::__construct('fw_fahrzeug_images');
    }
    
}

class Fahrzeug_Image_model extends Abstract_module_record {
    
}

?>