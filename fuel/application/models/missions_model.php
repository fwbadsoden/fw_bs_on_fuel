<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once('abstract_module_model.php');

class Missions_model extends Abstract_module_model {

    public $required = array('name',
        'datum_beginn',
        'uhrzeit_beginn',
        'datum_ende',
        'uhrzeit_ende',
        'lage',
        'anzahl_kraefte',
        'bericht',
        'cue_id',
        'type_id');
    public $foreign_keys = array('cue_id' => 'mission_cues_model', 'type_id' => 'mission_types_model');
    public $has_many = array('mission_images' => 'mission_images_model', 'fahrzeuge' => 'fahrzeuge_model');
    public $filters = array('name', 'datum_beginn', 'ort');
    protected $clear_related_on_save = TRUE;

    function __construct() {
        parent::__construct('fw_missions');
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
        $this->db->order_by('datum_beginn', 'desc');
        $this->db->order_by('uhrzeit_beginn', 'desc');
        $this->db->select('id, datum_beginn, uhrzeit_beginn, name, ort, published');
        $data = parent::list_items($limit, $offset, $col, $order, $just_count);

        if (!$just_count) {
            foreach ($data as $key => $val) {
                $data[$key]['datum_beginn'] = get_ger_date($data[$key]['datum_beginn']);
            }
        }
        if ($col == 'datum_beginn')
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

        $fields["einsatzdaten"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Einsatzdaten',
            'order' => 1);
        $fields["einsatz_nr"] = array('label' => lang('form_label_einsatz_nr'),
            'readonly' => true,
            'order' => 2);
        if (!isset($value["einsatz_nr"])) {
            $fields["einsatz_nr"]["value"] = "wird automatisch vergeben";
        }

        $fields["type_id"]['order'] = 3;
        $fields["type_id"]['label'] = lang('form_label_einsatz_type');

        $fields["cue_id"]['order'] = 4;
        $fields["cue_id"]['label'] = lang('form_label_einsatz_cue');
        $fields["cue_id"]["model"] = array('' => array('mission_cues' => 'get_mission_cue_list'));

        $options = array('no' => 'nein', 'yes' => 'ja');
        $fields["ueberoertlich"] = array('label' => lang('form_label_einsatz_ueberoertlich'),
            'type' => 'enum',
            'options' => $options,
            'order' => 5);

        $fields["name"]['order'] = 10;

        $fields['datum_beginn']['order'] = 11;
        $fields['datum_beginn']['label'] = lang('form_label_einsatz_datum_beginn');

        $fields["uhrzeit_beginn"]['order'] = 12;
        $fields['uhrzeit_beginn']['ampm'] = FALSE;
        $fields["uhrzeit_beginn"]['label'] = lang('form_label_einsatz_uhr_beginn');
        $fields['uhrzeit_beginn']['after_html'] = 'Uhr';

        $fields['datum_ende']['order'] = 13;
        $fields['datum_ende']['label'] = lang('form_label_einsatz_datum_ende');

        $fields['uhrzeit_ende']['order'] = 14;
        $fields['uhrzeit_ende']['ampm'] = FALSE;
        $fields['uhrzeit_ende']['label'] = lang('form_label_einsatz_uhr_ende');
        $fields['uhrzeit_ende']['after_html'] = 'Uhr';

        $fields["ort"] = array('label' => lang("form_label_einsatz_ort"),
            'order' => 15);

        $options = array('yes' => 'ja', 'no' => 'nein');
        $fields["ort_zeigen"] = array('type' => 'enum',
            'options' => $options,
            'comment' => lang('form_label_einsatz_ort_zeigen_comment'),
            'order' => 16);

        $fields["anzahl_kraefte"] = array('label' => lang("form_label_einsatz_anzahl_kraefte"),
            'after_html' => 'Personen',
            'order' => 17);

        $fields["anzahl_einsaetze"]['order'] = 18;
        $fields["anzahl_einsaetze"]['label'] = lang('form_label_einsatz_anzahl_einsaetze');
        $fields["anzahl_einsaetze"]['comment'] = lang('form_label_einsatz_anzahl_einsaetze_comment');

        $fields["lage"] = array('label' => lang("form_label_einsatz_lage"),
            'type' => 'textarea',
            'class' => 'no_editor',
            'preview' => false,
            'order' => 22);

        $fields["bericht"] = array('label' => lang("form_label_einsatz_bericht"),
            'type' => 'textarea',
            'class' => 'no_editor',
            'preview' => false,
            'order' => 23);

        $fields["fahrzeuge"]["order"] = 30;
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

        $fields["published"]["type"] = 'hidden';

        // http://forum.getfuelcms.com/discussion/comment/9329#Comment_9329
        // unset statt hidden field für Relationen

        $fields["relationen"] = array('type' => 'fieldset',
            'class' => 'tab',
            'label' => 'Bilder',
            'order' => 900);
        $fields["mission_images"]["order"] = 999;
        $fields["mission_images"]["label"] = 'Einsatzbilder';
        //unset($fields["mission_images"]);

        return $fields;
    }

    /**
     * Placeholder hook - right before validation of data
     *
     * @access	public
     * @param	array	values to be saved
     * @return	array
     */
    public function on_before_validate($values) {
        $values = parent::on_before_validate($values);

        if ($values["einsatz_nr"] == "wird automatisch vergeben") {
            $values["einsatz_nr"] = 0;
        }

        return $values;
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

        if ($values["einsatz_nr"] == 0) {
            $this->db->select_max('einsatz_nr');
            $query = $this->db->get_where('missions', array('substr(datum_beginn,1,4)' => substr($values['datum_beginn'], 0, 4)));
            $row = $query->row();

            if ($row->einsatz_nr != null)
                $values["einsatz_nr"] = $row->einsatz_nr + 1;
            else
                $values["einsatz_nr"] = 1;
        }

        return $values;
    }

    public function on_after_save($values) {
        $values = parent::on_after_save($values);

        $this->db->order_by('datum_beginn', 'asc');
        $this->db->order_by('uhrzeit_beginn', 'asc');
        $query = $this->db->get_where('missions', array('substr(datum_beginn,1,4)' => substr($values['datum_beginn'], 0, 4)));
        $einsatznr = 0;
        $arr_einsatz = array();
        $i = 0;
        $last_anzahl = 1;

        foreach ($query->result() as $row) {
            $arr_einsatz[$i]['id'] = $row->id;
            $arr_einsatz[$i]['sort'] = $row->datum_beginn . ' ' . $row->uhrzeit_beginn;
            $arr_einsatz[$i]['anzahl_einsaetze'] = $row->anzahl_einsaetze;
            $i++;
        }

        usort($arr_einsatz, function($a, $b) {
            $ad = new DateTime($a['sort']);
            $bd = new DateTime($b['sort']);
            if ($ad == $bd) {
                return 0;
            }
            return $ad > $bd ? 1 : -1;
        });

        foreach ($arr_einsatz as $einsatz) {
            $einsatznr = $einsatznr + $last_anzahl;
            $this->db->where('id', $einsatz['id']);
            $this->db->update('missions', array('einsatz_nr' => $einsatznr));
            $last_anzahl = $einsatz['anzahl_einsaetze'];
        }
    }

    public function options_list($key = 'id', $val = 'name', $where = array(), $order = TRUE, $group = TRUE) {
        $this->db->order_by('datum_beginn desc, uhrzeit_beginn desc, id desc');
        $this->db->select('id, name, datum_beginn, uhrzeit_beginn');
        $query = $this->db->get('missions');

        foreach ($query->result() as $row) {
            $data[$row->id] = get_ger_date($row->datum_beginn) . ' ' . $row->uhrzeit_beginn . ' - ' . $row->name;
        }

        return $data;
    }

    public function get_years() {
        $years = array();

        $query = $this->db->query('SELECT DISTINCT substring( datum_beginn, 1, 4 ) as datum FROM ' . $this->db->dbprefix('missions'));

        foreach ($query->result() as $row) {
            $years[] = $row->datum;
        }
        rsort($years);
        return $years;
    }

    public function get_mission_count($year) {

        $this->db->select_sum('anzahl_einsaetze');
        $this->db->where(array('substring(datum_beginn,1,4)' => $year));
        $query = $this->db->get('missions');
        $row = $query->row();
        $count = $row->anzahl_einsaetze;
        if (is_numeric($count))
            return $count;
        else
            return 0;
    }

    public function get_statistic($types, $selected_year, $selected_type) {

        $statistic = array();
        foreach ($types as $type) {
            $statistic[$type->id] = 0;
        }
        $statistic["all"] = 0;
        $statistic["ueberoertlich"] = 0;

        if ($selected_type != NULL && $selected_type != "") {
            $this->db->select_sum('anzahl_einsaetze');
            $this->db->where('type_id', $selected_type);
            if ($selected_year != NULL && $selected_year != "") {
                $this->db->where('substring(datum_beginn,1,4)', $selected_year);
            }
            $query = $this->db->get('missions');
            $row = $query->row();
            $statistic[$selected_type] = $statistic["all"] = $row->anzahl_einsaetze;

            // überörtlich
            $this->db->select_sum('anzahl_einsaetze');
            $this->db->where('ueberoertlich', 'yes');
            $this->db->where('type_id', $selected_type);
            if ($selected_year != NULL && $selected_year != "") {
                $this->db->where('substring(datum_beginn,1,4)', $selected_year);
            }
            $query = $this->db->get('missions');
            $row = $query->row();
            $statistic["ueberoertlich"] = $row->anzahl_einsaetze;
        } else {
            foreach ($types as $type) {
                $this->db->select_sum('anzahl_einsaetze');
                $this->db->where('type_id', $type->id);
                if ($selected_year != NULL && $selected_year != "") {
                    $this->db->where('substring(datum_beginn,1,4)', $selected_year);
                }
                $query = $this->db->get('missions');
                $row = $query->row();
                $statistic[$type->id] = $row->anzahl_einsaetze;
                $statistic["all"] += $statistic[$type->id];

                // überörtlich
                $this->db->select_sum('anzahl_einsaetze');
                $this->db->where('ueberoertlich', 'yes');
                $this->db->where('type_id', $type->id);
                if ($selected_year != NULL && $selected_year != "") {
                    $this->db->where('substring(datum_beginn,1,4)', $selected_year);
                }
                $query = $this->db->get('missions');
                $row = $query->row();
                $statistic["ueberoertlich"] += $row->anzahl_einsaetze;
            }
        }

        return $statistic;
    }

    public function get_stage_text($id) {
        $this->db->join('mission_types', 'mission_types.id = missions.type_id');
        $this->db->select('missions.einsatz_nr as einsatz_nr, missions.name as name, mission_types.name as type_name, mission_types.class as type_class');
        $query = $this->db->get_where('missions', array('missions.id' => $id));
        $row = $query->row();

        $text['name'] = $row->name;
        $text['name_lang'] = $row->type_name . ' (#' . $row->einsatz_nr . ')';
        $text['class'] = $row->type_class;

        return $text;
    }

    public function get_templates() {
        $this->db->select('id, title, situation, type, vehicles');
        $query = $this->db->get('mission_templates');
        $templates = array();
        foreach ($query->result() as $row) {
            $template["id"] = $row->id;
            $template["title"] = $row->title;
            $template["situation"] = $row->situation;
            $template["type"] = $row->type;
            $template["vehicles"] = $row->vehicles;
            $templates[$row->id] = $template;
        }

        return $templates;
    }

    public function get_template($id) {
        $this->db->select('title, situation, type, vehicles');
        $query = $this->db->get_where('mission_templates', array('mission_templates.id' => $id));
        $row = $query->row();
        $template["id"] = $id;
        $template["title"] = $row->title;
        $template["situation"] = $row->situation;
        $template["type"] = $row->type;
        $template["vehicles"] = $row->vehicles;

        return $template;
    }

}

class Mission_model extends Abstract_module_record {

    public function is_published() {

        if ($this->published == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    public function get_cue() {
        $CI = CI();
        $CI->db->select('name, description');
        $CI->db->where('id', $this->cue_id);
        $query = $CI->db->get('mission_cues');
        $row = $query->row();
        if (isset($row->name)) {
            $cue["name"] = $row->name;
            $cue["description"] = $row->description;
            return $cue;
        } else {
            return null;
        }
    }

    public function is_ueberoertlich() {

        if ($this->ueberoertlich == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    public function display_ort() {

        if ($this->ort_zeigen == 'yes') {
            return true;
        } else {
            return false;
        }
    }

    public function get_ort() {

        if ($this->display_ort()) {
            return parent::get_ort();
        } else {
            return "n/a";
        }
    }

    public function get_vehicle_count() {

        if (count($this->fahrzeuge) > 0) {
            return count($this->fahrzeuge);
        } else {
            return 0;
        }
    }

}

?>