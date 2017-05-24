<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// add your site specific functions here
  
function get_asset_size($asset, $folder = NULL) {
    if($folder != NULL) $asset = $folder.'/'.$asset;
    $assetpath = assets_path($asset);
    $file_info = get_file_info($_SERVER["DOCROOT"]."/".$assetpath, array('size'));
    $filesize = $file_info["size"] / 1024;
    
    return number_format($filesize, 1)." KB";
} 
  
function get_asset_date($asset, $folder = NULL) {
    if($folder != NULL) $asset = $folder.'/'.$asset;
    $assetpath = assets_path($asset);
    $file_info = get_file_info($_SERVER["DOCROOT"]."/".$assetpath, array('date'));
    $date = $file_info["date"];
    
    return date("d.m.Y", $date);
} 
  
function main_navigation() {
        
        $CI =& get_instance();
        
        $CI->load->model('mannschaft_members_model', 'mannschaft');
        $CI->load->model('fahrzeuge_model', 'fahrzeuge');
        
        $nav["pressarticles"]           = fuel_model("pressarticles_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes'), 'order' => ('datum desc')));
        $nav["appointments"]            = fuel_model("appointments_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes', 'datum >=' => date('Y-m-d')), 'order' => ('datum desc, beginn desc')));
        $nav["missions"]                = fuel_model("missions_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes'), 'order' => ('datum_beginn desc, uhrzeit_beginn desc')));
        $nav["news"]                    = fuel_model("news_articles_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes', 'datum <=' => date('Y-m-d')), 'order' => ('datum desc, id desc')));
        $nav["fahrzeuge"]               = $CI->fahrzeuge->find_all(array('ist_abrollbehaelter' => 'no'), 'precedence asc');
        $nav["fahrzeuge_hasretired"]    = $CI->fahrzeuge->has_retired();
        
        return $nav;
    }

function send_mail($name, $to, $subject, $redaktion, $email, $telefon, $message) {
    
    $CI->load->library('email');
    $this->email->from($email, $name);
    $this->email->to(EMAIL_CONTACT_FORM_TO);
    $this->email->subject($subject);
    $email_message = 'Name: ' . $name . '<br />';
    $email_message.= 'Redaktion: ' . $redaktion . '<br />';
    $email_message.= 'Email-Adresse: ' . $this->input->post('email') . '<br />';
    $email_message.= 'Telefon: ' . $telefon . '<br />';
    $email_message.= 'Nachricht: <br />' . $message . '<br />';
    $this->email->message($email_message);
    $this->email->send();
}

function internal_debug($var) {
    echo"<pre>";
    var_dump($var);
    echo"</pre>";
    die();
}

function get_vehicle_module_order($order_string) {
    $mapping = array('loadings' => 'fahrzeuge_detail_loadings.php', 'specialfunctions' => 'fahrzeuge_detail_specialfunctions.php', 'fittings' => 'fahrzeuge_detail_fittings.php', 'swapbodies' => 'fahrzeuge_detail_swapbodies.php', 'gallery' => 'fahrzeuge_detail_gallery.php');
    $module_order = explode(",", $order_string);
    $include_files = array();
    foreach($module_order as $module) {
        array_push($include_files, $mapping[$module]);
    }
    return $include_files;
}

function get_css_for_environment($css) {
    if(ENVIRONMENT == "production") {
        return css_path($css.".min.css");
    } else {
        return css_path($css.".css");
    }
}
/* End of file my_helper.php */
/* Location: ./application/helpers/my_helper.php */
