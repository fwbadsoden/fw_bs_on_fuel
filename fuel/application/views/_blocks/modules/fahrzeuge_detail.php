<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if ($data->is_wlf())
    $abrollbehaelter = $data->get_abrollbehaelter();

if ($data->rufname == 'n/a') : $ruf_name = 'n/a';
else : $ruf_name = $data->prefix_rufname . ' ' . $data->rufname;
endif;
?>

<div id="car_techdetails" class="fahrzeuge">
    <div class="slidewrapper techdetails">
        <div class="row_a">
            <div class="cell_non_bg">
                <p class="valuea"><?= $data->hersteller ?></p>
                <p class="label">Hersteller</p>
            </div>
            <?php if($data->aufbau != "") : ?>
            <div class="cell_non_bg">
                <p class="valuea"><?= $data->aufbau ?></p>
                <p class="label">Aufbau</p>
            </div>
            <?php endif; ?>
            <div class="cell_non_bg">
                <p class="valuea"><?= $ruf_name ?></p>
                <p class="label">Funkrufname</p>
            </div>
        </div>
        <div class="row_b">
            <div class="cell_with_bg">
                <img src="<?= assets_path('car_motor.svg', 'icons') ?>" />
                <p class="value"><?= $data->kw ?> KW</p>
                <p class="label">Leistung</p>
                <hr class="clear" />
            </div>
            <div class="cell_with_bg">
                <img src="<?= assets_path('car_gewicht.svg', 'icons') ?>" />
                <p class="value"><?= $data->gesamtmasse ?> t</p>
                <p class="label">Gewicht</p>
                <hr class="clear" />
            </div>
            <div class="cell_with_bg">
                <img src="<?= assets_path('car_besatzung.svg', 'icons') ?>" />
                <p class="value"><?= $data->besatzung ?></p>
                <p class="label">Besatzung</p>
                <hr class="clear" />
            </div>
        </div>
        <div class="row_c">
            <div class="cell_with_bg">
                <img src="<?= assets_path('car_laenge.svg', 'icons') ?>" />
                <p class="value"><?= $data->laenge ?> m</p>
                <p class="label">Länge</p>
                <hr class="clear" />
            </div>
            <div class="cell_with_bg">
                <img src="<?= assets_path('car_hoehe.svg', 'icons') ?>" />
                <p class="value"><?= $data->hoehe ?> m</p>
                <p class="label">H&ouml;he</p>
                <hr class="clear" />
            </div>
            <div class="cell_with_bg">
                <img src="<?= assets_path('car_breite.svg', 'icons') ?>" />
                <p class="value"><?= $data->breite ?> m</p>
                <p class="label">Breite</p>
                <hr class="clear" />
            </div>
        </div>
    </div> 
</div>


<?php
if (!$data->is_wlf()) :
    if (count($data->fahrzeug_loadings) > 0) :
        $counter = 1;
        ?> 
        <div class="slidewrapper">
            <div class="car_content">
                <h2>Ausrüstung und Beladung</h2>
            </div>
        </div>

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
                                <div class="number"><?= sprintf("%02d", $counter) ?></div>
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

    <?php
    if (count($data->fahrzeug_special_functions) > 0) :
        $counter = 1;
        $character = "A";
        ?> 
        <div class="car_darkspecial">  

            <h2>Besonderheiten</h2>
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
                            <p class="number"><?= $character ?></p>
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

    <?php
    foreach ($data->fahrzeug_fittings as $fitting) :
        ?> 
        <div class="car_freespecial">
            <div class="text">  
                <h2><?= $fitting->name ?></h2>
                <p><?= $fitting->text ?></p>
            </div>
            <div class="image">
                <img src="<?= img_path('fahrzeuge/anbauten/' . $fitting->image) ?>" alt="<?= $fitting->image ?>" />
            </div>
            <hr class="clear" />
        </div>
        <?php
    endforeach;
else :
    $counter = 1;
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
<?php
endif;
?>

<div class="slidewrapper">
    <div class="car_slideshowbox">  
        <div class="slideshow">

<?php if (count($data->fahrzeug_images) > 1) : ?>
                <div class="prevPic"><a href="#slideshow_car" id="slideshow_prev"><img src="<?= assets_path('button_detailShow_previous.png', 'layout') ?>" /></a></div>
                <div class="nextPic"><a href="#slideshow_car" id="slideshow_next"><img src="<?= assets_path('button_detailShow_next.png', 'layout') ?>" /></a></div>
<?php endif; ?>

            <ul id="slideshow_car">
                <?php foreach ($data->fahrzeug_images as $key => $img) : ?>           
                        <?php if ($key == 0) : ?>
                        <li id="slideshow_car_<?= $key + 1 ?>" class="active">
                        <?php else : ?>
                        <li id="slideshow_car_<?= $key + 1 ?>" class="noActive">
    <?php endif; ?>
                        <figure>
                            <img src="<?= img_path('fahrzeuge/' . $img->image) ?>" alt="<?= $img->description ?>" />
                            <div class="zoom"><a href="<?= img_path('fahrzeuge/' . $img->image) ?>" title="<?= $img->description ?>" class="fancybox-gallery" rel="gallery1"><img src="<?= assets_path('button_zoom.png', 'layout') ?>" /></a></div>
                        </figure>
                        <p><?= $key + 1 ?>: <?= $img->text ?></p>
                    </li>
<?php endforeach; ?> 
            </ul>
        </div>
    </div>
    <hr class="clear" />
</div>