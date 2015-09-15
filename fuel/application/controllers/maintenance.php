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
    
    public function fahrzeugbilder() {
        
        $this->load->model('fahrzeuge_model');
        $data = $this->fahrzeuge_model->find_all();
        
        foreach($data as $fahrzeug) {
            
            $this->load->model('fahrzeug_images_model');
            $images = $this->fahrzeug_images_model->find_all(array('length(image) >' => "50", 'fahrzeug_id' => $fahrzeug->id));
            $i = 1;
            $name = str_replace(" ", "_", $fahrzeug->name);
            $name = str_replace("/", "_", $name);

            foreach($images as $image) {
                
                $target = $_ENV["DOCUMENT_ROOT"] . "/assets/images/fahrzeuge/" . $image->image;
                    $bildname = $name."_".$i;
                        $newName = $_ENV["DOCUMENT_ROOT"] . "/assets/images/fahrzeuge/" . $bildname . ".jpg";
                        $renameResult = rename($target, $newName);
                        // Evaluate the value returned from the function if needed
                        if ($renameResult == true)
                        {
                            echo $target . " is now named " . $newName . "<br/>";
        
                            if($image->description == "") $image->description = $fahrzeug->name." ".$i;
                            $image->image = $bildname . ".jpg";
                            $image->save();
                        } else
                        {
                            echo "Could not rename that file";
                        }
                    
                    $i++;
            }
        }
    }
    
    public function newsbilder() {
    
        $this->load->model('news_articles_model');
        $data = $this->news_articles_model->find_all();
        
        foreach($data as $news) {
            $this->load->model('news_images_model');
            $images = $this->news_images_model->find_all(array('length(image) >' => "50", 'news_id' => $news->id));
            $i = 1;
            foreach($images as $image) {
                
                    $target = $_ENV["DOCUMENT_ROOT"] . "/assets/images/news/" . $image->image;
                    $name = str_replace(" ", "_", $news->title);
                    $bildname = $news->datum."_".$name."_".$i;
                        $newName = $_ENV["DOCUMENT_ROOT"] . "/assets/images/einsaetze/" . $bildname . ".jpg";
                        $renameResult = rename($target, $newName);
                        // Evaluate the value returned from the function if needed
                        if ($renameResult == true)
                        {
                            echo $target . " is now named " . $newName . "<br/>";
        
                            if($image->description == "") $image->description = $news->title." ".$i;
                            $image->image = $bildname . "_" . ".jpg";
                            $image->save();
                        } else
                        {
                            echo "Could not rename that file";
                        }
                    
                    $i++;
            }
        }
    }

    public function einsatzbilder()
    {
        $this->load->model('missions_model');
        $data = $this->missions_model->find_all();

        foreach ($data as $einsatz)
        {
            $this->load->model("mission_images_model");
            $images = $this->mission_images_model->find_all(array("mission_id" => $einsatz->id));

            $i = 1;
            foreach ($images as $image)
            {   
                    $target = $_ENV["DOCUMENT_ROOT"] . "/assets/images/einsaetze/" . $image->image;

                    if(!file_exists($target)) {
                        $image->delete();
                    } else {

                        $einsatzname = str_replace(" ", "_", $einsatz->name);
                        $einsatzname = $einsatz->datum_beginn."_".$einsatz->uhrzeit_beginn."_".$einsatzname."_".$i;
                        
                        $newName = $_ENV["DOCUMENT_ROOT"] . "/assets/images/einsaetze/" . $einsatzname . ".jpg";
                        $renameResult = rename($target, $newName);
                        // Evaluate the value returned from the function if needed
                        if ($renameResult == true)
                        {
                            echo $target . " is now named " . $newName . "<br/>";
        
                            if($image->description == "") $image->description = $einsatz->name." ".$i;
                            $image->image = $einsatzname . "_" . ".jpg";
                            $image->save();
                        } else
                        {
                            echo "Could not rename that file";
                        }
                        $i++;
                    }
            }
        }
    }
}

/* End of file maintenance.php */
/* Location: ./application/controllers/maintenance.php */
