<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class News_Images_model extends Abstract_module_model {
    
    public $required = array('description', 'news_id');
    public $foreign_keys = array('news_id' => 'news_articles_model');
        
    function __construct() {
        parent::__construct('fw_news_images');
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
	   $this->db->order_by('description', 'asc');
       $this->db->select('id, description, image, photographer');
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
        
        $fields['news_id']['label'] = lang("form_label_news_article");
        
        // Asset-Ordner                                        
        $fields['image'] = array('folder' => 'images/news',
                                 'create_thumb' => FALSE);                                          
        $fields["photographer"]          = array('type'  => 'photographer_input',
                                                 'comment' => lang('form_label_news_photographer_comment'),
                                                 'photographers' => fuel_model('mannschaft_members_model', array('find' => 'photographers')));  
        return $fields;
    }   
    
}

class News_Image_model extends Abstract_module_record {
    
    public function get_image() {
        $image = parent::get_image();
        return html_entity_decode($image);
    }
    
}

?>