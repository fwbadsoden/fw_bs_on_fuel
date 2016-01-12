<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['forms'] = array(
		'forms' => 'Formulare', // <--FEEL FREE TO REMOVE THIS IF YOU ARE NOT USING THE CMS TO STORE YOUR FORM INFORMATION
		'form_entries' => 'Einträge', // <--FEEL FREE TO REMOVE THIS IF YOU ARE NOT SAVING FORM ENTRIES
	);


/*
|--------------------------------------------------------------------------
| ADDITIONAL SETTINGS:
|--------------------------------------------------------------------------
*/

// you can add form configurations here which can then be referenced simply by one of the following methods form('test'), $this->fuel->forms->get('test')
$config['forms']['forms'] = array(
    'presse_cfg' => array(
        'anti_spam_method' => array('method' => 'honeypot'),
        'save_entries' => TRUE,
        'name' => 'Presse',
        'slug' => 'presse',
        'fields' => array(
            'message' => array('required' => TRUE, 'label' => 'Nachricht', 'type' => 'textarea'),
            'name' => array('required' => TRUE, 'label' => 'Name', 'type' => 'text'),
            'redaktion' => array('required' => FALSE, 'label' => 'Redaktion / Organisation', 'type' => 'text'),
            'email' => array('required' => TRUE, 'label' => 'Email', 'type' => 'text'),
            'telefon' => array('required' => FALSE, 'label' => 'Telefon', 'type' => 'text')
        ),
        'form_display' => 'block',
        'block_view' => 'forms/contact_form',
        'javascript_submit' => TRUE,
        'javascript_validate' => TRUE,
        'javascript_waiting_message' => 'Senden...',
        'form_action' => 'forms/process/presse',
        'after_submit_text' => 'Vielen Dank! Wir haben Ihre Anfrage erhalten und werden uns mit Ihnen in Verbindung setzen.',
        'email_recipients' => 'pressestelle@feuerwehr-bs.de',
        'email_subject' => 'feuerwehr-bs.de: Anfrage Presse',
    )
);

// Custom fields you want to use with forms (http://docs.getfuelcms.com/general/forms#association_parameters)
$config['forms']['custom_fields'] = array();

// The default testing email address for when then application is not in production
$config['forms']['test_email'] = array('habib@familiepleines.de', 'pa_ritter@arcor.de');

// The default from address to use when sending email notifications
$config['forms']['email_from'] = 'noreply@feuerwehr-bs.de';

// The testing email address for when then application is not in production
$config['forms']['email_subject'] = 'Webseitenformular';

// A list of IP addresses to block
$config['forms']['blacklist'] = array();

// Javascript files to include with each form
$config['forms']['js'] = array();

// Akismet API key if AKISMET is set for the antispam method
$config['forms']['akismet_api_key'] = '';

// Stopforumspam settings
$config['forms']['stopforumspam'] = array(
	'ip_threshold_flag'      => 5,
	'email_threshold_flag'   => 20,
	'ip_threshold_ignore'    => 20,
	'email_threshold_ignore' => 50,
);

// The fields used for SPAM checking
$config['forms']['spam_fields'] = array(
	'email_post_field'       => 'email',
	'name_post_field'        => 'name',
	'comment_post_field'     => 'comment',
);

// Save Spam to form_entries table?
$config['forms']['save_spam'] = TRUE;

// Send messages flagged as Spam to the form recipients?
$config['forms']['send_spam'] = FALSE;

// Will automatically attach any uploaded files to the email
$config['forms']['attach_files'] = TRUE;

// Attached file upload parameters
$config['forms']['attach_file_params'] = array(
	'upload_path'            => APPPATH.'cache/',
	'allowed_types'          => 'pdf|doc|docx',
	'max_size'               => '1000',
);

// Will remove attached files from the file system after being attached
$config['forms']['cleanup_attached'] = TRUE;

// Table configurations
$config['tables']['forms'] = 'fw_forms';
$config['tables']['form_entries'] = 'fw_form_entries';