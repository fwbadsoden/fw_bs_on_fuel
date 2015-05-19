<?php

/*
|--------------------------------------------------------------------------
| General
|--------------------------------------------------------------------------
*/
$lang['fuel_page_title'] = 'FUEL CMS';
$lang['logged_in_as'] = 'Angemeldet als:';
$lang['logout'] = 'Abmelden';
$lang['fuel_developed_by'] = 'FUEL CMS version %1s is developed by <a href="http://www.thedaylightstudio.com" target="_blank">Daylight Studio</a> and built upon the <a href="http://www.codeigniter.com" target="_blank">CodeIgniter</a> framework.';
$lang['fuel_copyright'] = 'Copyright &copy; %1s Feuerwehr Bad Soden am Taunus.';


/*
|--------------------------------------------------------------------------
| Error Messages
|--------------------------------------------------------------------------
*/
$lang['error_no_access'] = "Sie haben keine Berechtigung diese Seite aufzurufen.";
$lang['error_missing_module'] = "Das Modul %1s ist nicht vorhanden.";
$lang['error_invalid_login'] = 'Anmeldung nicht erfolgreich.';
$lang['error_max_attempts'] = 'Sorry, but your login information was incorrect and you are temporarily locked out. Please try again in %s seconds.';
$lang['error_empty_user_pwd'] = 'Bitte geben Sie einen Benutzernamen und ein Passwort an.';
$lang['error_pwd_reset'] = 'Es gab einen Fehler beim zur&uuml;cksetzen des Passworts.';
$lang['error_invalid_email'] = 'Die angebene Emailadresse ist im System nicht bekannt.';
$lang['error_invalid_password_match'] = 'Die Passwörter stimmen nicht überein.';
$lang['error_empty_email'] = 'Bitte tragen Sie eine Emailadresse ein.';
$lang['error_folder_not_writable'] = 'Das Verzeichnis %1s ist schreibgesch&uuml;tzt.';
$lang['error_invalid_folder'] = 'Ungültiges Verzeichnis %1s';
$lang['error_file_already_exists'] = 'Datei %1s existiert bereits.';
$lang['error_zip'] = 'Es gab einen Fehler beim Anlegen des ZIP Archivs.';
$lang['error_no_permissions'] = 'Sie verf&uuml;gen nicht &uuml;ber die Berechtigung zur Durchf&uuml;hrung der Aktion.';
$lang['error_no_lib_permissions'] = 'Sie verf&uuml;gen nicht &uuml;ber die Berechtigung, Methoden der Klasse %1s auszuf&uuml;hren.';
$lang['error_page_layout_variable_conflict'] = 'Es gibt einen Fehler mit dem Layout. Entweder existiert es nicht oder es enth&auml;lt eines der folgenden reservierten W&ouml;rter: %1s';
$lang['error_no_curl_lib'] = 'Die curl PHP Erweiterung muss aktiviert sein, um diese Tools zu nutzen.';
$lang['error_inline_page_edit'] = 'Diese Variable muss entweder im Adminbereich gespeichert werden oder im zugeordneten View oder der _variables Datei bearbeitet werden.';
$lang['error_saving'] = 'Das Speichern war nicht erfolgreich.';
$lang['error_cannot_preview'] = 'Es gab einen Fehler beim Anzeigen der Seitenvorschau.';
$lang['error_cannot_make_api_call'] = 'Es gab einen Fehler beim API Aufruf zu %1s.';
$lang['error_sending_email'] = 'Es gab einen Fehler beim Senden einer Email an %1s.';
$lang['error_upload'] = 'Es gab einen Fehler beim Hochladen der Datei.';
$lang['error_create_nav_group'] = 'Bitte erstellen Sie eine Navigationsgruppe';
$lang['error_requires_string_value'] = 'Das Name-Feld muss einen String-Wert enthalten';
$lang['error_missing_params'] = 'Es fehlen Parameter zum Anzeigen diese Seite';
$lang['error_invalid_method'] = 'Ung&uuml;ltiger Methodenname';
$lang['error_curl_page'] = 'Fehler beim Laden der Seite mit CURL';
$lang['error_class_property_does_not_exist'] = 'Klasseneigenschaft %1s existiert nicht';
$lang['error_class_method_does_not_exist'] = 'Klassenmethode %1s existiert nicht';
$lang['error_could_not_create_folder'] = 'Das Verzeichnis %1s konnte nicht erstellt werden.';
$lang['error_could_not_create_file'] = 'Die Datei %1s konnte nicht angelegt werden.';
$lang['error_no_build'] = "Kein Build-Setup f&uuml;r dieses Modul.\n";


/*
|--------------------------------------------------------------------------
| Warnings
|--------------------------------------------------------------------------
*/
$lang['warn_change_default_pwd'] = '<strong>Bitte ändern Sie Ihr Passwort von dem Default <em>%1s</em>!</strong>.';
$lang['warn_not_published'] = 'Dieses Element ist nicht veröffentlicht.';
$lang['warn_not_active'] = 'Dieses %1s ist nicht aktiv.';


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/
$lang['logged_in'] = "%s hat sich angemeldet";
$lang['logged_out'] = "%s hat sich abgemeldet";
$lang['dev_pwd_instructions'] = 'Diese Seite ist momentan im Entwicklermodus und Sie brauchen ein Passwort zum betrachten.';
$lang['login_forgot_pwd'] = 'Passwort vergessen?';
$lang['login_reset_pwd'] = 'Passwort zurücksetzen';
$lang['login_btn'] = 'Anmeldung';
$lang['logout_restore_original_user'] = 'Originalbenutzer wiederherstellen';

$lang['auth_log_pass_reset_request'] = "Password reset request for '%1s' from %2s";
$lang['auth_log_pass_reset'] = "Password reset for '%1s' from %2s";
$lang['auth_log_cms_pass_reset'] = "Password reset from CMS for '%1s' from %2s";
$lang['auth_log_login_success'] = "Successful login by '%1s' from %2s";
$lang['auth_log_failed_updating_login_info'] = "There was an error updating the login information for by '%1s' from %2s";
$lang['auth_log_failed_login'] = "Failed login by '%1s' from %2s, login attempts: %3s";
$lang['auth_log_account_lockout'] = "Account lockout for '%1s' from %2s";

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/
$lang['section_dashboard'] = 'Dashboard';
$lang['dashboard_intro'] = 'Willkommen im Feuerwehr Bad Soden CMS.';
$lang['dashboard_hdr_latest_activity'] = 'Letzte Aktivitäten';
$lang['dashboard_hdr_latest_news'] = 'Letzte FUEL News';
$lang['dashboard_hdr_modified'] = 'Zuletzt aktualisierte Seiten';
$lang['dashboard_hdr_site_docs'] = 'Seitendokumenation';
$lang['dashboard_change_pwd'] = 'Passwort ändern';
$lang['dashboard_change_pwd_later'] = 'Ich ändere mein Passwort später';
$lang['dashboard_subscribe_rss'] = 'RSS Feed abonnieren';
$lang['dashboard_view_all_pages'] = 'Alle Seiten ansehen';
$lang['dashboard_view_all_activity'] = 'Alle Aktivitäten ansehen';


/*
|--------------------------------------------------------------------------
| My Profile
|--------------------------------------------------------------------------
*/
$lang['section_my_profile'] = 'Mein Profil';
$lang['profile_instructions'] = 'Ändern Sie Ihre Profilinformationen:';


/*
|--------------------------------------------------------------------------
| My Modules
|--------------------------------------------------------------------------
*/
$lang['section_my_modules'] = 'Meine Module';


/*
|--------------------------------------------------------------------------
| Login/Password Reset
|--------------------------------------------------------------------------
*/
$lang['pwd_reset'] = 'An email to confirm your password reset is on its way.';
$lang['pwd_reset_subject'] = "FUEL admin password reset request";
$lang['pwd_reset_email'] = "Click the following link to confirm the reset of your FUEL password:\n%1s";
$lang['pwd_reset_subject_success'] = "FUEL admin password reset success";
$lang['pwd_reset_email_success'] = "Your FUEL password has been reset to %1s. To change your password, login to the FUEL CMS admin with this password and click on your login name in the upper right to access your profile information.";
$lang['pwd_reset_success'] = 'Your password was successfully reset and an email has been sent to you with the new password.';
$lang['cache_cleared'] = "Site cache cleared explicitly";


/*
|--------------------------------------------------------------------------
| Menu Titles / Sections
|--------------------------------------------------------------------------
*/

$lang['module_dashboard'] = 'Dashboard';
$lang['module_pages'] = 'Seiten';
$lang['module_blocks'] = 'Blöcke';
$lang['module_navigation'] = 'Navigation';
$lang['module_categories'] = 'Kategorien';
$lang['module_tags'] = 'Tags';
$lang['module_assets'] = 'Assets';
$lang['module_sitevariables'] = 'Seiten Variablen';
$lang['module_users'] = 'Benutzer';
$lang['module_permissions'] = 'Berechtigungen';
$lang['module_tools'] = 'Tools';
$lang['module_manage_cache'] = 'Seiten Cache';
$lang['module_manage_activity'] = 'Aktivitätslog';
$lang['module_manage_settings'] = 'Einstellungen';
$lang['module_generate'] = 'Generiert';


$lang['section_site'] = 'Seite';
$lang['section_blog'] = 'Blog';
$lang['section_modules'] = 'Module';
$lang['section_manage'] = 'Verwalten';
$lang['section_tools'] = 'Tools';
$lang['section_settings'] = 'Einstellungen';
$lang['section_recently_viewed'] = 'Kürzlich angesehen';


/*
|--------------------------------------------------------------------------
| Generic Module
|--------------------------------------------------------------------------
*/
$lang['module_created']= "%1s item <em>%2s</em> created";
$lang['module_edited'] = "%1s item <em>%2s</em> edited";
$lang['module_deleted'] = "%1s item for <em>%2s</em> deleted";
$lang['module_multiple_deleted'] = "Multiple <em>%1s</em> deleted";
$lang['module_restored'] = "%1s item restored from archive";
$lang['module_instructions_default'] = "Here you can manage the %1s for your site.";
$lang['module_restored_success'] = 'Previous version successfully restored.';
$lang['module_replaced_success'] = 'The contents of this record were successfully replaced.';
$lang['module_incompatible'] = 'The version of this module is not compatible with the install FUEL version of '.FUEL_VERSION;

$lang['cannot_determine_module'] = "Cannot determine module.";
$lang['incorrect_route_to_module'] = "Incorrect route to access this module.";
$lang['data_saved'] = 'Data has been saved.';
$lang['data_deleted'] = 'Data has been deleted.';
$lang['data_not_deleted'] = 'Some or all data couldn\'t be deleted.';
$lang['no_data'] = 'Keine Datensätze vorhanden.';
$lang['no_preview_path'] = 'There is no preview path assigned to this module.';
$lang['delete_item_message'] = 'You are about to delete the item:';
$lang['replace_item_message'] = 'Select a record from the list below that you would like to replace. Replacing will transfer the data from one record to the other and then delete the old record.';

// command line
$lang['module_install'] = "The '%1s' module has successfully been installed.\n";
$lang['module_install_error'] = "There was an error installing the '%1s' module.\n";

$msg = "The module %1s has been uninstalled in FUEL.\n\n";
$msg .= "However, removing a module from GIT is a little more work that we haven't automated yet. However, the below steps should help.\n\n";
$msg .= "1. Delete the relevant section from the .gitmodules file.\n";
$msg .= "2. Delete the relevant section from .git/config.\n";
$msg .= "3. Run git rm --cached %2s (no trailing slash).\n";
$msg .= "4. Commit and delete the now untracked submodule files.\n";
$lang['module_uninstall'] = $msg;

// build
$lang['module_build_asset'] = "%1s optimized and ouput to %2s\n";

/*
|--------------------------------------------------------------------------
| Migrations
|--------------------------------------------------------------------------
*/
$lang['migrate_success'] = "You have successfully migrated to version %s.\n";
$lang['migrate_nothing_todo'] = "No migrations were necessary.\n";

/*
|--------------------------------------------------------------------------
| List View
|--------------------------------------------------------------------------
*/
$lang['adv_search'] = 'Advanced Search';
$lang['reset_search'] = 'Reset Search';


/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/

$lang['page_route_warning'] = 'The location specified has the following routes already specified in the routes file (%1s):';
$lang['page_controller_assigned'] = 'There is a controller method already assigned to this page.';
$lang['page_updated_view'] = 'There is an updated view file located at <strong>%1s</strong>. Would you like to upload it into the body of your page (if available)?';
$lang['page_not_published'] = 'Diese Seite ist nicht veröffentlicht.';

$lang['page_no_upload'] = 'Nein, nicht hochladen';
$lang['page_yes_upload'] = 'Ja, hochladen';
$lang['page_information'] = 'Seiteninformation';
$lang['page_layout_vars'] = 'Layout Variablen';

$lang['pages_instructions'] = 'Hier können Sie die Daten der gewählten Seite bearbeiten.';
$lang['pages_associated_navigation'] = 'Zugehörige Navigation';
$lang['pages_success_upload'] = 'Die Seite wurde erfolgreich hochgeladen.';
$lang['pages_upload_instructions'] = 'Wählen Sie eine View-Datei und laden Sie diese zu einer der nachstehenden Seiten hoch.';
$lang['pages_select_action'] = 'Auswählen';

// page specific form fields
$lang['form_label_layout'] = 'Layout';
$lang['form_label_cache'] = 'Cache';
$lang['pages_last_updated'] = 'Zuletzt aktualisiert %1s';
$lang['pages_last_updated_by'] = 'Zuletzt aktualisiert %1s von %2s';
$lang['pages_not_published'] = 'Diese Seite ist nicht veröffentlicht.';
$lang['pages_default_location'] = 'Beispiel: company/about';

$lang['form_label_page'] = 'Seite';
$lang['form_label_target'] = 'Ziel';
$lang['form_label_class'] = 'Klasse';

$lang['navigation_related'] = 'Navigation erstellen';
$lang['navigation_quick_add'] = 'Dieses Feld lässt Sie schnell ein Navigationselement für diese Seite erstellen. Dies ist nur bei der Seitenerstellung möglich. Um das Element zu bearbeiten, klicken Sie auf den \'Navigation\'-Link auf der linken Seite, suchen das Element, welches Sie ändern wollen und wählen \'Bearbeiten\'.';

$lang['page_select_pages'] = 'Seiten';
$lang['page_select_pdfs'] = 'PDFs';

/*
|--------------------------------------------------------------------------
| Blocks
|--------------------------------------------------------------------------
*/
$lang['blocks_updated_view'] = 'There is an updated view file located at <strong>%1s</strong>. Would you like to import?';
$lang['blocks_success_upload'] = 'The block view was successfully uploaded.';
$lang['blocks_upload_instructions'] = 'Select a block view file and upload it below.';

$lang['form_label_view'] = 'View';

/*
|--------------------------------------------------------------------------
| Navigation
|--------------------------------------------------------------------------
*/
$lang['navigation_import'] = 'Navigation importieren';
$lang['navigation_instructions'] = 'Here you create and edit the top menu items of the page.';
$lang['navigation_import_instructions'] = 'Select a navigation group and upload a file to import below. The file should contain the PHP array variable assigned in the variable field below (e.g. <strong>$nav</strong>). For a reference of the array format, please consult the <a href="http://docs.getfuelcms.com/general/navigation" target="_blank">user guide</a>.';
$lang['navigation_success_upload'] = 'The navigation was successfully uploaded.';
$lang['form_label_navigation_group'] = 'Navigationsgruppe:';
$lang['form_label_nav_key'] = 'Schlüssel';
$lang['form_label_parent_id'] = 'Vorgänger';
$lang['form_label_attributes'] = 'Attribute';
$lang['form_label_selected'] = 'Ausgewählt';
$lang['form_label_hidden'] = 'Versteckt';

$lang['error_location_parents_match'] = 'Position und Vorgänger dürfen nicht identisch sein.';

// for upload form
$lang['form_label_clear_first'] = 'Erst leeren';


/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
*/
$lang['assets_instructions'] = 'Hier können Sie neue Assets hochladen. Wählen Sie überschreiben, wenn Sie eine bestehende Datei mit dem selben Namen überschreiben wollen.';
$lang['form_label_preview/kb'] = 'Vorschau/kb';
$lang['form_label_link'] = 'Link';
$lang['form_label_asset_folder'] = 'Asset Verzeichnis';
$lang['form_label_new_file_name'] = 'Neuer Dateiname';
$lang['form_label_subfolder'] = 'Unterverzeichnis';
$lang['form_label_overwrite'] = 'Überschreiben';
$lang['form_label_create_thumb'] = 'Thumbnail erstellen';
$lang['form_label_resize_method'] = 'Größenanpassungs-Methode';
$lang['form_label_maintain_ratio'] = 'Verhältnis beibehalten';
$lang['form_label_resize_and_crop'] = 'Beschneiden, wenn nötig';
$lang['form_label_overwrite'] = 'Überschreiben';
$lang['form_label_width'] = 'Breite';
$lang['form_label_height'] = 'Höhe';
$lang['form_label_alt'] = 'Alt';
$lang['form_label_align'] = 'Ausrichtung';
$lang['form_label_master_dim'] = 'Master Dimension';
$lang['form_label_unzip'] = 'Zipdateien entpacken';
$lang['assets_upload_action'] = 'Hochladen';
$lang['assets_select_action'] = 'Auswählen';
$lang['assets_comment_asset_folder'] = 'Das Asset Verzeichnis, in das hochgeladen wird';
$lang['assets_comment_filename'] = 'Wenn kein Name übermittelt wird, dann wird der bereits existierende DateinIf no name is provided, the filename that already exists will be used.';
$lang['assets_comment_subfolder'] = 'Es wird versucht, ein Unterverzeichnis anzulegen, um das Asset darin zu platzieren.';
$lang['assets_comment_overwrite'] = 'Eine Datei mit identischem Namen überschreiben. Wenn nicht angehakt, dann wird eine neue Datei mit einer Versionsnummer am Ende hochgeladen.';
$lang['assets_heading_general'] = 'Allgemein';
$lang['assets_heading_image_specific'] = 'Bild-bezogen';
$lang['assets_comment_thumb'] = 'Ein Thumbnail des Bilds erstellen.';
$lang['assets_comment_resize_method'] = 'Maintains the aspect ratio or resizes and crops the image to fit the provided dimensions. If "Create thumbnail" is selected, it will only effect the size of the thumbnail.';
$lang['assets_comment_width'] = 'Will change the width of an image to the desired amount. If "Create thumbnail" is selected, then it will only effect the size of the thumbnail.';
$lang['assets_comment_height'] = 'Will change the height of an image to the desired amount. If "Create thumbnail" is selected, it will only effect the size of the thumbnail.';
$lang['assets_comment_master_dim'] = 'Specifies the master dimension to use for resizing. If the source image size does not allow perfect resizing to those dimensions, this setting determines which axis should be used as the hard value. "auto" sets the axis automatically based on whether the image is taller then wider, or vice versa.';
$lang['assets_comment_unzip'] = 'Entpackt eine Zip Datei';

/*
|--------------------------------------------------------------------------
| Site Variables
|--------------------------------------------------------------------------
*/
$lang['sitevariables_instructions'] = 'Hier können Sie die Seitenvariablen Ihrer Webseite verwalten.';
$lang['sitevariables_scope'] = 'Geltungsbereich';


/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/
$lang['users_instructions'] = 'Hier können Sie die Benutzerdaten verwalten.';
$lang['permissions_heading'] = 'Berechtigungen';
$lang['form_label_language'] = 'Sprache';
$lang['form_label_send_email'] = 'Email senden';
$lang['btn_send_email'] = 'Email senden';
$lang['new_user_email_subject'] = 'Your FUEL CMS account has been created';
$lang['new_user_email'] = 'Your FUEL CMS account has been created. You can login with the following information:
Login URL: %1s
Benutzername: %2s
Passwort: %3s';
$lang['new_user_created_notification'] = 'The user information was successfully saved and a notification was sent to %1s.';
$lang['error_cannot_deactivate_yourself'] = 'Sie können Sich nicht selber deaktivieren.';


/*
|--------------------------------------------------------------------------
| Permissions
|--------------------------------------------------------------------------
*/
$lang['permissions_instructions'] = 'Here you can manage the permissions for FUEL modules and later assign them to users.';
$lang['form_label_other_perms'] = 'Generate related simple<br /> module permissions';

/*
|--------------------------------------------------------------------------
| Manage Cache
|--------------------------------------------------------------------------
*/
$lang['cache_cleared'] = 'Der Cache wurde geleert.';
$lang['cache_instructions'] = 'Sie sind dabei, den Cache der Webseite zu löschen.';
$lang['cache_no_clear'] = 'Nein, den Cache nicht leeren';
$lang['cache_yes_clear'] = 'Ja, Cache leeren';


/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
*/
$lang['settings_none'] = 'There are no settings for any advanced modules to manage.';
$lang['settings_manage'] = 'Manage the settings for the following advanced modules:';
$lang['settings_problem'] = 'There was a problem with the settings for the advanced module <strong>%1s</strong>. <br />Check that <strong>/fuel/modules/%1s/config/%1s.php</strong> config is configured to handle settings.';


/*
|--------------------------------------------------------------------------
| Generate
|--------------------------------------------------------------------------
*/
$lang['error_not_cli_request'] = 'This is not a CLI request.';
$lang['error_not_in_dev_mode'] = 'This will only run in dev mode.';
$lang['error_missing_generation_files'] = 'There are no generation files to create for %1s.';


/*
|--------------------------------------------------------------------------
| Table Actions
|--------------------------------------------------------------------------
*/
$lang['table_action_edit'] = 'BEARBEITEN';
$lang['table_action_delete'] = 'LÖSCHEN';
$lang['table_action_view'] = 'ANSEHEN';
$lang['click_to_toggle'] = 'umschalten';
$lang['table_action_login_as'] = 'ANMELDEN ALS';


/*
|--------------------------------------------------------------------------
| Labels
|--------------------------------------------------------------------------
*/
$lang['label_show'] = 'Zeigen:';
$lang['label_language'] = 'Sprache:';
$lang['label_restore_from_prev'] = 'Aus vorheriger Version wiederherstellen...';
$lang['label_select_another'] = 'Wählen Sie ein anderes...';
$lang['label_select_one'] = 'Wählen Sie eins...';
$lang['label_belongs_to'] = 'Gehört';
$lang['label_select_a_language'] = 'Wählen Sie eine Sprache...';


/*
|--------------------------------------------------------------------------
| Buttons
|--------------------------------------------------------------------------
*/
$lang['btn_list'] = 'Liste';
$lang['btn_tree'] = 'Baum';
$lang['btn_create'] = 'Erstellen';
$lang['btn_delete_multiple'] = 'Mehrere löschen';
$lang['btn_rearrange'] = 'Neu anordnen';
$lang['btn_search'] = 'Suche';
$lang['btn_view'] = 'Ansehen';
$lang['btn_publish'] = 'Veröffentlichen';
$lang['btn_unpublish'] = 'Offline setzen';
$lang['btn_activate'] = 'Aktivieren';
$lang['btn_deactivate'] = 'Deaktivieren';
$lang['btn_delete'] = 'Löschen';
$lang['btn_duplicate'] = 'Duplizieren';
$lang['btn_replace'] = 'Ersetzen';
$lang['btn_ok'] = 'OK';
$lang['btn_upload'] = 'Hochladen';
$lang['btn_download'] = 'Herunterladen';
$lang['btn_export_data'] = 'Export';

$lang['btn_no'] = 'Nein';
$lang['btn_yes'] = 'Ja';

$lang['btn_no_upload'] = 'Nein, nicht hochladen';
$lang['btn_yes_upload'] = 'Ja, hochladen';

$lang['btn_no_dont_delete'] = 'Nein, nicht löschen';
$lang['btn_yes_dont_delete'] = 'Ja, löschen';


/*
|--------------------------------------------------------------------------
| Common Form Labels
|--------------------------------------------------------------------------
*/
$lang['form_label_name'] = 'Name';
$lang['form_label_title'] = 'Titel';
$lang['form_label_label'] = 'Label';
$lang['form_label_location'] = 'Position';
$lang['form_label_published'] = 'Veröffentlicht';
$lang['form_label_active'] = 'Aktiv';
$lang['form_label_precedence'] = 'Rangfolge';
$lang['form_label_date_added'] = 'Erstellungsdatum';
$lang['form_label_last_updated'] = 'Aktualisiert:';
$lang['form_label_file'] = 'Datei';
$lang['form_label_value'] = 'Wert';
$lang['form_label_email'] = 'Email';
$lang['form_label_user_name'] = 'Benutzername';
$lang['form_label_first_name'] = 'Vorname';
$lang['form_label_last_name'] = 'Nachname';
$lang['form_label_super_admin'] = 'Superadmin';
$lang['form_label_password'] = 'Passwort';
$lang['form_label_confirm_password'] = 'Passwort bestätigen';
$lang['form_label_new_password'] = 'Neues Passwort';
$lang['form_label_description'] = 'Beschreibung';
$lang['form_label_entry_date'] = 'Eintrittsdatum';
$lang['form_label_message'] = 'Nachricht';
$lang['form_label_image'] = 'Bild';
$lang['form_label_upload_image'] = 'Bild hochladen';
$lang['form_label_upload_images'] = 'Bilder hochladen';
$lang['form_label_content'] = 'Inhalt';
$lang['form_label_excerpt'] = 'Auszug';
$lang['form_label_permalink'] = 'Permalink';
$lang['form_label_slug'] = 'Slug';
$lang['form_label_url'] = 'URL';
$lang['form_label_link'] = 'Link';
$lang['form_label_pdf'] = 'PDF';

$lang['form_label_group_id'] = 'Gruppe';
$lang['form_label_or_select'] = 'OR select';

$lang['form_enum_option_yes'] = 'ja';
$lang['form_enum_option_no'] = 'nein';

$lang['required_text'] = 'Pflichtfelder';


/*
|--------------------------------------------------------------------------
| Layouts
|--------------------------------------------------------------------------
*/
$lang['layout_field_main_copy'] = 'This is the main layout to be used for your site.';
$lang['layout_field_page_title'] = 'Seitentitel';
$lang['layout_field_meta_description'] = 'Meta description';
$lang['layout_field_meta_keywords'] = 'Meta keywords';
$lang['layout_field_body'] = 'Body';
$lang['layout_field_heading'] = 'Überschrift';
$lang['layout_field_body_description'] = 'Hauptinhalt der Seite';
$lang['layout_field_body_class'] = 'Body Klasse';
$lang['layout_field_redirect_to'] = 'Weiterleiten zu';

$lang['layout_field_301_redirect_copy'] = 'This layout will do a 301 redirect to another page.';
$lang['layout_field_alias_copy'] = 'This layout is similar to a 301 redirect but the location of the page does not change and <br />the page content from the specifiec location is used to render the page.';
$lang['layout_field_sitemap_xml_copy'] = 'This layout is used to generate a sitemap. For this page to appear, a sitemap.xml must not exist on the server.';
$lang['layout_field_robots_txt_copy'] = 'This layout is used to generate a robots.txt file. For this page to appear, a robots.txt must not exist on the server.';
$lang['layout_field_none_copy'] = 'This layout is the equivalent of having no layout assigned.';

$lang['layout_field_frequency'] = 'Häufigkeit';
$lang['layout_field_frequency_always'] = 'immer';
$lang['layout_field_frequency_hourly'] = 'stündlich';
$lang['layout_field_frequency_daily'] = 'täglich';
$lang['layout_field_frequency_weekly'] = 'wöchentlich';
$lang['layout_field_frequency_monthly'] = 'monatlich';
$lang['layout_field_frequency_yearly'] = 'jährlich';
$lang['layout_field_frequency_never'] = 'niemals';


/*
|--------------------------------------------------------------------------
| Tooltips
|--------------------------------------------------------------------------
*/
$lang['tooltip_dbl_click_to_open'] = 'Doppelklick zum Öffnen';


/*
|--------------------------------------------------------------------------
| Pagination
|--------------------------------------------------------------------------
*/

$lang['pagination_prev_page'] = '&lt;';
$lang['pagination_next_page'] = '&gt;';
$lang['pagination_first_link'] = '&lsaquo; Erster';
$lang['pagination_last_link'] = 'Letzter &rsaquo;';


/*
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
*/
$lang['action_edit'] = 'Bearbeiten';
$lang['action_create'] = 'Erstellen';
$lang['action_delete'] = 'Löschen';
$lang['action_upload'] = 'Hochladen';
$lang['action_replace'] = 'Ersetzen';

/*
|--------------------------------------------------------------------------
| Migrations
|--------------------------------------------------------------------------
*/
$lang['database_migration_success'] = 'Erfolgreiche Datenbankmigration zu Version %1s';

//$lang['import'] = 'Import';

// now include the Javascript specific ones since there is some crossover
include('fuel_js_lang.php');

/* End of file fuel_lang.php */
/* Location: ./modules/fuel/language/english/fuel_lang.php */