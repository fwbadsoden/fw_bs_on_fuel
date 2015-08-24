<?php 

// declared here so we don't have to in each controller's variable file
$CI =& get_instance();

// generic global page variables used for all pages
$vars = array();
$vars['layout'] = 'main';
$vars['page_title'] = fuel_nav(array('render_type' => 'page_title', 'delimiter' => ' : ', 'order' => 'desc', 'home_link' => 'Home'));
$vars['meta_keywords'] = '';
$vars['meta_description'] = '';
$vars['js'] = array();
$vars['css'] = array();
$vars['body_class'] = uri_segment(1).' '.uri_segment(2);

// page specific variables
$pages = array();

// Navigation variables
$vars['metanavigation']         = fuel_nav(array('group_id' => 2, 'last_class' => ''));
$vars['metanavigation_mobile']  = fuel_nav(array('group_id' => 2, 'first_class' => '', 'last_class' => ''));
$vars['shortlinks']             = fuel_nav(array('group_id' => 3, 'last_class' => ''));
$vars['sitemap_box']            = fuel_nav(array('group_id' => 4, 'first_class' => 'headline', 'last_class' => ''));
$vars['sitemap_box']           .= fuel_nav(array('group_id' => 5, 'first_class' => 'headline', 'last_class' => ''));
$vars['sitemap_box']           .= fuel_nav(array('group_id' => 6, 'first_class' => 'headline', 'last_class' => ''));
$vars['sitemap_box']           .= fuel_nav(array('group_id' => 7, 'first_class' => 'headline', 'last_class' => ''));
$vars['sitemap_box']           .= fuel_nav(array('group_id' => 8, 'first_class' => 'headline', 'last_class' => ''));
$vars['small_sitemap']          = fuel_nav(array('group_id' => 9, 'container_tag' => '', 'item_tag' => '', 'first_class' => '', 'last_class' => ''));

//$vars['main_navigation']        = main_navigation();
?>