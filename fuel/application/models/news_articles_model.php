<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class News_articles_model extends Abstract_module_model {

    public $has_many = array('news_images' => 'news_images_model');
    public $required = array('title', 'stage_title', 'teaser');
    public $hidden_fields = array('last_modified', 'last_modified_by');
    protected $clear_related_on_save = FALSE;

    function __construct() {
        parent::__construct('fw_news_articles');
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
        $this->db->select('id, datum, title, published');
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


        $fields["newsdaten"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'News',
            'order' => 1);
        $fields['title'] = array('label' => lang('form_label_news_title'),
            'order' => 2);

        $fields['stage_title'] = array('label' => lang('form_label_news_stage_title'),
            'order' => 3);

        $fields['link']['comment'] = lang('form_label_news_link');

        $fields['datum']["label"] = lang('form_label_news_datum');
        $fields['datum']["order"] = 4;

        $fields['teaser_image'] = array('label' => lang('form_label_news_teaser_image'),
            'comment' => lang('form_comment_news_teaser_image'),
            'folder' => 'images/news',
            'hide_options' => true,
            'order' => 5);

        $fields['og_image'] = array('label' => lang('form_label_news_og_image'),
            'comment' => lang('form_comment_news_og_image'),
            'folder' => 'images/news',
            'hide_options' => true,
            'order' => 6);

        $fields['teaser'] = array('type' => 'textarea',
            'preview' => false,
            'class' => 'no_editor',
            'order' => 7);

        $fields['text'] = array('type' => 'textarea',
            'preview' => false,
            'img_folder' => 'news',
            'order' => 8);

        $fields['published']['type'] = 'hidden';

        // http://forum.getfuelcms.com/discussion/comment/9329#Comment_9329
        // unset statt hidden field für Relationen
        //$fields["news_images"]["type"] = 'hidden'; 

        $fields["bilder"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Bilder',
            'order' => 900);
        $fields["news_images"]["label"] = 'Bilder';
        $fields["news_images"]["order"] = 999;

        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('datum desc, title desc, id desc');
        $this->db->select('id, title, datum');
        $query = $this->db->get('news_articles');

        foreach ($query->result() as $row) {
            $data[$row->id] = get_ger_date($row->datum) . ' - ' . $row->title;
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
        $values["last_modified_by"] = $this->fuel->auth->user_data("id");
        return $values;
    }

    public function get_stage_text($id) {
        $this->db->where("id", $id);
        $this->db->select("stage_title, title");
        $query = $this->db->get('news_articles');
        $row = $query->row();
        $text['name'] = $row->stage_title;
        $text['name_lang'] = $row->title;

        return $text;
    }

    public function get_og_image($id) {
        $this->load->library('opengraph');
        $this->db->where('id', $id);
        $this->db->select('og_image');
        $query = $this->db->get('news_articles');
        $row = $query->row();
        if ($row->og_image != "") {
            return $this->opengraph->create_ogImage(img_path('news/' . $row->og_image));
        } else {
            return null;
        }
    }

}

class News_article_model extends Abstract_module_record {
    
}

?>