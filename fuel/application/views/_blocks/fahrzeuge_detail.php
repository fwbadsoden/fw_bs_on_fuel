<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
    $tab_index_1  = 1;
    $tab_index_2  = 1;
    if($data->rufname == 'n/a') : $rufname = 'n/a'; 
    else : $rufname = $data->rufname_prefix.' '.$data->rufname; 
    endif; 
    if($data->is_retired()) : $headline = "Ausser Dienst"; 
    else : $headline = "Alle Fahrzeuge";
    endif;
?>

<section id="content">
    <div class="<?=$stage->type->css_slidewrapper_class?>">
        <div class="oneColumnBox">
            <ul class="TeaserListe">
            
                <div class="oneColumnBox">
                    <div class="factSheet">
                        <div class="table">
                            <div class="row">
                                <div class="black">Funkrufname:</div>                   
                                <div class="red"><?=$rufname?></div>
                            </div>
                            <div class="row">
                                <div class="black">Hersteller:</div>
                                <div class="red"><?=$data->hersteller?></div>
                            </div>
                            <div class="row">
                                <div class="black">Aufbau:</div>
                                <div class="red"><?=$data->aufbau?></div>
                            </div>
                            <div class="row">
                                <div class="black lastRow">Baujahr:</div>
                                <div class="red lastRow"><?=$data->baujahr?></div>
                            </div>
                        </div>        
                        <div class="data">
                            <h1>Leistung:</h1>
                            <h2><?=$data->kw?> KW</h2>
                            <div class="icon">
                                <img src="<?=assets_path('icon_ps.png', 'icons')?>"/>
                                <span><?=$data->ps?> ps</span>
                                <hr class="clear" />
                            </div>
                        </div>
                        <div class="data">
                            <h1>L&auml;nge:</h1>
                            <h2><?=$data->laenge?> m</h2>
                            <div class="icon">
                                <img src="<?=assets_path('icon_length.png', 'icons')?>"/>
                                <hr class="clear" />
                            </div>
                        </div>
                        <div class="data">
                            <h1>H&ouml;he:</h1>
                            <h2><?=$data->hoehe?> m</h2>
                            <div class="icon">
                                <img src="<?=assets_path('icon_height.png', 'icons')?>"/>
                                <hr class="clear" />
                            </div>
                        </div>
                        <div class="data">
                            <h1>Breite:</h1>
                            <h2><?=$data->breite?> m</h2>
                            <div class="icon">
                                <img src="<?=assets_path('icon_width.png', 'icons')?>"/>
                                <hr class="clear" />
                            </div>
                        </div>
                        <div class="data">
                            <h1>Leermasse:</h1>
                            <h2><?=$data->leermasse?> t</h2>
                            <div class="icon">
                                <img src="<?=assets_path('icon_weight.png', 'icons')?>"/>
                                <span><?=str_replace(',', '.', $data->leermasse)*1000?> kg</span>
                                <hr class="clear" />
                            </div>
                        </div>
                        <div class="data">
                            <h1>Besatzung:</h1>
                            <h2><?=$data->besatzung?></h2>
                            <div class="icon">
                                <img src="<?=assets_path('icon_people.png', 'icons')?>"/>
                                <hr class="clear" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="clear" />  
                
                <div class="BigBox firstColumn">    
                    <div class="TabBox">
                        <ul class="tabNav_details">
                            <li><a href="#details_<?=$tab_index_1?>" func="tab" class="active">Beschreibung</a></li>
                        </ul>
                        <div class="TabBoxContent">                
                            <h1 class="reiter"><a href="#details_<?=$tab_index_2?>" func="tab" class="active">Beschreibung</a></h1>
                            <div id="box_details_<?=$tab_index_2?>" style="">
        <?     if($data->is_retired()) : $rufname .= " (ausser Dienst)"; endif; ?>
                                <h1><?=$tab_index_2?>: <?=$rufname?></h1>
                                <p><?=$data->text?></p>                     
        <? if($data->pumpe != '' && $data->loeschmittel != '') : ?>                        
                                <div class="facttable">   
                                    <div class="left">
                                        <h1>Pumpe</h1>
                                        <ul>               
                                            <li><?=str_replace("\n", "<br />", trim($data->pumpe));?></li>                                 
                                        </ul>
                                    </div>                            
                                    <div class="right">
                                        <h1>Löschmittelvorrat</h1>
                                        <ul>     
                                            <li><?=str_replace("\n", "<br />", trim($data->loeschmittel));?></li>                          
                                        </ul>
                                    </div>                         
                                    <hr class="clear" />
                                </div>
        <? elseif($data->besonderheit != '') : ?>   
                                <div class="facttable">   
                                    <div class="left">
                                        <h1>Besondere Ausrüstung</h1>
                                        <ul>                              
                                            <li><?=str_replace("\n", "<br />", trim($data->besonderheit));?></li>       
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
                        <h1><?=$headline?></h1>
                        <ul>
        <? foreach($fahrzeugliste as $key => $fahrzeug) : ?>      
        <? if(count($fahrzeugliste) == ($key + 1)) : ?>
                            <li class="last">
        <? else : ?>
                            <li>
        <? endif; ?>                                                  
                                <a href="<?=base_url('technik/fahrzeuge/'.$data->id)?>"><?=$data->name_lang?> - <span class="downlight"><?=$data->name?></span></a>
                            </li>
        <? endforeach; ?>                    
                        </ul>
                        <h1 class="subnavi_opener_mobile">Alle Fahrzeuge</h1>
                        <ul class="subnavi_content_mobile">
        <? foreach($fahrzeugliste as $key => $fahrzeug) : ?>      
        <? if(count($fahrzeugliste) == ($key + 1)) : ?>
                            <li class="last">
        <? else : ?>
                            <li>
        <? endif; ?>                                                  
                                <a href="<?=base_url('technik/fahrzeuge/'.$data->id)?>"><?=$data->name_lang?> - <span class="downlight"><?=$data->name?></span></a>
                            </li>
        <? endforeach; ?>   
                        </ul>
                    </div>
                </div >    
                <hr class="clear" />  
                
                <div class="BigBox firstColumn">  
                    <div class="slideshow">
        
        		<?php if(count($images) > 1) {?>
                        <div class="prevPic"><a href="#slideshow_car" id="slideshow_prev"><img src="<?=assets_path('button_detailShow_previous.png', 'layout')?>" /></a></div>
                        <div class="nextPic"><a href="#slideshow_car" id="slideshow_next"><img src="<?=assets_path('button_detailShow_next.png', 'layout')?>" /></a></div>
        		<?php }?>                
        
                        <ul id="slideshow_car">
        <? foreach($images as $key => $img) : ?>           
        <? if($key == 0) : ?>
                            <li id="slideshow_car_<?=$key+1?>" class="active">
        <? else : ?>
                            <li id="slideshow_car_<?=$key+1?>" class="noActive">
        <? endif; ?>
                                <figure>
                                	<img src="<?=base_url(CONTENT_IMG_FAHRZEUG_UPLOAD_PATH.$img['img_file'])?>" alt="<?=$img['description']?>" />
                                	<div class="zoom"><a href="<?=base_url(CONTENT_IMG_FAHRZEUG_UPLOAD_PATH.$img['img_file'])?>" title="<?=$img['description']?>" class="fancybox-gallery" rel="gallery1"><img src="<?=assets_path('button_zoom.png', 'layout')?>" /></a></div>
                                </figure>
                                <p><?=$key+1?>: <?=$img['text']?></p>
                            </li>
        <? endforeach; ?>             
                        </ul>
                    </div>
                </div>
                
                <div class="SmallBox secondColumn">  
            	    <div class="dateBox">
                        <h1>Die letzten Einsätze</h1>
                        <ul>
        <? foreach($einsaetze as $einsatz) : ?>                
                            <li>
                                <a href="<?=base_url('aktuelles/einsatz/'.$einsatz['einsatzID'])?>">
                                <h2><?=cp_get_ger_date($einsatz['datum'])?></h2>
                                <p><?=$einsatz['lage']?></p>
                                </a>
                            </li>
        <? endforeach; ?>                    
                        </ul>
                    </div>
                </div>
                <hr class="clear" />
                                
            </ul>
        </div>
        <hr class="clear" />
    </div>
</section>