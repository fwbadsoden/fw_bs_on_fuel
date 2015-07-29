<?php 
    $stage_vars['stage'] = $stage;
             
    $this->load->view('_blocks/header');
    $this->load->view('_blocks/stage', $stage_vars);  
?>

<section id="content">
    <div class="<?=$stage->type->css_slidewrapper_class?>">
		<?=fuel_var('body', 'This is a default layout. To change this layout go to the fuel/application/views/_layouts/main.php file.'); ?>
        <hr class="clear" />   
    </div>
</section>
	
<?php 
    $this->load->view('_blocks/footer');
?>
