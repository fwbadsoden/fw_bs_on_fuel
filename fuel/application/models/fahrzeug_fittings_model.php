<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Fahrzeug_fittings_model extends Abstract_module_model {
    public $required = array('name', 'vehicle', 'text', 'image', 'precedence');
    protected $clear_related_on_save = TRUE;

    function __construct() {
        parent::__construct('fw_fahrzeug_fittings');
    }
    
    public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->order_by('published desc, precedence asc');
        $this->db->select('id, name, vehicle as fahrzeug, published');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);        
        return $data;
    }
    
    public function form_fields($values = array(), $related = array()) {
        $fields = parent::form_fields($values, $related);      

        $fields['vehicle']['label'] = lang('form_label_fahrzeug_module_fahrzeug');
        $fields['vehicle']['comment'] = lang('form_comment_fahrzeug_module_fahrzeug');
        
        $fields['image'] = array('comment' => lang('form_comment_fahrzeug_module_image'),
                                 'folder' => 'images/fahrzeuge/anbauten',
                                 'hide_options' => true);
        
        $fields["text"] = array('type' => 'textarea',
            'max_length' => 10,
            'class' => 'no_editor');
        
        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('vehicle asc, name asc');
        $this->db->select('id, vehicle, name');
        $query = $this->db->get('fahrzeug_fittings');
        foreach ($query->result() as $row) {
            $data[$row->id] = $row->vehicle . " - " . $row->name;
        }
        return $data;
    }
}

class Fahrzeug_fitting_model extends Abstract_module_record {
    
}