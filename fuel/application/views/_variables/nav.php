<?php 
/****************************************************************************************
// EXAMPLE:
$nav['about'] = 'About';
$nav['showcase'] = array('label' => 'Showcase', 'active' => 'showcase$|showcase/:any');
$nav['blog'] = array('label' => 'Blog', 'active' => 'blog$|blog/:any');
$nav['contact'] = 'Contact';

// about sub menu
$nav['about/services'] = array('label' => 'Services', 'parent_id' => 'about');
$nav['about/team'] = array('label' => 'Team', 'parent_id' => 'about');
$nav['about/what-they-say'] = array('label' => 'What They Say', 'parent_id' => 'about');
*****************************************************************************************/

$nav = array();

$nav['aktuelles']                                                       = 'News';
$nav['aktuelles/news']                                                  = array('label' => 'News',      'parent_id' => 'aktuelles');
$nav['aktuelles/einsaetze']                                             = array('label' => 'Einsätze',  'parent_id' => 'aktuelles');
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

$nav['#']                                                               = '';