<?php
    if($picture_orientation == "right") $counter = 1;
    else $counter = 0;
?>
<div class="slidewrapper">
    <div class="car_content">
        <h2>Abrollbehälter</h2>
    </div>
</div>

<div class="slidewrapper">
    <div class="car_tools">
        <?php
        foreach ($abrollbehaelter as $behaelter) :
            foreach($behaelter->fahrzeug_images as $image) {
                $img = $image;
                break;
            }
            if ($counter % 2 == 0) {
                $css_image = "image imageright";
                $css_text = "text textright";
                $picture_orientation = "left";
            } else {
                $css_image = "image imageleft";
                $css_text = "text textleft";
                $picture_orientation = "right";
            }
            ?>
            <div class="toolbox">
                <div class="<?= $css_image ?>">
                    <img src="<?= img_path('fahrzeuge/' . $img->image) ?>" alt="<?= $img->description ?>" />
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