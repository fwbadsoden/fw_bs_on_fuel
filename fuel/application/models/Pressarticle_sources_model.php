<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('abstract_module_model.php');

class PressArticle_Sources_model extends Abstract_module_model {
    public $required = array('name');
    public $unique = array('name');
    
    function __construct() {
        parent::__construct('fw_pressarticle_sources');
    }
}

class PressArticle_Source_model extends Abstract_module_record {
    
}

?>