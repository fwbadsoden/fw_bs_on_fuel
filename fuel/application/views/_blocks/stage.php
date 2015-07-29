<section id="stage">

<?php foreach($stage->stage_images as $key => $image) {     
      
        switch($image->stage_image_type_id) {
            case 1: $css_inner_class = "stageContentHeadlineTop half_blackBG smallstage"; break;
            case 2: $css_inner_class = "stageQuoteLeft"; break; 
            case 3: $css_inner_class = "stageQuoteRight"; break;
            case 4: $css_inner_class = "stageContentCar"; break;
        }    
?>
    
    <div class="<?=$stage->type->css_outer_class?>" id="pictures_<?=$key?>" style="background-image: url(<?=$image->image?>); display: none;">
        <div id="stagewrapper">    
            <div class="<?=$css_inner_class?>">
                <?php if($image->text_1 != "") : ?> <h1<?=$image->css_text_class_1?>><?=$image->text_1?></h1> <?php endif; ?>
                <?php if($image->text_2 != "") : ?> <h2<?=$image->css_text_class_2?>><?=$image->text_2?></h2> <?php endif; ?>          
            </div>
        </div>
    </div>
    
<?php  }   ?> 
      
</section>