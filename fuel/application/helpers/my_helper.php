<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// add your site specific functions here

function menu_news_label($date, $text) {
    return '<span class="subline">'.$date.'</span><br/>'.$text;
}


    
function main_navigation() {
        
        $CI =& get_instance();
        
        $CI->load->model('mannschaft_members_model', 'mannschaft');
        $CI->load->model('fahrzeuge_model', 'fahrzeuge');
      //  $CI->load->model('news_model', 'news');
      //  $CI->load->model('missions_model', 'missions');
        $CI->load->model('pressarticles_model', 'pressarticles');
        
        $nav["fahrzeuge"] = $CI->fahrzeuge->find_all(NULL, 'precedence asc');
        $nav["fahrzeuge_hasretired"] = $CI->fahrzeuge->has_retired();
        $nav["mannschaft_leader"] = $CI->mannschaft->find_fuehrung();
        $nav["mannschaft_team"] = $CI->mannschaft->find_team();
        
        return $nav;
    }

function internal_debug($var, $die = true) {
    echo"<pre>";
    var_dump($var);
    echo"</pre>";
    
    if($die) { die(); }
}
/* End of file my_helper.php */
/* Location: ./application/helpers/my_helper.php */
