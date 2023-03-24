<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
    $i=0;
    $j=0;
?>    
        <div class="oneColumnBox" id="submenue">
        
        	<div class="filter">
<? foreach($monate as $monat) : ?>
                <div class="thirdnavi_button"><a href="#anker_<?=strtolower($monat)?>" class="button_black" rel="nicescrolling"><?=ucfirst($monat)?></a></div>
<? endforeach; ?>
                <div><a href="#top" class="backToTop" rel="nicescrolling"></a></div>
	            <hr class="clear" />
            </div>
            
        
        </div>
        <div class="jsplatzhalter"></div>
        <hr class="clear" />
<? foreach($termine as $monat => $termine_pro_monat) : ?>
        <a id="anker_<?=strtolower($monat)?>"></a>   
<? if($j != 0) : ?>
        <h1 class="module" id="anker_<?=strtolower($monat)?>"><?=ucfirst($monat)?></h1>
<? endif; ?>   
        <div class="oneColumnBox">               
            <ul class="terminListe">     
<?        
            $show_description = "true"; //fuel_var('termin_beschreibung_zeigen');
            foreach($termine_pro_monat as $termin) : 
                $ort = "";
                if(strpos($termin->ort, ",") != false) {
                    $ort_array = explode(",", $termin->ort);
                    foreach($ort_array as $key => $o) {
                        if($key == count($ort_array)-1) {
                            $ort.= $o;
                        } else {
                            $ort.= $o."<br/>";
                        }
                    }
                } else {
                    $ort = $termin->ort;
                }
?>               
                <li>
                    <a href="#<?=$i?>" rel="js_terminopen">
                    <div class="row">
                        <div class="termin_date" id="js_termincolor_<?=$i?>">
                            <p class="day"><?=substr($termin->datum, 8, 2)?></p>
                            <p class="month"><?=$monat?></p>
                            <p class="year"><?=substr($termin->datum, 0, 4)?></p>
                        </div>
                        <div class="termin_headline">
                            <h1><?=$termin->name?></h1>
                            <? if($show_description == "true" and $termin->description != "") { ?>
                            <h2><?=$termin->beginn?> Uhr</h2>
                            <div class="termin_details" id="js_termin_<?=$i?>">
                                <p>
                                <?=$termin->description?>
                                </p>
                            <? } else { ?>
                            <h2><?=$termin->beginn?> Uhr</h2>
                            <div class="termin_details" id="js_termin_<?=$i?>">
                            <? } ?>
                                <div class="time">
                                    <p class="datum"><?=get_day_name($termin->datum)?>, den <?=get_ger_date($termin->datum)?></p>
                                    <p class="clock">
                                    	<span style="white-space:nowrap;"><?=$termin->beginn?> <span class="word">Uhr</span></span>
                                         <span class="trenner">/</span> 
                                    	<span style="white-space:nowrap;"><?=$termin->ende?> <span class="word">Uhr</span></span>
                                    </p>
                                </div>
                                <? if($ort != "") { ?>
                                <div class="loction">
                                    <p>
                                        <?=$ort?>
                                    </p>
                                </div>
                                <? } ?>
                            </div>
                            <div class="linkleiste">
                                <p class="link_open active" id="js_linkopen_<?=$i?>">Mehr lesen</p>
                                <p class="link_close" id="js_linkclose_<?=$i?>">Schließen</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </li> 
<?
            $i++; 
            endforeach; 
?>            
            </ul>
        </div>
        <hr class="clear" />
<? 
    $j++;
    endforeach; 
?>      
        <a id="anker_dienstplan"></a>   
        <h1 class="module" id="anker_dienstplan?>">Dienstplan</h1>
        <div class="oneColumnBox">            
            <ul class="terminListe">
                <li>
                    <div class="oneColumnBox">       
                        <div class="listContent">
                            <div class="row">
                                <a href="<?=pdf_path('dienstplan/Dienstplan.pdf')?>" target="_blank">
                                	<div class="date_small trenner"><span class="inline_date"><?=get_asset_date('pdf/dienstplan/Dienstplan.pdf')?></span></div>
                                 	<div class="size trenner"><p>PDF</p><p class="bytes"><?=get_asset_size('pdf/dienstplan/Dienstplan.pdf')?></p></div>
                	               	<div class="headline smallBoxHead"><span class="medium">Einsatzabteilung Bad Soden</span><br/>Dienstplan</div>
                               	</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <hr class="clear" />
