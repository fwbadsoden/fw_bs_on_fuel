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
	'file' 		=> $config['layouts_path'].'main',
	'class'		=> 'Main_layout',
	'filepath' => 'libraries/_layouts',
	'filename' => 'Main_layout.php',	
	'fields'	=> array(
       // 'Stage' => array('type' => 'fieldset', 'label' => 'Bildbühne', 'class' => 'tab'),
       // 'stagesel' => array('type' => 'select', 'label' => 'Bildbühne','model' => array('stages_model' => 'stages')),
    	'Body' => array('type' => 'fieldset', 'label' => 'Body', 'class' => 'tab'),
		'body' => array('label' => lang('layout_field_body'), 'type' => 'textarea', 'description' => lang('layout_field_body_description')),
	)
);

/* End of file MY_fuel_layouts.php */
/* Location: ./application/config/MY_fuel_layouts.php */

