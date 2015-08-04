<?php 
    include("_header.php"); 
?>

<section id="content">
    <div class="<?=$stage->type->css_slidewrapper_class?>">
		<?=fuel_var('body', 'This is a default layout. To change this layout go to the fuel/application/views/_layouts/main.php file.'); ?>
        <hr class="clear" />   
    </div>
</section>
	
<?php 
    include("_footer.php");
?>
