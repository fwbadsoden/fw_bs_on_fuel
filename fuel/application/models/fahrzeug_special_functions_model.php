<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Fahrzeug_special_functions_model extends Abstract_module_model {
    public $required = array('name', 'vehicle', 'text', 'image', 'precedence');
    protected $clear_related_on_save = TRUE;

    function __construct() {
        parent::__construct('fw_fahrzeug_special_functions');
    }
    
    public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->order_by('published desc, vehicle asc, precedence asc');
        $this->db->select('id, name, vehicle as fahrzeug, published');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);
        return $data;
    }
    
    public function form_fields($values = array(), $related = array()) {
        $fields = parent::form_fields($values, $related);      

        $fields['vehicle']['label'] = lang('form_label_fahrzeug_module_fahrzeug');
        $fields["vehicle"]["comment"] = lang('form_comment_fahrzeug_module_fahrzeug');
        
        $fields['image'] = array('comment' => lang('form_comment_fahrzeug_module_image'),
                                 'folder' => 'images/fahrzeuge/spezialfunktionen',
                                 'hide_options' => true);
        
        $fields["text"] = array('type' => 'textarea',
            'max_length' => 700,
            'class' => 'no_editor');
        
        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('fahrzeug_special_functions.vehicle asc, fahrzeug_special_functions.name asc');
        $this->db->select('fahrzeug_special_functions.id, fahrzeug_special_functions.vehicle, fahrzeug_special_functions.name');
        $query = $this->db->get('fahrzeug_special_functions');
        foreach ($query->result() as $row) {
            $data[$row->id] = $row->vehicle . " - " . $row->name;
        }
        return $data;
    }
    
}

class Fahrzeug_special_function_model extends Abstract_module_record {
    
}