<div id="MainContent">        
    <ul class="news onlyList">
    <?php foreach($data as $item) : ?>
        <li>
            <a href="<?=base_url('aktuelles/news/'.$item->id)?>">
                <h2><span class="date"><?=get_ger_date($item->datum)?></span></h2>
                <h1><?=$item->title?></h1>
                <p><?=$item->teaser?></p>
            </a>
        </li>
    <?php endforeach; ?>        
    </ul>
</div>
<div id="SidebarContent">
        
        <div class="dates">
            <h1 class="first">Termine</h1>
            <ul> 
            <?php foreach($termine as $termin) : ?>
                <li>    
                    <h3><span class="date"><?=get_ger_date($termin->datum).' - '.$termin->beginn?></span> / <?=$termin->ort_short?></h3>
                    <h2><?=$termin->name?></h2>
                </li>
            <?php endforeach; ?>
            </ul>
            <p class="more"><a href="<?=base_url('aktuelles/termine')?>" class="button_white">Mehr lesen</a></p>
        </div> 
        
        <div class="weather">
       	    <h1>Wetter Aussichten</h1>
            <div class="wrapper">    
                <!-- <div class="icon"><?=$weather['weather_img']?></div>-->
                <div class="text">
                <?php if($weather['weather_cond']['temp'] != '_') : ?>                    
                    <p class="grad"><?=$weather['weather_cond']['temp']?>&deg;<span class="celsius">Celsius</span></p>
                <?php endif; ?>                        
                    <p class="status"><?=$weather['weather_cond']['text']?></p>
                </div>
            </div>
            <hr class="clear" />
        </div>
    </div>
    <hr class="clear" />   