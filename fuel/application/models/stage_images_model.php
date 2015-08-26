<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once('abstract_module_model.php');

class Stage_Images_model extends Abstract_module_model {
    
    public $required = array('name', 'image', 'stage_image_type_id');
    
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
        
        $fields['name']['order'] = 1;  
         
        // Asset-Ordner                                        
        $fields['image'] = array('folder' => 'images/bildbuehnen',
                                 'order' => 2,
                                 'create_thumb' => FALSE,
                                 'width' => '1280',
                                 'master_dim' => 'width');
        
        // Bildtyp / Bildbühnentyp - Zuordnung
        $options = array( 1 => 'kleine Bildbühne, Textbox links, 1280*650px',
                          2 => 'große Bildbühne, Textbox links, 1280*720px',
                          3 => 'große Bildbühne, Textbox rechts, 1280*720px',
                          4 => 'kleine Bildbühne, Fahrzeugdetailansicht, Textbox links, 1280*650px',
                          5 => 'große Bildbühne, Einsatzdetailansicht, Textbox lang, 1280*720px');
        $fields['stage_image_type_id'] = array('label' => lang('form_label_stage_image_type'),
                                               'type' => 'select', 'options' => $options,
                                               'order' => 3);  
     
        // Überschrift + CSS Klasse
        $fields['text_1'] = array('label' => lang('form_label_stage_image_text_1'),
                                  'order' => 4);
        $options = array( '' => 'Standard',
                          'quote' => 'Startseite');
        $fields['css_text_class_1'] = array('label' => lang('form_label_stage_image_css_text_class_1'),
                                            'type' => 'select', 'options' => $options,
                                            'order' => 5);   
        
        // Untertitel + CSS Klasse
        $fields['text_2'] = array('label' => lang('form_label_stage_image_text_2'),
                                  'order' => 6);
        $options = array( '' => 'Standard',
                          'quotePerson' => 'Startseite');
        $fields['css_text_class_2'] = array('label' => lang('form_label_stage_image_css_text_class_2'),
                                            'type' => 'select', 'options' => $options,
                                            'order' => 7); 
                                            
        $fields['link'] = array('order' => 8);                                            

        return $fields;
    }
}

class Stage_Image_model extends Abstract_module_record {
    
}

?>