<?php fuel_set_var('layout', ''); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-de" lang="de-de">
<head>
    <meta name="keywords" content="feuerwehr-bs.de, Feuerwehr, Freiwillige Feuerwehr, Bad Soden" />
<meta name="description" content="Alle Infos rund um die Freiwillige Feuerwehr der Stadt Bad Soden am Taunus" />
<meta name="page-topic" content="feuerwehr-bs.de - Freiwillige Feuerwehr der Stadt Bad Soden am Taunus" />
<meta name="revisit-after" content="1 days" />
<meta name="language" content="de" />
<meta name="copyright" content="feuerwehr-bs.de" />
<meta name="author" content="info[at]feuerwehr-bs.de" />
<meta name="publisher" content="Freiwillige Feuerwehr Bad Soden am Taunus" />
<meta name="audience" content="Alle" />
<meta name="expires" content="never" />
<meta name="page-type" content="Portal" />
<meta name="robots" content="INDEX,FOLLOW" />
<meta name="rating" content="General" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="X-UA-Compatible" content="edge" />
<meta http-equiv="imagetoolbar" content="no" />
 	<title>Freiwillige Feuerwehr Bad Soden am Taunus</title>
	
    <link rel="shortcut icon" href="/assets/icons/favicon.ico" type="image/x-icon" />

    <link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="/assets/css/styles.css?c=" type="text/css" />
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    
    <!-- socialshareprivacy -->
    <script type="text/javascript" src="/assets/js/socialshareprivacy/jquery.socialshareprivacy.min.js?c="></script>
    <script type="text/javascript" src="/assets/js/socialshareprivacy/socialshareprivacy.min.de.js?c="></script>
    
    <script type="text/javascript">
    $(document).ready(function () {     
        if($('#share').length > 0) { 
            $('#share').socialSharePrivacy({ 
                
                "path_prefix"       : "/assets/js/socialshareprivacy/",
                "info_link_target"  : "_blank",
                "uri"               : "https://www.facebook.com/feuerwehr.badsoden",
                "services" : { 
                    "facebook"      : { 
                        "dummy_line_img"    : "images/de/dummy_facebook.png",
                        "dummy_box_img"     : "images/de/dummy_box_facebook.png"
                    },
                    "buffer"        : { "status":false },
                    "delicious"     : { "status":false },
                    "disqus"        : { "status":false },
                    "fbshare"       : { "status":false },
                    "flattr"        : { "status":false },
                    "gplus"         : { "status":false },
                    "hackernews"    : { "status":false},
                    "linkedin"      :{ "status":false},
                    "mail"          :{ "status":false},
                    "pinterest"     :{ "status":false},
                    "reddit"        :{ "status":false},
                    "stumbleupon"   :{ "status":false},
                    "tumblr"        :{ "status":false},
                    "twitter"       :{ "status":false},
                    "xing"          :{ "status":false}
                },
                "css_path"  : "socialshareprivacy.css",
                "language"  : "de"
                
            });
        }
    });    
    </script>
    <!-- socialshareprivacy END -->
</head>
<body>
<header>
	<div class="site" id="top">
        <h1>
        	<a href="<?= base_url() ?>" title="Home"><?= fuel_var('pagetitle'); ?></a>
        </h1>
        <nav>    
          <div id="metanavigation">                 
			<ul>
				<li class="first"><a href="https://portal-fwbs.de/" target="_blank">Infoportal</a></li>
				<li><a href="#notruflayer_js" class="fancybox-metaLayer">Notfall</a></li>
			</ul>
          </div>
          <ul id="menu"></ul>
       	</nav>
    </div>
</header>

<section id="stage">
    
    <div class="pictures small" id="pictures_0" style="background-image: url(/assets/images/bildbuehnen/stage_kontakt.jpg); display: none;">
        <div id="stagewrapper">    
            <div class="stageContentHeadlineTop half_blackBG smallstage">        
                 <h1 class=>Im Einsatz</h1>                  <h2 class=>Die Seite ist aktuell offline</h2>   
            </div>
        </div>
    </div>
	
</section>

<section id="content">
    <div class="slidewrapper smallstage">
		<div id="MainContent">      
    <div class="article">
        <p>
            Aktuell führen wir technische Arbeiten an unserem Webauftritt durch. <br />Bitte kommen Sie später noch einmal.
		</p><p>
            Sollten Sie Fragen haben, sind auf dieser Seite noch mal alle Kontaktinformationen für Sie zusammengefasst.
        </p>
    </div>
    <hr class="clear" />
</div>    
<div id="SidebarContent">   
    <div class="address">
        <h1 class="first">Kontaktadresse</h1>
        <p>Freiwillige Feuerwehr<br/>Bad Soden am Taunus</p>
        <p>Hunsrückstr. 5-7<br/>65812 Bad Soden am Taunus</p>
		<ul>
            <li class="tel">+49 6196 24074</li>
            <li class="fax">+49 6196 62596</li></li>
            <li class="mail"><?=safe_mailto_notitleencoding('stadtbrandinspektor@feuerwehr-bs.de', 'Stadtbrandinspektor')?></li>
            <li class="mail"><?=safe_mailto_notitleencoding('wehrfuehrung@feuerwehr-bs.de', 'Wehrführung')?></li>
            <li class="mail"><?=safe_mailto_notitleencoding('pressestelle@feuerwehr-bs.de', 'Pressestelle')?></li>
            <li class="mail"><?=safe_mailto_notitleencoding('jugendfeuerwehr@feuerwehr-bs.de', 'Jugendfeuerwehr')?></li>
            <li class="mail"><?=safe_mailto_notitleencoding('minifeuerwehr@feuerwehr-bs.de', 'Minifeuerwehr')?></li>
            <li class="mail"><?=safe_mailto_notitleencoding('verein@feuerwehr-bs.de', 'Verein')?></li>
        </ul>
        <br />
    </div>    
</div>
<hr class="clear" />        <hr class="clear" />   
    </div>	
    </div>
</section>
<footer id="endOfPage">

	<div id="shortlinks">
    	<h1>Freiwillige Feuerwehr Bad Soden am Taunus</h1>   

    </div>
    <div id="share"></div>
    <div id="sitemap">

    </div>
    
    <div id="copyright">
    	<p>&copy;2016 Freiwillige Feuerwehr Bad Soden am Taunus 1868 e.V. / Hunsrückstraße 5-7 / 65812 Bad Soden am Taunus</p>
    </div>

</footer>

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
    	<p class="button"><a href="http://www.gehoerlosen-bund.de/images/stories/pdfs/dgb_notruftelefaxvorlage.pdf" class="button_black_gross" target="_blank">Notruffax &raquo;</a></p>
    	<hr class="clear" />
	</div>
</div>

<script type="text/javascript" charset="utf-8" src="http://dev.feuerwehr-bs.de/assets/js/basic-min.js"></script>
<script type="text/javascript" charset="utf-8" src="http://dev.feuerwehr-bs.de/assets/js/doubletaptogo.js"></script>

<script type="text/javascript" src="http://dev.feuerwehr-bs.de/assets/js/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="http://dev.feuerwehr-bs.de/assets/js/fancyBox/jquery.fancybox.js?v=2.1.5"></script>
    
<link rel="stylesheet" type="text/css" href="http://dev.feuerwehr-bs.de/assets/js/fancyBox/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="http://dev.feuerwehr-bs.de/assets/js/fancyBox/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	
<script type="text/javascript" src="http://dev.feuerwehr-bs.de/assets/js/fancyBox/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<link rel="stylesheet" type="text/css" href="http://dev.feuerwehr-bs.de/assets/js/fancyBox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	
<script type="text/javascript" src="http://dev.feuerwehr-bs.de/assets/js/fancyBox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script type="text/javascript" src="http://dev.feuerwehr-bs.de/assets/js/fancyBox/helpers/jquery.fancybox-media.js?v=1.0.6"></script>    
 
 <script type="text/javascript">
    $( function() {  $( '#menu li:has(div)' ).doubleTapToGo(); });      
 </script>
</body>
</html>