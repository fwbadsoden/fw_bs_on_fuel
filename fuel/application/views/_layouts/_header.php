<?php 
    $stage_vars['stage'] = $stage;
    $header_vars['main_navigation'] = $main_navigation;
             
    $this->load->view('_blocks/header', $header_vars);
    $this->load->view('_blocks/stage', $stage_vars);  
?>