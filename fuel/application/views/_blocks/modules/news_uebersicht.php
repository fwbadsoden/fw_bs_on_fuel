<div id="MainContent">        
    <ul class="news onlyList">
        <?php foreach ($data as $item) : ?>
            <li>
                <?php if($item->text != '') : ?>
                    <a href="<?= base_url('aktuelles/news/' . $item->id) ?>">
                <?php elseif($item->link != '') : ?>
                    <a href="<?= base_url($item->link) ?>">
                <?php endif; ?> 
                    <h2><span class="date"><?= get_ger_date($item->datum) ?></span></h2>
                    <h1><?= $item->title ?></h1>
                    <p><?= $item->teaser ?></p>
                </a>
            </li>
        <?php endforeach; ?>        
    </ul>
</div>
<div id="SidebarContent">

    <div class="dates">
        <h1 class="first">Termine</h1>
        <ul> 
            <?php foreach ($termine as $termin) : ?>
                <li>    
                    <h3><span class="date"><?= get_ger_date($termin->datum) . ' - ' . $termin->beginn ?></span> / <?= $termin->ort_short ?></h3>
                    <h2><?= $termin->name ?></h2>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="more"><a href="<?= base_url('aktuelles/termine') ?>" class="button_white">Mehr lesen</a></p>
    </div> 

    <?php if ($weather != false) : ?>
        <div class="weather">
            <h1>Wetter Aussichten</h1>
            <div class="wrapper">    
                <div class="icon"><!--<?= $weather['image'] ?>--></div>
                <div class="text">                 
                    <p class="grad"><?= round($weather['temperature']) ?>&deg;<span class="celsius">Celsius</span></p>
                    <p class="status"><?= $weather['description'] ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>
<hr class="clear" />   