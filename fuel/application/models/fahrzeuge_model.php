<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Fahrzeuge_model extends Abstract_module_model {
        
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
       $this->db->select('id, name, rufname, precedence, retired as ausser_dienst, published');
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
        
        
        
        $fields["name_lang"]["label"] = lang("form_label_fahrzeug_name_lang");
        $fields["text_kurz"]["label"] = lang("form_label_fahrzeug_text_kurz");
        
        $fields["text"] = array('class' => 'no_editor',
                                'type' => 'textarea');
        
        $options = array('Florian Bad Soden', 'Florian Main-Taunus');
        $fields['prefix_rufname'] = array('label' => lang("form_label_fahrzeug_prefix_rufname"),
                                          'options' => $options,
                                          'type' => 'select');
        $options = array('yes' => 'ja', 'no' => 'nein');                                 
        $fields['einsaetze_zeigen'] = array('label'   => lang('form_label_fahrzeug_einsaetze_zeigen'),
                                            'type'    => 'enum',
                                            'options' => $options,
                                           );                               
        $fields['retired'] = array('label'   => lang('form_label_fahrzeug_retired'),
                                   'type'    => 'enum',
                                   'options' => $options,
                                  );
        
        return $fields;
    }
}

class Fahrzeug_model extends Abstract_module_record {
    
}

?>