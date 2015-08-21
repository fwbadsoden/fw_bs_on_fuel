<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Mission_Images_model extends Abstract_module_model {
    
    public $required = array('description', 'mission_id');
    public $foreign_keys = array('mission_id' => 'missions_model');
        
    function __construct() {
        parent::__construct('fw_mission_images');
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
	   $this->db->order_by('mission_id', 'desc');
       $this->db->select('id, description, image, photographer as fotograf');
	   $data = parent::list_items($limit, $offset, $col, $order, $just_count);
       
       return $data;   
    }    
}

class Mission_Image_model extends Abstract_module_record {
    
}

?>