<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class News_articles_model extends Abstract_module_model {
    
    public $required = array('title', 'stage_title', 'teaser');
    public $hidden_fields = array('last_modified', 'last_modified_by');

    function __construct() {
        parent::__construct('fw_news_articles');
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
	    $this->db->order_by('datum', 'desc');
        $this->db->select('id, datum, title, published');
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
        
        $fields['title']            = array('label' => lang('form_label_news_title'),
                                            'order' => 2);
        
        $fields['stage_title']      = array('label' => lang('form_label_news_stage_title'),
                                            'order' => 3);
        
        $fields['datum']["label"]   = lang('form_label_news_datum');
        $fields['datum']["order"]   = 4;
        
        $fields['teaser_image']     = array('label' => lang('form_label_news_teaser_image'),
                                            'folder' => 'images/news',  
                                            'order' => 5);
        
        $fields['og_image']         = array('label' => lang('form_label_news_og_image'),
                                            'folder' => 'images/news',  
                                            'order' => 6);
        
        $fields['teaser']           = array('type' => 'textarea',
                                            'order' => 7);
        
        $fields['text']             = array('type' => 'textarea',
                                            'order' => 8);
        
        $fields['published']['type'] = 'hidden';
        
        return $fields;
    }

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
        $values["last_modified_by"] = $this->fuel->auth->user_data("id"); 
		return $values;
	}
    
	/**
	 * Hook - right after saving of data
	 *
	 * @access	public
	 * @param	array	values to be saved
	 * @return	array
	 */	
	public function on_after_save($values)
	{
		$values = parent::on_after_save($values);
             
        return $values;
	}
    
    public function get_stage_text($id) {
        
        $this->db->where("id", $id);
        $this->db->select("stage_title, title");
        $query = $this->db->get('news_articles');
        $row = $query->row();
        $text['name']       = $row->stage_title;
        $text['name_lang']  = $row->title;
        
        return $text;
    }
    
    public function get_og_image($id) {
        
        $this->db->where('id', $id);
        $this->db->select('og_image');
        $query = $this->db->get('news_articles');
        $row = $query->row();
        return img_path('news/'.$row->og_image);
    }
}

class News_article_model extends Abstract_module_record {
    
}

?>