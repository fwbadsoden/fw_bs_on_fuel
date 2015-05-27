<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Modules
|--------------------------------------------------------------------------
|
| Specifies the module controller (key) and the name (value) for fuel
*/


/*********************** EXAMPLE ***********************************

$config['modules']['quotes'] = array(
	'preview_path' => 'about/what-they-say',
);

$config['modules']['projects'] = array(
	'preview_path' => 'showcase/project/{slug}',
	'sanitize_images' => FALSE // to prevent false positives with xss_clean image sanitation
);

*********************** /EXAMPLE ***********************************/

$config['modules']['autosuggests'] = array(
    'module_name' => 'Autosuggestwerte',
    //'instructions' => lang("autosuggests_instructions"),
    'permission' => 'autosuggests',
);
$config['modules']['stages'] = array(
    'module_name' => 'Bildbühnen',
    'instructions' => lang("stage_instructions"),
    'permission' => 'stages',
);

$config['modules']['stage_types'] = array(
    'module_name' => 'Bildbühnentypen',
    'instructions' => lang("stage_types_instructions"),
    'permission' => 'stage_types',
);

$config['modules']['einsatz_types'] = array(
    'module_name' => 'Einsatzarten',
    'instructions' => lang("einsatz_types_instructions"),
    'permission' => 'einsatz_types',
);

$config['modules']['einsatz_cues'] = array(
    'module_name' => 'Einsatzstichwörter',
    'instructions' => lang("einsatz_cues_instructions"),
    'permission' => 'einsatz_cues',
);

$config['modules']['mannschaft_members'] = array(
    'module_name' => 'Mannschaft',
    'permission' => 'mannschaft_members',
);

$config['modules']['mannschaft_sections'] = array(
    'module_name' => 'Mannschaft Abteilungen',
    'default_col' => 'precedence',
    'instructions' => lang("mannschaft_sections_instructions"),
    'permission' => 'mannschaft_sections',
    'hidden' => true,
);

$config['modules']['mannschaft_grades'] = array(
    'module_name' => 'Mannschaft Dienstgrade',
    'default_col' => 'precedence',
    'instructions' => lang("mannschaft_grades_instructions"),
    'permission' => 'mannschaft_grades',
);

$config['modules']['mannschaft_executives'] = array(
    'module_name' => 'Mannschaft Führungsfunktionen',
    'default_col' => 'precedence',
    'instructions' => lang("mannschaft_executives_instructions"),
    'permission' => 'mannschaft_executives',
);

$config['modules']['mannschaft_teams'] = array(
    'module_name' => 'Mannschaft Teams',
    'instructions' => lang("mannschaft_teams_instructions"),
    'permission' => 'mannschaft_teams',
    'hidden' => true,
);

$config['modules']['pressarticles'] = array(
    'module_name' => 'Presseartikel',
    'instructions' => lang("presse_instructions"),
    'permission' => 'pressarticles',
);

$config['modules']['pressarticle_sources'] = array(
    'module_name' => 'Presseartikel - Quellen',
    'display_field' => 'name',
    'instructions' => lang("presse_sources_instructions"),
    'permission' => 'pressarticle_sources',
);

$config['modules']['appointments'] = array(
    'module_name' => 'Termine',
    'instructions' => lang("appointments_instructions"),
    'permission' => 'appointments',
);

/*********************** OVERWRITES ************************************/

$config['module_overwrites']['categories']['hidden'] = FALSE; // change to FALSE if you want to use the generic categories module
$config['module_overwrites']['tags']['hidden'] = TRUE; // change to FALSE if you want to use the generic tags module

$config['module_overwrites']['pages']['model_name'] = 'MY_pages_model';

/*********************** /OVERWRITES ************************************/
