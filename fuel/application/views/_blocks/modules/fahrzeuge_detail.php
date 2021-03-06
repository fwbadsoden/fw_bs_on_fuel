<?php
if (!defined('BASEPATH')) : exit('No direct script access allowed'); endif;

if ($data->is_wlf()) : $abrollbehaelter = $data->get_abrollbehaelter(); endif;
if ($data->rufname == 'n/a') : $ruf_name = 'n/a'; else : $ruf_name = $data->prefix_rufname . ' ' . $data->rufname; endif;
if ($data->ausserdienststellung != 0 && $data->is_retired()) : $baujahr = $data->ausserdienststellung; elseif ($data->baujahr != 0) : $baujahr = $data->baujahr; else : $baujahr = "n/a"; endif; 
if ($data->ausserdienststellung != 0 && $data->is_retired()) : $text_baujahr = "außer Dienst seit"; else : $text_baujahr = "Baujahr"; endif; 
?>

<div id="car_techdetails" class="fahrzeuge">
    <div class="slidewrapper techdetails">
        <div class="row_a">
            <div class="cell_non_bg">
                <? if($data->aufbau != "" && $data->aufbau != "n/a") : ?>
                <p class="valuea"><?= $data->hersteller ?> / <?= $data->aufbau ?></p>
                <p class="label">Hersteller / Aufbau</p>
                <? else : ?>
                <p class="valuea"><?= $data->hersteller ?></p>
                <p class="label">Hersteller</p>
                <? endif; ?>
            </div>
            <div class="cell_non_bg">
                <p class="valuea"><?= $baujahr ?></p>
                <p class="label"><?= $text_baujahr ?></p>
            </div>
            <div class="cell_non_bg">
                <p class="valuea"><?= $ruf_name ?></p>
                <p class="label">Funkrufname</p>
            </div>
        </div>
        <div class="row_b">
            <div class="cell_with_bg">
                <img src="<?= assets_path('car_motor.svg', 'icons') ?>" />
                <p class="value"><?= $data->kw ?> <?= $data->kw_unit ?></p>
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
    $displayed = false; 
    foreach($modules as $module) :
        include($module); 
    endforeach;
?>