<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');

class PressArticles_model extends Base_module_model {
    
    function __construct() {
        parent::__construct('fw_pressarticles');
    }
    
    public function form_fields($values = array(), $related = array()) {
        
        $fields = parent::form_fields($values, $related);  
		$fields['userfile'] = array('label' => lang('form_label_file'), 'type' => 'file', 'class' => 'file', 'accept' => 'jpg|jpeg|png|pdf'); // key is userfile because that is what CI looks for in Upload Class
        
        return $fields;
    }
}

class PressArticle_model extends Base_module_record {
    
}

?>