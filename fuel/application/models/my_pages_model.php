<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
    
require_once(FUEL_PATH.'models/fuel_pages_model.php');    
    
class MY_pages_model extends fuel_pages_model {
    
    public $foreign_keys = array('stage_id' => 'stages_model', 'stage_id_detail' => 'stages_model');
    public $required = array('stage_id', 'location');
    
    function __construct() {
        parent::__construct( );
    }
    
    public function form_fields($values = array(), $related = array()) {        
        $fields = parent::form_fields($values = array(), $related = array());
       
        $fields["stage_id"]["label"] = "Bildbühne (Hauptseite)";
        $fields["stage_id_detail"]["label"] = "Bei Modulseiten Bildbühne für die Detailsicht";
        unset($fields["navigation_label"]);
        
        return $fields;
    }
}
?>