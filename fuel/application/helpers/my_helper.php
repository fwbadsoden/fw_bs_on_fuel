<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// add your site specific functions here
  
function main_navigation() {
        
        $CI =& get_instance();
        
        $CI->load->model('mannschaft_members_model', 'mannschaft');
        $CI->load->model('fahrzeuge_model', 'fahrzeuge');
        
        $nav["pressarticles"]           = fuel_model("pressarticles_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes'), 'order' => ('datum desc')));
        $nav["appointments"]            = fuel_model("appointments_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes'), 'order' => ('datum desc, beginn desc')));
        $nav["missions"]                = fuel_model("missions_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes'), 'order' => ('datum_beginn desc, uhrzeit_beginn desc')));
        $nav["news"]                    = fuel_model("news_articles_model", array('find' => 'all', 'limit' => 5, 'where' => array('published' => 'yes'), 'order' => ('datum desc, id desc')));
        $nav["fahrzeuge"]               = $CI->fahrzeuge->find_all(NULL, 'precedence asc');
        $nav["fahrzeuge_hasretired"]    = $CI->fahrzeuge->has_retired();
        $nav["mannschaft_leader"]       = $CI->mannschaft->find_fuehrung();
        $nav["mannschaft_team"]         = $CI->mannschaft->find_team();
        
        return $nav;
    }

function internal_debug($var) {
    echo"<pre>";
    var_dump($var);
    echo"</pre>";
    die();
}
/* End of file my_helper.php */
/* Location: ./application/helpers/my_helper.php */
