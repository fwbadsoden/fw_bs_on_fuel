<?php if(isset($warning) && is_object($warning)) : ?>
<div id="unwetterwarnung">
    <div class="container">
        <div class="wettericon"></div> 
        <div class="wettertext">
            <h1><?= $warning->headline ?></h1>
            <h2>G&uuml;ltig von: <?= $warning->start ?> Uhr<span>bis: <?= $warning->end ?> Uhr</span></h2>
        </div>
        <div class="dwdlink">
            <p class="button">
                <a href="http://www.dwd.de/DE/wetter/warnungen/warnkarten/warnWetter_hes_node.html?bundesland=hes" target="_blank" class="red">Details zur Warnung</a>
            </p>
        </div>
    </div>
    <hr class="clear" />
</div>
<?php endif; ?>
<div id="MainContent">
    <?php
    foreach($news as $key => $n) :
    if($key == 0) $class = "BildTextTeaser first";
    else $class = "BildTextTeaser";
    ?>
    <div class="<?= $class ?>">  
        <?php if($n->teaser_image != '') { ?>
        <figure>
            <img src="<?= img_path('news/'.$n->teaser_image) ?>" title="<?= $n->title ?>" />
        </figure>
        <?php } ?>
        <h1><?= $n->title ?></h1>
        <p><?= $n->teaser ?></p>
        <?php if($n->text != '') : ?>
        <p class="more"><a href="<?= base_url('/aktuelles/news/'.$n->id) ?>" class="button_black"><?=$n->text_detail_button?></a></p>
        <?php elseif($n->link != '') : ?>
        <p class="more"><a href="<?= base_url($n->link) ?>" class="button_black"><?=$n->text_detail_button?></a></p>
        <?php endif; ?>        
    </div>          
    <?php endforeach; ?>

    <hr class="clear" />

    <h1 class="module">Einsatz-Ticker</h1>           
    <ul class="news"> 
        <?php foreach($missions as $m) : ?>
        <li>
            <a href="<?= base_url('aktuelles/einsaetze/'.$m->id) ?>">
                <h2><span class="date"><?= get_ger_date($m->datum_beginn).' '.$m->uhrzeit_beginn ?></span> / <?= $m->type->name ?></h2>
                <h1><?= $m->name ?></h1>
                <p><?= $m->lage ?></p>
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
       	    <tr><td>Eins&auml;tze <?= date('Y') ?></td><td class="value"><?= $mission_count ?></td></tr>
            <? if(date('m') == '01' || date('m') == '02' || date('m') == '03' || date('m') == '04' || date('m') == '05' || date('m') == '06') : ?>
       	    <tr><td>Eins&auml;tze <?= date('Y')-1 ?></td><td class="value"><?= $mission_count_last_year ?></td></tr>
            <? endif; ?>
            <tr><td>Mannschaft</td><td class="value"><?= $member_count["anzahl"] ?></td></tr>
            <tr><td>Frauen</td><td class="value"><?= $member_count["anzahl_w"] ?></td></tr>
            <tr><td>M&auml;nner</td><td class="value"><?= $member_count["anzahl_m"] ?></td></tr>
            <tr><td>Fahrzeuge</td><td class="value"><?= $vehicle_count ?></td></tr>
            <tr><td>Abrollbehälter</td><td class="value"><?= $swapbody_count ?></td></tr>
        </table>          
    </div>
    <hr class="clear" />

    <div class="dates">
        <h1>Termine</h1>
        <ul> 
            <?php foreach($appointments as $a) : ?>
            <li>    
                <h3><span class="date"><?= get_ger_date($a->datum).' - '.$a->beginn ?></span><? if($a->ort_short != "") { ?> / <?= $a->ort_short ?> <? } ?></h3>
                <h2><?= $a->name ?></h2>
            </li>
            <?php endforeach; ?>
        </ul>
        <p class="more"><a href="<?= base_url('aktuelles/termine') ?>" class="button_white">Mehr lesen</a></p>
    </div>     
    <hr class="clear" />

    <div class="facebook">
        <h1>Folge uns auf Facebook</h1>
        <div class="wrapper">
            <div class="fb-page" data-href="https://www.facebook.com/feuerwehr.badsoden/" data-width="265" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">

                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/feuerwehr.badsoden/">
                        <a href="https://www.facebook.com/feuerwehr.badsoden/">Freiwillige Feuerwehr Bad Soden am Taunus</a>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>

    <?php if($weather != null && $weather != false) :  ?>
    <?php if($weather['image'] == '') : $image = ""; else : $image = '<img src="'.assets_path("icons/" . $weather["image"]).'" title="'.$weather['description'].'" alt="'.$weather['description'].'" />'; endif; ?>
    <div class="weather">
        <h1>Wetter Aussichten</h1>
        <div class="wrapper">    
            <div class="icon"><?=$image?></div>
            <div class="text">                 
                <p class="grad"><?= round($weather['temperature']) ?>&deg;<span class="celsius">Celsius</span></p>
                <p class="status"><?= $weather['description'] ?></p>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <hr class="clear" />

    <div style="height: 10px;"></div>
</div>
<hr class="clear" />  