<?php 
    $header_vars['stage'] = $stage;
    $header_vars['main_navigation'] = $main_navigation;
    if(isset($facebook_infos)) $header_vars["facebook_infos"] = $facebook_infos;

    $this->load->view('_blocks/header', $header_vars); 
?>