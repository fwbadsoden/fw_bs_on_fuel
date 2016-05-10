<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$tab_index_1 = 1;
$tab_index_2 = 2;

if ($data->is_wlf()) $abrollbehaelter = $data->get_abrollbehaelter(); 

if ($data->rufname == 'n/a') : $ruf_name = 'n/a';
else : $ruf_name = $data->prefix_rufname . ' ' . $data->rufname;
endif;
if ($data->is_retired()) : 
    $headline = "Außer Dienst";
    $overview_link = "ausserdienst/";
    $baujahr_headline = "Außer Dienst:";
    $baujahr_value = $data->ausserdienststellung;
else : 
    $headline = "Alle Fahrzeuge";
    $overview_link = "";
    $baujahr_headline = "Baujahr:";
    $baujahr_value = $data->baujahr;
endif;
?>

<div class="oneColumnBox">

    <div class="oneColumnBox">
        <div class="factSheet">
            <div class="table">
                <div class="row">
                    <div class="black">Funkrufname:</div>                   
                    <div class="red"><?= $ruf_name ?></div>
                </div>
                <div class="row">
                    <div class="black">Hersteller:</div>
                    <div class="red"><?= $data->hersteller ?></div>
                </div>
                <div class="row">
                    <div class="black">Aufbau:</div>
                    <div class="red"><?= $data->aufbau ?></div>
                </div>
                <div class="row">
                    <div class="black lastRow"><?= $baujahr_headline ?></div>
                    <div class="red lastRow"><?= $baujahr_value ?></div>
                </div>
            </div>        
            <div class="data">
                <h1>Leistung:</h1>
                <h2><?= $data->kw ?> KW</h2>
                <div class="icon">
                    <img src="<?= assets_path('icon_ps.png', 'icons') ?>"/>
                    <span><?= $data->ps ?> ps</span>
                    <hr class="clear" />
                </div>
            </div>
            <div class="data">
                <h1>L&auml;nge:</h1>
                <h2><?= $data->laenge ?> m</h2>
                <div class="icon">
                    <img src="<?= assets_path('icon_length.png', 'icons') ?>"/>
                    <hr class="clear" />
                </div>
            </div>
            <div class="data">
                <h1>H&ouml;he:</h1>
                <h2><?= $data->hoehe ?> m</h2>
                <div class="icon">
                    <img src="<?= assets_path('icon_height.png', 'icons') ?>"/>
                    <hr class="clear" />
                </div>
            </div>
            <div class="data">
                <h1>Breite:</h1>
                <h2><?= $data->breite ?> m</h2>
                <div class="icon">
                    <img src="<?= assets_path('icon_width.png', 'icons') ?>"/>
                    <hr class="clear" />
                </div>
            </div>
            <div class="data">
                <h1>Leermasse:</h1>
                <h2><?= $data->leermasse ?> t</h2>
                <div class="icon">
                    <img src="<?= assets_path('icon_weight.png', 'icons') ?>"/>
                    <span><?= str_replace(',', '.', $data->leermasse) * 1000 ?> kg</span>
                    <hr class="clear" />
                </div>
            </div>
            <div class="data">
                <h1>Besatzung:</h1>
                <h2><?= $data->besatzung ?></h2>
                <div class="icon">
                    <img src="<?= assets_path('icon_people.png', 'icons') ?>"/>
                    <hr class="clear" />
                </div>
            </div>
        </div>
    </div>
    <hr class="clear" />  

    <div class="BigBox firstColumn">    
        <div class="TabBox">
            <ul class="tabNav_details">
                <li><a href="#details_<?= $tab_index_1 ?>" func="tab" class="active">Beschreibung</a></li>
            </ul>
            <div class="TabBoxContent">                
                <h1 class="reiter"><a href="#details_<?= $tab_index_1 ?>" func="tab" class="active">Beschreibung</a></h1>
                <div id="box_details_<?= $tab_index_1 ?>" style="">
                    <?     if($data->is_retired()) : $ruf_name .= " (außer Dienst)"; endif; ?>
                    <h1><?= $tab_index_2 ?>: <?= $ruf_name ?></h1>
                    <p><?= $data->text ?></p>                     
                    <? if($data->pumpe != '' && $data->loeschmittel != '') : ?>                        
                    <div class="facttable">   
                        <div class="left">
                            <h1>Pumpe</h1>
                            <ul>               
                                <li><?= $data->get_pumpe() ?></li>                                 
                            </ul>
                        </div>                            
                        <div class="right">
                            <h1>Löschmittelvorrat</h1>
                            <ul>     
                                <li><?= $data->get_loeschmittel() ?></li>                          
                            </ul>
                        </div>                         
                        <hr class="clear" />
                    </div>
                    <? elseif($data->besonderheit != '') : ?>   
                    <div class="facttable">   
                        <div class="left">
                            <h1>Besondere Ausrüstung</h1>
                            <ul>                              
                                <li><?= $data->get_besonderheit() ?></li>       
                            </ul>
                        </div>                           
                        <hr class="clear" />
                    </div>
                    <? endif; ?>                                             
                </div>     
            </div>
        </div>                        
    </div>        

    <div class="SmallBox secondColumn">   
        <div class="menueBox">
            <h1><?= $headline ?></h1>
            <ul>
                <? foreach($fahrzeugliste as $key => $fahrzeug) : ?>      
                <? if(count($fahrzeugliste) == ($key + 1)) : ?>
                <li class="last">
                    <? else : ?>
                <li>
                    <? endif; ?>                                                  
                    <a href="<?= base_url('technik/fahrzeuge/' . $overview_link . $fahrzeug->id) ?>"><?= $fahrzeug->name_lang ?> - <span class="downlight"><?= $fahrzeug->name ?></span></a>
                </li>
                <? endforeach; ?>                    
            </ul>
            <h1 class="subnavi_opener_mobile"><?= $headline ?></h1>
            <ul class="subnavi_content_mobile">
                <? foreach($fahrzeugliste as $key => $fahrzeug) : ?>      
                <? if(count($fahrzeugliste) == ($key + 1)) : ?>
                <li class="last">
                    <? else : ?>
                <li>
                    <? endif; ?>                                                  
                    <a href="<?= base_url('technik/fahrzeuge/' . $overview_link . $fahrzeug->id) ?>"><?= $fahrzeug->name_lang ?> - <span class="downlight"><?= $fahrzeug->name ?></span></a>
                </li>
                <? endforeach; ?>   
            </ul>
        </div>
    </div >    
    <hr class="clear" />  

    <? if($data->is_wlf()) : ?>
    <div class="oneColumnBox">
        <div class="detailShow">
            <ul class="charts">
                <? foreach($abrollbehaelter as $fahrzeug) : 
                $i = 1;
                ?>
                <li id="detailShow_<?= $i ?>" class="active">
                    <figure><img src="images/geraete/Pumpe.jpg" alt="Pumpe xyz" /></figure>
                    <div class="text">
                        <h2>Abrollbehälter</h2>
                        <h1><?= $fahrzeug->name ?></h1>
                        <p><?= $fahrzeug->text ?></p>
                        <ul class="facts">
                            <?= $fahrzeug->get_abrollbehaelter_besonderheit() ?>
                        </ul>
                    </div>
                    <hr class="clear" />
                </li>
                <?  $i++;
                endforeach; ?>
            </ul>
            <hr class="clear" />
            <div class="interactionBar">
                <div class="previous"><a href="#previous" id="detailShow_prev">prev</a></div>
                <div class="tableofcontent">
                    <ul>
                        <li><a href="#1" class="detailShowLink active">Spezial</a></li>
                        <li><a href="#2" class="detailShowLink">Fach G1 / G2</a></li>
                        <li><a href="#3" class="detailShowLink">Fach G2 / G3</a></li>
                    </ul>
                </div>
                <div class="next"><a href="#next" id="detailShow_next">next</a></div>
            </div>
        </div>
    </div>
    <? endif; ?>

    <div class="BigBox firstColumn">  
        <div class="slideshow">

            <?php if (count($data->fahrzeug_images) > 1) { ?>
                <div class="prevPic"><a href="#slideshow_car" id="slideshow_prev"><img src="<?= assets_path('button_detailShow_previous.png', 'layout') ?>" /></a></div>
                <div class="nextPic"><a href="#slideshow_car" id="slideshow_next"><img src="<?= assets_path('button_detailShow_next.png', 'layout') ?>" /></a></div>
            <?php } ?>                

            <ul id="slideshow_car">
                <? foreach($data->fahrzeug_images as $key => $img) : ?>           
                <? if($key == 0) : ?>
                <li id="slideshow_car_<?= $key + 1 ?>" class="active">
                    <? else : ?>
                <li id="slideshow_car_<?= $key + 1 ?>" class="noActive">
                    <? endif; ?>
                    <figure>
                        <img src="<?= img_path('fahrzeuge/' . $img->image) ?>" alt="<?= $img->description ?>" />
                        <div class="zoom"><a href="<?= img_path('fahrzeuge/' . $img->image) ?>" title="<?= $img->description ?>" class="fancybox-gallery" rel="gallery1"><img src="<?= assets_path('button_zoom.png', 'layout') ?>" /></a></div>
                    </figure>
                    <p><?= $key + 1 ?>: <?= $img->text ?></p>
                </li>
                <? endforeach; ?>             
            </ul>
        </div>
    </div>

    <div class="SmallBox secondColumn">  
        <div class="dateBox">
            <h1>Die letzten Einsätze</h1>
            <ul>
                <? foreach($data->get_missions() as $mission) : 
                ?>                
                <li>
                    <a href="<?= base_url('aktuelles/einsatz/' . $mission->id) ?>">
                        <h2><?= get_ger_date($mission->datum_beginn) ?> </h2>
                        <p><?= $mission->get_cue()["name"]." - ".$mission->lage ?></p>
                    </a>
                </li>
                <? endforeach; ?>                    
            </ul>
        </div>
    </div>
    <hr class="clear" />

</div>
<hr class="clear" />