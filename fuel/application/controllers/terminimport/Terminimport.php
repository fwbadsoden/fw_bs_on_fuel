<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TerminImport
 * Controller als Schnittstelle für den Import der Termine aus dem Informationsportal
 * 
 * @package com.cp.feuerwehr.terminImport.TerminImport  
 * @author Patrick Ritter <pa_ritter@arcor.de>
 * @copyright 
 * @version 2013
 * @access public
 */
class Terminimport extends CI_Controller {

	 /**
	  * Terminimport::__construct()
	  * 
	  * @return
	  */
	 public function __construct()
    {
        parent::__construct();
        $this->load->model('appointments_model', 'm_appointment');  
    }

	/**
	 * Terminimport::fetch()
	*	Provides list of stored future appointments
	 * 
	 * @return
	 */
	public function fetch()
    {
		//Check if remote host is in IP4-Whitelist
		if(in_array($_SERVER['HTTP_HOST'], explode(";",fuel_var("termin_import_whitelist")))){
			echo "NOT AUTHENTICATED: ".$_SERVER['HTTP_HOST'];
			exit;
		}

		//Print for each future appointment id and md5-hash of relevant data
        $where = array('datum >=' => date('Y-m-d'), 'published' => 'yes');
        $order_by = ('datum asc, beginn asc');
		$termine = $this->m_appointment->find_all($where, $order_by);
        foreach($termine as $termin)
        {
			$md5 = md5($termin->name . $termin->description . $termin->datum. $termin->beginn . $termin->ende);
			echo $termin->id.";".$md5."\n";
        }
		echo "FETCH_OK";
     }

	/**
	 * Terminimport::update()
	*	Insert additional and removes obsolete appointments
	 * 
	 * @return
	 */
	public function update()
	{
        if(strpos($name, 'Gesamte Wehr') != false) {
            $category = fuel_model("fuel_categories_model", array('find' => 'one', 'where' => array('slug' => 'gesamte')));
        } elseif(strpos($name, 'Gesamte Wehr') != false) {
            $category = fuel_model("fuel_categories_model", array('find' => 'one', 'where' => array('slug' => 'zusatzdienst')));
        } else {
            $category = fuel_model("fuel_categories_model", array('find' => 'one', 'where' => array('slug' => 'sonstige-dienste')));            
        }
        $category_id = $category->id;
    
		//Check if remote host is in IP4-Whitelist
		if(in_array($_SERVER['HTTP_HOST'], explode(";",fuel_var("termin_import_whitelist")))){
			echo "NOT AUTHENTICATED: ".$_SERVER['HTTP_HOST'];
			exit;
		}

		if(isset($_GET['toDelete']) && isset($_GET['toInsert'])){

			//Delete obsolete appointments 
			if(strlen($_GET['toDelete'])>0){
		    	foreach(explode(";", $_GET['toDelete']) as $idToDelete)
		    	{
					$this->m_termin->delete_termin(intval($idToDelete));	
					echo "Deleted id ".$idToDelete." in db\n";
		    	}
			}

			//Insert additional appointments
			if(strlen($_GET['toInsert'])>0){
				foreach(explode("\n", $_GET['toInsert']) as $lineToInsert)
				{
					list($name,$description,$datum,$beginn,$ende,$md5) = explode(";",$lineToInsert);
                    $termin["category_id"] = $category_id;
                    $termin["name"] = $name;
                    $termin["description"] = $description;
                    $termin["datum"] = $datum;
                    $termin["beginn"] = $beginn;
                    $termin["ende"] = $ende;
                    $termin['ort_short'] = 'Feuerwehr Bad Soden';
                    $termin['ort'] = 'Freiwillige Feuerwehr Bad Soden am Taunus<br />Hunsrückstr. 5-7<br />65812 Bad Soden am Taunus';
                    $termin['published'] = 'yes';
					$this->m_termin->save($termin);
					echo "Inserted ".$lineToInsert." into db\n";
				}
			}

			echo "INSERT_OK";
		}
     }
}

/* End of file Terminimport.php */
/* Location: ./application/controllers/terminimport/Terminimport.php */