<?php
if (count($data->fahrzeug_special_functions) > 0) :
    $counter = 1;
    $character = "A";
    ?> 
    <div class="car_darkspecial">  

        <?php if ($data->show_specialfunctions_header()) : ?>
            <h2>Besonderheiten</h2>
        <?php endif; ?>
        <div class="specialwrapper">

            <?php
            foreach ($data->fahrzeug_special_functions as $function) :
                if ($counter % 2 == 0) {
                    $css_image = "image imageleft";
                    $css_text = "text textleft";
                } else {
                    $css_image = "image";
                    $css_text = "text";
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
<?php endif; ?>