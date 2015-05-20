<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(FUEL_PATH.'models/base_module_model.php');

class PressArticle_Sources_model extends Base_module_model {
    public $required = array('name', 'tag');
    
    function __construct() {
        parent::__construct('fw_pressarticle_sources');
    }
}

class PressArticle_Source_model extends Base_module_record {
    
}

?>