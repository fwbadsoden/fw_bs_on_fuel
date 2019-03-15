<?php

/**
 * Mission Admin
 * Controller für die Verwaltung der Einsätze
 *
 * @author Habib Pleines <habib@familiepleines.de>
 * @copyright 
 * @version 2016
 * @access public
 */
class Mission_Admin extends CI_Controller {
    
    /**
     * Mission_Admin::construct()
     * 
     * @return 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Missions_model', 'm_mission');
        $this->load->model('Fahrzeuge_model', 'm_vehicle');
    }

    /**
     * Mission_Admin::json_get_einsatz_template()
     * JSON call get_template für Einsatzerstellung
     * 
     * @param integer $id
     * @return
     */
    public function json_get_einsatz_template($id) {
        
        $template = fuel_model('Mission_templates', array('find' => 'one', 'where' => array('id' => $id)));
      
        //build the JSON array for return
        $vehicles = "";
        foreach($template->fahrzeuge as $fahrzeug) {
            if($vehicles == "") {
                $vehicles = $fahrzeug->id;
            } else {
                $vehicles.="|".$fahrzeug->id;
            }
        }       
        
        $json = array(array('field' => 'name',     'value' => $template->einsatz_name),
                      array('field' => 'lage', 'value' => $template->lage),
                      array('field' => 'bericht', 'value' => $template->bericht),
                      array('field' => 'ort', 'value' => $template->ort),
                      array('field' => 'weitere_kraefte', 'value' => $template->weitere_kraefte),
                      array('field' => 'type_id',      'value' => $template->type_id),
                      array('field' => 'cue_id',      'value' => $template->cue_id),
                      array('field' => 'vehicles',  'value' => $vehicles)
        );
        echo json_encode($json);
    }
    
    public function test() {
        internal_debug("xyz");
    }

    /**
     * Mission_Admin::create_mission()
     * Insert mission into database
     */
    public function create_mission() {
        
        if(isset($_GET["fds_mission"])) {
            // LST_EINSATZNR;EI_V_DAT;EI_V_ZEIT;EI_E_DAT;EI_E_ZEIT;LTS_STICHWORT;DB1_EI_STRASSE;DB1_EI_HAUSNR;DB1_EI_PLZ;DB1_EI_ORT;DB1_EI_ORTSTEIL;FAHRZEUGE
            // FAHRZEUGE: FZG_FUNK_1|FZG_FUNK_2|FZG_FUNK_3...
            list($einsatznr, $datum_beginn, $uhrzeit_beginn, $datum_ende, $uhrzeit_ende, $stichwort, $strasse, $hausnr, $plz, $ort, $ortsteil, $fahrzeuge) = explode(";", $_GET["fds_mission"]);
            $fahrzeuge = explode("|", $fahrzeuge);
            
            if($strasse != "") {
                $ort = $ort.", ".$strasse;
            }
            
            $mission_obj = $this->m_mission->create();
            $mission_obj->einsatz_nr = 0;
            $mission_obj->datum_beginn = get_eng_date($datum_beginn);
            $mission_obj->uhrzeit_beginn = $uhrzeit_beginn;
            $mission_obj->datum_ende = get_eng_date($datum_ende);
            $mission_obj->uhrzeit_ende = $uhrzeit_ende;
            $mission_obj->lage = $stichwort;
            $mission_obj->name = "FDS Import LstNr. ".$einsatznr;
            $mission_obj->ort = $ort;
            
            if($mission_obj != null) {         
                $fahrzeug_objects = array();
                foreach($fahrzeuge as $fahrzeug) {
                    if(stringStartsWith($fahrzeug, "BSO")) {
                        $fahrzeug_id = explode(" ", $fahrzeug);
                        $where = array("rufname" => $fahrzeug_id[1]);
                        $vehicle_obj = $this->m_vehicle->find('one', $where);
                        if($vehicle_obj != null) {
                            array_push($fahrzeug_objects, $vehicle_obj);
                        }
                    }
                }
                if(count($fahrzeug_objects) > 0) {
                    $mission_obj->fahrzeuge = $fahrzeug_objects;
                }
                $mission_obj->save(false);
              // internal_debug($mission_obj);
                echo "Inserted " . $_GET["fds_mission"] . " into db\n";
            }
        }
    }
}

//Beispiel: [FDS]
//Datum=02.01.2019
//Zeit=17:06:10
//Inhalt=Einsatz
//
//[Einsatzdaten]
//EA_EREIGNIS=Einsatzbericht
//EI_V_DAT=02.01.2019
//EI_V_ZEIT=17:06:10
//EA_BSTG_DAT=02.01.2019
//EA_BSTG_ZEIT=17:06:09
//EI_E_DAT=02.01.2019
//EI_E_ZEIT=18:30:27
//LST_EINSATZNR=1190000286
//LST_JAHRNR=2019
//MLDG_DURCH=<ENTFERNT>
//MLDG_UEBER=01
//LTS_STICHWORT_K=1
//LTS_STICHWORT=Brand im Freien
//
//[Einsatzort]
//DB1_EI_STELLE= 
//DB1_EI_STRASSE=Im Hopfengarten
//DB1_EI_HAUSNR=2 -6
//DB1_EI_PLZ=65812
//DB1_EI_ORT=Bad Soden am Taunus
//DB1_EI_ORTSTEIL=Neuenhain
//
//[Alarmierung]
//ALARM_DAT_1=02.01.2019
//ALARM_ZEIT_1=17:06:18
//ALARM_BESCHR_1=Kurzfristige AAO Änderung
//ALARM_UEBER_1=L
//ALARM_DAT_2=02.01.2019
//ALARM_ZEIT_2=17:07:20
//ALARM_BESCHR_2=Alarmfax/-Mail - FW Neuenhain
//ALARM_UEBER_2=M
//ALARM_DAT_3=02.01.2019
//ALARM_ZEIT_3=17:07:20
//ALARM_BESCHR_3=Fax - Feuerwache Neuenhain
//ALARM_UEBER_3=A
//ALARM_DAT_4=02.01.2019
//ALARM_ZEIT_4=17:06:27
//ALARM_BESCHR_4=Mail - Feuerwache Neuenhain
//ALARM_UEBER_4=A
//ALARM_DAT_5=02.01.2019
//ALARM_ZEIT_5=17:06:28
//ALARM_BESCHR_5=Mail - SBI/Führung Bad Soden 
//ALARM_UEBER_5=A
//ALARM_DAT_6=02.01.2019
//ALARM_ZEIT_6=17:06:29
//ALARM_BESCHR_6=Alarm - SBI Bad Soden (532&TME)
//ALARM_UEBER_6=M
//ALARM_DAT_7=02.01.2019
//ALARM_ZEIT_7=17:06:26
//ALARM_BESCHR_7=FME - BSO SBI 532
//ALARM_UEBER_7=G
//ALARM_DAT_8=02.01.2019
//ALARM_ZEIT_8=17:06:28
//ALARM_BESCHR_8=TME.BSO&50.SBI Bad Soden
//ALARM_UEBER_8=G
//ALARM_DAT_9=02.01.2019
//ALARM_ZEIT_9=17:06:29
//ALARM_BESCHR_9=Mail - SBI/Führung Bad Soden 
//ALARM_UEBER_9=A
//ALARM_DAT_10=02.01.2019
//ALARM_ZEIT_10=17:06:27
//ALARM_BESCHR_10=Alarm - FW Neuenhain Feuer
//ALARM_UEBER_10=M
//ALARM_DAT_11=02.01.2019
//ALARM_ZEIT_11=17:06:27
//ALARM_BESCHR_11=FME - NEU 1 Feuer 529
//ALARM_UEBER_11=G
//ALARM_DAT_12=02.01.2019
//ALARM_ZEIT_12=17:06:30
//ALARM_BESCHR_12=Mail - KBM 04-7/SGL Rieger
//ALARM_UEBER_12=A
//
//[LageMeldung]
//LMLDG_DAT_1=02.01.2019
//LMLDG_ZEIT_1=17:17:46
//LMLDG_L_M_1=1 m³ Mülltonne brennt - SRohr und Schaumrohr im Einsatz- keine weiteren Kräfte!
//LMLDG_L_M1_1=
//LMLDG_L_ABS_1=BSO 3-22 
//LMLDG_DAT_2=02.01.2019
//LMLDG_ZEIT_2=17:31:31
//LMLDG_L_M_2=Mülltonne geleert. Abgelöscht. Rückfahrt.
//LMLDG_L_M1_2=
//LMLDG_L_ABS_2=BSO 3-22 
//
//[Fahrzeuge]
//FZG_TYP_1=22
//FZG_FUNK_1=BSO 3-22
//FZG_FMS_CODE_1=67602222
//FZG_AUS_DAT_1=02.01.2019
//FZG_AUS_ZEIT_1=17:09:54
//FZG_EIN_DAT_1=02.01.2019
//FZG_EIN_ZEIT_1=17:11:06
//FZG_ABG_DAT_1=02.01.2019
//FZG_ABG_ZEIT_1=17:30:13
//FZG_RUC_DAT_1=02.01.2019
//FZG_RUC_ZEIT_1=17:32:17
//FZG_TYP_2=42
//FZG_FUNK_2=BSO 3-42
//FZG_FMS_CODE_2=67602242
//FZG_AUS_DAT_2=02.01.2019
//FZG_AUS_ZEIT_2=17:11:31
//FZG_EIN_DAT_2=02.01.2019
//FZG_EIN_ZEIT_2=17:12:38
//FZG_ABG_DAT_2=02.01.2019
//FZG_ABG_ZEIT_2=17:12:59
//FZG_RUC_DAT_2=02.01.2019
//FZG_RUC_ZEIT_2=17:17:01
//FZG_TYP_3=19
//FZG_FUNK_3=BSO 3-19
//FZG_FMS_CODE_3=67602219
//FZG_AUS_DAT_3=02.01.2019
//FZG_AUS_ZEIT_3=17:15:41
//FZG_EIN_DAT_3=
//FZG_EIN_ZEIT_3=
//FZG_ABG_DAT_3=
//FZG_ABG_ZEIT_3=
//FZG_RUC_DAT_3=02.01.2019
//FZG_RUC_ZEIT_3=17:18:21

?>
