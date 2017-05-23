<?php

/*
  |--------------------------------------------------------------------------
  | MY Custom Modules
  |--------------------------------------------------------------------------
  |
  | Specifies the module controller (key) and the name (value) for fuel
 */


/* * ********************* EXAMPLE ***********************************

  $config['modules']['quotes'] = array(
  'preview_path' => 'about/what-they-say',
  );

  $config['modules']['projects'] = array(
  'preview_path' => 'showcase/project/{slug}',
  'sanitize_images' => FALSE // to prevent false positives with xss_clean image sanitation
  );

 * ********************** /EXAMPLE ********************************** */

$config['modules']['Stages'] = array(
    'module_name' => 'Bildbühnen',
    'instructions' => lang("stage_instructions"),
    'permission' => 'stages',
    'item_actions' => array('save', 'delete', 'create')
);

$config['modules']['Stage_images'] = array(
    'module_name' => 'Bildbühnenbilder',
    'instructions' => lang("stage_images_instructions"),
    'permission' => 'stages',
    'display_field' => 'name',
    'table_headers' => array('id', 'name', 'link', 'text_1', 'text_2'),
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Stage_types'] = array(
    'module_name' => 'Bildbühnentypen',
    'instructions' => lang("stage_types_instructions"),
    'permission' => 'stage_types',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Missions'] = array(
    'module_name' => 'Einsätze',
    'instructions' => lang("einsatz_instructions"),
    'permission' => 'missions',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Mission_types'] = array(
    'module_name' => 'Einsatzarten',
    'instructions' => lang("einsatz_types_instructions"),
    'permission' => 'mission_types',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Mission_images'] = array(
    'module_name' => 'Einsatzbilder',
    'display_field' => 'image',
    'instructions' => lang("einsatz_images_instructions"),
    'permission' => 'missions',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Mission_cues'] = array(
    'module_name' => 'Einsatzstichwörter',
    'instructions' => lang("einsatz_cues_instructions"),
    'permission' => 'mission_cues',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Mission_templates'] = array(
    'module_name' => 'Einsatzvorlagen',
    'instructions' => lang("einsatz_templates_instructions"),
    'permission' => 'mission_templates',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Fahrzeuge'] = array(
    'module_name' => 'Fahrzeuge',
    'instructions' => lang("fahrzeuge_instructions"),
    'permission' => 'vehicles',
    'limit_options' => array('1000' => '1000'),
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Fahrzeug_images'] = array(
    'module_name' => 'Fahrzeugbilder',
    'instructions' => lang("fahrzeuge_images_instructions"),
    'display_field' => 'image',
    'permission' => 'vehicles',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Fahrzeug_fittings'] = array(
    'module_name' => 'Fahrzeuganbauten',
    'instructions' => lang("fahrzeuge_fittings_instructions"),
    'display_field' => 'name',
    'permission' => 'vehicles',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Fahrzeug_loadings'] = array(
    'module_name' => 'Fahrzeugbeladung',
    'instructions' => lang("fahrzeug_loadings_instructions"),
    'display_field' => 'name',
    'permission' => 'vehicles',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Fahrzeug_special_functions'] = array(
    'module_name' => 'Fahrzeugbesonderheiten',
    'instructions' => lang("fahrzeug_special_functions_instructions"),
    'display_field' => 'name',
    'permission' => 'vehicles',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Mannschaft_members'] = array(
    'module_name' => 'Mannschaft',
    'instructions' => lang("mannschaft_members_instructions"),
    'permission' => 'mannschaft_members',
    'limit_options' => array('20' => '20', '50' => '50'),
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Mannschaft_sections'] = array(
    'module_name' => 'Mannschaft Abteilungen',
    'default_col' => 'precedence',
    'instructions' => lang("mannschaft_sections_instructions"),
    'permission' => 'mannschaft_sections',
    'hidden' => true,
);

$config['modules']['Mannschaft_grades'] = array(
    'module_name' => 'Mannschaft Dienstgrade',
    'default_col' => 'precedence',
    'instructions' => lang("mannschaft_grades_instructions"),
    'permission' => 'mannschaft_grades',
    'hidden' => true,
);

$config['modules']['Mannschaft_executives'] = array(
    'module_name' => 'Mannschaft Führungsfunktionen',
    'default_col' => 'precedence',
    'instructions' => lang("mannschaft_executives_instructions"),
    'permission' => 'mannschaft_executives',
    'hidden' => true,
);

$config['modules']['Mannschaft_teams'] = array(
    'module_name' => 'Mannschaft Teams',
    'instructions' => lang("mannschaft_teams_instructions"),
    'permission' => 'mannschaft_teams',
    'hidden' => true,
);

$config['modules']['News_articles'] = array(
    'module_name' => 'Newsartikel',
    'instructions' => lang("news_article_instructions"),
    'permission' => 'news',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['News_images'] = array(
    'module_name' => 'Newsbilder',
    'display_field' => 'image',
    'instructions' => lang("news_images_instructions"),
    'permission' => 'news',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Pressarticles'] = array(
    'module_name' => 'Presseartikel',
    'instructions' => lang("presse_instructions"),
    'permission' => 'pressarticles',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Pressarticle_sources'] = array(
    'module_name' => 'Presseartikel - Quellen',
    'display_field' => 'name',
    'instructions' => lang("presse_sources_instructions"),
    'permission' => 'pressarticle_sources',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);

$config['modules']['Appointments'] = array(
    'module_name' => 'Termine',
    'instructions' => lang("appointments_instructions"),
    'permission' => 'appointments',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);
$config['modules']['Autosuggests'] = array(
    'module_name' => 'Vorschlagswerte',
    'instructions' => lang("autosuggests_instructions"),
    'permission' => 'autosuggests',
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete', 'duplicate', 'create')
);
$config['modules']['Tickets'] = array(
    'module_name' => 'Ticketshop',
    'instructions' => 'Ticketbestellungen verwalten',
    'permission' => 'ticketshop',
    'limit_options' => array('1000' => '1000'),
    'item_actions' => array('save', 'view', 'publish', 'activate', 'delete')
);

/* * ********************* OVERWRITES *********************************** */

$config['module_overwrites']['categories']['hidden'] = FALSE; // change to FALSE if you want to use the generic categories module
$config['module_overwrites']['tags']['hidden'] = TRUE; // change to FALSE if you want to use the generic tags module

$config['module_overwrites']['pages']['model_name'] = 'MY_pages_model';

/*********************** /OVERWRITES ************************************/
