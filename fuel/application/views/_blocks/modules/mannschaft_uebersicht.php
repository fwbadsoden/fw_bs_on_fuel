<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
        
        <div class="oneColumnBox" id="submenue">
        	<div class="filter">
                    <div class="thirdnavi_button"><a href="#anker_fuehrung" class="button_black" rel="nicescrolling">Führung</a></div>
                    <div class="thirdnavi_button"><a href="#anker_mannschaft" class="button_black" rel="nicescrolling">Mannschaft</a></div>
                    <div><a href="#top" class="backToTop" rel="nicescrolling"></a></div>
                    <hr class="clear" />
            </div>        
        </div>
        <div class="jsplatzhalter"></div>
       
        <div class="oneColumnBox">
            <ul class="TeaserListe">
            
<?php       
    $listcount = 1;
    $class = ""; 
    $nonLineBreakingFunktionen = array("Stadtbrandinspektor", "Wehrführer", "stellv. Wehrführer");
    $lastFunktion = "";

    foreach($fuehrung as $f) :
        if($listcount > 3) $listcount = 1;
        
        if($f["show_geburtstag"] == 0) $f["geburtstag"] = "";
        if($f["show_beruf"] == 0) $f["beruf"] = "";
        if($f["show_image"] == 0) $f["image"] = "dummy.jpg";
        
        if($f["executive_name"] != $lastFunktion && array_search($f["executive_name"], $nonLineBreakingFunktionen) === false){
            $class = '';
            $listcount = 1;
        } else {
            switch($listcount)
            {
                case '1': $class = ''; break;
                case '2': $class = ' class="second"'; break;
                case '3': $class = ' class="third"'; break;
            }
        }
        $lastFunktion=$f["executive_name"];
        $listcount++;
        if($f["geschlecht"] == 'm') $dienstgrad_name = $f["grade_name_m"];
        elseif($f["geschlecht"] == 'w') $dienstgrad_name = $f["grade_name_w"];
        else $dienstgrad_name = $f["dienstgrad_name"];
        
        if($f["executive_name"] != "") $rang_text = $dienstgrad_name.', '.$f["executive_name"];
        else $rang_text = $dienstgrad_name;
?>
                    <li<?=$class?>>
                        <figure>
                            <img src="<?=img_path('mannschaft/'.$f["image"])?>" />
                            <img src="<?=img_path('dienstgrad/'.$f["grade_image"])?>" class="abzeichen" original-title="Dienstgrad" rel="tipsy" />
                        </figure>
                        <h1><?=$f["vorname"]?> <?=$f["name"]?></h1>
                        <h2><?=$rang_text?></h2>
                        <p>
<?php                      
            
    if($f["geburtstag"] != '' && $f["geburtstag"] != '0000-00-00' && $f["beruf"] != ''){                      
        echo cp_get_alter($f["geburtstag"]) . " Jahre, " .$f["beruf"];
    }      
    else{
       if($f["geburtstag"] != '' and $f["geburtstag"] != '0000-00-00'  && $f["beruf"] == '') {                  
        echo cp_get_alter($f["geburtstag"]) . " Jahre, " .$f["beruf"];
       }else{
           if($f["beruf"] != ''){
               echo $f["beruf"];
           }
           else{ 
               echo '&nbsp;';       
           }
       }        
   }
                            ?>         
                        </p>
                    </li>
<? endforeach; 
   $listcount = 1;
?>                    
                </ul>

            <hr class="clear" />
            
            <h1 class="module" id="anker_mannschaft">Mannschaft</h1>
            <div class="oneColumnBox">
                <ul class="TeaserListe">
<? foreach($team as $t) : 
    if($listcount > 3) $listcount = 1;
        
    if($t["show_geburtstag"] == 0) $t["geburtstag"] = "";
    if($t["show_beruf"] == 0) $t["beruf"] = "";
    if($t["show_image"] == 0) $t["image"] = "dummy.jpg";
        
    switch($listcount)
    {
        case '1': $class = ''; break;
        case '2': $class = ' class="second"'; break;
        case '3': $class = ' class="third"'; break;
    }
    $listcount++;
    if($t["geschlecht"] == 'm') $dienstgrad_name = $t["grade_name_m"];
    elseif($t["geschlecht"] == 'w') $dienstgrad_name = $t["grade_name_w"];
    else $dienstgrad_name = $t["dienstgrad_name"];
?>
                    <li<?=$class?>>
                        <figure>
                            <img src="<?=img_path('mannschaft/'.$t["image"])?>" />
                            <img src="<?=img_path('dienstgrad/'.$t["grade_image"])?>" class="abzeichen" original-title="Dienstgrad" rel="tipsy" />
                        </figure>
                        <h1><?=$t["vorname"]?> <?=$t["name"]?></h1>
                        <h2><?=$dienstgrad_name?></h2>
                         <p>
                             <?php                              
    if($t["geburtstag"] != '' && $t["geburtstag"] != '0000-00-00' && $t["beruf"] != ''){                      
        echo cp_get_alter($t["geburtstag"]) . " Jahre, " .$t["beruf"];
    }      
    else{
       if($t["geburtstag"] != '' and $t["geburtstag"] != '0000-00-00'  && $t["beruf"] == '') {                  
        echo cp_get_alter($t["geburtstag"]) . " Jahre, " .$t["beruf"];
       }else{
           if($t["beruf"] != ''){
               echo $t["beruf"];
           }
           else{ 
               echo '&nbsp;'; 
           }
       }        
   }
                            ?>
                         </p>
                    </li>
<? endforeach; ?>                    
                </ul>
                <hr class="clear" />
    
            </div>
            <hr class="clear" />
		</div>
        <hr class="clear" />