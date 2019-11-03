<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
    $url = current_url();
    $last_segment = '/'.$this->uri->segment($this->uri->total_segments());
    $url_back = str_replace($last_segment, '', $url);
?> 
<div id="MainContent">
    <div class="backtooverview">
        <a href="<?=$url_back?>" class="backlink">zurück zur Übersicht</a>
    </div>
    <div class="article">
        <h1 class="first"><?=$data->title?></h1>
        <p>
          	<strong><?=$data->teaser?></strong>
        </p>
        <p>
            <?=$data->text?>
        </p>
    </div>
<?php foreach($data->news_images as $key_gallery => $gallery) :    
   if(count($gallery) > 1) : ?>            
<div class="slideshow">
    <div class="prevPic"><a href="#slideshow_news_<?=$key_gallery?>" id="slideshow_prev"><img src="<?=assets_path('button_detailShow_previous.png', 'layout')?>" /></a></div>
    <div class="nextPic"><a href="#slideshow_news_<?=$key_gallery?>" id="slideshow_next"><img src="<?=assets_path('button_detailShow_next.png', 'layout')?>" /></a></div>
                
    <ul id="slideshow_news_<?=$key_gallery?>">
<?php foreach($gallery as $key => $image) : 
    if($key == 0) $class = ' class="active"';
    else          $class = ' class="noActive"';
?>                
        <li id="slideshow_news_<?=$key_gallery?>_<?=$key+1?>"<?=$class?>>
            <figure>
              	<img src="<?=img_path('news/'.$image->get_image())?>" alt="<?=$image->title?>" />
               	<div class="zoom"><a href="<?=img_path('news/'.$image->get_image())?>" class="fancybox-gallery" rel="gallery1" title="<?=$image->title?>"><img src="<?=assets_path('button_zoom.png', 'layout')?>" /></a></div>
            </figure>
        </li>
<?php endforeach; ?>                    
    </ul>
</div>
<?php elseif(count($gallery) == 1) : ?> 
<div class="slideshow">        
    <ul id="slideshow_news_<?=$key_gallery?>">              
        <li id="slideshow_news_<?=$key_gallery?>_1" class="active">
            <figure>
                <img src="<?=img_path('news/'.$gallery[0]->get_image())?>" alt="<?=$gallery[0]->title?>" />
           	    <div class="zoom"><a href="<?=img_path('news/'.$gallery[0]->get_image())?>" class="fancybox-gallery" rel="gallery1" title="<?=$gallery[0]->title?>"><img src="<?=assets_path('button_zoom.png', 'layout')?>" /></a></div>
            </figure>
        </li>                 
    </ul>
</div>
<?php endif; endforeach; ?> 
</div>   
        
<div id="SidebarContent">   
    <div class="menueBox">
        <h1 class="first">Die 10 letzten News</h1>
        <ul>
<? foreach($latest_news as $news) : 
        if($news->text != '') : 
            $url = $url_back.'/'.$news->id;
        elseif($news->link != '') :
            $url = base_url($news->link);
        endif;
    if($url == current_url()) $class = ' class="active"'; else $class = '';
?>                
            <li><a href="<?=$url?>"<?=$class?>><?=$news->title?></a></li>
<? endforeach; ?>                    
        </ul>
    </div>
</div>
<hr class="clear" />