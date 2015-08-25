<?php 
    $header_vars['stage'] = $stage;
    $header_vars['main_navigation'] = $main_navigation;
             
    $this->load->view('_blocks/header', $header_vars); 
?>