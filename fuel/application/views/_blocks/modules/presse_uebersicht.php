<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

        <div id="MainContent">  
            <div class="article">
                <p>Die Pressestelle der Feuerwehr Bad Soden am Taunus ist für die interne und externe Presse- und Öffentlichkeitsarbeit zuständig. Sie berichtet über alle nennenswerten Einsätze der Feuerwehr und steht für 
                    eine offene und schnelle Kommunikation mit den Medien und deren Mitarbeitern. Ebenso gehört die Information der Bevölkerung über alltägliche Gefahren im Rahmen von Veröffentlichungen und Veranstaltungen 
                    mit dazu.</p>
                <p>Bei presserelevanten Ereignissen steht ein Feuerwehr-Pressesprecher für die Medien bereit und versorgt diese mit Pressemitteilungen, Informationen und ggf. Bildmaterial. 
                    Gerne beantworten wir Ihre Presseanfragen, koordinieren Interviewwünsche und betreuen Ihre Fernseh-, Hörfunk- und Internetbeiträge. Wir bieten allen 
                    Redaktionen an, Sie in unseren Presse e-Mail Verteiler aufzunehmen.</p>
                <div class="kontaktformularOpener"><p class="link_open active" id="js_openKontakt"><a href="#" rel="js_contact">Kontaktformular öffnen</a></p></div>
                <div class="kontaktformularOpener"><p class="link_close" id="js_closeKontakt"><a href="#" rel="js_contact">Kontaktformular schlie&szlig;en</a></p></div>
<?php if($success) : ?>
            <div class="kontaktformular" style="display:block">
<?php else : ?>
        <div class="kontaktformular">
           <?php endif; ?>
            {form('kontakt')}
                </div>
            </div>
            
            <h1 class="module" id="anker_mitteilungen">Pressemitteilungen</h1>
            <div class="listContent">
<? foreach($data as $article) :  
    $date = get_date_as_array($article->datum);
?>
                <div class="row">
<? if($article->online_article == '') : ?>
                    <a href="<?=assets_path($article->asset, 'pressarticles')?>" class="fancybox-gallery" rel="gallery1">
<? else : ?>
                    <a href="<?=$article->online_article?>" target="_blank">
<? endif; ?>
                	<div class="date_small trenner"><span class="inline_date"><?=$date[2]?>. <?=get_month_short_name($date[1])?>. <?=$date[0]?></span></div>
<? if($article->online_article == '') : ?>                    
                 	<div class="size trenner"><p><?=strtoupper(substr($article->asset, -3))?></p><p class="bytes"><?=get_asset_size($article->asset, 'pressarticles')?></p></div>
<? else : ?>
                    <div class="size trenner"><p>URL&nbsp;&nbsp;</p><p class="bytes"></p></div>
<? endif; ?>                    
	               	<div class="headline smallBoxHead"><span class="medium"><?=$article->source->name?></span><br/><?=$article->name?></div>
                    <div class="moreButton_arrow"></div>
               		</a>
                </div>
<? endforeach; ?>

            <hr class="clear" />
            </div>
        </div>
        <div id="SidebarContent">   
            <div class="address">
    			<h1 class="first">Kontaktadresse</h1>
    			<p>Pressestelle der Freiwilligen Feuerwehr<br/>Bad Soden am Taunus</p>
    			<p>Hunsrückstr. 5-7<br/>65812 Bad Soden am Taunus</p>
    			<ul>
    				<li class="tel">+49 6196 24074</li>
    				<li class="mail"><a href="mailto:pressestelle@feuerwehr-bs.de">pressestelle@feuerwehr-bs.de</a></li>
    			</ul>
            </div>    
    		<div class="textTeaser">    
    			<h1>Kontakt am Einsatzort</h1>
    			<p>An größeren Einsatzstellen steht Ihnen unser Pressesprecher direkt am Einsatzort zur Verfügung.</p>
    			<p>Damit sie ihn besser finden, trägt er eine grüne Weste mit der Aufschrift: </p>
    			<h2>"Feuerwehr Pressestelle"</h2>
    		</div>
    		<div class="textTeaser">    
    			<h1>Informationsblatt<br/>Bad Soden</h1>
    			<p>In dem wöchtenlich erscheinenden "Bad Soden am Taunus kompakt" ist die Feuerwehr Bad Soden so oft als möglich mit aktuellen Einsatzberichten 
                   und sonstigen Informationen Rund um die Feuerwehr vertreten.</p>
    			<p><a href="http://www.bad-soden.de/de/aktuelles/mitteilungen/bad-soden-am-taunus-kompakt.aspx" target="_blank">Zur digitalen Ausgabe</a></p>
    		</div>
        </div>
        <hr class="clear" />     