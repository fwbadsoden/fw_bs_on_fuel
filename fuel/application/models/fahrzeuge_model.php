<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Fahrzeuge_model extends Abstract_module_model {
    
    public $has_many = array('fahrzeug_images' => 'fahrzeug_images_model');
    public $belongs_to = array('missions' => 'missions_model');   
    public $boolean_fields = array('retired', 'ausser_dienst'); 
        
    function __construct() {
        parent::__construct('fw_fahrzeuge');
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
        $this->db->order_by('published', 'descending');
	    $this->db->order_by('precedence', 'ascending');
        $this->db->select('id, name, rufname, retired as ausser_dienst, published');
	    $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        if (!$just_count)
        {
    		foreach($data as $key => $val)
    		{
              //  $data[$key]['ausser_dienst'] = translate_enum($data[$key]['ausser_dienst']);
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
        
        $fields["grunddaten"] = array('type' => 'fieldset',
                                      'class' => 'tab',
                                      'label' => 'Grunddaten',
                                      'order' => 1);
                       
        $fields["name"]      = array('label' => lang("form_label_fahrzeug_name"),
                                     'order' => 2);    
                                           
        $fields["name_lang"] = array('label' => lang("form_label_fahrzeug_name_lang"),
                                     'order' => 3); 
        
        $options = array('Florian Bad Soden', 'Florian Main-Taunus');
        $fields['prefix_rufname'] = array('label' => lang("form_label_fahrzeug_prefix_rufname"),
                                          'options' => $options,
                                          'type' => 'select',
                                          'order' => 4); 
                                           
        $fields["rufname"] = array('label' => lang("form_label_fahrzeug_funkrufname"),
                                   'order' => 5); 
                                           
        $fields['setcard_image']     = array('label' => lang('form_label_fahrzeug_setcard_image'),
                                            'comment' => lang('form_comment_fahrzeug_setcard_image'),
                                            'folder' => 'images/fahrzeuge',  
                                            'hide_options' => true,
                                            'order' => 6);                                 
                                          
        $options = array('yes' => 'ja', 'no' => 'nein');                                 
        $fields['einsaetze_zeigen'] = array('label'   => lang('form_label_fahrzeug_einsaetze_zeigen'),
                                            'type'    => 'enum',
                                            'options' => $options,
                                            'order'   => 7);              
                                            
        $options = array('no' => 'nein','yes' => 'ja'); 
        $fields['retired'] = array('label'   => lang('form_label_fahrzeug_retired'),
                                   'type'    => 'enum',
                                   'options' => $options,
                                   'order' => 8); 
        
        $fields["fahrzeugdaten"] = array('type' => 'fieldset',
                                      'class' => 'tab',
                                      'label' => 'Fahrzeugdaten',
                                      'order' => 9);                                                                                                         
        
        $fields["text_stage"]= array('label' => lang("form_label_fahrzeug_text_kurz"),
                                     'class' => 'no_editor',
                                     'type' => 'textarea',
                                     'preview' => false,
                                     'order' => 10);
        
        $fields["text"] = array('class' => 'no_editor',
                                'type' => 'textarea',
                                'preview' => false,
                                'order' => 11);  
                                           
        $fields["hersteller"]['order'] = 12; 
                                           
        $fields["aufbau"]['order'] = 13; 
                                           
        $fields["baujahr"]['order'] = 14; 
        
        $options = array('1/8', '1/7', '1/5', '1/4', '1/3', '1/2', '1/1', '16' => '16 (RH Hänger)');
        $fields['besatzung'] = array('options' => $options,
                                     'type' => 'select',
                                     'order' => 15);
        
        $fields["zusatzdaten"] = array('type' => 'fieldset',
                                      'class' => 'tab',
                                      'label' => 'Zusatzdaten',
                                      'order' => 16);    
        
        $fields["pumpe"]['order'] = 17; 
        
        $fields["loeschmittel"]['order'] = 18; 
        
        $fields["besonderheit"]['order'] = 20;    
        
        $fields["fahrzeugwerte"] = array('type' => 'fieldset',
                                      'class' => 'tab',
                                      'label' => 'Fahrzeugwerte',
                                      'order' => 21);      
        
        $fields["kw"] = array('label' => lang("form_label_fahrzeug_kw"),
                                 'after_html' => 'KW',
                                 'order' => 22);
        
        $fields["ps"] = array('label' => lang("form_label_fahrzeug_ps"),
                                 'after_html' => 'PW',
                                 'order' => 23);
        
        $fields["hoehe"] = array('label' => lang("form_label_fahrzeug_hoehe"),
                                 'after_html' => 'm',
                                 'order' => 24);
        
        $fields["breite"] = array('label' => lang("form_label_fahrzeug_breite"),
                                  'after_html' => 'm',
                                  'order' => 25);
        
        $fields["laenge"] = array('label' => lang("form_label_fahrzeug_laenge"),
                                  'after_html' => 'm',
                                  'order' => 26);
        
        $fields["gesamtmasse"] = array('after_html' => 't',
                                       'order' => 27);
        
        $fields["leermasse"] = array('after_html' => 't',
                                     'order' => 28);     
                                     
        $fields["precedence"]["type"] = 'hidden';  
        $fields["published"]["type"] = 'hidden';
        $fields["fahrzeug_images"]["type"] = 'hidden';       
        $fields["missions"]["type"] = 'hidden';                                            
        
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
    
    public function get_mission_vehicle_list() {
        
        $this->db->order_by('precedence asc');
        $this->db->select('id, name');
        $this->db->where(array('published' => 'yes', 'retired' => 'no'));
        $query = $this->db->get('fahrzeuge');
        return $query->result_assoc_array('id');
    }
    
    public function has_retired() {
        
        $this->db->where('published', 'yes');
        $this->db->where('retired', 'yes');
        $query = $this->db->get('fahrzeuge');
        
        if($query->num_rows() > 0)
            return true;
        else 
            return false;
        
    }
    
    public function get_fahrzeugliste($ad) {
        
        if($ad) {
            $this->db->where(array("retired" => "yes", "published" => "yes"));
        } else {
            $this->db->where(array("retired" => "no", "published" => "yes"));
        }
        $this->db->order_by('precedence', 'ascending');
        $this->db->select("name, name_lang, id");
        $query = $this->db->get("fahrzeuge");
        $fahrzeuge = array();
        
        foreach($query->result() as $row) {
            array_push($fahrzeuge, $row);
        }
        
        return $fahrzeuge;
    }
    
    public function get_stage_text($id) {
        
        $this->db->where("id", $id);
        $this->db->select("name, name_lang, text_stage");
        $query = $this->db->get('fahrzeuge');
        $row = $query->row();
        $text['name']       = $row->name;
        $text['name_lang']  = $row->name_lang;
        $text['text_stage'] = $row->text_stage;
        
        return $text;
    }
    
    public function get_fahrzeug_anzahl()
    {
        $this->db->where('published', 'yes');
        $this->db->where('retired', 'no');
        return $this->db->count_all_results("fahrzeuge");
    }
}

class Fahrzeug_model extends Abstract_module_record {
    
    public function is_retired() {
        
        if($this->retired == 'yes') return true;
        else return false;
    }
    
    public function is_published() {
        
        if($this->published == 'yes') return true;
        else return false;        
    }
}

?>