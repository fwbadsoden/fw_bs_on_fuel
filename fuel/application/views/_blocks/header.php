<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-de" lang="de-de">
<head>
    <meta name="page-topic" content="<?php echo fuel_var('metapagetopic')?>" />
	<meta name="keywords" content="<?php echo fuel_var('metakeywords')?>"/>
	<meta name="description" content="<?php echo fuel_var('metadescription')?>"/>
    <meta name="revisit-after" content="1 days" />
    <meta name="language" content="de" />
    <meta name="copyright" content="feuerwehr-bs.de" />
    <meta name="author" content="info[at]feuerwehr-bs.de" />
    <meta name="publisher" content="<?php echo fuel_var('pagetitle'); ?>" />
    <meta name="audience" content="Alle" />
    <meta name="expires" content="never" />
    <meta name="page-type" content="Portal" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="rating" content="General" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="X-UA-Compatible" content="edge" />
    <meta http-equiv="imagetoolbar" content="no" />
 	<title><?=fuel_var('pagetitle'); ?></title>
	
    <link rel="shortcut icon" href="<?=base_url("assets/icons/favicon.ico")?>" type="image/x-icon" />

    <link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="<?=base_url("assets/css/styles.css")?>" type="text/css" />
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    
    <!-- socialshareprivacy -->
    <script type="text/javascript" src="<?=base_url("assets/js/socialshareprivacy/jquery.socialshareprivacy.min.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/js/socialshareprivacy/jquery.socialshareprivacy.min.de.js")?>"></script>
    
    <script type="text/javascript">
    $(document).ready(function () {    
        if($('#share').length > 0) {
            $('#share').socialSharePrivacy({
                
                "path_prefix"       : "<?=base_url("assets/js/socialshareprivacy")?>/",
                "info_link_target"  : "_blank",
                "uri"               : "https://www.facebook.com/feuerwehr.badsoden",
                "services" : {
                    "facebook"      : {
                        "dummy_line_img"    : "images/de/dummy_facebook.png",
                        "dummy_box_img"     : "images/de/dummy_box_facebook.png"
                    },
                    "buffer"        : {"status":false },
                    "delicious"     : {"status":false },
                    "disqus"        : {"status":false },
                    "fbshare"       : {"status":false },
                    "flattr"        : {"status":false },
                    "gplus"         : {"status":false },
                    "hackernews"    : {"status":false},
                    "linkedin"      :{"status":false},
                    "mail"          :{"status":false},
                    "pinterest"     :{"status":false},
                    "reddit"        :{"status":false},
                    "stumbleupon"   :{"status":false},
                    "tumblr"        :{"status":false},
                    "twitter"       :{"status":false},
                    "xing"          :{"status":false}
                },
                "css_path"  : "socialshareprivacy.css",
                "language"  : "de"
                
            });
        }
    });    
    </script>
    <!-- socialshareprivacy END -->

	<?php
		echo css('main').css($css);


	?>

</head>
<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44450948-1', 'feuerwehr-bs.de');
  ga('send', 'pageview');

</script>

<header>
	<div class="site" id="top">
        <h1>
        	<a href="<?=base_url()?>" title="Home"><?=fuel_var('pagetitle'); ?></a>
        </h1>
        <nav>    
            <div id="metanavigation"> 
                <?=$metanavigation?>
            </div>
            <ul id="menu">  
             
                <li><a href="http://feuerwehr-bs.de/aktuelles">News</a>  
                   <div class="dropdown">  
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/aktuelles/news">News</a></li>
  
              
                
                        	<li><a href="http://feuerwehr-bs.de/aktuelles/news/24"><span class="subline">17.03.2015</span><br />Nachwuchs für die Einsatzabteil...</a></li>
  
                
                    	</ul>                    
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/aktuelles/einsaetze">Einsätze</a></li>
 
             
                
                        	<li><a href="http://feuerwehr-bs.de/aktuelles/einsatz/2751"><span class="subline">04.04.2015 / Hilfeleistungseinsatz</span><br />Ölspur</a></li>
 
                 
                    	</ul>  
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/aktuelles/termine">Termine</a></li>
                           
         
                        	<li><a><span class="subline">09.04.2015 / 19:30:00 Uhr</span><br />Zusatzdienst</a></li>
  
                    	</ul>  
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/aktuelles/presse">Presse</a></li>
    
                        
                	       <li><a href="http://feuerwehr-bs.de/files/content/FNP_2015-03-30_Der neue Kreisbrandmeister.jpg" class="fancybox-gallery" rel="gallery_presse_menue"><span class="subline">30.03.2015 / Frankfurter Neue Presse</span><br />Der neue Kreisbrandmeister</a></li>
    
                           
                       	</ul>  
                   </div>  
                </li>  
                 
                <li><a href="http://feuerwehr-bs.de/menschen/mannschaft">Menschen</a>  
                    <div class="dropdown">  
                    	<ul>                      
                        	<li class="headline"><a href="http://feuerwehr-bs.de/menschen/mannschaft">Mannschaft</a></li>
                        	<li><a href="http://feuerwehr-bs.de/menschen/mannschaft#anker_fuehrung">Führung</a></li>
                            <li><a href="http://feuerwehr-bs.de/menschen/mannschaft#anker_mannschaft">Mannschaft</a></li>
                    	</ul>  
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/menschen/rettungshunde">Rettungshunde</a></li>
                        	<li><a href="http://feuerwehr-bs.de/menschen/rettungshunde#anker_einleitung">Einleitung</a></li>
                            <li><a href="http://feuerwehr-bs.de/menschen/rettungshunde#anker_ausbildung">Ablauf der Ausbildung</a></li>
                    	</ul> 
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/menschen/jugend">Nachwuchs</a></li>
                             
                        	<li><a href="http://feuerwehr-bs.de/menschen/jugend">Jugendfeuerwehr</a></li>
                             
                            <li><a href="http://feuerwehr-bs.de/menschen/minifeuerwehr">Minifeuerwehr</a></li>
                    	</ul>   
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/menschen/leistungsgruppe">Leistungsgruppe</a></li>
                        	<li><a href="http://feuerwehr-bs.de/menschen/leistungsgruppe#anker_theorie">Theorie</a></li>
                            <li><a href="http://feuerwehr-bs.de/menschen/leistungsgruppe#anker_praxis">Praxis</a></li>
                    	</ul>  
                    </div>  
				</li>  
                 
                <li><a href="http://feuerwehr-bs.de/technik">Technik</a>  
                    <div class="dropdown">  
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/technik/fahrzeuge">Fahrzeuge</a></li>
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/29">
                            KdoW - SBI - KdoW - Stadtbrandinspektor                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/16">
                            KdoW - Kommandowagen                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/1">
                            ELW 1 - Einsatzleitwagen                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/12">
                            PKW - Führungsdienst PKW                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/11">
                            Notdienst-PKW - Notdienst-/Werkstatt PKW                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/26">
                            MTF 1 - Mannschaftstransporter                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/27">
                            MTF 2 - Mannschaftstransporter                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/28">
                            TLF 4000 - Tanklöschfahrzeug                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/4">
                            DLK 23/12 - Drehleiter                            </a></li>  
                        </ul><ul>                                  
                        	<li class="headline"><a href="http://feuerwehr-bs.de/technik/fahrzeuge">&nbsp;</a></li>
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/2">
                            LF 16/2 - Löschgruppenfahrzeug                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/3">
                            LF 16/1 - Löschgruppenfahrzeug                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/25">
                            LF 20 KatS - Löschgruppenfahrzeug                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/6">
                            RW - Rüstwagen                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/7">
                            GW-L - Gerätewagen Logistik                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/10">
                            WLF - Wechselladerfahrzeug                            </a></li>  
            
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/20">
                            RH-Hänger - Rettungshundeanhänger                            </a></li>  
                    	</ul>  
   	                    <ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/technik/fahrzeuge/ausserdienst">Fahrzeuge a.D.</a></li>
                        
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/8">
                            KdoW - Kommandowagen                            </a></li>  
                        
     
                        	<li><a href="http://feuerwehr-bs.de/technik/fahrzeug/5">
                            TLF 24/50 - Tanklöschfahrzeug                            </a></li>  
                    	</ul>  
                    </div>  
                </li>  
                 
                <li><a href="http://feuerwehr-bs.de/informationen">Infos</a>  
                    <div class="dropdown">  
                    	<ul>
                         
                        	<li class="headline"><a href="http://feuerwehr-bs.de/informationen/buergerinformationen">B&uuml;rgerinfos</a></li>
  
                            	<li><a href="http://feuerwehr-bs.de/informationen/buergerinformationen/blaulicht">Blaulicht und Martinshorn</a></li>
      
                                <li><a href="http://feuerwehr-bs.de/informationen/buergerinformationen/nachdembrand">Nach dem Brand</a></li>
                                <li><a class="fancybox-metaLayer" href="#notruflayer_js" >Notruf richtig absetzen</a></li>
      
                                <li><a href="http://feuerwehr-bs.de/informationen/buergerinformationen/rauchmelder">Rauchwarnmelder</a></li>
      
                                <li><a href="http://feuerwehr-bs.de/informationen/buergerinformationen/hausnummern">Sichtbare Hausnummern</a></li>
                    	</ul>  
                        <ul>
  
                        	<li class="headline"><a href="http://feuerwehr-bs.de/informationen/einsatzgebiet">Einsatzgebiet</a></li>
                            <li><a href="http://feuerwehr-bs.de/informationen/einsatzgebiet#anker_allgemein">Allgemein</a></li>
                            <li><a href="http://feuerwehr-bs.de/informationen/einsatzgebiet#anker_schwerpunkte">Schwerpunkte</a></li>
                        </ul>
                        <ul>
  
                        	<li class="headline"><a href="http://feuerwehr-bs.de/informationen/aufgaben">Aufgaben & Gesetze</a></li>
                            <li><a href="http://feuerwehr-bs.de/informationen/aufgaben#anker_aufgaben">Aufgaben</a></li>
                            <li><a href="http://feuerwehr-bs.de/informationen/aufgaben#anker_gesetze">Gesetze</a></li>                            
                        </ul>
                        <ul>
  
                        	<li class="headline"><a href="http://feuerwehr-bs.de/informationen/aao">Alarm- und Ausrückeordnung</a></li>
                            <li><a href="http://feuerwehr-bs.de/informationen/aao#anker_oertlich">Örtlich</a></li>
                            <li><a href="http://feuerwehr-bs.de/informationen/aao#anker_uoertlich">Überörtlich</a></li>                        
                        </ul>
                    </div>  
                </li>
  
                <li><a href="http://feuerwehr-bs.de/verein" class="active">Verein</a>  
                </li> 
                <li><a href="#" class="desktopsearch">&nbsp;</a>
                    <div class="dropdown">
                        <form action="http://feuerwehr-bs.de/search" method="post" accept-charset="utf8" id="search" name="search"><div style="display:none">
<input type="hidden" name="csrf_f5g5h7z5b4f3f6g4_t" value="3cd435411c7fcf811b18f80f98a4e2a4" />
</div>                        <div class="search">	
                            <input type="text" name="search_query" value="" id="search_query" class="searchtext"  />                        </div>
                        <input type="submit" value="Suchen &raquo;" class="searchbutton" />
                        </form>
                    </div>
                </li>
            </ul>
       	</nav>
        
        <div id="mobileHeader">
           	<a href="#"><img src="http://feuerwehr-bs.de/images/layout/nav_mobileButton.png" width="18" height="18" id="mobileNavButton" /></a>
        </div>
    </div>
</header>

<div id="mobileNavigation">    
   <ul class="mobileMainNavContainer">
      <li><a href="http://feuerwehr-bs.de/aktuelles">News</a></li>
      <li class="subnavi">    
          <ul> 
              <li><a href="http://feuerwehr-bs.de/aktuelles/news">News</a></li>
              <li><a href="http://feuerwehr-bs.de/aktuelles/einsaetze">Einsätze</a></li>
              <li><a href="http://feuerwehr-bs.de/aktuelles/termine">Termine</a></li>
              <li><a href="http://feuerwehr-bs.de/aktuelles/presse">Presse</a></li>
            </ul>
      </li>
      <li><a href="http://feuerwehr-bs.de/menschen">Menschen</a></li>
      <li class="subnavi">    
          <ul> 
              <li><a href="http://feuerwehr-bs.de/menschen/mannschaft">Mannschaft</a></li>
              <li><a href="http://feuerwehr-bs.de/menschen/rettungshunde">Rettungshunde</a></li>
              <li><a href="http://feuerwehr-bs.de/menschen/jugend">Jugendfeuerwehr</a></li>
              <li><a href="http://feuerwehr-bs.de/menschen/minifeuerwehr">Minifeuerwehr</a></li>
              <li><a href="http://feuerwehr-bs.de/menschen/leistungsgruppe">Leistungsgruppe</a></li>
          </ul>
      </li>
      <li><a href="http://feuerwehr-bs.de/technik">Technik</a></li>
      <li class="subnavi">    
          <ul>  
            <li><a href="http://feuerwehr-bs.de/technik/fahrzeuge" class="first">Fahrzeuge</a></li>
          </ul>
      </li>
      <li><a href="http://feuerwehr-bs.de/informationen">Infos</a></li>
      <li class="subnavi">    
          <ul>  
                <li><a href="http://feuerwehr-bs.de/informationen/buergerinformationen">Bürgerinfos</a></li>
                <li><a href="http://feuerwehr-bs.de/informationen/einsatzgebiet" class="active">Einsatzgebiet</a></li>
               	<li><a href="http://feuerwehr-bs.de/informationen/aufgaben" class="active">Aufgaben &amp; Gesetze</a></li>
               	<li><a href="http://feuerwehr-bs.de/informationen/aao" class="active">Alarm- und Ausrückeordnung</a></li>
          </ul>
      </li>
      <li><a href="http://feuerwehr-bs.de/verein">Verein</a></li>
      <li class="subnavi">    
          <ul>  
            <li><a href="http://feuerwehr-bs.de/verein" class="first">Verein</a></li>
          </ul>
      </li>
      <li class="metanav">
        <?=$metanavigation_mobile?>
      </li>
   </ul>
</div>