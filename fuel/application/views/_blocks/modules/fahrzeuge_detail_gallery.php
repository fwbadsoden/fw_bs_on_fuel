<div class="slidewrapper">
    <div class="car_slideshowbox">  
        <div class="slideshow">

            <?php if (count($data->fahrzeug_images) > 1) : ?>
                <div class="prevPic"><a href="#slideshow_car" id="slideshow_prev"><img src="<?= assets_path('button_detailShow_previous.png', 'layout') ?>" /></a></div>
                <div class="nextPic"><a href="#slideshow_car" id="slideshow_next"><img src="<?= assets_path('button_detailShow_next.png', 'layout') ?>" /></a></div>
            <?php endif; ?>

            <ul id="slideshow_car">
                <?php foreach ($data->fahrzeug_images as $key => $img) : ?>           
                    <?php if ($key == 0) : ?>
                        <li id="slideshow_car_<?= $key + 1 ?>" class="active">
                        <?php else : ?>
                        <li id="slideshow_car_<?= $key + 1 ?>" class="noActive">
                        <?php endif; ?>
                        <figure>
                            <img src="<?= img_path('fahrzeuge/' . $img->image) ?>" alt="<?= $img->description ?>" />
                            <div class="zoom"><a href="<?= img_path('fahrzeuge/' . $img->image) ?>" title="<?= $img->description ?>" class="fancybox-gallery" rel="gallery1"><img src="<?= assets_path('button_zoom.png', 'layout') ?>" /></a></div>
                        </figure>
                        <p><?= $key + 1 ?>: <?= $img->description ?></p>
                    </li>
                <?php endforeach; ?> 
            </ul>
        </div>
    </div>
    <hr class="clear" />
</div>