<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Stage_Images_model extends Abstract_module_model {
    
    public $required = array('stage_id', 'image', 'css_inner_class');
    public $foreign_keys = array('stage_id' => 'stages_model');
    
    function __construct() {
        parent::__construct('fw_stage_images');
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
        
        $fields['stage_id']['label'] = lang('form_label_stage_image_stageid');    
        $options = array('stageContentHeadlineTop half_blackBG smallstage' => 'kleine Bildbühne', 'stageContentHeadline blackBG' => 'große Bildbühne', 'stageQuoteRight' => 'Textbox rechts', 'stageQuoteLeft' => 'Textbox links', 'stageContentCar' => 'Bildbühne Fahrzeuge');     
        $fields['css_inner_class'] = array('label' => lang('form_label_stage_image_css_inner_class'),
                                           'type'  => 'select', 'options' => $options);   
        $fields['css_text_class_1']['label'] = lang('form_label_stage_image_css_text_class_1');   
        $fields['css_text_class_2']['label'] = lang('form_label_stage_image_css_text_class_2');   
        $fields['css_text_class_3']['label'] = lang('form_label_stage_image_css_text_class_3');        
        $fields['image']['folder'] = 'images/bildbuehnen';
        $fields['precedence']['label'] = lang('form_label_stage_image_precedence');   

        return $fields;
    }
}

class Stage_Image_model extends Abstract_module_record {
    
    public function save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL) {
        
        $this->last_modified = datetime_now();
        $saved = parent::save($validate = TRUE, $ignore_on_insert = TRUE, $clear_related = NULL);
        return $saved;
    }
}

?>