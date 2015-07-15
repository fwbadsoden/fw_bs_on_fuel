<section id="stage">
    
<?
    foreach($stage["images"] as $key => $image) { 
        
        if(isset($image['css_text_class_1'])) $image['css_text_class_1'] = ' class="'.$image['css_text_class_1'].'"';
        if(isset($image['css_text_class_2'])) $image['css_text_class_2'] = ' class="'.$image['css_text_class_2'].'"';
        if(isset($image['css_text_class_3'])) $image['css_text_class_3'] = ' class="'.$image['css_text_class_3'].'"';
?>    
    
    <div class="<?=$image["css_outer_class"]?>" id="pictures_<?=$key?>" style="background-image: url(<?=$image["file"]?>); display: none;">
        <div id="stagewrapper">   
            <div class="<?=$image["css_inner_class"]?>">
<? if($image['text_1'] != "") : ?> <h1<?=$image['css_text_class_1']?>><?=$image['text_1']?></h1> <? endif; ?>
<? if($image['text_2'] != "") : ?> <h2<?=$image['css_text_class_2']?>><?=$image['text_2']?></h2> <? endif; ?>
<? if($image['text_3'] != "") : ?> <p<?=$image['css_text_class_3']?>><?=$image['text_3']?></p> <? endif; ?>
<? if($image['link'] != '')     : ?> <h2 class="button"><a href="<?=base_url($image['link'])?>" class="button_white">weiter lesen</a></h2><? endif; ?>                   
            </div>        
        </div>
    </div>

<?  }   ?>      
</section>