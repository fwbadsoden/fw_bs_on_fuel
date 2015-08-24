<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Missions_model extends Abstract_module_model {
    
    public $required = array('name', 'datum_beginn', 'uhrzeit_beginn', 'datum_ende', 'uhrzeit_ende', 'lage', 'anzahl_kraefte', 'bericht', 'cue_id', 'type_id');
    public $foreign_keys = array('cue_id' => 'mission_cues_model', 'type_id' => 'mission_types_model');
    public $has_many = array('mission_images' => 'mission_images_model', 'fahrzeuge' => 'fahrzeuge_model');
    public $filters = array('name', 'datum_beginn', 'ort');
        
    function __construct() {
        parent::__construct('fw_missions');
    }
    
    /**
	 * Lists the module's items
	 *
	 * @access	public
	 * @param	int The limit value for the list data (optional)
	 * @param	int The offset value for the list data (optional)
	 * @param	string The field name to order by (optional)
	 * @param	string The sorting order (optional)
	 * @param	boolean Determines whether the result is just an integer of the number of records or an array of data (optional)
	 * @return	mixed If $just_count is true it will return an integer value. Otherwise it will return an array of data (optional)
	 */	
	public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE)
	{
	   $this->db->order_by('datum_beginn', 'desc');
	   $this->db->order_by('uhrzeit_beginn', 'desc');
       $this->db->select('id, datum_beginn, uhrzeit_beginn, name, ort, published');
	   $data = parent::list_items($limit, $offset, $col, $order, $just_count);
       
       return $data;   
    }
    
    /**
	 * Add specific changes to the form_fields method
	 *
	 * @access	public
	 * @param	array Values of the form fields (optional)
	 * @param	array An array of related fields. This has been deprecated in favor of using has_many and belongs to relationships (deprecated)
	 * @return	array An array to be used with the Form_builder class
	 */	
    public function form_fields($values = array(), $related = array()) {
        
        $fields = parent::form_fields($values, $related); 
        $fields["einsatzdaten"]     = array('type' => 'fieldset',
                                            'label' => 'Einsatzdaten',
                                            'order' => 1);
                               
        $fields["einsatz_nr"]       = array('readonly' => true,  
                                            'order' => 2);  
        if(!isset($value["einsatz_nr"])) {
            $fields["einsatz_nr"]["value"] = "wird automatisch vergeben";
        }                                          
        
        $fields["type_id"]          = array('order' => 3); 
        
        $options = array('yes' => 'ja', 'no' => 'nein');   
        $fields["ueberoertlich"]          = array('label'   => lang('form_label_einsatz_art'),
                                            'type'    => 'enum',
                                            'options' => $options,
                                            'order'   => 4);   
                                           
        $fields["name"]             = array('order' => 5); 
        
        $fields['datum_beginn']     = array('order' => 6); 
                                           
        $fields["uhrzeit_beginn"]   = array('order' => 7); 
                                                                     
        $fields['datum_ende']       = array('order' => 8);              
                                            
        $fields['uhrzeit_ende']     = array('order' => 9); 
        
        $fields["anzahl_kraefte"]   = array('label' => lang("form_label_einsatz_anzahl_kraefte"),
                                            'after_html' => 'Personen',
                                            'order' => 10);
        
        $fields["anzahl_einsaetze"] = array('order' => 11);
        
        $fields["ort"]              = array('label' => lang("form_label_einsatz_ort"),
                                            'type'  => 'textarea',
                                            'class' => 'no_editor',
                                            'order' => 11);                                                                                                         
        
        $fields["lage"]             = array('label' => lang("form_label_einsatz_lage"),
                                            'type'  => 'textarea',
                                            'class' => 'no_editor',
                                            'order' => 12);                                                                                                     
        
        $fields["bericht"]          = array('label' => lang("form_label_einsatz_bericht"),
                                            'type'  => 'textarea',
                                            'class' => 'no_editor',
                                            'order' => 13);                                                                                                  
        
        $fields["weitere_kraefte"]  = array('label' => lang("form_label_einsatz_weiterekraefte"),
                                            'type'  => 'textarea',
                                            'class' => 'no_editor',
                                            'order' => 14);      
    
        $fields["published"]["type"] = 'hidden';      
        $fields["mission_images"]["type"] = 'hidden';  
        $fields["lfd_nr"]["type"] = 'hidden';                                       
        
        return $fields;
    }

}

class Mission_model extends Abstract_module_record {
    

}

?>