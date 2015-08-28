<div id="MainContent">
<?php foreach($news as $key => $n) : 
        if($key == 0) $class = "BildTextTeaser first"; else $class = "BildTextTeaser";
?>
    <div class="<?=$class?>">  
<?php   if($n->teaser_image != '') { ?>
        <figure>
            <img src="<?=img_path('news/'.$n->teaser_image)?>" title="<?=$n->title?>" />
        </figure>
<?php   } ?>
        <h1><?=$n->title?></h1>
        <p><?=$n->teaser?></p>
<?php   if($n->text != '') : ?>
        <p class="more"><a href="<?=base_url('/aktuelles/news/'.$n->id)?>" class="button_black">Mehr lesen</a></p>
<?php   elseif($n->link != '') : ?>
        <p class="more"><a href="<?=base_url($n->link)?>" class="button_black">Mehr lesen</a></p>
<?php   endif; ?>        
    </div>          
<?php endforeach; ?>

    <hr class="clear" />
    
    <h1 class="module">Einsatz-Ticker</h1>           
    <ul class="news"> 
<?php foreach($missions as $m) : ?>
        <li>
            <a href="<?=base_url('aktuelles/einsatz/'.$m->id)?>">
                <h2><span class="date"><?=get_ger_date($m->datum_beginn).' '.$m->uhrzeit_beginn?></span> / <?=$m->type->name?></h2>
                <h1><?=$m->name?></h1>
                <p><?=$m->lage?></p>
            </a>
        </li>
<?    endforeach; ?>
    </ul>
</div>

<div id="SidebarContent">
    <div class="statistic">
        <h1 class="first">Das sind wir in Zahlen</h1>               
        <hr class="clear" />
        <table>
       	    <tr><td>Eins&auml;tze <?=date('Y')?></td><td class="value"><?=$mission_count?></td></tr>
           	<tr><td>Mannschaft</td><td class="value"><?=$member_count["anzahl"]?></td></tr>
           	<tr><td>Frauen</td><td class="value"><?=$member_count["anzahl_w"]?></td></tr>
           	<tr><td>M&auml;nner</td><td class="value"><?=$member_count["anzahl_m"]?></td></tr>
           	<tr><td>Fahrzeuge</td><td class="value"><?=$vehicle_count?></td></tr>
        </table>          
    </div>
    <hr class="clear" />
    
    <div class="dates">
        <h1 class="first">Termine</h1>
        <ul> 
        <?php foreach($appointments as $a) : ?>
            <li>    
                <h3><span class="date"><?=get_ger_date($a->datum).' - '.$a->beginn?></span> / <?=$a->ort_short?></h3>
                <h2><?=$a->name?></h2>
            </li>
        <?php endforeach; ?>
        </ul>
        <p class="more"><a href="<?=base_url('aktuelles/termine')?>" class="button_white">Mehr lesen</a></p>
    </div> 
        
    <div class="weather">
        <h1>Wetter Aussichten</h1>
        <div class="wrapper">    
            <!-- <div class="icon"><?=$weather['weather_img']?></div>-->
            <div class="text">
                <?php if($weather['weather_cond']['temp'] != '_') : ?>                    
                <p class="grad"><?=$weather['weather_cond']['temp']?>&deg;<span class="celsius">Celsius</span></p>
                <?php endif; ?>                        
                <p class="status"><?=$weather['weather_cond']['text']?></p>
            </div>
        </div>
    <hr class="clear" />
    </div>
</div>
