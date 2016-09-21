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
            <?php if ($data->aufbau != "") : ?>
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
                <p class="label">Höhe</p>
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
    $picture_orientation = "right";
    $modules = get_vehicle_module_order($data->module_order);
    foreach($modules as $module) {
        include($module);
    }
?>