<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class PressArticles_model extends Abstract_module_model {

    public $required = array('name', 'source_id', 'datum', 'category_id');
    public $foreign_keys = array('source_id' => 'pressarticle_sources_model', 'category_id' => array(FUEL_FOLDER => 'fuel_categories_model', 'where' => array('context' => 'pressarticles')));

    function __construct() {
        parent::__construct('fw_pressarticles');
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
        $this->db->order_by('datum', 'desc');
        $this->db->join('pressarticle_sources', 'pressarticle_sources.id = pressarticles.source_id');
        $this->db->select('pressarticles.id as id, pressarticles.name as name, pressarticle_sources.name as quelle, pressarticles.datum as datum, pressarticles.published as published');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);

        if (!$just_count) {
            foreach ($data as $key => $val) {
                $data[$key]['datum'] = get_ger_date($data[$key]['datum']);
            }
        }
        if ($col == 'datum')
            array_sorter($data, $col, $order);

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

        $fields['name']['order'] = 1;
        $fields['category_id']['label'] = lang("form_label_category");
        $fields['category_id']['order'] = 2;
        $fields['source_id']['label'] = lang('form_label_press_source');
        $fields['source_id']['order'] = 3;
        $fields['datum']['order'] = 4;
        $fields['section_example'] = array('type' => 'section', 'tag' => 'h3', 'value' => lang("form_label_press_section"));
        $fields['section_example']['order'] = 5;
        $fields['online_article']['label'] = lang('form_label_press_link');
        $fields['online_article']['comment'] = lang('form_comment_press_link');
        $fields['online_article']['attributes'] = 'placeholder="http://"';
        $fields['online_article']['order'] = 6;
        $fields['asset'] = array('label' => lang('form_label_file'),
            'folder' => 'pressarticles',
            'type' => 'asset',
            'class' => 'file',
            'order' => 7,
            'comment' => lang('form_comment_press_asset'),
            'hide_options' => true,
            'accept' => 'jpg|jpeg|png|pdf');
        $fields['published']['type'] = 'hidden';

        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('datum desc, name desc, id desc');
        $this->db->select('id, name, datum');
        $query = $this->db->get('pressarticles');

        foreach ($query->result() as $row) {
            $data[$row->id] = get_ger_date($row->datum) . ' - ' . $row->name;
        }

        return $data;
    }
}

class PressArticle_model extends Abstract_module_record {
    
}

?>