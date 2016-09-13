<?php
if (count($data->fahrzeug_loadings) > 0) :
    $counter = 1;
    ?> 

    <?php if ($data->show_loadings_header()) : ?>
        <div class="slidewrapper">
            <div class="car_content">
                <h2>Ausrüstung und Beladung</h2>
            </div>
        </div>
    <?php endif; ?>

    <div class="slidewrapper">
        <div class="car_tools">

            <?php
            foreach ($data->fahrzeug_loadings as $loading) :
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
                        <img src="<?= img_path('fahrzeuge/beladung/' . $loading->image) ?>" alt="<?= $loading->image ?>" />
                    </div>
                    <div class="<?= $css_text ?>">
                        <div class="head">
                            <?php if (count($data->fahrzeug_loadings) == 1) : ?>
                                <div class="number">&nbsp;</div>
                            <?php else : ?>
                                <div class="number"><?= sprintf("%02d", $counter) ?></div>
        <?php endif; ?>
                            <div class="content">
                                <h4><?= $loading->fach ?></h4>
                                <h3><?= $loading->name ?></h3>
                            </div>
                        </div>
                        <p><?= $loading->text ?></p>
                    </div>
                    <hr class="clear" />
                </div>
                <?php
                $counter++;
            endforeach;
            ?>
        </div>
    </div>
<?php endif; ?>