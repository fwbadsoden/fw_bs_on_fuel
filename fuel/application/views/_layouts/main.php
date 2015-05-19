<?php
    if(isset($this->fuel_page->id)) {
        // Stage für Inhaltsseite laden   
    } else {
        // Stage für Modulseite laden
    }
    
    $stage_type = fuel_var('stage_type');
  //  echo $stage_type; die();
    switch ($stage_type) {
        case 'small':
            fuel_set_var('stage_inner_class', 'stageContentHeadlineTop half_blackBG smallstage');
            fuel_set_var('stage_outer_class', 'pictures small');
            $stage_slidewrapper_class = 'slidewrapper smallstage';
            break;
        case 'big':
            fuel_set_var('stage_inner_class', 'stageQuoteRight');
            fuel_set_var('stage_outer_class', 'pictures');
            $stage_slidewrapper_class = 'slidewrapper';
            break;
    }
    
    fuel_set_var('stage_wrapper_class', 'stagewrapper');
?>
<?php $this->load->view('_blocks/header')?>
<?php $this->load->view('_blocks/stage')?>

<section id="content">
    <div class="<?=$stage_slidewrapper_class?>">
		<?=fuel_var('body', 'This is a default layout. To change this layout go to the fuel/application/views/_layouts/main.php file.'); ?>
        <hr class="clear" />   
    </div>
</section>
	
<?php $this->load->view('_blocks/footer')?>
