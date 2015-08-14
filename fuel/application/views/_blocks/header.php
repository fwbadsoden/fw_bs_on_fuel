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

    <!-- variables for javascript templates -->    
    <script type="text/javascript">
        var iconPath = "<?=assets_path("icons")?>/";
    </script>
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
             
                <li><a href="<?=base_url('aktuelles')?>">News</a>  
                   <div class="dropdown">  
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('aktuelles/news')?>">News</a></li>
  
              
                
                        	<li><a href="<?=base_url('aktuelles/news/24')?>"><span class="subline">17.03.2015</span><br />Nachwuchs für die Einsatzabteil...</a></li>
  
                
                    	</ul>                    
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('aktuelles/einsaetze')?>">Einsätze</a></li>
 
             
                
                        	<li><a href="<?=base_url('aktuelles/einsatz/2751')?>"><span class="subline">04.04.2015 / Hilfeleistungseinsatz</span><br />Ölspur</a></li>
 
                 
                    	</ul>  
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('aktuelles/termine')?>">Termine</a></li>
                           
         
                        	<li><a><span class="subline">09.04.2015 / 19:30:00 Uhr</span><br />Zusatzdienst</a></li>
  
                    	</ul>  
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('aktuelles/presse')?>">Presse</a></li>
    
                        
                	       <li><a href="<?=base_url('files/content/FNP_2015-03-30_Der neue Kreisbrandmeister.jpg')?>" class="fancybox-gallery" rel="gallery_presse_menue"><span class="subline">30.03.2015 / Frankfurter Neue Presse</span><br />Der neue Kreisbrandmeister</a></li>
    
                           
                       	</ul>  
                   </div>  
                </li>  
                 
                <li><a href="<?=base_url('menschen/mannschaft')?>">Menschen</a>  
                    <div class="dropdown">  
                    	<ul>                      
                        	<li class="headline"><a href="<?=base_url('menschen/mannschaft')?>">Mannschaft</a></li>
                        	<li><a href="<?=base_url('menschen/mannschaft#anker_fuehrung')?>">Führung</a></li>
                            <li><a href="<?=base_url('menschen/mannschaft#anker_mannschaft')?>">Mannschaft</a></li>
                    	</ul>  
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('menschen/rettungshunde')?>">Rettungshunde</a></li>
                        	<li><a href="<?=base_url('menschen/rettungshunde#anker_einleitung')?>">Einleitung</a></li>
                            <li><a href="<?=base_url('menschen/rettungshunde#anker_ausbildung')?>">Ablauf der Ausbildung</a></li>
                    	</ul> 
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('menschen/jugend')?>">Nachwuchs</a></li>
                             
                        	<li><a href="<?=base_url('menschen/jugend')?>">Jugendfeuerwehr</a></li>
                             
                            <li><a href="<?=base_url('menschen/minifeuerwehr')?>">Minifeuerwehr</a></li>
                    	</ul>   
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('menschen/leistungsgruppe')?>">Leistungsgruppe</a></li>
                        	<li><a href="<?=base_url('menschen/leistungsgruppe#anker_theorie')?>">Theorie</a></li>
                            <li><a href="<?=base_url('menschen/leistungsgruppe#anker_praxis"')?>>Praxis</a></li>
                    	</ul>  
                    </div>  
				</li>  
                 
<? if(strpos(current_url(), base_url('technik')) !== false) : $class = ' class="active"'; else : $class = ''; endif; ?>                    
                <li><a href="<?=base_url('technik')?>"<?=$class?>>Technik</a> 
                    <div class="dropdown">  
                    	<ul>
                         
<? if(current_url() == base_url('technik/fahrzeuge')) : $class = ' class="active"'; else : $class = ''; endif; ?>                         
                        	<li class="headline"><a href="<?=base_url('technik/fahrzeuge')?>"<?=$class?>>Fahrzeuge</a></li>
<?  $counter = 0;
    foreach($main_navigation["fahrzeuge"] as $f) : 
        if($f->retired == 'no') : 
            if($counter == 9) :
                $counter = 0;        
?>     
                        </ul><ul>                                  
                        	<li class="headline"><a href="<?=base_url('technik/fahrzeuge')?>"<?=$class?>>&nbsp;</a></li>       
<?          endif;  ?>               
<? if(current_url() == base_url('technik/fahrzeug/'.$f->id)) : $class = ' class="active"'; else : $class = ''; endif; ?>     
                        	<li><a href="<?=base_url('technik/fahrzeuge/'.$f->id)?>"<?=$class?>>
                            <? if($f->name_lang != '') : echo $f->name.' - '.$f->name_lang; else : echo $f->name; endif; ?>
                            </a></li>  
<?          $counter++;
        endif;
    endforeach; 
?>   
                    	</ul>  
   	                    <ul>
<? if(current_url() == base_url('technik/fahrzeuge/ausserdienst')) : $class = ' class="active"'; else : $class = ''; endif; ?>                         
                        	<li class="headline"><a href="<?=base_url('technik/fahrzeuge/ausserdienst')?>"<?=$class?>>Fahrzeuge a.D.</a></li>
<?  if($main_navigation["fahrzeuge_hasretired"]) : 
        foreach($main_navigation["fahrzeuge"] as $f) : 
            if($f->retired == 'yes') :
?>                        
<? if(current_url() == base_url('technik/fahrzeug/'.$f->id)) : $class = ' class="active"'; else : $class = ''; endif; ?>     
                        	<li><a href="<?=base_url('technik/fahrzeuge/'.$f->id)?>"<?=$class?>>
                            <? if($f->name_lang != '') : echo $f->name.' - '.$f->name_lang; else : echo $f->name; endif; ?>
                            </a></li>  
<?          endif;
        endforeach; 
    endif; 
?>           
                    	</ul>  
                    </div>  
                </li>  
                 
                <li><a href="<?=base_url('informationen/buergerinformationen')?>">Infos</a>  
                    <div class="dropdown">  
                    	<ul>
                         
                        	<li class="headline"><a href="<?=base_url('informationen/buergerinformationen')?>">B&uuml;rgerinfos</a></li>
  
                            	<li><a href="<?=base_url('informationen/buergerinformationen/blaulicht')?>">Blaulicht und Martinshorn</a></li>
      
                                <li><a href="<?=base_url('informationen/buergerinformationen/nachdembrand')?>">Nach dem Brand</a></li>
                                <li><a class="fancybox-metaLayer" href="#notruflayer_js" >Notruf richtig absetzen</a></li>
      
                                <li><a href="<?=base_url('informationen/buergerinformationen/rauchmelder')?>">Rauchwarnmelder</a></li>
      
                                <li><a href="<?=base_url('informationen/buergerinformationen/hausnummern')?>">Sichtbare Hausnummern</a></li>
                    	</ul>  
                        <ul>
  
                        	<li class="headline"><a href="<?=base_url('informationen/einsatzgebiet')?>">Einsatzgebiet</a></li>
                            <li><a href="<?=base_url('informationen/einsatzgebiet#anker_allgemein')?>">Allgemein</a></li>
                            <li><a href="<?=base_url('informationen/einsatzgebiet#anker_schwerpunkte')?>">Schwerpunkte</a></li>
                        </ul>
                        <ul>
  
                        	<li class="headline"><a href="<?=base_url('informationen/aufgaben')?>">Aufgaben &amp; Gesetze</a></li>
                            <li><a href="<?=base_url('informationen/aufgaben#anker_aufgaben')?>">Aufgaben</a></li>
                            <li><a href="<?=base_url('informationen/aufgaben#anker_gesetze')?>">Gesetze</a></li>                            
                        </ul>
                        <ul>
  
                        	<li class="headline"><a href="<?=base_url('informationen/aao')?>">Alarm- und Ausrückeordnung</a></li>
                            <li><a href="<?=base_url('informationen/aao#anker_oertlich')?>">Örtlich</a></li>
                            <li><a href="<?=base_url('informationen/aao#anker_uoertlich')?>">Überörtlich</a></li>                        
                        </ul>
                    </div>  
                </li>
  
                <li><a href="<?=base_url('verein')?>">Verein</a>  
                </li> 
                <li><a href="#" class="desktopsearch">&nbsp;</a>
                    <div class="dropdown">
                        <form action="<?=base_url('search')?>" method="post" accept-charset="utf8" id="search" name="search"><div style="display:none">
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
      <li><a href="<?=base_url('aktuelles')?>">News</a></li>
      <li class="subnavi">    
          <ul> 
              <li><a href="<?=base_url('aktuelles/news')?>">News</a></li>
              <li><a href="<?=base_url('aktuelles/einsaetze')?>">Einsätze</a></li>
              <li><a href="<?=base_url('aktuelles/termine')?>">Termine</a></li>
              <li><a href="<?=base_url('aktuelles/presse')?>">Presse</a></li>
            </ul>
      </li>
      <li><a href="<?=base_url('menschen')?>">Menschen</a></li>
      <li class="subnavi">    
          <ul> 
              <li><a href="<?=base_url('menschen/mannschaft')?>">Mannschaft</a></li>
              <li><a href="<?=base_url('menschen/rettungshunde')?>">Rettungshunde</a></li>
              <li><a href="<?=base_url('menschen/jugend')?>">Jugendfeuerwehr</a></li>
              <li><a href="<?=base_url('menschen/minifeuerwehr')?>">Minifeuerwehr</a></li>
              <li><a href="<?=base_url('menschen/leistungsgruppe')?>">Leistungsgruppe</a></li>
          </ul>
      </li>
      <li><a href="<?=base_url('technik')?>">Technik</a></li>
      <li class="subnavi">    
          <ul>  
            <li><a href="<?=base_url('technik/fahrzeuge')?>" class="first">Fahrzeuge</a></li>
          </ul>
      </li>
      <li><a href="<?=base_url('informationen/buergerinformationen')?>">Infos</a></li>
      <li class="subnavi">    
          <ul>  
                <li><a href="<?=base_url('informationen/buergerinformationen')?>">Bürgerinfos</a></li>
                <li><a href="<?=base_url('informationen/einsatzgebiet')?>" class="active">Einsatzgebiet</a></li>
               	<li><a href="<?=base_url('informationen/aufgaben')?>" class="active">Aufgaben &amp; Gesetze</a></li>
               	<li><a href="<?=base_url('informationen/aao')?>" class="active">Alarm- und Ausrückeordnung</a></li>
          </ul>
      </li>
      <li><a href="<?=base_url('verein')?>">Verein</a></li>
      <li class="subnavi">    
          <ul>  
            <li><a href="<?=base_url('verein')?>" class="first">Verein</a></li>
          </ul>
      </li>
      <li class="metanav">
        <?=$metanavigation_mobile?>
      </li>
   </ul>
</div>