<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Appointments_model extends Abstract_module_model {
    public $required = array('category_id', 'name', 'description', 'datum', 'published');
    public $foreign_keys = array('category_id' => array(FUEL_FOLDER => 'fuel_categories_model', 'where' => array('context' => 'termin')));
    
    function __construct() {
        parent::__construct('fw_appointments');
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
	    $this->db->order_by('datum desc, beginn desc');
	    $this->db->join('categories', 'categories.id = appointments.category_id');
        $this->db->select('appointments.id as id, categories.name as kategorie, appointments.name, appointments.datum, appointments.beginn, appointments.ort, appointments.published');
	    $data = parent::list_items($limit, $offset, $col, $order, $just_count);
       
        if (!$just_count)
        {
    		foreach($data as $key => $val)
    		{
    			$data[$key]['datum'] = get_ger_date($data[$key]['datum']);
    		}
    	}
        if ($col == 'datum') array_sorter($data, $col, $order);
           
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
        
        $fields['category_id']['label'] = lang("form_label_category");
        $fields['ort_short']['label'] = lang("form_label_appointments_shortcity");
        $fields['beginn']['ampm'] = false;
        $fields['ende']['ampm'] = false;
        $fields['description'] = array('type' => 'textarea', 'class' => 'no_editor');
        $fields['ort'] = array('type' => 'textarea', 'rows' => 3, 'class' => 'no_editor');
        return $fields;
    }   
    
    public function get_months_for_filter()
    {   
        $this->db->select('datum');
        $this->db->where('datum >=', date('Y-m-d'));
        $this->db->order_by('datum', 'ASC');
        $query = $this->db->get('appointments');
        $i=0;
        $months = array();
        $month = '';
        
        foreach($query->result() as $row)
        {
            if($month == '') $month = get_month_name(substr($row->datum,5,2));    
            if($month != get_month_name(substr($row->datum,5,2)))
            {
                $i++;
                $month = get_month_name(substr($row->datum,5,2));
            }
            $months[$i] = $month;
        }
        
        return $months;
    }
    
    public function get_appointments()
    {
        $this->db->order_by('datum asc, beginn asc');
        $this->db->where(array('datum >=' => date('Y-m-d'), 'published' => 'yes'));
        $this->db->select(array('id', 'datum'));
        $query = $this->db->get('appointments');
        
        $termine = array();
        $i = 0;
        $month = '';      
        
        foreach($query->result() as $row)
        { 
            if($month == '') $month = get_month_name((int)substr($row->datum, 5, 2));
            if($month != get_month_name((int)substr($row->datum, 5, 2)))
            {
                $month = get_month_name((int)substr($row->datum, 5, 2));
                $i = 0;
            }
            
            $termine[$month][$i] = fuel_model("appointments_model", array('find' => 'key', 'where' => $row->id));
            $i++;
        }
        
        return $termine;
    }

}

class Appointment_model extends Abstract_module_record {
    
}

?>