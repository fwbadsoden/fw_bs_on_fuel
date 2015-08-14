<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Stages_model extends Abstract_module_model {
    
    public $required = array('name', 'type_id');
    public $unique = array('name');
    public $foreign_keys = array('type_id' => 'stage_types_model',
                                 'last_modified_by' => 'fuel_users_model');
    public $has_many = array('stage_images' => 'stage_images_model');
    public $hidden_fields = array('last_modified', 'last_modified_by');
    
    function __construct() {
        parent::__construct('fw_stages');
    }
    
    public function get_stage_for_frontend($stage_id) {
        
        $stage = fuel_model('stages', array('find' => 'one', 'where' => array('id' => $stage_id)));
        
        $img_count = $stage->img_count;
        $randomize = $stage->randomize;
        
        $images = $stage->stage_images;
        $images_new = array();
        
        if($randomize == true) {
            $random_keys = array_rand($images, $img_count);
            if(is_array($random_keys)) {
            foreach($random_keys as $key) {
                array_push($images_new, $images[$key]);
            }
            } else {
                array_push($images_new, $images[$random_keys]);
            }
        } else {
            for($i = 0; i < count($images); $i++) {
                array_push($images_new, $images[$i]);
            }
        }
        
        $stage->stage_images = $images_new;
        
        return $stage;
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
	   
       $this->db->join('stage_types', 'stage_types.id = stages.type_id');
       $this->db->join('users', 'users.id = stages.last_modified_by');
       $this->db->select('stages.id as id, stages.name as name, stage_types.name as stage_type, img_count as anzahl_bilder, date_added, last_modified, users.user_name as last_modified_by, published');
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
        $options = array('yes' => 'ja', 'no' => 'nein'); 
        $fields['randomize'] = array('label' => lang('form_label_stage_randomize'),
                                     'comment' => lang('form_comment_stage_randomize'),
                                     'type' => 'enum',
                                     'options' => $options
                                     );
        $fields['type_id']['label'] = lang('form_label_stage_type');                                     
        $fields['img_count'] = array('label' => lang('form_label_stage_image_count'),
                                     'comment' => lang('form_comment_stage_image_count'),
                                     'ignore_represantative' => true,
                                     'type' => 'int');
        $fields['last_modified']['label'] = lang('form_label_last_modified');
        $fields['stage_images']['label'] = lang('form_label_stage_images');
        
        return $fields;
    }
	
	// --------------------------------------------------------------------

	/**
	 * Hook - right before saving of data
	 *
	 * @access	public
	 * @param	array	values to be saved
	 * @return	array
	 */	
	public function on_before_save($values)
	{
        $values = parent::on_before_save($values);
        
        if($values["img_count"] == 0 || $values["img_count"] == 1) {
            $values["img_count"] = 1;
            $values["randomize"] = 'no';
        }
        $values["last_modified_by"] = $this->fuel->auth->user_data("id"); 
        
		return $values;
	}
}

class Stage_model extends Abstract_module_record {
    
//    public function save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL) {
//        
//        if($this->img_count == 0 || $this->img_count == 1) {
//            $this->img_count = 1;
//            $this->randomize = 'no';
//        }
//        
//        $this->last_modified = datetime_now();
//        $this->last_modified_by = $this->fuel->auth->user_data("id"); 
//        echo $this->last_modified_by; die();
//        $saved = parent::save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL);
//        return $saved;
//    }
}

?>