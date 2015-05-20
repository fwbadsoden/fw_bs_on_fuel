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

$config['modules']['stages'] = array(
    'module_name' => 'Bildbühnen',
    'instructions' => lang("stage_instructions"),
    'permission' => 'stages',
);

$config['modules']['stage_types'] = array(
    'module_name' => 'Bildbühnentypen',
    'permission' => 'stage_types',
);

/*********************** OVERWRITES ************************************/

$config['module_overwrites']['categories']['hidden'] = TRUE; // change to FALSE if you want to use the generic categories module
$config['module_overwrites']['tags']['hidden'] = TRUE; // change to FALSE if you want to use the generic tags module

$config['module_overwrites']['pages']['model_name'] = 'MY_pages_model';

/*********************** /OVERWRITES ************************************/
