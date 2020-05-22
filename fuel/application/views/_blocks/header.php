<?php
$meta = array(
array('name' => 'keywords', 'content' => fuel_var('metakeywords')),
 array('name' => 'description', 'content' => fuel_var('metadescription')),
 array('name' => 'page-topic', 'content' => fuel_var('metapagetopic')),
 array('name' => 'revisit-after', 'content' => "1 days"),
 array('name' => 'language', 'content' => "de"),
 array('name' => 'copyright', 'content' => "feuerwehr-bs.de"),
 array('name' => 'author', 'content' => "info[at]feuerwehr-bs.de"),
 array('name' => 'publisher', 'content' => fuel_var('pagetitle')),
 array('name' => 'audience', 'content' => "Alle"),
 array('name' => 'expires', 'content' => "never"),
 array('name' => 'page-type', 'content' => "Portal"),
 array('name' => 'robots', 'content' => "INDEX,FOLLOW"),
 array('name' => 'rating', 'content' => "General"),
 array('name' => 'Content-type', 'content' => "text/html; charset=utf-8", 'type' => 'equiv'),
 array('name' => 'viewport', 'content' => "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"),
 array('name' => 'X-UA-Compatible', 'content' => "edge"),
 array('name' => 'imagetoolbar', 'content' => "no", 'type' => 'equiv')
);

$year_optout_cookie = date("Y") + 90;

// Open Graph Tags
if (isset($facebook_infos)) {
foreach ($facebook_infos as $info) {
array_push($meta, array('name' => $info["property"], 'content' => $info["content"], 'type' => 'property'));
}
}
echo doctype('html5');
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de-de" lang="de-de">
    <head>
        <?= meta($meta) ?>
        <title><?= fuel_var('pagetitle'); ?></title>

        <link rel="shortcut icon" href="<?= assets_path("favicon.ico", "icons") ?>" type="image/x-icon" />

        <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" href="<?= css_path("styles.css") ?>" type="text/css" />
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

        <!-- variables for javascript templates -->    
        <script type="text/javascript">
            var iconPath = "<?= assets_path("icons") ?>/";
        </script>
    </head>
    <body>

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.5&appId=1389865491270726";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>    

        <script type="text/javascript">
            var gaProperty = 'UA-44450948-1';
            var disableStr = 'ga-disable-' + gaProperty;
            if (document.cookie.indexOf(disableStr + '=true') > -1) {
                window[disableStr] = true;
            }
            function gaOptout() {
                document.cookie = disableStr + '=true; expires=Thu, 31 Dec <?= $year_optout_cookie ?> 23:59:59 UTC;
                        path = /';
                window[disableStr] = true;
            }
        </script>

        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-44450948-1', 'feuerwehr-bs.de');
            ga('send', 'pageview');

        </script>
        <?php if (ENVIRONMENT == 'production') : ?>

        <?php endif; ?>
        <header>
            <div class="site" id="top">
                <h1>
                    <a href="<?= base_url() ?>" title="Home"><?= fuel_var('pagetitle'); ?></a>
                </h1>
                <nav>    
                    <div id="metanavigation"> 
                        <ul>
                            <li class="first mitmachen"><a href="<?= base_url('mitmachen') ?>">Mitmachen</a></li>
                            <li><a href="<?= base_url('fuel') ?>" target="_blank">Login</a></li>
                            <li><a href="https://portal-fwbs.de/" target="_blank">Infoportal</a></li>
                            <li><a href="<?= base_url('kontakt') ?>">Kontakt</a></li>
                            <li><a href="<?= base_url('links') ?>">Links</a></li>
                            <li><a href="#notruflayer_js" class="fancybox-metaLayer">Notfall</a></li>
                        </ul>
                    </div>
                    <ul id="menu">  
                        <?php
                        if (strpos(current_url(), base_url('aktuelles')) !== false && strpos(current_url(), base_url('menschen/jugend/jubilaeum')) === false) : $class = ' class="active"';
                        else : $class = '';
                        endif;
                        ?>                
                        <li><a href="<?= base_url('aktuelles') ?>"<?= $class ?>>News</a>  
                            <div class="dropdown">  
                                <ul>                       
                                    <li class="headline"><a href="<?= base_url('aktuelles/news') ?>">News</a></li>
                                    <?php
                                    foreach ($main_navigation["news"] as $n) :
                                    if (strlen($n->title) > 32)
                                    $n->title = substr($n->title, 0, 32) . '...';
                                    ?> 
                                    <li><a href="<?= base_url('aktuelles/news/' . $n->id) ?>"><span class="subline"><?= get_ger_date($n->datum) ?></span><br /><?= $n->title ?></a></li>
                                    <?php endforeach; ?>
                                </ul>                    
                                <ul>                   
                                    <?php
                                    if (current_url() == base_url('aktuelles/einsaetze')) : $class = ' class="active"';
                                    else : $class = '';
                                    endif;
                                    ?>      
                                    <li class="headline"><a href="<?= base_url('aktuelles/einsaetze') ?>"<?= $class ?>>Einsätze</a></li> 
                                    <?php
                                    foreach ($main_navigation["missions"] as $m) :
                                    if (strlen($m->name) > 32)
                                    $m->name = substr($m->name, 0, 32) . '...';
                                    ?>   
                                    <li><a href="<?= base_url('aktuelles/einsaetze/' . $m->id) ?>"><span class="subline"><?= get_ger_date($m->datum_beginn) ?> / <?= $m->type->name ?></span><br /><?= $m->name ?></a></li>
                                    <?php endforeach; ?>
                                </ul>  
                                <ul>                         
                                    <?php
                                    if (current_url() == base_url('aktuelles/termine')) : $class = ' class="active"';
                                    else : $class = '';
                                    endif;
                                    ?> 
                                    <li class="headline"><a href="<?= base_url('aktuelles/termine') ?>"<?= $class ?>>Termine</a></li>  
                                    <?php
                                    foreach ($main_navigation["appointments"] as $a) :
                                    if (strlen($a->name) > 32)
                                    $a->name = substr($a->name, 0, 32) . '...';
                                    ?>   
                                    <li><a><span class="subline"><?= get_ger_date($a->datum) ?> / <?= $a->beginn ?> Uhr</span><br /><?= $a->name ?></a></li>
                                    <?php endforeach; ?>
                                </ul>  
                                <ul>
                                    <?php
                                    if (current_url() == base_url('aktuelles/presse')) : $class = ' class="active"';
                                    else : $class = '';
                                    endif;
                                    ?>  
                                    <li class="headline"><a href="<?= base_url('aktuelles/presse') ?>">Presse</a></li>
                                    <?php
                                    foreach ($main_navigation["pressarticles"] as $p) :
                                    if (strlen($p->name) > 32)
                                    $p->name = substr($p->name, 0, 32) . '...';
                                    ?>  
                                    <?php if ($p->online_article == '') : ?>                      
                                    <li><a href="<?= assets_path($p->asset, 'pressarticles') ?>" class="fancybox-gallery" rel="gallery_presse_menue"><span class="subline"><?= get_ger_date($p->datum) ?> / <?= $p->source->name ?></span><br /><?= $p->name ?></a></li>
                                    <?php else : ?>
                                    <li><a href="<?= $p->online_article ?>" target="_blank"><span class="subline"><?= get_ger_date($p->datum) ?> / <?= $p->source->name ?></span><br /><?= $p->name ?></a></li>
                                    <?php endif; ?>        
                                    <?php endforeach; ?>                   
                                </ul>  
                            </div>  
                        </li>  

                        <?php
                        if (strpos(current_url(), base_url('menschen')) !== false) : $class = ' class="active"';
                        else : $class = '';
                        endif;
                        ?>  
                        <li><a href="<?= base_url('menschen') ?>"<?= $class ?>>Menschen</a>  
                            <div class="dropdown">  
                                <ul>            
                                    <li class="headline"><a href="<?= base_url('menschen/mannschaft') ?>">Mannschaft</a></li>
                                    <li><a href="<?= base_url('menschen/mannschaft#anker_fuehrung') ?>">Führung</a></li>
                                    <li><a href="<?= base_url('menschen/mannschaft#anker_mannschaft') ?>">Mannschaft</a></li>
                                </ul>  
                                <ul>                      
                                    <li class="headline"><a href="<?= base_url('menschen/altersundehrenabteilung') ?>">Alters &amp; Ehrenabt.</a></li>                        
                                    <li><a href="<?= base_url('menschen/altersundehrenabteilung#anker_a') ?>">Altersabteilung</a></li>                      
                                    <li><a href="<?= base_url('menschen/altersundehrenabteilung#anker_e') ?>">Ehrenabteilung</a></li>
                                </ul> 
                                <ul>
                                    <li class="headline"><a href="<?= base_url('menschen/jugend') ?>">Nachwuchs</a></li>                             
                                    <li><a href="<?= base_url('menschen/jugend') ?>">Jugendfeuerwehr</a></li>
                                    <li><a href="<?= base_url('menschen/minifeuerwehr') ?>">Minifeuerwehr</a></li>
                                </ul>   
                                <ul>
                                    <li class="headline"><a href="<?= base_url('menschen/leistungsgruppe') ?>">Leistungsgruppe</a></li>
                                    <li><a href="<?= base_url('menschen/leistungsgruppe#anker_theorie') ?>">Theorie</a></li>
                                    <li><a href="<?= base_url('menschen/leistungsgruppe#anker_praxis"') ?>>Praxis</a></li>
                                           </ul>  
                                           </div>  
                                           </li>  

                                           <?php
                                           if (strpos(current_url(), base_url('technik')) !== false) : $class = ' class="active"';
                                           else : $class = '';
                                           endif;
                                           ?>                    
                                           <li><a href="<?= base_url('technik') ?>"<?= $class ?>>Technik</a> 
                                        <div class="dropdown">  
                                            <ul>                         
                                                <li class="headline"><a href="<?= base_url('technik/fahrzeuge') ?>">Fahrzeuge</a></li>
                                                <?php
                                                $counter = 0;
                                                $anz_fahrzeuge = 0;
                                                foreach ($main_navigation["fahrzeuge"] as $f) :
                                                if ($f->retired == 'no')
                                                $anz_fahrzeuge++;
                                                endforeach;
                                                $break = $anz_fahrzeuge / 2;
                                                $break = ceil($break);

                                                foreach ($main_navigation["fahrzeuge"] as $f) :
                                                if ($f->retired == 'no') :
                                                if ($counter == $break) :
                                                $counter = 0;
                                                ?>     
                                            </ul>
                                            <ul>                                  
                                                <li class="headline"><a href="<?= base_url('technik/fahrzeuge') ?>">&nbsp;</a></li>       
                                                <?php endif; ?>               
                                                <li><a href="<?= base_url('technik/fahrzeuge/' . $f->id) ?>">
                                                        <?php
                                                        if ($f->name_lang != '') : echo $f->name . ' - ' . $f->name_lang;
                                                        else : echo $f->name;
                                                        endif;
                                                        ?>
                                                    </a></li>  
                                                <?php
                                                $counter++;
                                                endif;
                                                endforeach;
                                                ?>   
                                            </ul>  
                                            <ul>
                                                <li class="headline"><a href="<?= base_url('technik/fahrzeuge/ausserdienst') ?>">Fahrzeuge a.D.</a></li>
                                                <?php
                                                if ($main_navigation["fahrzeuge_hasretired"]) :
                                                foreach ($main_navigation["fahrzeuge"] as $f) :
                                                if ($f->retired == 'yes') :
                                                ?>                        
                                                <li><a href="<?= base_url('technik/fahrzeuge/ausserdienst/' . $f->id) ?>">
                                                        <?php
                                                        if ($f->name_lang != '') : echo $f->name . ' - ' . $f->name_lang;
                                                        else : echo $f->name;
                                                        endif;
                                                        ?>
                                                    </a></li>  
                                                <?php
                                                endif;
                                                endforeach;
                                                endif;
                                                ?>           
                                            </ul>  
                                            <ul>                     
                                                <li class="headline"><a>Spezialeinheiten</a></li>
                                                <li><a href="<?= base_url('technik/rettungshunde') ?>">Rettungshundeeinheit</a></li>
                                                <li><a href="<?= base_url('technik/gefahrstoffkomponente') ?>">Gefahrstoffeinheit</a></li>
                                            </ul>  
                                        </div>  
                                    </li>  

                                    <?php
                                    if (current_url() == base_url('informationen')) : $class = ' class="active"';
                                    else : $class = '';
                                    endif;
                                    ?> 
                                    <li><a href="<?= base_url('informationen') ?>"<?= $class ?>>Infos</a>  
                                        <div class="dropdown">  
                                            <ul>
                                                <li class="headline"><a href="<?= base_url('informationen/buergerinformationen') ?>">B&uuml;rgerinfos</a></li>
                                                <li><a href="<?= base_url('informationen/buergerinformationen/blaulicht') ?>">Blaulicht und Martinshorn</a></li>
                                                <li><a href="<?= base_url('informationen/buergerinformationen/nachdembrand') ?>">Nach dem Brand</a></li>
                                                <li><a class="fancybox-metaLayer" href="#notruflayer_js" >Notruf richtig absetzen</a></li>
                                                <li><a href="<?= base_url('informationen/buergerinformationen/rauchmelder') ?>">Rauchwarnmelder</a></li>
                                                <li><a href="<?= base_url('informationen/buergerinformationen/hausnummern') ?>">Sichtbare Hausnummern</a></li>
                                                <li><a href="<?= base_url('informationen/buergerinformationen/sirenen') ?>">Sireneninformationen</a></li>
                                            </ul>  
                                            <ul>
                                                <li class="headline"><a href="<?= base_url('informationen/einsatzgebiet') ?>">Einsatzgebiet</a></li>
                                                <li><a href="<?= base_url('informationen/einsatzgebiet#anker_allgemein') ?>">Allgemein</a></li>
                                                <li><a href="<?= base_url('informationen/einsatzgebiet#anker_schwerpunkte') ?>">Schwerpunkte</a></li>
                                            </ul>
                                            <ul>
                                                <li class="headline"><a href="<?= base_url('informationen/aufgaben') ?>">Aufgaben &amp; Gesetze</a></li>
                                                <li><a href="<?= base_url('informationen/aufgaben#anker_aufgaben') ?>">Aufgaben</a></li>
                                                <li><a href="<?= base_url('informationen/aufgaben#anker_gesetze') ?>">Gesetze</a></li>                            
                                            </ul>
                                            <ul>
                                                <li class="headline"><a href="<?= base_url('informationen/aao') ?>">Alarm- und Ausrückeordnung</a></li>
                                                <li class="headline"><a href="<?= base_url('informationen/feuerwache') ?>">Unsere Wache</a></li>            
                                            </ul>
                                        </div>  
                                    </li>
                                    <?php
                                    if (current_url() == base_url('verein')) : $class = ' class="active"';
                                    else : $class = '';
                                    endif;
                                    ?> 
                                    <li><a href="<?= base_url('verein') ?>"<?= $class ?>>Verein</a>  
                                    </li> 
                                </ul>
                                </nav>

                                <div id="mobileHeader">
                                    <a href="#"><img src="<?= assets_path("layout/nav_mobileButton.png") ?>" width="18" height="18" id="mobileNavButton" /></a>
                                </div>
                            </div>
                            </header>

                            <div id="mobileNavigation">    
                                <ul class="mobileMainNavContainer">
                                    <li><a href="<?= base_url('menschen/jugend/jubilaeum') ?>">Jubiläum</a></li>
                                    <li><a href="<?= base_url('mitmachen') ?>">Mitmachen</a></li>
                                    <li><a href="<?= base_url('aktuelles') ?>">News</a></li>
                                    <li class="subnavi">    
                                        <ul> 
                                            <li><a href="<?= base_url('aktuelles/news') ?>">News</a></li>
                                            <li><a href="<?= base_url('aktuelles/einsaetze') ?>">Einsätze</a></li>
                                            <li><a href="<?= base_url('aktuelles/termine') ?>">Termine</a></li>
                                            <li><a href="<?= base_url('aktuelles/presse') ?>">Presse</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?= base_url('menschen') ?>">Menschen</a></li>
                                    <li class="subnavi">    
                                        <ul> 
                                            <li><a href="<?= base_url('menschen/mannschaft') ?>">Mannschaft</a></li>
                                            <li><a href="<?= base_url('menschen/altersundehrenabteilung') ?>">Alters- und Ehrenabteilung</a></li>
                                            <li><a href="<?= base_url('menschen/jugend') ?>">Jugendfeuerwehr</a></li>
                                            <li><a href="<?= base_url('menschen/minifeuerwehr') ?>">Minifeuerwehr</a></li>
                                            <li><a href="<?= base_url('menschen/leistungsgruppe') ?>">Leistungsgruppe</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?= base_url('technik') ?>">Technik</a></li>
                                    <li class="subnavi">    
                                        <ul>  
                                            <li><a href="<?= base_url('technik/fahrzeuge') ?>" class="first">Fahrzeuge</a></li>
                                            <li><a href="<?= base_url('technik/fahrzeuge/ausserdienst') ?>">Fahrzeuge a.D.</a></li>
                                            <li><a href="<?= base_url('technik/rettungshunde') ?>">Rettungshundeeinheit</a></li>
                                            <li><a href="<?= base_url('technik/gefahrstoffkomponente') ?>">Gefahrstoffeinheit</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?= base_url('informationen/buergerinformationen') ?>">Infos</a></li>
                                    <li class="subnavi">    
                                        <ul>  
                                            <li><a href="<?= base_url('informationen/buergerinformationen') ?>">Bürgerinfos</a></li>
                                            <li><a href="<?= base_url('informationen/einsatzgebiet') ?>" class="active">Einsatzgebiet</a></li>
                                            <li><a href="<?= base_url('informationen/aufgaben') ?>" class="active">Aufgaben &amp; Gesetze</a></li>
                                            <li><a href="<?= base_url('informationen/aao') ?>" class="active">Alarm- und Ausrückeordnung</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?= base_url('verein') ?>">Verein</a></li>
                                    <li class="subnavi">    
                                        <ul>  
                                            <li><a href="<?= base_url('verein') ?>" class="first">Verein</a></li>
                                        </ul>
                                    </li>
                                    <li class="metanav">
                                        <ul>
                                            <li class="mitmachen"><a href="<?= base_url('mitmachen') ?>">Mitmachen</a></li>
                                            <li><a href="<?= base_url('fuel') ?>" target="_blank">Login</a></li>
                                            <li><a href="https://portal-fwbs.de/" target="_blank">Infoportal</a></li>
                                            <li><a href="<?= base_url('kontakt') ?>">Kontakt</a></li>
                                            <li><a href="<?= base_url('links') ?>">Links</a></li>
                                            <li><a href="#notruflayer_js" class="fancybox-metaLayer">Notfall</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                            <?php if (isset($stage_info) && $stage_info["stage"] == "fahrzeug") : ?>
                            <section id="stage">
                                <div class="<?= $stage->type->css_outer_class ?>">
                                    <div id="stagewrapper">
                                        <div class="fahrzeughero">
                                            <img src="<?= img_path("fahrzeuge/bildbuehnen/" . $stage_info["stage_image"]) ?>" />
                                        </div>
                                    </div>
                                </div>    
                            </section>
                            <div id="substage">
                                <div class="slidewrapper">
                                    <div>
                                        <h1><?= $stage_info["name"] ?></h1>
                                        <h2><?= $stage_info["name_lang"] ?></h2>
                                        <p><?= $stage_info["text_stage"] ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php else : ?>
                            <section id="stage">
                                <?php $stage_images = $stage->get_stage_images_for_frontend(); ?>
                                <?php
                                foreach ($stage_images as $key => $image) :
                                if (strtolower($image->text_1) == "dummy") {
                                if (isset($stage_text["name"]))
                                $text1 = $stage_text["name"];
                                else
                                $text1 = "";
                                if (isset($stage_text["name_lang"]))
                                $text2 = $stage_text["name_lang"];
                                else
                                $text2 = "";
                                if (isset($stage_text["text_stage"]))
                                $text3 = $stage_text["text_stage"];
                                else
                                $text3 = "";
                                if (isset($stage_text["class"]))
                                $stage_type = "einsatz";
                                else
                                $stage_type = 'default';
                                } else {
                                $text1 = $image->text_1;
                                $text2 = $image->text_2;
                                $text3 = "";
                                $stage_type = 'default';
                                }
                                switch ($image->stage_image_type_id) {
                                case 1: $css_inner_class = "stageContentHeadlineTop half_blackBG smallstage";
                                break;
                                case 2: $css_inner_class = "stageQuoteLeft";
                                break;
                                case 3: $css_inner_class = "stageQuoteRight";
                                break;
                                case 4: $css_inner_class = "stageContentCar";
                                break;
                                case 5: $css_inner_class = "stageContentHeadline blackBG";
                                break;
                                }
                                ?>
                                <div class="<?= $stage->type->css_outer_class ?>" id="pictures_<?= $key ?>" style="background-image: url(<?= img_path("bildbuehnen/" . $image->image) ?>); display: none;">
                                    <div id="stagewrapper">    
                                        <div class="<?= $css_inner_class ?>">            
                                            <?php if ($stage_type == 'default') : ?>   
                                            <?php if($text1 != "") : ?> <h1<?= $image->get_css_text_class_1() ?>><?= $text1 ?></h1> <?php endif; ?>
                                            <?php if($text2 != "") : ?> <h2<?= $image->get_css_text_class_2() ?>><?= $text2 ?></h2> <?php endif; ?>  
                                            <?php if($text3 != "") : ?> <p><?= $text3 ?></p> <? endif; ?>       
                                            <?php else : ?>
                                            <figure><img src="<?= assets_path('icons/'.$stage_text["class"].'.png') ?>" /></figure>
                                            <h1><?= $text1 ?></h1>
                                            <h2><?= $text2 ?></h2>  
                                            <?php endif; ?>      
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?> 
                            </section>
                            <?php endif; ?>

                            <section id="content">
                                <?php if (!isset($stage_info) || $stage_info["stage"] != "fahrzeug") : ?>
                                <div class="<?= $stage->type->css_slidewrapper_class ?>">
                                    <?php if ($stage->img_count > 1) : ?>
                                    <div id="slider">
                                        <ul>
                                            <?php
                                            foreach ($stage_images as $key => $item) :
                                            if ($key == 0)
                                            $class = ' first';
                                            else
                                            $class = '';
                                            ?>             
                                            <li><a href="#<?= $key ?>" class="changeStage<?= $class ?>" id="slide-link-<?= $key ?>"><?= $key + 1 ?></a></li>
                                                <?php endforeach; ?>                
                                        </ul>
                                    </div> 
                                    <?php endif; ?>
                                    <?php endif; ?>
