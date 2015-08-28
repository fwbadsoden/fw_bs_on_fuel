<?php 
// to simplify updates, we post the helpers in the fuel module
require_once(FUEL_PATH.'helpers/MY_language_helper.php');

function translate_enum($value) {
    
    switch($value) {
        case 'yes': return 'ja'; break;
        case 'no': return 'nein'; break;
    }
}