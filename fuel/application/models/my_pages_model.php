<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
    
require_once(FUEL_PATH.'models/fuel_pages_model.php');    
    
class MY_pages_model extends fuel_pages_model {
    
    function __construct() {
        parent::__construct( );
    }
    
    public function form_fields($values = array(), $related = array()) {
        
        $fields = parent::form_fields($values = array(), $related = array());
        
        $fields['stage']['type']    = 'select';
        $fields['stage']['options'] = $this->_stage_options_list();
        
        return $fields;
    }
    
    private function _stage_options_list() {
        
        $CI =& get_instance();
        $this->load_model('stages_model');
        return $this->stages_model->get_stage_options();
    }
    
    public function on_after_save($values) {
        
        $CI =& get_instance();
        $this->load_model('stages_model');
        
        $values = parent::on_after_save($values);
        $page_id = $values['id'];
        $stage_id = $_POST['stage'];
        $this->stages_model->create_update_stage_mapping($page_id, $stage_id);
        
        return $values;
    }
    
	public function on_after_delete($where)
	{
	   parent::on_after_delete($where);
       $this->db->where(array('page_id' => $where['id']));
       $this->db->delete('stage_mapping');
	}
}
?>