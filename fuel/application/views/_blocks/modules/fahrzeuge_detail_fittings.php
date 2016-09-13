<?php foreach ($data->fahrzeug_fittings as $fitting) : ?> 
    <div class="car_freespecial">
        <div class="text">  
            <h2><?= $fitting->name ?></h2>
            <p><?= $fitting->text ?></p>
        </div>
        <div class="image">
            <img src="<?= img_path('fahrzeuge/anbauten/' . $fitting->image) ?>" alt="<?= $fitting->image ?>" />
        </div>
        <hr class="clear" />
    </div>
<?php endforeach; ?>