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
       
        if (!$just_count)
        {
    		foreach($data as $key => $val)
    		{
    			$data[$key]['datum_beginn'] = get_ger_date($data[$key]['datum_beginn']);
    		}
    	}
       
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
                                            'type'  => 'tagsinput',
                                            'class' => 'no_editor',
                                            'autosuggests' => fuel_model('autosuggests_model', array('find' => 'all', 'where' => array('keyword' => 'einsatz_weitere_kraefte'))),
                                            'order' => 14);      
    
        $fields["published"]["type"] = 'hidden';      
        $fields["mission_images"]["type"] = 'hidden';  
        $fields["lfd_nr"]["type"] = 'hidden';                                       
        
        return $fields;
    }
    
    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE)
    {
    	if (empty($val))
    	{
    		$val ='name';
    	}
    	$data = parent::options_list($key, $val, $where, $order);
    	return $data;
    }
    
	public function get_years()
	{
		$years = array();
		
		$query = $this->db->query('SELECT DISTINCT substring( datum_beginn, 1, 4 ) as datum FROM '.$this->db->dbprefix('missions')); 
		
		foreach ($query->result() as $row)
		{ 
			$years[] = $row->datum;
		}
		rsort($years);
		return $years;
	}
    
    public function get_statistic($types, $selected_year, $selected_type) {
        
        $statistic = array();
        foreach($types as $type) {
            $statistic[$type->id] = 0;
        }
        $statistic["all"] = 0;
        $statistic["ueberoertlich"] = 0;
        
        if($selected_type != NULL && $selected_type != "") {
            $this->db->where('type_id', $selected_type);
            if($selected_year != NULL && $selected_year != "") {
                $this->db->where('substring(datum_beginn,1,4)', $selected_year);
            } 
            $statistic[$selected_type] = $statistic["all"] = $this->db->count_all_results('missions');
            
            // überörtlich
            $this->db->where('ueberoertlich', 'yes');
            $this->db->where('type_id', $selected_type);
            if($selected_year != NULL && $selected_year != "") {
                $this->db->where('substring(datum_beginn,1,4)', $selected_year);
            } 
            $statistic["ueberoertlich"] = $this->db->count_all_results('missions');
        } else {
            foreach($types as $type) {
                $this->db->where('type_id', $type->id);
                if($selected_year != NULL && $selected_year != "") {
                    $this->db->where('substring(datum_beginn,1,4)', $selected_year);
                } 
                $statistic[$type->id] = $this->db->count_all_results('missions');  
                $statistic["all"] += $statistic[$type->id];         
            
                // überörtlich
                $this->db->where('ueberoertlich', 'yes');
                $this->db->where('type_id', $type->id);
                if($selected_year != NULL && $selected_year != "") {
                    $this->db->where('substring(datum_beginn,1,4)', $selected_year);
                } 
                $statistic["ueberoertlich"] += $this->db->count_all_results('missions');         
            }
        }
        
        return $statistic;
    }
	
    public function get_stage_text($id)
    {
        $this->db->join('mission_types', 'mission_types.id = missions.type_id');
        $this->db->select('missions.einsatz_nr as einsatz_nr, missions.name as name, mission_types.name as type_name, mission_types.class as type_class');
        $query = $this->db->get_where('missions', array('missions.id' => $id));
        $row = $query->row();
        
        $text['name']       = $row->name;
        $text['name_lang']  = $row->type_name.' (#'.$row->einsatz_nr.')';
        $text['class']   = $row->type_class;
        
        return $text;
    }

}

class Mission_model extends Abstract_module_record {
    
    
    public function is_published() {
        
        if($this->published == 'yes') return true;
        else return false;        
    }
    
    public function is_ueberoertlich() {
        
        if($this->ueberoertlich == 'yes') return true;
        else return false;        
    }
    
    public function display_ort() {
        
        if($this->ort_zeigen == 'yes') return true;
        else return false;               
    }
    
    public function get_ort() {
        
        if($this->display_ort()) {
            return parent::get_ort();
        } else {
            return "n/a";
        }
    }
    
    public function get_vehicle_count() {
        
        if(count($this->fahrzeuge) > 0) {
            return count($this->fahrzeuge); 
        } else {
            return 0; 
        }
    }
}

?>