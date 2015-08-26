<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
    $form = array(
        'id'   => 'einsatzFilter',
        'name' => 'einsatzFilter'
    ); 
	
	$year_options = array();
	if(isset($_POST['mission_year'])) $year_selected = $_POST['mission_year']; 
	else 							 $year_selected = 0;
	$year_attr = "class = 'input_dropdown' id = 'input_dropdown' onChange='this.form.submit()'";
	foreach($years as $year)
	{
		$year_options[$year] = $year;	
	}
	
	$type_options = array();
	if(isset($_POST['mission_type'])) $type_selected = $_POST['mission_type']; 
	else 							$type_selected = 0;
	$type_attr = 'class = "input_dropdown" id = "input_dropdown" onChange="this.form.submit()"';
    $type_options[0] = 'Alle Einsätze';
	foreach($mission_types as $type)
	{
		$type_options[$type->id] = $type->name;	
	} 
    
    $count = 0;
?>

<div class="oneColumnBox" id="submenue">
    <div class="filter">
        <div class="filterBox" id="einsatzJahr">
            <?=form_open(current_url(), $form);?>
            <div class="styled-select">
                <?=form_dropdown('mission_year', $year_options, $year_selected, $year_attr)?>
           	</div>
            <div class="styled-select">
                <?=form_dropdown('mission_type', $type_options, $type_selected, $type_attr)?>
           	</div>
            <div><a href="#top" class="backToTop" rel="nicescrolling"></a></div>
            <hr class="clear" />
        </div>
    </div>      
</div>
<div class="jsplatzhalter"></div>

<div class="oneColumnBox">
    <div class="factSheet_einsatzListe">
        <div class="factBox">    
               
<? foreach($mission_types as $type) : ?>
            <div class="row">
                <div class="icon <?=$type->class?>"><a style="width: 36px;">Icon:<?=ucfirst($type->class)?></a></div> 
                <div class="label"><?=$type->name_plural?>:</div>
                <div class="red"><?=$statistic[$type->id]?></div>
            </div>
<? endforeach ;               ?>
            <div class="row">
                <div class="icon all">Icon:Alle</div> 
                <div class="label">Insgesamt:</div>
                <div class="red"><?=$statistic['all']?></div>
            </div>
            <div class="row">
                <div class="icon city"><a style="width: 36px;">Icon:City</a></div> 
                <div class="label">Davon überörtliche Einsätze:</div>
                <div class="red"><?=$statistic['ueberoertlich']?></div>
            </div>
        </div>
    </div>
</div>
<hr class="clear" />

<div class="oneColumnBox">  

<?php
    $month_num = null;
    $month_old = null; 
    
    for($i = 0; $i < count($data); $i++) : 

        $mission = $data[$i];
        if($i+1 == count($data)) {
            $mission_next = null;
        } else {
            $mission_next = $data[$i+1];
        }
        
        if($month_num != substr($mission->datum_beginn, 5, 2)) {
            if($month_old == null) {
                $month_old = substr($mission->datum_beginn, 5, 2);
            }
            $month_num = substr($mission->datum_beginn, 5, 2);
            $month_name = get_month_name($month_num);  
            $month_year = substr($mission->datum_beginn, 0, 4);    
                  
            echo'<h1 class="module">'.$month_name.' '.$month_year.'</h1>';
    
            if($month_old != $month_num) {
                echo '<hr class="clear" />';
                $month_old = $month_num;
            }
        }
        if($mission_next == null) {
            $special_class = ' lastRow';
        } elseif(substr($mission->datum_beginn, 5, 2) != substr($mission_next->datum_beginn, 5, 2)) {
            $special_class = ' lastRow';
        } else {
            $special_class = "";
        }
?>

    <div class="listContent">

        <div class="row">
       	    <div class="number trenner<?=$special_class?>"><a href="<?=base_url('aktuelles/einsaetze/'.$mission->id)?>"><? printf("%3s\n", $mission->einsatz_nr); ?></a></div>
            <div class="date trenner<?=$special_class?>"><a href="<?=base_url('aktuelles/einsaetze/'.$mission->id)?>"><span class="inline_date"><?=get_ger_date($mission->datum_beginn)?></span> <span class="inline_slash">/</span> <span class="inline_time"><?=$mission->uhrzeit_beginn?> Uhr</span></a></div>
            <div class="icon trenner<?=$special_class?>"><a href="<?=base_url('aktuelles/einsaetze/'.$mission->id)?>" class="<?=$mission->type->class?>"><?=$mission->type->class?></a></div>
            <div class="headline<?=$special_class?>"><a href="<?=base_url('aktuelles/einsaetze/'.$mission->id)?>"><?=$mission->name?></a></div>
            <div class="moreButton<?=$special_class?>"><a href="<?=base_url('aktuelles/einsaetze/'.$mission->id)?>" class="button_black">Mehr lesen</a></div>
            <div class="moreButton_mobile<?=$special_class?>"><a href="<?=base_url('aktuelles/einsaetze/'.$mission->id)?>" class="button_blackarrow_mobile">&nbsp;</a></div>
        </div>
                
    </div>
	<hr class="clear" />
    
<?php endfor; ?>
    
</div>