<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');

class PressArticles_model extends Base_module_model {
    
    public $required = array('name', 'source_id', 'datum');
    public $foreign_keys = array('source_id' => 'pressarticle_sources_model');
    
    function __construct() {
        parent::__construct('fw_pressarticles');
    }
    
    public function form_fields($values = array(), $related = array()) {
        
        $fields = parent::form_fields($values, $related); 
        
		$fields['asset'] = array('label' => lang('form_label_file'), 
                                 'folder' => 'pressarticles',                                 
                                 'type' => 'asset', 
                                 'class' => 'file', 
                                 'accept' => 'jpg|jpeg|png|pdf'); 
        $fields['source_id']['label'] = lang('form_label_press_source');
        $fields['online_article']['label'] = lang('form_label_press_link');
        $fields['online_article']['attributes'] = 'placeholder="http://"';
        //internal_debug($fields);
        
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
        internal_debug($values);        
        return $values;
	}
}

class PressArticle_model extends Base_module_record {
    
}

?>