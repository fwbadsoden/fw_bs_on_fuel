<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// add your site specific functions here

function menu_news_label($date, $text) {
    return '<span class="subline">'.$date.'</span><br/>'.$text;
}

function main_navigation() {
	$CI =& get_instance();
    $main_navigation = fuel_nav();
    
    //internal_debug($main_navigation);
    
    return $main_navigation;
}

function internal_debug($var, $die = true) {
    echo"<pre>";
    var_dump($var);
    echo"</pre>";
    
    if($die) { die(); }
}
/* End of file my_helper.php */
/* Location: ./application/helpers/my_helper.php */
