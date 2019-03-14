<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
    $beginn = $data->datum_beginn.' '.$data->uhrzeit_beginn; 
    $ende   = $data->datum_ende.' '.$data->uhrzeit_ende;
    $differenz = time_diff($beginn, $ende);
    $cue_data = $data->get_cue();
?>

<div class="oneColumnBox">
    <div class="factSheet_einsatz">
        <div class="table">               
            <div class="row">
                <div class="black">Einsatzort:</div>
                <div class="red"><?=$data->get_ort()?></div>
            </div>                    
            <div class="row">
                <div class="black">Alarmstichwort:</div>
                <?php if($cue_data != null) : $cue = $cue_data["name"].' - '.$cue_data["description"];
                      else : $cue = "n/a";
                      endif; ?>
                <div class="red"><?=$cue?></div>
            </div>  
            <div class="row">
                <div class="black lastRow">Einsatzart:</div>    
                <?php if($data->type == null || $data->type->name == "") : $type_name = "n/a";
                      else : $type_name = $data->type->name;
                        if($data->is_ueberoertlich()) :
                            $type_name = "Überörtlich ".$type_name;
                        endif;
                      endif; ?>
                <div class="red lastRow"><?=$type_name?></div>
            </div>
        </div>        
        <div class="data">
            <h1>Einsatzbeginn:</h1>
            <div class="icon showIcon">
                <img src="<?=assets_path('icon_cal.png', 'icons')?>"/>
            </div>
            <div class="info showInfo">     
                <h3><?=get_ger_date($data->datum_beginn)?></h3>
                <h4><?=$data->uhrzeit_beginn?> Uhr</h4>
            </div>    
            <hr class="clear" />
        </div>
        <div class="data">
            <h1>Einsatzende:</h1>
            <div class="icon showIcon">
                <img src="<?=assets_path('icon_cal_red.png', 'icons')?>"/>
            </div>
            <div class="info showInfo">    
                <h3><?=get_ger_date($data->datum_ende)?></h3>
                <h4><?=$data->uhrzeit_ende?> Uhr</h4>
            </div>
            <hr class="clear" />
        </div>
        <div class="data">
            <h1>Einsatzdauer:</h1>
            <div class="icon">
                <img src="<?=assets_path('icon_clock.png', 'icons')?>"/>
            </div>
            <div class="info"> 
                <h3><?=$differenz["total_hours_minutes"]?> h</h3>
                <h4><?=$differenz["total_minutes"]?> Min</h4>
            </div>
            <hr class="clear" />
        </div>
        <div class="data">
            <h1>Fahrzeuge:</h1>
            <div class="icon">
                <img src="<?=assets_path('icon_cars.png', 'icons')?>"/>
            </div>
            <div class="info">                    
                <h2><?=$data->get_vehicle_count()?></h2>
            </div>
            <hr class="clear" />
        </div>
        <div class="data">
            <h1>Eigene Kr&auml;fte:</h1>
            <div class="icon">
                <img src="<?=assets_path('icon_people.png', 'icons')?>"/>
            </div>
            <div class="info">    
                <h2><?=$data->anzahl_kraefte?></h2>
            </div>
            <hr class="clear" />
        </div>
    </div>
</div>
<hr class="clear" />

<?php 
    $einsatzkraefte = explode(',', strip_tags($data->weitere_kraefte)); 
    $slide_count = 0;
?>

<div id="MainContent">    
            
    <div class="article">
        <h1>Einsatzbericht</h1>
        <p><?=$data->lage?></p>
        <p><?=$data->bericht?></p>
    </div>
<?  if(count($data->mission_images) > 0) : ?>
    <div class="slideshow">
<?  if(count($data->mission_images) > 1) : ?>
        <div class="prevPic"><a href="#slideshow_mission" id="slideshow_prev"><img src="<?=assets_path('button_detailShow_previous.png', 'layout')?>" /></a></div>
        <div class="nextPic"><a href="#slideshow_mission" id="slideshow_next"><img src="<?=assets_path('button_detailShow_next.png', 'layout')?>" /></a></div>
<?  endif; ?>                
        <ul id="slideshow_mission">
<?  foreach($data->mission_images as $b) :
        $slide_count++;       ?>                
            <li id="slideshow_mission_<?=$slide_count?>" <? if($slide_count == 1) : ?> class="active" <? endif; ?> >
                <figure>
               	    <img src="<?=img_path('einsaetze/'.$b->get_image())?>" alt="" />
                   	<div class="zoom"><a href="<?=img_path('einsaetze/'.$b->get_image())?>" class="fancybox-gallery" rel="gallery1"><img src="<?=assets_path('button_zoom.png', 'layout')?>" /></a></div>
                </figure>
<?  if($b->photographer != null && $b->photographer != "") : ?>                
                <p><b>#<?=$slide_count?>: <?=$b->description?> </b><br/>Fotograf: <?=$b->photographer?></p>
<?  else : ?>
                <p><b>#<?=$slide_count?>: <?=$b->description?> </b></p>
<?  endif; ?>
            </li>
<?  endforeach; ?>                    
        </ul>
    </div>
<?  endif; ?>     
<?  if($data->display_ort()) : ?>               
    <h1 class="module">Einsatzort</h1>
    <div class="googlemaps">
        <div class="Flexible-container">
            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.de/maps?q=<?=$data->ort?>&ie=UTF8&t=m&z=13&output=embed"></iframe><br /><small><a href="https://maps.google.de/maps?q=Bad+Soden+am+Taunus" style="color:#0000FF;text-align:left">Größere Kartenansicht</a></small>
        </div>
    </div>
<?  endif; ?>            
</div>	

<div id="SidebarContent">  
<?  if(count($data->fahrzeuge) > 0) : ?>        
    <div class="SBfahrzeugListe">
        <h1 class="first">Eingesetzte Fahrzeuge</h1>                
            <ul>
<?  foreach ($data->fahrzeuge as $f) : ?>
                <li>
<?  if($f->is_published()) : ?>                    
                    <a href="<?=base_url('technik/fahrzeuge/'.$f->id)?>">
<?  endif; ?>
                        <figure><img src="<?=img_path('fahrzeuge/setcards/'.$f->setcard_image)?>" width="100" height="50" /></figure>
                        <div class="info">
<?  if(mb_strlen($f->name,'utf-8') > 13) : $f->name = mb_substr($f->name,0,10,'utf-8').'.'; endif; ?>                           
                            <h2><?=$f->name?></h2>
<?  if($f->name_lang != '') : 
        if(mb_strlen($f->name_lang,'utf-8') > 20) : $f->name_lang = mb_substr($f->name_lang,0,17,'utf-8').'.'; endif;
?>                            
                            <h3><?=$f->name_lang?></h3>
<?  endif; ?>
						</div>
<?  if($f->is_published()) : ?>  
                    </a>
<?  endif; ?>
                    <hr class="clear" />
                </li>
<?  endforeach; ?>      
            </ul>
        </div>
<?  endif; ?>            
<?  if($data->weitere_kraefte != '') : ?>           
        <div class="SBListe">
            <h1>Alarmierte Einsatzkräfte</h1>
            <ul>
<?  foreach ($einsatzkraefte as $e) : ?>               
                <li><?=trim($e);?></li>
<?  endforeach; ?>
            </ul>
        </div>    
<? else:  ?>
        <div class="SBListe">
            <h1>Alarmierte Einsatzkräfte</h1>
            <ul>          
                <li>keine weiteren Kräfte</li>
            </ul>
       	</div> 
<? endif; ?>                       
    </div>
    <hr class="clear" />
</div>