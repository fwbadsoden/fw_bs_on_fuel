<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
// add your site specific functions here

function menu_news_label($date, $text) {
    return '<span class="subline">'.$date.'</span><br/>'.$text;
}

function main_navigation() {
    
	$CI =& get_instance();
    $params = array();    
    $nav = array();

    $nav['aktuelles']                                                       = 'News';
    $nav['aktuelles/news']                                                  = array('label' => 'News',      'parent_id' => 'aktuelles');
    $nav['aktuelles/einsaetze']                                             = array('label' => 'Einsätze',  'parent_id' => 'aktuelles');
    
    // Einsätze aus DB
    $this->db->limit(5,0);
    $query = $this->db->get('mannschaft_members');
    foreach($query->result() as $row) {
        if(strlen($row->name) > 32) $row->name = substr($row->name,0,32).'...'; 
        
        $nav['aktuelles/einsatz/'.$row->id] = array('label' => $row->name, 'parent_id' => 'aktuelles/einsaetze');
    }
    
    $nav['aktuelles/termine']                                               = array('label' => 'Termine',   'parent_id' => 'aktuelles');
    $nav['aktuelles/presse']                                                = array('label' => 'Presse',    'parent_id' => 'aktuelles');
    
    $nav['menschen']                                                        = 'Menschen';
    $nav['menschen/mannschaft']                                             = array('label' => 'Mannschaft', 'parent_id' => 'menschen');
    $nav['menschen/mannschaft#anker_fuehrung']                              = array('label' => 'Führung', 'parent_id' => 'menschen/mannschaft');
    $nav['menschen/mannschaft#anker_mannschaft']                            = array('label' => 'Mannschaft', 'parent_id' => 'menschen/mannschaft');
    $nav['menschen/rettungshunde']                                          = array('label' => 'Rettungshunde', 'parent_id' => 'menschen');
    $nav['menschen/rettungshunde#anker_einleitung']                         = array('label' => 'Einleitung', 'parent_id' => 'menschen/rettungshunde');
    $nav['menschen/rettungshunde#anker_ausbildung']                         = array('label' => 'Ablauf der Ausbildung', 'parent_id' => 'menschen/rettungshunde');
    $nav['menschen/nachwuchs']                                              = array('location' => 'menschen/jugend', 'label' => 'Nachwuchs', 'parent_id' => 'menschen');
    $nav['menschen/jugend']                                                 = array('label' => 'Jugendfeuerwehr', 'parent_id' => 'menschen/nachwuchs');
    $nav['menschen/minifeuerwehr']                                          = array('label' => 'Minifeuerwehr', 'parent_id' => 'menschen/nachwuchs');
    $nav['menschen/leistungsgruppe']                                        = array('label' => 'Leistungsgruppe', 'parent_id' => 'menschen');
    $nav['menschen/leistungsgruppe#anker_theorie']                          = array('label' => 'Theorie', 'parent_id' => 'menschen/leistungsgruppe');
    $nav['menschen/leistungsgruppe#anker_praxis']                           = array('label' => 'Praxis', 'parent_id' => 'menschen/leistungsgruppe');
    
    $nav['technik']                                                         = 'Technik';
    
    $nav['informationen']                                                   = 'Infos';
    $nav['informationen/buergerinformationen']                              = array('label' => 'Mannschaft', 'parent_id' => 'informationen');
    $nav['informationen/buergerinformationen/blaulicht']                    = array('label' => 'Mannschaft', 'parent_id' => 'informationen');
    $nav['informationen/buergerinformationen/nachdembrand']                 = array('label' => 'Mannschaft', 'parent_id' => 'informationen');
    $nav['informationen/buergerinformationen/#notruflayer_js']              = array('label' => 'Mannschaft', 'parent_id' => 'informationen'); 
    $nav['informationen/buergerinformationen/rauchmelder']                  = array('label' => 'Mannschaft', 'parent_id' => 'informationen');
    $nav['informationen/buergerinformationen/hausnummern']                  = array('label' => 'Mannschaft', 'parent_id' => 'informationen');
    
    $nav['verein']                                                          = 'Verein';      
    
    // ersten Menüitem / Menüüberschrift
    $styles[0][0] = "headline";        
        
    $params["items"] = $nav;  
    $params["container_tag_class"] = "menu";   
    $params["styles"] = $styles;
    
    return fuel_nav($params);
}

function internal_debug($var, $die = true) {
    echo"<pre>";
    var_dump($var);
    echo"</pre>";
    
    if($die) { die(); }
}
/* End of file my_helper.php */
/* Location: ./application/helpers/my_helper.php */
