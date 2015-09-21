<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="oneColumnBox">
    <div class="article">
        <h1 class="first">Die Alters- und Ehrenabteilung der Feuerwehr Bad Soden a.Ts.</h1>
        <p>
                Die Alters- und Ehrenabteilung umfasst die erfahrenste der vier Abteilungen der Freiwilligen Feuerwehr Bad Soden.
                Sie wird darüber hinaus noch einmal in zwei Hälften unterteilt. Zum einen werden die Mitglieder der Einsatzabteilung mit dem 63. Lebensjahr in den 
                "Ruhestand" geschickt und somit in die Altersabteilung übergeben. Zum anderen werden Freunde der Feuerwehr aufgrund ihrer Verbundenheit 
                mit dem Feuerwehrverein zu Ehrenmitgliedern ernannt.
        </p>
        <p>
                Dadurch unterstützen alle Angehörigen dieser Abteilung die Feuerwehr auf ihre Weise. Die Kameraden der Altersabteilung haben beispielsweise regelmäßig
                einen Stammstisch, bei dem in geselliger Runde alte Geschichten ausgetauscht werden, oder donnerstags nach dem Übungsdienst mit der Einsatzabteilung
                über aktuelle Dinge gesprochen.
        </p>
    </div>
    <hr class="clear" />       
    <div class="oneColumnBox" id="submenue">
       	<div class="filter">
            <div class="thirdnavi_button"><a href="#anker_a" class="button_black" rel="nicescrolling">Altersabteilung</a></div>
            <div class="thirdnavi_button"><a href="#anker_e" class="button_black" rel="nicescrolling">Ehrenabteilung</a></div>
            <div><a href="#top" class="backToTop" rel="nicescrolling"></a></div>
            <hr class="clear" />
        </div>        
    </div>
    <div class="jsplatzhalter"></div>
       
    <div class="oneColumnBox">
   	    <h1 class="module">Altersabteilung</h1>
        <ul class="TeaserListe">            
<?php       
    $listcount = 1;
    foreach($alters as $t) : 
    if($listcount > 3) $listcount = 1;
        
    if($t["show_eintrittsdatum"] == "no") $t["eintrittsdatum"] = "";
    if($t["show_image"] == "no") $t["image"] = "dummy_aue.jpg";
        
    switch($listcount)
    {
        case '1': $class = ''; break;
        case '2': $class = ' class="second"'; break;
        case '3': $class = ' class="third"'; break;
    }
    $listcount++;
?>
            <li<?=$class?>>
                <figure>
                    <img src="<?=img_path('mannschaft/'.$t["image"])?>" />
                </figure>
                <h1><?=$t["vorname"]?> <?=$t["name"]?></h1>
                <p><?php if($t["show_eintrittsdatum"] == "yes") echo"Zugehörigkeit: ".get_alter($t["eintrittsdatum"])." Jahre"; else echo "&nbsp;"; ?></p>
            </li>
<? endforeach; ?>                    
        </ul>
        <hr class="clear" />
    </div>
    <hr class="clear" />
    <div class="oneColumnBox">           
        <h1 class="module">Ehrenabteilung</h1>
        <ul id="anker_e" class="TeaserListe">
<?php       
    $listcount = 1;
    foreach($ehren as $t) : 
    if($listcount > 3) $listcount = 1;
        
    switch($listcount)
    {
        case '1': $class = ''; break;
        case '2': $class = ' class="second"'; break;
        case '3': $class = ' class="third"'; break;
    }
    $listcount++;
?>      
            <li<?=$class?>>
                <h1><?=$t["vorname"]?> <?=$t["name"]?></h1>
            </li>
<? endforeach; ?>   
        </ul>
    </div>
</div>
<hr class="clear" />