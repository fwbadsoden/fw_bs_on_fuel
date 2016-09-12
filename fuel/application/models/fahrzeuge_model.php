<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Fahrzeuge_model extends Abstract_module_model {

    public $required = array('name', 'name_lang', 'prefix_rufname', 'rufname', 'text', 'besatzung', 'hersteller', 'setcard_image', 'stage_image');
    public $has_many = array('fahrzeug_images' => 'fahrzeug_images_model', 
                             'fahrzeug_loadings' => 'fahrzeug_loadings_model', 
                             'fahrzeug_special_functions' => 'fahrzeug_special_functions_model', 
                             'fahrzeug_fittings' => 'fahrzeug_fittings_model');
    //public $belongs_to = array('missions' => 'missions_model');   
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
        $this->db->select('id, name, rufname, retired as ausser_dienst, published');
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

        $fields["wlf"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Steuerdaten WLF',
            'order' => 30);

        $options = array('no' => 'nein', 'yes' => 'ja');
        $fields['abrollbehaelter_tauglich'] = array('label' => lang('form_label_fahrzeug_abrollbehaelter_tauglich'),
            'type' => 'enum',
            'options' => $options,
            'order' => 34);

        $options = array('no' => 'nein', 'yes' => 'ja');
        $fields['ist_abrollbehaelter'] = array('label' => lang('form_label_fahrzeug_abrollbehaelter'),
            'type' => 'enum',
            'options' => $options,
            'order' => 35);

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

        $fields["precedence"]["type"] = 'hidden';
        $fields["published"]["type"] = 'hidden';
        
        // http://forum.getfuelcms.com/discussion/comment/9329#Comment_9329
        // unset statt hidden field für Relationen
        //$fields["fahrzeug_images"]["type"] = 'hidden';
        //$fields["missions"]["type"] = 'hidden';

        $fields["images"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Bilder',
            'order' => 100);
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

        $fields["deprecated"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Nicht pflegbar',
            'order' => 900);
        
        $fields["missions"]["label"] = "Einsätze";
        $fields["missions"]["order"] = 901;

// HPL 12.09.2016 disabled, da Felder im neuen Layout entfallen
        $fields["baujahr"]['order'] = 902;
        $fields["baujahr"]['comment'] = lang("form_comment_fahrzeug_baujahr");
        $fields["baujahr"]['type'] = $fields["ausserdienststellung"]['order'] = 15;
        $fields["baujahr"]["disabled"] = TRUE;
        $fields["ausserdienststellung"]['order'] = 903;
        $fields["ausserdienststellung"]['label'] = lang("form_label_fahrzeug_ausserdienststellung");
        $fields["ausserdienststellung"]['comment'] = lang("form_comment_fahrzeug_ausserdienststellung");
        $fields["ausserdienststellung"]["disabled"] = TRUE;

// HPL 12.09.2016 disabled, da Felder im neuen Layout entfallen
        $fields["pumpe"] = array('type' => 'textarea',
            'label' => lang('form_label_fahrzeug_pumpe'),
            'comment' => lang('form_comment_fahrzeug_zusatz'),
            'class' => 'no_editor',
            'rows' => 3,
            'order' => 904,
            'disabled' => TRUE);

// HPL 12.09.2016 disabled, da Felder im neuen Layout entfallen
        $fields["loeschmittel"] = array('type' => 'textarea',
            'label' => lang('form_label_fahrzeug_loeschmittel'),
            'comment' => lang('form_comment_fahrzeug_zusatz'),
            'class' => 'no_editor',
            'rows' => 5,
            'order' => 905,
            'disabled' => TRUE);

// HPL 12.09.2016 disabled, da Felder im neuen Layout entfallen
        $fields["besonderheit"] = array('type' => 'textarea',
            'label' => lang('form_label_fahrzeug_besonderheiten'),
            'comment' => lang('form_comment_fahrzeug_zusatz'),
            'class' => 'no_editor',
            'rows' => 5,
            'order' => 906,
            'disabled' => TRUE);

// HPL 12.09.2016 disabled, da Felder im neuen Layout entfallen
        $fields["leermasse"]['after_html'] = 't';
        $fields["leermasse"]['order'] = 907;
        $fields["leermasse"]["disabled"] = TRUE;

// HPL 12.09.2016 disabled, da Felder im neuen Layout entfallen
        $fields["ps"]['label'] = lang("form_label_fahrzeug_ps");
        $fields["ps"]['after_html'] = 'PW';
        $fields["ps"]['order'] = 908;
        $fields["ps"]["disabled"] = TRUE;

        return $fields;
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        if (empty($val)) {
            $val = 'name';
        }
        $data = parent::options_list($key, $val, $where, $order);
        return $data;
    }

    public function get_fahrzeugliste($ad) {

        if ($ad) {
            $this->db->where(array("retired" => "yes", "published" => "yes", "ist_abrollbehaelter" => "no"));
        } else {
            $this->db->where(array("retired" => "no", "published" => "yes", "ist_abrollbehaelter" => "no"));
        }
        $this->db->order_by('precedence', 'ascending');
        $this->db->select("name, name_lang, id");
        $query = $this->db->get("fahrzeuge");
        $fahrzeuge = array();

        foreach ($query->result() as $row) {
            array_push($fahrzeuge, $row);
        }

        return $fahrzeuge;
    }

    public function get_mission_vehicle_list() {

        $this->db->order_by('precedence asc');
        $this->db->select("id, CONCAT((name), (' ('), (rufname), (')')) as name");      
        $this->db->where(array('published' => 'yes', 'retired' => 'no', "ist_abrollbehaelter" => "no"));
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
        $this->db->select("name, name_lang, text_stage, stage_image");
        $query = $this->db->get('fahrzeuge');
        $row = $query->row();
        $text['name'] = $row->name;
        $text['name_lang'] = $row->name_lang;
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

// HPL 12.09.2016 auskommentiert, da Felder im neuen Layout entfallen
//    public function on_before_save($values) {
//        
//        $values = parent::on_before_save($values);
//        
//        // Validierungen
//        if($values["retired"] == 'no' && ( $values["baujahr"] == 0 || $values["baujahr"] == "")) {
//            $this->add_error("Baujahr darf nicht leer oder 0 sein");
//        }
//        if($values["retired"] == 'yes' && ( $values["ausserdienststellung"] == 0 || $values["ausserdienststellung"] == "")) {
//            $this->add_error("Außer Dienst seit darf nicht leer oder 0 sein");
//        }
//        
//        return $values;
//    }

}

class Fahrzeug_model extends Abstract_module_record {

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

    public function get_abrollbehaelter() {

        return fuel_model('fahrzeuge_model', array('find' => 'all', 'order' => 'precedence asc', 'where' => array('ist_abrollbehaelter' => 'yes', 'published' => 'yes', 'retired' => 'no')));
    }

// HPL 12.09.2016 auskommentiert, da Felder im neuen Layout entfallen
//    public function get_abrollbehaelter_besonderheit() {
//        if (parent::get_besonderheit() != "")
//            return $this->_prepare_fahrzeugbesonderheit(parent::get_besonderheit(), true);
//        else
//            return null;
//    }
//
//    public function get_besonderheit() {
//        if (parent::get_besonderheit() != "")
//            return $this->_prepare_fahrzeugbesonderheit(parent::get_besonderheit());
//        else
//            return null;
//    }
//
//    public function get_loeschmittel() {
//        if (parent::get_arloeschmittel() != "")
//            return $this->_prepare_fahrzeugbesonderheit(parent::get_arloeschmittel());
//        else
//            return null;
//    }
//
//    public function get_pumpe() {
//        if (parent::get_pumpe() != "")
//            return $this->_prepare_fahrzeugbesonderheit(parent::get_pumpe());
//        else
//            return null;
//    }
//
//    private function _prepare_fahrzeugbesonderheit($value, $list = false) {
//        if ($list == false) {
//            return str_replace("\n", "<br />", trim($value));
//        } else {
//            $array = split("\n", $value);
//            $return = "";
//            foreach ($array as $item) {
//                $return.="<li>" . $item . "</li>";
//            }
//            return $return;
//        }
//    }

}

?>
