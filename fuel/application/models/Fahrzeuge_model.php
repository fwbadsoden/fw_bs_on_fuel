<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Fahrzeuge_model extends Abstract_module_model {

    public $required = array('name', 'name_lang', 'prefix_rufname', 'rufname', 'text_stage', 'besatzung', 'hersteller', 'setcard_image', 'stage_image');
    public $has_many = array('fahrzeug_images' => 'fahrzeug_images_model',
        'fahrzeug_loadings' => 'fahrzeug_loadings_model',
        'fahrzeug_special_functions' => 'fahrzeug_special_functions_model',
        'fahrzeug_fittings' => 'fahrzeug_fittings_model');
    public $boolean_fields = array('retired', 'ausser_dienst');
    protected $clear_related_on_save = TRUE;

    function __construct() {
        parent::__construct('fw_fahrzeuge');
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
        $this->db->order_by('published', 'descending');
        $this->db->order_by('precedence', 'ascending');
        $this->db->select('id, name, rufname, retired as ausser_dienst, published, precedence');
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

        $fields["grunddaten"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Grunddaten',
            'order' => 1);

        $fields["name"] = array('label' => lang("form_label_fahrzeug_name"),
            'order' => 2);

        $fields["name_lang"] = array('label' => lang("form_label_fahrzeug_name_lang"),
            'order' => 3);

        $options = array('Florian Bad Soden' => 'Florian Bad Soden', 'Florian Main-Taunus' => 'Florian Main-Taunus');
        $fields['prefix_rufname'] = array('label' => lang("form_label_fahrzeug_prefix_rufname"),
            'options' => $options,
            'type' => 'select',
            'order' => 4);

        $fields["rufname"] = array('label' => lang("form_label_fahrzeug_funkrufname"),
            'order' => 5);

        $fields['setcard_image'] = array('label' => lang('form_label_fahrzeug_setcard_image'),
            'comment' => lang('form_comment_fahrzeug_setcard_image'),
            'folder' => 'images/fahrzeuge/setcards',
            'hide_options' => true,
            'order' => 6);

        $fields['stage_image'] = array('label' => lang('form_label_fahrzeug_stage_image'),
            'comment' => lang('form_comment_fahrzeug_stage_image'),
            'folder' => 'images/fahrzeuge/bildbuehnen',
            'hide_options' => true,
            'order' => 7);

        $options = array('yes' => 'ja', 'no' => 'nein');
        $fields['einsaetze_zeigen'] = array('label' => lang('form_label_fahrzeug_einsaetze_zeigen'),
            'type' => 'enum',
            'options' => $options,
            'order' => 10);

        $options = array('no' => 'nein', 'yes' => 'ja');
        $fields['retired'] = array('label' => lang('form_label_fahrzeug_retired'),
            'type' => 'enum',
            'options' => $options,
            'order' => 11);

        $fields["fahrzeugdaten"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Fahrzeugdaten',
            'order' => 12);

        $fields["text_stage"] = array('label' => lang("form_label_fahrzeug_text_kurz"),
            'class' => 'no_editor',
            'type' => 'textarea',
            'preview' => false,
            'order' => 13);

        $fields["text"] = array('class' => 'no_editor',
            'label' => lang("form_label_fahrzeug_text_abroller"),
            'type' => 'textarea',
            'preview' => false,
            'order' => 14);

        $fields["hersteller"]['order'] = 15;

        $fields["aufbau"]['order'] = 16;

        $options = array('1:8' => '1:8',
            '1:7' => '1:7',
            '1:5' => '1:5',
            '1:4' => '1:4',
            '1:3' => '1:3',
            '1:2' => '1:2',
            '1:1' => '1:1',
            '16' => '16 (RH Hänger)',
            '0' => 'Abrollbehälter');
        $fields['besatzung'] = array('options' => $options,
            'type' => 'select',
            'order' => 17);

        $fields["fahrzeugwerte"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Fahrzeugwerte',
            'order' => 50);

        $fields["kw"]['label'] = lang("form_label_fahrzeug_kw");
        $fields["kw"]['after_html'] = 'KW';
        $fields["kw"]['order'] = 51;

        $fields["hoehe"]['label'] = lang("form_label_fahrzeug_hoehe");
        $fields["hoehe"]['after_html'] = 'm';
        $fields["hoehe"]['order'] = 53;

        $fields["breite"]['label'] = lang("form_label_fahrzeug_breite");
        $fields["breite"]['after_html'] = 'm';
        $fields["breite"]['order'] = 54;

        $fields["laenge"]['label'] = lang("form_label_fahrzeug_laenge");
        $fields["laenge"]['after_html'] = 'm';
        $fields["laenge"]['order'] = 55;

        $fields["gesamtmasse"]['after_html'] = 't';
        $fields["gesamtmasse"]['order'] = 56;
        
        $fields["baujahr"]['order'] = 58;
        $fields["baujahr"]['comment'] = lang("form_comment_fahrzeug_baujahr");
        
        $fields["ausserdienststellung"]['order'] = 59;
        $fields["ausserdienststellung"]['label'] = lang("form_label_fahrzeug_ausserdienststellung");
        $fields["ausserdienststellung"]['comment'] = lang("form_comment_fahrzeug_ausserdienststellung");

        $fields["images"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Bilder',
            'order' => 100);
        $fields["fahrzeug_images"]["sorting"] = TRUE;
        $fields["fahrzeug_images"]["label"] = "Bilder";
        $fields["fahrzeug_images"]["order"] = 101;

        $fields["loadings"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Beladung',
            'order' => 200);
        $fields["fahrzeug_loadings"]["label"] = "Beladung";
        $fields["fahrzeug_loadings"]["order"] = 201;

        $fields["special_functions"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Besonderheiten',
            'order' => 300);
        $fields["fahrzeug_special_functions"]["label"] = "Besonderheiten";
        $fields["fahrzeug_special_functions"]["order"] = 301;

        $fields["fittings"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Anbauten',
            'order' => 400);
        $fields["fahrzeug_fittings"]["label"] = "Anbauten";
        $fields["fahrzeug_fittings"]["order"] = 401;

        $fields["customizing"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Steuerfelder',
            'order' => 800);

        $options = array('no' => 'nein', 'yes' => 'ja');
        $fields['abrollbehaelter_tauglich'] = array('label' => lang('form_label_fahrzeug_abrollbehaelter_tauglich'),
            'type' => 'enum',
            'options' => $options,
            'order' => 801);

        $options = array('no' => 'nein', 'yes' => 'ja');
        $fields['ist_abrollbehaelter'] = array('label' => lang('form_label_fahrzeug_abrollbehaelter'),
            'type' => 'enum',
            'options' => $options,
            'order' => 802);

        $options = array('yes' => 'ja', 'no' => 'nein');
        $fields['show_loadings_header'] = array('label' => lang('form_label_fahrzeug_show_loadings_header'),
            'type' => 'enum',
            'options' => $options,
            'order' => 803);

        $options = array('yes' => 'ja', 'no' => 'nein');
        $fields['show_specialfunctions_header'] = array('label' => lang('form_label_fahrzeug_show_specialfunctions_header'),
            'type' => 'enum',
            'options' => $options,
            'order' => 804);

        $fields["precedence"]["type"] = 'hidden';
        $fields["published"]["type"] = 'hidden';
        $fields["module_order"]["type"] = 'hidden';
        $fields["leermasse"]["type"] = 'hidden';

        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('rufname asc, name asc, retired asc');
        $this->db->select('id, name, rufname, retired');
        $query = $this->db->get('fahrzeuge');

        foreach ($query->result() as $row) {
			$name = $row->rufname . ' - ' . $row->name;
			if($row->retired == 'yes') $name .= ' a.D.';
            $data[$row->id] = $name;
        }

        return $data;
    }

    public function get_mission_vehicle_list() {

        $this->db->order_by('precedence asc, ist_abrollbehaelter asc');
        $this->db->select("id, CONCAT((name), (' ('), (rufname), (')')) as name");
        $this->db->where(array('published' => 'yes', 'retired' => 'no'));
        $query = $this->db->get('fahrzeuge');
        return $query->result_assoc_array('id');
    }

    public function has_retired() {

        $this->db->where(array('published' => 'yes', 'retired' => 'yes', "ist_abrollbehaelter" => "no"));
        $query = $this->db->get('fahrzeuge');

        if ($query->num_rows() > 0)
            return true;
        else
            return false;
    }

    public function get_stage_info($id) {

        $this->db->where("id", $id);
        $this->db->select("name, name_lang, text_stage, stage_image, retired");
        $query = $this->db->get('fahrzeuge');
        $row = $query->row();
        $text['name'] = $row->name;
        $text['name_lang'] = $row->name_lang;
        if($row->retired == "yes") $text["name_lang"] .= " (a. D.)";
        $text['text_stage'] = $row->text_stage;
        $text['stage_image'] = $row->stage_image;

        return $text;
    }

    public function get_fahrzeug_anzahl() {
        $this->db->where('published', 'yes');
        $this->db->where('retired', 'no');
        $this->db->where('ist_abrollbehaelter', 'no');
        return $this->db->count_all_results("fahrzeuge");
    }

    public function get_abroller_anzahl() {
        $this->db->where('published', 'yes');
        $this->db->where('retired', 'no');
        $this->db->where('ist_abrollbehaelter', 'yes');
        return $this->db->count_all_results("fahrzeuge");
    }
}

class Fahrzeug_model extends Abstract_module_record {

    public function get_fahrzeug_images() {
        CI()->db->select('relationships.foreign_key');
        CI()->db->distinct();
        CI()->db->where(array('relationships.candidate_table' => 'fw_fahrzeuge', 'relationships.foreign_table' => 'fw_fahrzeug_images', 'relationships.candidate_key' => $this->id));
        CI()->db->order_by('relationships.id asc');
        $query = CI()->db->get('relationships');
        $i = 0;
        $fahrzeug_images = array();
        foreach ($query->result() as $row) {
            $fahrzeug_images[$i] = fuel_model('fahrzeug_images_model', array('find' => 'one', 'where' => array('id' => $row->foreign_key)));
            $i++;
        }
        return $fahrzeug_images;
    }

    public function get_fahrzeug_loadings() {
        CI()->db->select('relationships.foreign_key');
        CI()->db->distinct();
        CI()->db->join('fahrzeug_loadings', 'fahrzeug_loadings.id = relationships.foreign_key');
        CI()->db->where(array('relationships.candidate_table' => 'fw_fahrzeuge', 'relationships.foreign_table' => 'fw_fahrzeug_loadings', 'relationships.candidate_key' => $this->id, 'fahrzeug_loadings.published' => 'yes'));
        CI()->db->order_by('fahrzeug_loadings.precedence asc');
        $query = CI()->db->get('relationships');
        $i = 0;
        $fahrzeug_loadings = array();
        foreach ($query->result() as $row) {
            $fahrzeug_loadings[$i] = fuel_model('fahrzeug_loadings_model', array('find' => 'one', 'where' => array('id' => $row->foreign_key)));
            $i++;
        }
        return $fahrzeug_loadings;
    }

    public function get_fahrzeug_special_functions() {
        CI()->db->select('relationships.foreign_key');
        CI()->db->distinct();
        CI()->db->join('fahrzeug_special_functions', 'fahrzeug_special_functions.id = relationships.foreign_key');
        CI()->db->where(array('relationships.candidate_table' => 'fw_fahrzeuge', 'relationships.foreign_table' => 'fw_fahrzeug_special_functions', 'relationships.candidate_key' => $this->id, 'fahrzeug_special_functions.published' => 'yes'));
        CI()->db->order_by('fahrzeug_special_functions.precedence asc');
        $query = CI()->db->get('relationships');
        $i = 0;
        $fahrzeug_special_functions = array();
        foreach ($query->result() as $row) {
            $fahrzeug_special_functions[$i] = fuel_model('fahrzeug_special_functions_model', array('find' => 'one', 'where' => array('id' => $row->foreign_key)));
            $i++;
        }
        return $fahrzeug_special_functions;
    }

    public function get_fahrzeug_fittings() {
        CI()->db->select('relationships.foreign_key');
        CI()->db->distinct();
        CI()->db->join('fahrzeug_fittings', 'fahrzeug_fittings.id = relationships.foreign_key');
        CI()->db->where(array('relationships.candidate_table' => 'fw_fahrzeuge', 'relationships.foreign_table' => 'fw_fahrzeug_fittings', 'relationships.candidate_key' => $this->id, 'fahrzeug_fittings.published' => 'yes'));
        CI()->db->order_by('fahrzeug_fittings.precedence asc');
        $query = CI()->db->get('relationships');
        $i = 0;
        $fahrzeug_fittings = array();
        foreach ($query->result() as $row) {
            $fahrzeug_fittings[$i] = fuel_model('fahrzeug_fittings_model', array('find' => 'one', 'where' => array('id' => $row->foreign_key)));
            $i++;
        }
        return $fahrzeug_fittings;
    }
    
    public function get_missions() {
        CI()->db->select('relationships.candidate_key');
        CI()->db->distinct();
        CI()->db->join('missions', 'missions.id = relationships.candidate_key');
        CI()->db->where(array('relationships.candidate_table' => 'fw_missions', 'relationships.foreign_table' => 'fw_fahrzeuge', 'relationships.foreign_key' => $this->id));
        CI()->db->order_by('datum_beginn desc, uhrzeit_beginn desc');
        CI()->db->limit(5);
        $query = CI()->db->get('relationships');

        $i = 0;
        $missions = array();
        foreach ($query->result() as $row) {
            $missions[$i] = fuel_model('missions_model', array('find' => 'one', 'where' => array('id' => $row->candidate_key)));
            $i++;
        }
        return $missions;
    }

    public function is_retired() {
        if ($this->retired == 'yes')
            return true;
        else
            return false;
    }

    public function is_published() {
        if ($this->published == 'yes')
            return true;
        else
            return false;
    }

    public function is_wlf() {
        if ($this->abrollbehaelter_tauglich == 'yes')
            return true;
        else
            return false;
    }

    public function is_abrollbehaelter() {
        if ($this->ist_abrollbehaelter == 'yes')
            return true;
        else
            return false;
    }

    public function show_loadings_header() {
        if ($this->show_loadings_header == 'yes')
            return true;
        else
            return false;
    }

    public function show_specialfunctions_header() {
        if ($this->show_specialfunctions_header == 'yes')
            return true;
        else
            return false;
    }

    public function get_abrollbehaelter() {
        return fuel_model('fahrzeuge_model', array('find' => 'all', 'order' => 'precedence asc', 'where' => array('ist_abrollbehaelter' => 'yes', 'published' => 'yes', 'retired' => 'no')));
    }
}

?>