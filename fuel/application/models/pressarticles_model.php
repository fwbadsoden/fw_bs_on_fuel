<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class PressArticles_model extends Abstract_module_model {
    
    public $required = array('name', 'source_id', 'datum');
    public $foreign_keys = array('source_id' => 'pressarticle_sources_model');
    
    function __construct() {
        parent::__construct('fw_pressarticles');
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

class PressArticle_model extends Abstract_module_record {
    
}

?>