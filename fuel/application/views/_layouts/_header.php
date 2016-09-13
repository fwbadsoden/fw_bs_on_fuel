<?php 
    $header_vars['stage'] = $stage;
    $header_vars['main_navigation'] = $main_navigation;
    if(isset($facebook_infos)) $header_vars["facebook_infos"] = $facebook_infos;
    if(isset($my_module)) $header_vars['module'] = $my_module;
    else $header_vars['module'] = "";

    $this->load->view('_blocks/header', $header_vars); 
?>