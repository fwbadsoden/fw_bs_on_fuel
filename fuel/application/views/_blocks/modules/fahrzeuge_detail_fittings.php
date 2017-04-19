<?php
if (count($data->fahrzeug_fittings) > 0) :
    $displayed = true; 
    if($picture_orientation == "right") $counter = 1;
    else $counter = 0;
    ?> 
<?php foreach ($data->fahrzeug_fittings as $fitting) : 
                if ($counter % 2 == 0) {
                    $css_image = "image imageleft";
                    $css_text = "text textleft";
                    $picture_orientation = "right";
                } else {
                    $css_image = "image";
                    $css_text = "text";
                    $picture_orientation = "left";
                }
?> 
    <div class="car_freespecial">
        <div class="<?=$css_text?>">  
            <h2><?= $fitting->name ?></h2>
            <p><?= $fitting->text ?></p>
        </div>
        <div class="<?=$css_image?>">
            <img src="<?= img_path('fahrzeuge/anbauten/' . $fitting->image) ?>" alt="<?= $fitting->image ?>" />
        </div>
        <hr class="clear" />
    </div>
<?php 
        $counter++;
    endforeach; 
else : 
    $displayed = false; 
endif;?>