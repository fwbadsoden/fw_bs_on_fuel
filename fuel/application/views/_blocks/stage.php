<section id="stage">

<?php foreach($stage->stage_images as $key => $image) {   
    
        if(strtolower($image->text_1) == "dummy") {
            $text1 = $stage_text["name"];
            $text2 = $stage_text["name_lang"];
            $text3 = $stage_text["text_stage"];
        } else {
            $text1 = $image->text_1;
            $text2 = $image->text_2;
            $text3 = "";
        }
      
        switch($image->stage_image_type_id) {
            case 1: $css_inner_class = "stageContentHeadlineTop half_blackBG smallstage"; break;
            case 2: $css_inner_class = "stageQuoteLeft"; break; 
            case 3: $css_inner_class = "stageQuoteRight"; break;
            case 4: $css_inner_class = "stageContentCar"; break;
        }   
?>
    
    <div class="<?=$stage->type->css_outer_class?>" id="pictures_<?=$key?>" style="background-image: url(<?=img_path("bildbuehnen/".$image->image)?>); display: none;">
        <div id="stagewrapper">    
            <div class="<?=$css_inner_class?>">
                <?php if($text1 != "") : ?> <h1<?=$image->css_text_class_1?>><?=$text1?></h1> <?php endif; ?>
                <?php if($text2 != "") : ?> <h2<?=$image->css_text_class_2?>><?=$text2?></h2> <?php endif; ?>  
                <?php if($text3 != "") : ?> <p><?=$text3?></p> <? endif; ?>       
            </div>
        </div>
    </div>
    
<?php  }   ?> 
      
</section>