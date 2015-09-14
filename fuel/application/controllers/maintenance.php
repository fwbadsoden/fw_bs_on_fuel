<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Maintenance Controller
 *
 * Controller für Wartungs- und Entwicklungsfunktionalitäten 
 *
 * @author Habib Pleines <habib@familiepleines.de>
 * @version 1.0
 * @package com.cp.feuerwehr.backend.maintenance
 **/

class Maintenance extends CI_Controller
{

    /**
     * Maintenance::__construct()
     * 
     * @return
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function einsatzbilder($offset, $limit)
    { 
        $this->load->model('missions_model');
        $data = $this->missions_model->find_all(NULL, NULL, $limit, $offset);

        foreach ($data as $einsatz)
        {
            $this->load->model("mission_images_model");
            $images = $this->mission_images_model->find_all(array("mission_id" => $einsatz->id));

            $i = 1;
            foreach ($images as $image)
            {
                $target = $_ENV["DOCUMENT_ROOT"]."/assets/images/einsaetze/" . $image->image;
                $newName = $_ENV["DOCUMENT_ROOT"]."/assets/images/einsaetze/" . $einsatz->name . "_" . $i.".jpg";
                $renameResult = rename($target, $newName);
                // Evaluate the value returned from the function if needed
                if ($renameResult == true)
                {
                    echo $target . " is now named " . $newName . "<br/>";
                } else
                {
                    echo "Could not rename that file";
                }
                
                $image->image = $einsatz->name . "_" . $i.".jpg";
                $image->save();
                $i++;
            }
        }
    }
}

/* End of file maintenance.php */
/* Location: ./application/controllers/maintenance.php */
