<?php $counter = 1; ?>
<div class="slidewrapper">
    <div class="car_content">
        <h2>Abrollbehälter</h2>
    </div>
</div>

<div class="slidewrapper">
    <div class="car_tools">
        <?php
        foreach ($abrollbehaelter as $behaelter) :
            if ($counter % 2 == 0) {
                $css_image = "image imageright";
                $css_text = "text textright";
            } else {
                $css_image = "image imageleft";
                $css_text = "text textleft";
            }
            ?>
            <div class="toolbox">
                <div class="<?= $css_image ?>">
                    <img src="<?= img_path('fahrzeuge/' . $data->fahrzeug_images[0]->image) ?>" alt="<?= $behaelter->name ?>" />
                </div>
                <div class="<?= $css_text ?>">
                    <div class="head">
                        <div class="number"><?= sprintf("%02d", $counter) ?></div>
                        <div class="content">
                            <h4>Abrollbehälter</h4>
                            <h3><?= $behaelter->name_lang ?></h3>
                        </div>
                    </div>
                    <p><?= $behaelter->text ?></p>
                </div>
                <hr class="clear" />
            </div>
            <?php
            $counter++;
        endforeach;
        ?>
    </div>
</div>