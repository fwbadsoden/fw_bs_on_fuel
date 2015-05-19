<?php
/***************************************************************
ATTENTION: There is a static view file of sitemap_xml.php that 
can be used to create sitemaps outside of creating a CMS page
**************************************************************/

fuel_set_var('layout', '');
$default_frequency = 'Monthly';
$nav = fuel_nav(array('return_normalized' => TRUE));
$used = array();


/***************************************************************
Add any dynamic pages and associate them to the $nav array here:
**************************************************************/
$modules = $CI->fuel->pages->options_list('modules', FALSE, FALSE);
$nav = array_merge($nav, $modules); 
$nav[''] = '';
unset($nav['home']);


/**************************************************************/

if (empty($nav)) show_404();
header('Content-type: text/xml');
// needed because of the Loader class mistaking the end of the xml node as PHP in load->view
echo str_replace(';', '', '<?xml version="1.0" encoding="UTF-8"?>');
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
		xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
		xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php foreach($nav as $uri=>$page) : ?>
	<?php if(is_array($page) AND isset($page['location']) AND $page['location'] != 'sitemap.xml' AND !isset($used[$page['location']])): ?> 
		<url>
			<loc><![CDATA[<?=site_url($page['location'])?>]]></loc> 
			<?php if (!empty($page['last_modified'])) : ?><lastmod><?=$page['last_modified']?></lastmod><?php endif; ?> 
			<changefreq><?=fuel_var('frequency', $default_frequency)?></changefreq>
		</url>	
	<?php $used[$page['location']] = $page['location'];  ?>
	<?php elseif (is_string($page) AND !isset($used[$page])): ?>
	<url> 
		<loc><![CDATA[<?=site_url($page)?>]]></loc> 
		<changefreq><?=fuel_var('frequency', $default_frequency)?></changefreq>
	</url>
	<?php $used[$page] = $page; ?>
	<?php endif; ?>

<?php endforeach; ?>
</urlset>