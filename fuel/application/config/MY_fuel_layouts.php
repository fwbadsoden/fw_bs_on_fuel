<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Layouts
|--------------------------------------------------------------------------
|
| specify the name of the layouts and their fields associated with them
*/

$config['default_layout'] = 'main';

$config['layouts_folder'] = '_layouts';

$config['hidden'] = array();

$config['layouts']['main'] = array(
	'file' 		  => $config['layouts_path'].'main',
    'description' => "Dieses Layout wird für alle statischen Inhaltsseiten genutzt.",
	'class'		  => 'Main_layout',
	'filepath'    => 'libraries/_layouts',
	'filename'    => 'Main_layout.php',	
	'fields'	  => array('Body'  => array('type' => 'fieldset', 'label' => 'Hauptinhalt', 'class' => 'tab'),
                	       'body'  => array('label' => lang('layout_field_body'), 'type' => 'textarea', 'description' => lang('layout_field_body_description')),)
);
            
$module_options = array('altersabteilung' => 'Alters- und Ehrenabteilung', 'einsatz' => 'Einsätze', 'fahrzeug' => 'Fahrzeuge', 'mannschaft' => 'Mannschaft', 'news' => 'News', 'presse' => 'Presse', 'startseite' => 'Startseite', 'termin' => 'Termine' );
$config['layouts']['module'] = array(
	'file' 		  => $config['layouts_path'].'module_pages',
    'label'       => "Modulseite",
    'description' => "Layout für alle Modulbasierten Inhaltsseiten",
	'class'		  => 'Module_layout',
	'filepath'    => 'libraries/_layouts',
	'filename'    => 'Module_layout.php',
    'fields'      => array('Parameters'  => array('type' => 'fieldset', 'label' => 'Steuerparameter', 'clas' => 'tab'),
                           'my_module'   => array('type' => 'select', 'label' => 'Modul', 'options' => $module_options))
);

/* End of file MY_fuel_layouts.php */
/* Location: ./application/config/MY_fuel_layouts.php */

