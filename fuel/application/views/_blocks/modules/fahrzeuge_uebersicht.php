<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<section id="content">
    <div class="<?=$stage->type->css_slidewrapper_class?>">
        <div class="oneColumnBox">
            <ul class="TeaserListe">
        
<?php  
    $i=1;
    foreach($data as $fahrzeug) {
        
        if($i > 3) $i = 1;
        
        $image = $fahrzeug->get_setcard_image();
        $image_string = $image->image;
        
        switch($i)
        {
            case '1': $class = ''; break;
            case '2': $class = ' class="second"'; break;
            case '3': $class = ' class="third"'; break;
        }
?> 

                <a href="<?=base_url('technik/fahrzeuge/'.$fahrzeug->id)?>">
                    <li<?=$class?>>
                        <figure><img src="<?=base_url("assets/images/fahrzeuge/".$image_string)?>" /></figure>
                        <h1><?=$fahrzeug->name_lang?></h1>
                        <h2><?=$fahrzeug->name?></h2>
                    </li>
                </a>
                
<?php 
        $i++;
    }
?>    
                    
            </ul>
        </div>
        <hr class="clear" />
    </div>
</section>