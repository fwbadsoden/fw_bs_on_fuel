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
        <p class="more"><a href="<?= base_url('/aktuelles/news/'.$n->id) ?>" class="button_black">Mehr lesen</a></p>
        <?php elseif($n->link != '') : ?>
        <p class="more"><a href="<?= base_url($n->link) ?>" class="button_black">Mehr lesen</a></p>
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

<!-- START: Countdown für Jubiläum -->
<script type="text/javascript" src="<?= js_path('jquery.syotimer.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#simple_timer').syotimer({
            year: 2018,
            month: 8,
            day: 10
        });
    });
</script>
<style type="text/css">
    /* Customization Style of SyoTimer */
    .timer{
        text-align: center;

        margin: 10px auto 0;
        padding: 0 0 10px;

    }
    .timer .table-cell{
        display: inline-block;
        margin: 0 5px;

        width: 30px;
        background: url(<?= assets_path('timer.png', 'layout') ?>) no-repeat 0 0;
    }
    .timer .table-cell .tab-val{
        font-size: 18px;
        color: #80a3ca;

        height: 54px;
        line-height: 54px;

        margin: 0 0 5px;
    }
    .timer .table-cell .tab-metr{
        font-family: Arial;
        font-size: 12px;
        text-transform: uppercase;
    }

    #simple_timer.timer .table-cell.day, 
    #periodic_timer_days.timer .table-cell.hour{
        width: 80px;
        background-image: url(<?= assets_path('timer_long.png', 'layout') ?>);
    }
</style>
<!-- ENDE Countdown für Jubiläum -->

<div id="SidebarContent">

    <div class="statistic">
        <h1 class="first">Countdown</h1>               
        <hr class="clear" />
        <div id="simple_timer"></div>
    </div>
    <hr class="clear" />

    <div class="statistic">
        <h1 class="first">Das sind wir in Zahlen</h1>               
        <hr class="clear" />
        <table>
       	    <tr><td>Eins&auml;tze <?= date('Y') ?></td><td class="value"><?= $mission_count ?></td></tr>
            <tr><td>Mannschaft</td><td class="value"><?= $member_count["anzahl"] ?></td></tr>
            <tr><td>Frauen</td><td class="value"><?= $member_count["anzahl_w"] ?></td></tr>
            <tr><td>M&auml;nner</td><td class="value"><?= $member_count["anzahl_m"] ?></td></tr>
            <tr><td>Fahrzeuge</td><td class="value"><?= $vehicle_count ?></td></tr>
        </table>          
    </div>
    <hr class="clear" />

    <div class="dates">
        <h1>Termine</h1>
        <ul> 
            <?php foreach($appointments as $a) : ?>
            <li>    
                <h3><span class="date"><?= get_ger_date($a->datum).' - '.$a->beginn ?></span> / <?= $a->ort_short ?></h3>
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

    <?php if($weather != false) : ?>
    <div class="weather">
        <h1>Wetter Aussichten</h1>
        <div class="wrapper">    
            <div class="icon"><!--<?= $weather['image'] ?>--></div>
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