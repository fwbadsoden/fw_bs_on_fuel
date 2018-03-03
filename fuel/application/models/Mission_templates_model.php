<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Mission_Templates_model extends Abstract_module_model {

    public $unique = array('name');
    public $required = array('name', 'einsatz_name', 'lage', 'type_id', 'cue_id');
    public $foreign_keys = array('cue_id' => 'mission_cues_model', 'type_id' => 'mission_types_model');
    public $has_many = array('fahrzeuge' => 'fahrzeuge_model');
    protected $clear_related_on_save = TRUE;

    function __construct() {
        parent::__construct('fw_mission_templates');
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->order_by('mission_templates.name asc');
        $this->db->join('mission_types', 'mission_types.id = mission_templates.type_id');
        $this->db->select('mission_templates.id, mission_templates.name, mission_templates.einsatz_name, lage, mission_types.name as einsatzart');
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

        $fields["type_id"]["order"] = 1;
        $fields["type_id"]["label"] = lang('form_label_einsatz_type');

        $fields["cue_id"]["order"] = 2;
        $fields["cue_id"]["label"] = lang('form_label_einsatz_cue');
        
        $fields["name"]["order"] = 3;
        $fields["name"]["label"] = "Name der Vorlage";
        
        $fields["einsatz_name"]["order"] = 4;
        $fields["einsatz_name"]["label"] = "Name des Einsatz";
        
        $fields["ort"]["order"] = 5;
        
        $fields["lage"]["order"] = 6;
        $fields["lage"]["class"] = "no_editor";
        
        $fields["bericht"]["order"] = 7;
        $fields["bericht"]["class"] = "no_editor";

        $fields["fahrzeuge"]["order"] = 8;
        $fields["fahrzeuge"]["mode"] = "checkbox";
        $fields["fahrzeuge"]["model"] = array('' => array('fahrzeuge' => 'get_mission_vehicle_list'));
        // forum.getfuelcms.com/discussion/comment/9315 
        // The issue may be because a checkbox or multi select that doesn't have anything selected will not send anything
        // in the POST so FUEL doesn't know whether it should process it. So the solution is to setup a hidden field with 
        // the name of 'exists_{field_name}' (so an "exists_" prefix) with a value of 1.
        $fields["exists_fahrzeuge"] = array('type' => 'hidden', 'value' => 1);
        
        $fields["weitere_kraefte"] = array('label' => lang("form_label_einsatz_weiterekraefte"),
            'type' => 'tagsinput',
            'class' => 'no_editor',
            'preview' => false,
            'comment' => lang('form_label_einsatz_weiterekraefte_comment'),
            'autosuggests' => fuel_model('autosuggests_model', array('find' => 'all', 'where' => array('keyword' => 'einsatz_weitere_kraefte'))),
            'order' => 34);

        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('name asc');
        $this->db->select('id, name');
        $query = $this->db->get('mission_templates');
        
        $data[0] = "...";
        foreach ($query->result() as $row) {
            $data[$row->id] = $row->name;
        }
        return $data;
    }

}

class Mission_Template_model extends Base_module_record {
 
}

?>