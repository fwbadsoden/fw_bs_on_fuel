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
<?          foreach($termine_pro_monat as $termin) : ?>               
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
                            <h2><?=$termin->beginn?> Uhr / <?=substr($termin->description, 0, 60)?></h2>
                            <div class="termin_details" id="js_termin_<?=$i?>">
                                <p>
                                <?=$termin->description?>
                                </p>
                                <div class="time">
                                    <p class="datum"><?=get_day_name($termin->datum)?>, den <?=get_ger_date($termin->datum)?></p>
                                    <p class="clock">
                                    	<span style="white-space:nowrap;"><?=$termin->beginn?> <span class="word">Uhr</span></span>
                                         <span class="trenner">/</span> 
                                    	<span style="white-space:nowrap;"><?=$termin->ende?> <span class="word">Uhr</span></span>
                                    </p>
                                </div>
                                <div class="loction">
                                    <p>
                                        <?=$termin->ort?>
                                    </p>
                                </div>
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