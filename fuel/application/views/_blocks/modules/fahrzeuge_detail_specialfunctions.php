<?php 
if (count($data->fahrzeug_special_functions) > 0) :
    if($picture_orientation == "right") $counter = 1;
    else $counter = 0;
    $character = "A";
    if($displayed == false) : $class = "car_darkspecial first"; else : $class = "car_darkspecial"; endif;
    $displayed = true; 
    ?> 
    <div class="<?=$class?>">  

        <?php if ($data->show_specialfunctions_header()) : ?>
            <h2>Besonderheiten</h2>
        <?php endif; ?>
        <div class="specialwrapper">

            <?php
            foreach ($data->fahrzeug_special_functions as $function) :
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
                <div>
                    <div class="<?= $css_image ?>">
                        <img src="<?= img_path('fahrzeuge/spezialfunktionen/' . $function->image) ?>" alt="<?= $function->image ?>" />
                    </div>
                    <div class="<?= $css_text ?>">
                        <?php if (count($data->fahrzeug_special_functions) == 1) : ?>
                            <p class="number">&nbsp;</p>
                        <?php else : ?>
                            <p class="number"><?= $character ?></p>
                        <?php endif; ?>
                        <div class="contentblock">
                            <h3><?= $function->name ?></h3>
                            <p><?= $function->text ?></p>
                        </div>
                    </div>
                    <hr class="clear" />
                </div>
                <?php
                $counter++;
                $character++;
            endforeach;
            ?>
        </div>
    </div>
<?php 
else :     
    $displayed = false; 
endif; ?>