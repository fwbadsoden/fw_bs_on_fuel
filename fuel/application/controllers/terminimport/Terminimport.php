<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * TerminImport
 * Controller als Schnittstelle für den Import der Termine aus dem Informationsportal
 * 
 * @package com.cp.feuerwehr.terminImport.TerminImport  
 * @author Patrick Ritter <pa_ritter@arcor.de>
 * @author Habib Pleines <habib@familiepleines.de>
 * @copyright 
 * @version 2015
 * @access public
 */
class Terminimport extends CI_Controller {

    /**
     * Terminimport::__construct()
     *
     * @return
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('appointments_model', 'm_appointment');
    }

    /**
     * Terminimport::fetch()
     * 	Provides list of stored future appointments
     *
     * @return
     */
    public function fetch() {
        //Check if remote host is in IP4-Whitelist
        if (in_array($_SERVER['HTTP_HOST'], explode(";", fuel_var("termin_import_whitelist")))) {
            echo "NOT AUTHENTICATED: " . $_SERVER['HTTP_HOST'];
            exit;
        }

        //Print for each future appointment id and md5-hash of relevant data
        $where = array('published' => 'yes');
        $order_by = ('datum asc, beginn asc');
        $termine = $this->m_appointment->find_all($where, $order_by);
        foreach ($termine as $termin) {
            $md5 = md5($termin->name . $termin->description . $termin->ort . $termin->ort_short . $termin->datum . $termin->beginn . $termin->ende);
            echo $termin->id . ";" . $md5 . "\n";
        }
        echo "FETCH_OK";
    }

    /**
     * Terminimport::update()
     * 	Insert additional and removes obsolete appointments
     *
     * @return
     */
    public function update() {

        //Check if remote host is in IP4-Whitelist
        if (in_array($_SERVER['HTTP_HOST'], explode(";", fuel_var("termin_import_whitelist")))) {
            echo "NOT AUTHENTICATED: " . $_SERVER['HTTP_HOST'];
            exit;
        }

        if (isset($_GET['toDelete']) && isset($_GET['toInsert'])) {

            //Delete obsolete appointments
            if (strlen($_GET['toDelete']) > 0) {
                foreach (explode(";", $_GET['toDelete']) as $idToDelete) {
                    $where = array('id' => intval($idToDelete));
                    $this->m_appointment->delete($where);
                    echo "Deleted id " . $idToDelete . " in db\n";
                }
            }

            //Insert additional appointments
            if (strlen($_GET['toInsert']) > 0) {
                foreach (explode("\n", $_GET['toInsert']) as $lineToInsert) {
                    list($name, $description, $ort, $ort_kurz, $datum, $beginn, $ende, $md5) = explode(";", $lineToInsert);

                    //Determine category id
                    if (strpos($name, 'Gesamte Wehr') != false) {
                        $category = fuel_model("fuel_categories_model", array('find' => 'one', 'where' => array('slug' => 'gesamte')));
                    } elseif (strpos($name, 'Gesamte Wehr') != false) {
                        $category = fuel_model("fuel_categories_model", array('find' => 'one', 'where' => array('slug' => 'zusatzdienst')));
                    } else {
                        $category = fuel_model("fuel_categories_model", array('find' => 'one', 'where' => array('slug' => 'sonstige-dienste')));
                    }
                    $category_id = $category->id;

                    $termin["category_id"] = $category_id;
                    $termin["name"] = $name;
                    $termin["description"] = $description;
                    $termin["datum"] = $datum;
                    $termin["beginn"] = $beginn;
                    $termin["ende"] = $ende;
                    $termin['ort_short'] = $ort_kurz;
                    $termin['ort'] = $ort;
                    $termin['published'] = 'yes';
                    $this->m_appointment->insert($termin);
                    echo "Inserted " . $lineToInsert . " into db\n";
                }
            }

            echo "INSERT_OK";
        }
    }
    
    /**
     * Terminimport::generate_pdf()
     * generate pdf from db schedule entries
     */
    public function generate_pdf() {
        
        $this->load->helper('pdf_helper');
        $rows = $this->m_appointment->get(TRUE, 'object');
        foreach($rows->result() as $row) {
            
        }
    }

}

/* End of file Terminimport.php */
/* Location: ./application/controllers/terminimport/Terminimport.php */