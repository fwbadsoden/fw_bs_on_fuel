<?php
    $CI =& get_instance();
    $CI->load->model('stages_model');
    
    if(isset($this->fuel_page->id)) {
        // Stage für Inhaltsseite laden   
        $stage = $CI->stages_model->get_stage_from_page_id($this->fuel_page->id);
    } else {
        // Stage für Modulseite laden
    }
    
    $stage_vars['stage'] = $stage;
?>
<?php $this->load->view('_blocks/header')?>
<?php $this->load->view('_blocks/stage', $stage_vars)?>

<section id="content">
    <div class="<?=$stage['css_slidewrapper_class']?>">
		<?=fuel_var('body', 'This is a default layout. To change this layout go to the fuel/application/views/_layouts/main.php file.'); ?>
        <hr class="clear" />   
    </div>
</section>
	
<?php $this->load->view('_blocks/footer')?>
