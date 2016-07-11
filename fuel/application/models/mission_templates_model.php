<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Mission_Templates_model extends Abstract_module_model {

    public $unique = array('title');
    public $required = array('title', 'description', 'situation', 'type_id');
    public $foreign_keys = array('type_id' => 'mission_types_model');
    public $has_many = array('fahrzeuge' => 'fahrzeuge_model');
    protected $clear_related_on_save = TRUE;

    function __construct() {
        parent::__construct('fw_mission_templates');
    }

    public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->order_by('title asc');
        $this->db->join('mission_types', 'mission_types.id = mission_templates.type_id');
        $this->db->select('mission_templates.id, mission_templates.title as vorlage, mission_templates.description, mission_templates.situation as lage, mission_types.name as einsatzart');
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

        $fields["situation"]["class"] = "no_editor";

        $fields["type_id"]["label"] = "Einsatzart";

        $fields["fahrzeuge"]["order"] = 30;
        $fields["fahrzeuge"]["mode"] = "checkbox";
        $fields["fahrzeuge"]["model"] = array('' => array('fahrzeuge' => 'get_mission_vehicle_list'));
        // forum.getfuelcms.com/discussion/comment/9315 
        // The issue may be because a checkbox or multi select that doesn't have anything selected will not send anything
        // in the POST so FUEL doesn't know whether it should process it. So the solution is to setup a hidden field with 
        // the name of 'exists_{field_name}' (so an "exists_" prefix) with a value of 1.
        $fields["exists_fahrzeuge"] = array('type' => 'hidden', 'value' => 1);

        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('title asc');
        $this->db->select('id, title');
        $query = $this->db->get('mission_templates');
        
        $data[0] = "...";
        foreach ($query->result() as $row) {
            $data[$row->id] = $row->title;
        }
        return $data;
    }

}

?>