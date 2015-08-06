<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Layouts
|--------------------------------------------------------------------------
|
| specify the name of the layouts and their fields associated with them
*/

$config['default_layout'] = 'Inhaltsseiten';

$config['layouts_folder'] = '_layouts';

$config['hidden'] = array();

$config['layouts']['Inhaltsseiten'] = array(
	'file' 		=> $config['layouts_path'].'main',
	'class'		=> 'Main_layout',
	'filepath' => 'libraries/_layouts',
	'filename' => 'Main_layout.php',	
	'fields'	=> array(
    	'Body' => array('type' => 'fieldset', 'label' => 'Hauptinhalt', 'class' => 'tab'),
		'body' => array('label' => lang('layout_field_body'), 'type' => 'textarea', 'description' => lang('layout_field_body_description')),
	)
);
                
//$fahrzeuge_layout = new Fuel_layout('fahrzeuge'); 
//$fahrzeuge_layout->set_description("Layout für alle Modulbasierten Inhaltsseiten");
//$fahrzeuge_layout->set_label("Fahrzeuge");
//$fahrzeuge_layout->in               
$config['layouts']['Fahrzeuge'] = array(
	'file' 		=> $config['layouts_path'].'fahrzeuge_module',
	'class'		=> 'Module_layout',
	'filepath' => 'libraries/_layouts',
	'filename' => 'Module_layout.php'
);
                
$config['layouts']['News'] = array(
	'file' 		=> $config['layouts_path'].'news_module',
	'class'		=> 'Module_layout',
	'filepath' => 'libraries/_layouts',
	'filename' => 'Module_layout.php'
);

/* End of file MY_fuel_layouts.php */
/* Location: ./application/config/MY_fuel_layouts.php */

