<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Mission_Images_model extends Abstract_module_model {

    public $required = array('description', 'mission');
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
        $this->db->order_by('id desc');
        $this->db->select('id, description, description, image');
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

        //$fields["photographer"]['label']        = lang('form_label_photographer');      
        $fields["photographer"] = array('type' => 'photographer_input',
            'comment' => lang('form_label_news_photographer_comment'),
            'photographers' => fuel_model('mannschaft_members_model', array('find' => 'photographers')));

        $fields["mission"]["label"] = 'Einsatz';
        $fields["mission"]["order"] = 999;

        return $fields;
    }

}

class Mission_Image_model extends Abstract_module_record {

    public function get_image() {
        $image = parent::get_image();
        return html_entity_decode($image);
    }

}

?>