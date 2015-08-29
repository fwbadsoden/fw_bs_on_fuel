<?php
    $meta = array(
        array('name' => 'keywords', 'content' => fuel_var('metakeywords')),
        array('name' => 'description', 'content' => fuel_var('metadescription')),
        array('name' => 'page-topic', 'content' => fuel_var('metapagetopic')),
        array('name' => 'revisit-after', 'content' => "1 days"),
        array('name' => 'language', 'content' => "de"),
        array('name' => 'copyright', 'content' => "feuerwehr-bs.de"),
        array('name' => 'author', 'content' => "into[at]feuerwehr-bs.de"),
        array('name' => 'publisher', 'content' => fuel_var('pagetitle')),
        array('name' => 'audience', 'content' => "Alle"),
        array('name' => 'expires', 'content' => "never"),
        array('name' => 'page-type', 'content' => "Portal"),
        array('name' => 'robots', 'content' => "INDEX,FOLLOW"),
        array('name' => 'rating', 'content' => "General"),
        array('name' => 'Content-type', 'content' => "text/html; charset=utf-8", 'type' => 'equiv'),
        array('name' => 'viewport', 'content' => "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" ),
        array('name' => 'X-UA-Compatible', 'content' => "edge"),
        array('name' => 'imagetoolbar', 'content' => "no", 'type' => 'equiv')
    );
    
    // Open Graph Tags
    if(isset($facebook_infos)) {
        foreach($facebook_infos as $info) {
            array_push($meta, array('name' => $info["property"], 'content' => $info["content"], 'type' => 'property'));
        }
    }
    echo doctype('html5');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-de" lang="de-de">
<head>
    <?=meta($meta)?>
 	<title><?=fuel_var('pagetitle'); ?></title>
	
    <link rel="shortcut icon" href="<?=assets_path("favicon.ico", "icons")?>" type="image/x-icon" />

    <link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="<?=css_path("styles.css")?>" type="text/css" />
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    
    <!-- socialshareprivacy -->
    <script type="text/javascript" src="<?=js_path('socialshareprivacy/jquery.socialshareprivacy.min.js')?>"></script>
    <script type="text/javascript" src="<?=js_path('socialshareprivacy/socialshareprivacy.min.de.js')?>"></script>
    
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

<?php if(ENVIRONMENT == 'production') : ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44450948-1', 'feuerwehr-bs.de');
  ga('send', 'pageview');

</script>
<?php endif; ?>
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
                <?php if(strpos(current_url(), base_url('aktuelles')) !== false) : $class = ' class="active"'; else : $class = ''; endif; ?>                
                <li><a href="<?=base_url('aktuelles')?>"<?=$class?>>News</a>  
                   <div class="dropdown">  
                    	<ul>                       
                        	<li class="headline"><a href="<?=base_url('aktuelles/news')?>">News</a></li>
                            <?php foreach($main_navigation["news"] as $n) : 
                                  if(strlen($n->title) > 32) $n->title = substr($n->title,0,32).'...'; 
                            ?> 
                        	<li><a href="<?=base_url('aktuelles/news/'.$n->id)?>"><span class="subline"><?=get_ger_date($n->datum)?></span><br /><?=$n->title?></a></li>
                            <?php endforeach; ?>
                    	</ul>                    
                    	<ul>                   
                            <?php if(current_url() == base_url('aktuelles/einsaetze')) : $class = ' class="active"'; else : $class = ''; endif; ?>      
                        	<li class="headline"><a href="<?=base_url('aktuelles/einsaetze')?>"<?=$class?>>Einsätze</a></li> 
                            <?php foreach($main_navigation["missions"] as $m) : 
                                  if(strlen($m->name) > 32) $m->name = substr($m->name,0,32).'...';                                   
                            ?>   
                        	<li><a href="<?=base_url('aktuelles/einsaetze/'.$m->id)?>"><span class="subline"><?=get_ger_date($m->datum)?> / <?=$m->type->name?></span><br /><?=$m->name?></a></li>
                            <?php endforeach; ?>
                    	</ul>  
                    	<ul>                         
                            <?php if(current_url() == base_url('aktuelles/termine')) : $class = ' class="active"'; else : $class = ''; endif; ?> 
                        	<li class="headline"><a href="<?=base_url('aktuelles/termine')?>"<?=$class?>>Termine</a></li>  
                            <?php foreach($main_navigation["appointments"] as $a) : 
                                  if(strlen($a->name) > 32) $a->name = substr($a->name,0,32).'...'; 
                            ?>   
                        	<li><a><span class="subline"><?=get_ger_date($a->datum)?> / <?=$a->beginn?> Uhr</span><br /><?=$a->name?></a></li>
                            <?php endforeach; ?>
                    	</ul>  
                    	<ul>
                            <?php if(current_url() == base_url('aktuelles/presse')) : $class = ' class="active"'; else : $class = ''; endif; ?>  
                        	<li class="headline"><a href="<?=base_url('aktuelles/presse')?>">Presse</a></li>
                            <?php foreach($main_navigation["pressarticles"] as $p) : 
                                  if(strlen($p->name) > 32) $p->name = substr($p->name,0,32).'...'; 
                            ?>  
                            <?php if($p->online_article == '') : ?>                      
                	        <li><a href="<?=assets_path($p->asset, 'pressarticles')?>" class="fancybox-gallery" rel="gallery_presse_menue"><span class="subline"><?=$p->datum?> / <?=$p->source->name?></span><br /><?=$p->name?></a></li>
                            <?php else : ?>
                            <li><a href="<?=$p->online_article?>" target="_blank"><span class="subline"><?=get_ger_date($p->datum)?> / <?=$p->source->name?></span><br /><?=$p->name?></a></li>
                            <?php endif; ?>        
                            <?php endforeach; ?>                   
                       	</ul>  
                   </div>  
                </li>  
                 
                <?php if(strpos(current_url(), base_url('menschen')) !== false) : $class = ' class="active"'; else : $class = ''; endif; ?>  
                <li><a href="<?=base_url('menschen')?>"<?=$class?>>Menschen</a>  
                    <div class="dropdown">  
                    	<ul>            
                            <li class="headline"><a href="<?=base_url('menschen/mannschaft')?>">Mannschaft</a></li>
                        	<li><a href="<?=base_url('menschen/mannschaft#anker_fuehrung')?>">Führung</a></li>
                            <li><a href="<?=base_url('menschen/mannschaft#anker_mannschaft')?>">Mannschaft</a></li>
                    	</ul>  
                    	<ul>                      
                        	<li class="headline"><a href="<?=base_url('menschen/altersundehrenabteilung')?>">Alters &amp; Ehrenabt.</a></li>                        
                            <li><a href="<?=base_url('menschen/altersundehrenabteilung')?>">Alters &amp; Ehrenabteilung</a></li>
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
                 
                <?php if(strpos(current_url(), base_url('technik')) !== false) : $class = ' class="active"'; else : $class = ''; endif; ?>                    
                <li><a href="<?=base_url('technik')?>"<?=$class?>>Technik</a> 
                    <div class="dropdown">  
                    	<ul>                         
                            <li class="headline"><a href="<?=base_url('technik/fahrzeuge')?>">Fahrzeuge</a></li>
                            <?php $counter = 0;
                                  $anz_fahrzeuge = 0;
                                  foreach($main_navigation["fahrzeuge"] as $f) : 
                                    if($f->retired == 'no') $anz_fahrzeuge++;
                                  endforeach;
                                  $break = $anz_fahrzeuge / 2;
                                  $break = ceil($break);
                                  
                                  foreach($main_navigation["fahrzeuge"] as $f) : 
                                    if($f->retired == 'no') : 
                                        if($counter == $break) :
                                            $counter = 0;        
                            ?>     
                        </ul>
                        <ul>                                  
                        	<li class="headline"><a href="<?=base_url('technik/fahrzeuge')?>">&nbsp;</a></li>       
                            <?php       endif;  ?>               
                            <li><a href="<?=base_url('technik/fahrzeuge/'.$f->id)?>">
                            <?php if($f->name_lang != '') : echo $f->name.' - '.$f->name_lang; else : echo $f->name; endif; ?>
                            </a></li>  
                            <?php       $counter++;
                                    endif;
                                  endforeach; 
                            ?>   
                    	</ul>  
   	                    <ul>
                            <li class="headline"><a href="<?=base_url('technik/fahrzeuge/ausserdienst')?>">Fahrzeuge a.D.</a></li>
                            <?php  if($main_navigation["fahrzeuge_hasretired"]) : 
                                    foreach($main_navigation["fahrzeuge"] as $f) : 
                                        if($f->retired == 'yes') :
                            ?>                        
                            <li><a href="<?=base_url('technik/fahrzeuge/'.$f->id)?>">
                            <?php if($f->name_lang != '') : echo $f->name.' - '.$f->name_lang; else : echo $f->name; endif; ?>
                            </a></li>  
                            <?php       endif;
                                    endforeach; 
                                   endif; 
                            ?>           
                    	</ul>  
                    	<ul>                     
                        	<li class="headline"><a>Spezialeinheiten</a></li>
                        	<li><a href="<?=base_url('technik/rettungshunde')?>">Rettungshunde-Ortungstechnik</a></li>
                            <li><a href="<?=base_url('menschen/gabc')?>">Gefahrstoffzug</a></li>
                    	</ul>  
                    </div>  
                </li>  
                 
                <?php if(current_url() == base_url('informationen')) : $class = ' class="active"'; else : $class = ''; endif; ?> 
                <li><a href="<?=base_url('informationen')?>"<?=$class?>>Infos</a>  
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
                <?php if(current_url() == base_url('verein')) : $class = ' class="active"'; else : $class = ''; endif; ?> 
                <li><a href="<?=base_url('verein')?>"<?=$class?>>Verein</a>  
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

<section id="stage">
<?php foreach($stage->stage_images as $key => $image) {   
    
        if(strtolower($image->text_1) == "dummy") {
            if(isset($stage_text["name"]))          $text1 = $stage_text["name"];       else $text1 = "";
            if(isset($stage_text["name_lang"]))     $text2 = $stage_text["name_lang"];  else $text2 = "";
            if(isset($stage_text["text_stage"]))    $text3 = $stage_text["text_stage"]; else $text3 = "";
            if(isset($stage_text["class"]))         $stage_type = "einsatz";            else $stage_type = 'default';
        } else {
            $text1 = $image->text_1;
            $text2 = $image->text_2;
            $text3 = "";
            $stage_type = 'default';
        }
      
        switch($image->stage_image_type_id) {
            case 1: $css_inner_class = "stageContentHeadlineTop half_blackBG smallstage"; break;
            case 2: $css_inner_class = "stageQuoteLeft"; break; 
            case 3: $css_inner_class = "stageQuoteRight"; break;
            case 4: $css_inner_class = "stageContentCar"; break;
            case 5: $css_inner_class = "stageContentHeadline blackBG"; break;
        }   
?>
    
    <div class="<?=$stage->type->css_outer_class?>" id="pictures_<?=$key?>" style="background-image: url(<?=img_path("bildbuehnen/".$image->image)?>); display: none;">
        <div id="stagewrapper">    
            <div class="<?=$css_inner_class?>">            
<?php   if($stage_type == 'default') : ?>   
                <?php if($text1 != "") : ?> <h1<?=$image->get_css_text_class_1()?>><?=$text1?></h1> <?php endif; ?>
                <?php if($text2 != "") : ?> <h2<?=$image->get_css_text_class_2()?>><?=$text2?></h2> <?php endif; ?>  
                <?php if($text3 != "") : ?> <p><?=$text3?></p> <? endif; ?>       
<?php   else : ?>
                <figure><img src="<?=assets_path('icons/'.$stage_text["class"].'.png')?>" /></figure>
                <h1><?=$text1?></h1>
                <h2><?=$text2?></h2>  
<?php   endif; ?>      
            </div>
        </div>
    </div>
    
<?php  } ?> 
      
</section>

<section id="content">
    <div class="<?=$stage->type->css_slidewrapper_class?>">
<? if($stage->img_count > 1) : ?>
        <div id="slider">
            <ul>
<?  foreach($stage->stage_images as $key => $item) :
        if($key == 0) $class = ' first'; else $class = ''; ?>             
                <li><a href="#<?=$key?>" class="changeStage<?=$class?>" id="slide-link-<?=$key?>"><?=$key+1?></a></li>
<?  endforeach; ?>                
            </ul>
    	</div> 
<?  endif; ?>