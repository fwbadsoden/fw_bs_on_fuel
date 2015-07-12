<?php
/*
|---------------------------------------------------------------------------------------------------
| IMPORTANT: for a complete list of fuel configurations, go to the modules/fuel/config/fuel.php file
|---------------------------------------------------------------------------------------------------
*/

// path to the fuel admin from the web base directory... MUST HAVE TRAILING SLASH!
$config['fuel_path'] = 'fuel/';

// the name to be displayed on the top left of the admin
$config['site_name'] = 'Feuerwehr Bad Soden';

// whether the admin backend is enabled or not
$config['admin_enabled'] = TRUE;

// options are cms, views, and auto. 
// cms pulls views and variables from the database,
// views mode pulls views from the views folder and variables from the _variables folder,
// and the auto option will first check the database for a page and if it doesn't exist or is 
// not published, it will then check for the corresponding view file.
$config['fuel_mode'] = 'auto';

// specifies which modules are allowed to be used in the fuel admin
$config['modules_allowed'] = array(
	'user_guide',
);

// used for system emails
$config['domain'] = '';

// shows an alert in the admin backend if this is the admin password
$config['default_pwd'] = 'admin';

// maximum number of paramters that can be passed to the page. Used to cut down on queries to the db.
// If it is an array, then it will loop through the array using the keys to match against a regular expression:
// $config['max_page_params'] = array('about/news/' => 1);
$config['max_page_params'] = 0;

// will auto search view files. 
// If the URI is about/history and the about/history view 
// does not exist but about does, it will render the about page
$config['auto_search_views'] = FALSE;

// max upload files size for assets
$config['assets_upload_max_size']	= 5000;

// max width for asset images being uploaded
$config['assets_upload_max_width']  = 1024;

// max height for asset images being uploaded
$config['assets_upload_max_height']  = 768;


// text editor settings  (options are markitup or ckeditor)
// markitup: allows you to visualize the code in its raw format - not wysiwyg (http://markitup.jaysalvat.com/)
// ckeditor: suitable for clients; shows what the output will look like in the page (http://ckeditor.com/)
$config['text_editor'] = 'markitup';

/*
|--------------------------------------------------------------------------
| Language settings 
|--------------------------------------------------------------------------
*/

// Languages for pages. The key is saved to the page variables
$config['languages'] = array(
	'german' => 'Deutsch'
);
    
/*
|--------------------------------------------------------------------------
| DB Table settings
|--------------------------------------------------------------------------
*/

// The FUEL specific database tables
$config['tables'] = array(
	'fuel_archives' => 'fw_archives',
	'fuel_blocks' => 'fw_blocks',
	'fuel_categories' => 'fw_categories',
	'fuel_logs' => 'fw_logs',
	'fuel_navigation' => 'fw_navigation',
	'fuel_navigation_groups' => 'fw_navigation_groups',
	'fuel_pages' => 'fw_pages',
	'fuel_pagevars' => 'fw_page_variables',
	'fuel_permissions' => 'fw_permissions',
    'fuel_site_variables' => 'fw_site_variables',
	'fuel_relationships' => 'fw_relationships',
	'fuel_settings' => 'fw_settings',
	'fuel_tags' => 'fw_tags',
	'fuel_users' => 'fw_users'
);
    
// The delimiters used by the parsing engine
$config['parser_delimiters'] = array(
				'tag_comment'   => array('{#', '#}'), // Twig only
				'tag_block'     => array('{%', '%}'), // Twig only
				'tag_variable'  => array('{', '}'), // Used by Twig, Dwoo and CI. Default for twig is '{{', '}}' and Dwoo is '{', '}'
				'interpolation' => array('#{', '}'), // Twig only
			);

// Functions allowed by the parsing engine
$config['parser_allowed_functions'] = array(
	'strip_tags', 'date', 
	'detect_lang','lang',
	'js', 'css', 'swf', 'img_path', 'css_path', 'js_path', 'swf_path', 'pdf_path', 'media_path', 'cache_path', 'captcha_path', 'assets_path', // assets specific
	'fuel_block', 'fuel_model', 'fuel_nav', 'fuel_edit', 'fuel_set_var', 'fuel_var', 'fuel_var_append', 'fuel_form', 'fuel_page', // FUEL specific
	'quote', 'safe_mailto', // HTML/URL specific
	'session_flashdata', 'session_userdata', // Session specific
	'prep_url', 'site_url', 'show_404', 'redirect', 'uri_segment', 'auto_typography', 'current_url' // CI specific
);
/* Uncomment if you want to control FUEL settings in the CMS. Below are a couple examples of ones you can configure
$config['settings'] = array();
$config['settings']['module_stages'] = array();
$config['settings']['site_name'] = array();
if (!empty($config['modules_allowed']))
{
	$config['settings']['modules_allowed'] = array('type' => 'multi', 'options' => array_combine($config['modules_allowed'], $config['modules_allowed']));
}
*/



/* End of file MY_fuel.php */
/* Location: ./application/config/MY_fuel.php */