<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Autosuggests_model extends Abstract_module_model {
    public $required = array('keyword', 'value');
    
    function __construct() {
        parent::__construct('fw_autosuggests');
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
        
        $options = array('einsatz_weitere_kraefte' => 'einsatz_weitere_kraefte');
        $fields['keyword'] = array('type' => 'select', 'options' => $options);
        return $fields;
    }  

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('keyword asc, value asc');
        $this->db->select('id, keyword, value');
        $query = $this->db->get('autosuggests');

        foreach ($query->result() as $row) {
            $data[$row->id] = $row->keyword.' - '.$row->value;
        }

        return $data;
    } 

}

class Autosuggest_model extends Abstract_module_record {
    
}

?>