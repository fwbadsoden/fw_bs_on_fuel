<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Mission_Images_model extends Abstract_module_model {

    public $required = array('date', 'description', 'mission');
    public $belongs_to = array('mission' => 'missions_model');

    function __construct() {
        parent::__construct('fw_mission_images');
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
    public function list_items($limit = NULL, $offset = 0, $col = 'id', $order = 'asc', $just_count = FALSE) {
        $this->db->order_by('date desc, id desc');
        $this->db->select('id, date, description, image, photographer');
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

        // Asset-Ordner                     

        $fields['image']['folder'] = 'images/einsaetze';
        $fields['image']['create_thumb'] = FALSE;
        $fields['image']['hide_options'] = TRUE;
        $fields['image']['maintain_ratio'] = TRUE;
        $fields['image']['width'] = 1280;
        $fields['image']['height'] = 1024;
        $fields['image']['master_dim'] = 'auto';
        $fields['image']['overwrite'] = FALSE;

        //$fields["photographer"]['label']        = lang('form_label_photographer');      
        $fields["photographer"] = array('type' => 'photographer_input',
            'comment' => lang('form_label_news_photographer_comment'),
            'photographers' => fuel_model('mannschaft_members_model', array('find' => 'photographers')));

        $fields["date"]["label"] = 'Datum';
        $fields["date"]["max_date"] = date('d.m.Y');
        $fields["date"]["default"] = date('d.m.Y');
        
        $fields["mission"]["label"] = 'Einsatz';
        $fields["mission"]["order"] = 999;
        
        $fields["creation"]["type"] = 'hidden';

        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('date desc, id desc');
        $this->db->select('id, description, date');
        $query = $this->db->get('mission_images');

        foreach ($query->result() as $row) {
            $data[$row->id] = get_ger_date($row->date) . ' - ' . $row->description;
        }

        return $data;
    }

    /**
     * Hook - right before saving of data
     *
     * @access	public
     * @param	array	values to be saved
     * @return	array
     */
    public function on_before_save($values) {
        $values = parent::on_before_save($values);
        if($values["creation"] == "1970-01-01 01:00:00") $values["creation"] = date('Y-m-d G:i:s');
        return $values;
    }
}

class Mission_Image_model extends Abstract_module_record {

    public function get_image() {
        $image = parent::get_image();
        return html_entity_decode($image);
    }

}

?>