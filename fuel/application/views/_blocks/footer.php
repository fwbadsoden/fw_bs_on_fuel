</div>
</section>
<footer id="endOfPage">

    <div id="shortlinks">
        <h1><?= fuel_var('pagetitle'); ?></h1>
        <?= $shortlinks ?>
    </div>
    <div id="share"><a href="https://www.facebook.com/feuerwehr.badsoden" target="_blank"><img src="<?= assets_path('button_facebook.png', 'layout') ?>" width="90" height="23" alt="feuerwehr-bs.de auf Facebook" /></a></div>
    <div id="sitemap">

        <div class="completeSitemap"> 
            <div class="sitemapBox">   
                <?= $sitemap_box ?>
            </div>        
        </div>

        <div class="smallSitemap">               
            <?= $small_sitemap ?>
        </div>

    </div>

    <div id="copyright">
        <p>&copy;<?= date("Y") . " " . fuel_var('copyright') ?></p>
    </div>

</footer>

<div id="mitmachen_js" class="mitmachen_layer">
    <div class="mitmachen">
        <h3>Mitmachen</h3>
        Lorem Ipsum dolor sit amet.<br/>Lorem Ipsum dolor sit amet.<br/>Lorem Ipsum dolor sit amet.
    </div>
    <hr class="clear" />
    <div class="mitmachen">

        <div class="box boxtrenner">
            <p class="abteilung">Einsatzabteilung</p>
            <p>Dienst: Donnerstags von 19:30 – 21:30 Uhr</p>
            <p>Wehrführer: Sven Griese und Marc Bauer</p>
        </div>
        <div class="box">
            <p class="abteilung">Verein</p>
            <p>Vereinsvorsitzende: Sven Griese und Dirk Stehning</p>
        </div>
    </div>
    <hr class="clear" />
    <div class="mitmachen">                
        <div class="box boxtrenner">
            <p class="abteilung">Jugendfeuerwehr</p>
            <p>Dienst: Montags von 18:00 – 20:00 Uhr</p>
            <p>Jugendwarte: Alexander Haase und Florian Becker</p>
        </div>
        <div class="box">
            <p class="abteilung">Minifeuerwehr</p>
            <p>Dienst: Montags von 18:00 – 20:00 Uhr</p>
            <p>Verantwortliche: Max Mustermann</p>
        </div>
    </div>
    <hr class="clear" />
    <div class="mitmachen">                
        <div class="box boxtrenner">
            <p class="abteilung">Rettungshundeeinheit</p>
            <p>Dienst: Montags von 18:00 – 20:00 Uhr</p>
            <p>Verantwortliche: Patrick Ritter</p>
        </div>
        <div class="box">
            <p class="abteilung">Alters- und Ehrenabteilung</p>
            <p>Vorsitzender: Max Mustermann</p>
        </div>
    </div>
    <hr class="clear" />
</div>
</div>

<div id="notruflayer_js" class="notruf_layer">
    <div class="tele">
        <h3>Notrufnummern</h3>
        <div class="box boxtrenner">
            <p class="number">112</p>
            <p>Feuerwehr</p>
            <p>Rettungsdienst</p>
        </div>
        <div class="box">
            <p class="number">110</p>
            <p>Polizei</p>
        </div>
    </div>
    <div class="faq">
        <h3>Notruf richtig absetzen</h3>
        <ul>
            <li>/ <span class="hightlight">Wo</span> ist es passiert?</li>
            <li>/ <span class="hightlight">Was</span> ist passiert?</li>
            <li>/ <span class="hightlight">Wie</span> viele Personen sind betroffen?</li>
            <li>/ <span class="hightlight">Welche</span> Art der Erkrankung oder Verletzung liegt vor?</li>
            <li>/ <span class="hightlight">Warten</span> auf Rückfragen.</li>
        </ul>
    </div>
    <hr class="clear" />
    <div class="greybox">
        <p class="number">Zentrale Leitstelle <span>+49 6192-5095</span></p>
        <p class="button"><a href="<?= fuel_var('url_notruffax') ?>" class="button_black_gross" target="_blank">Notruffax &raquo;</a></p>
        <hr class="clear" />
    </div>
</div>

<script type="text/javascript" charset="utf-8" src="<?= base_url("assets/js/basic-min.js") ?>"></script>
<script type="text/javascript" charset="utf-8" src="<?= base_url("assets/js/doubletaptogo.js") ?>"></script>

<script type="text/javascript" src="<?= base_url("assets/js/jquery.mousewheel-3.0.6.pack.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/fancyBox/jquery.fancybox.js?v=2.1.5") ?>"></script>

<link rel="stylesheet" type="text/css" href="<?= base_url("assets/js/fancyBox/jquery.fancybox.css?v=2.1.5") ?>" media="screen" />
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/js/fancyBox/helpers/jquery.fancybox-buttons.css?v=1.0.5") ?>" />

<script type="text/javascript" src="<?= base_url("assets/js/fancyBox/helpers/jquery.fancybox-buttons.js?v=1.0.5") ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/js/fancyBox/helpers/jquery.fancybox-thumbs.css?v=1.0.7") ?>" />

<script type="text/javascript" src="<?= base_url("assets/js/fancyBox/helpers/jquery.fancybox-thumbs.js?v=1.0.7") ?>"></script>
<script type="text/javascript" src="<?= base_url("assets/js/fancyBox/helpers/jquery.fancybox-media.js?v=1.0.6") ?>"></script>    

<script type="text/javascript">
    $(function () {
        $('#menu li:has(div)').doubleTapToGo();
    });
</script>
</body>
</html>