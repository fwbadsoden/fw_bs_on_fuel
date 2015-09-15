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
<? if(count($data->news_images) > 1) : ?>            
<div class="slideshow">
    <div class="prevPic"><a href="#slideshow_news" id="slideshow_prev"><img src="<?=assets_path('button_detailShow_previous.png', 'layout')?>" /></a></div>
    <div class="nextPic"><a href="#slideshow_news" id="slideshow_next"><img src="<?=assets_path('button_detailShow_next.png', 'layout')?>" /></a></div>
                
    <ul id="slideshow_news">
<? foreach($data->news_images as $key => $image) : 
    if($key == 0) $class = ' class="active"';
    else          $class = ' class="noActive"';
?>                
        <li id="slideshow_news_<?=$key+1?>"<?=$class?>>
            <figure>
              	<img src="<?=img_path('news/'.$image->image)?>" alt="<?=$image->title?>" />
               	<div class="zoom"><a href="<?=img_path('news/'.$image->image)?>" class="fancybox-gallery" rel="gallery1" title="<?=$image->title?>"><img src="<?=assets_path('button_zoom.png', 'layout')?>" /></a></div>
            </figure>
        </li>
<? endforeach; ?>                    
    </ul>
</div>
<? elseif(count($data->news_images) == 1) : ?> 
<div class="slideshow">        
    <ul id="slideshow_news">              
        <li id="slideshow_news_1" class="active">
            <figure>
                <img src="<?=img_path('news/'.$data->news_images[0]->image)?>" alt="<?=$data->news_images[0]->title?>" />
           	    <div class="zoom"><a href="<?=img_path('news/'.$data->news_images[0]->image)?>" class="fancybox-gallery" rel="gallery1" title="<?=$data->news_images[0]->title?>"><img src="<?=assets_path('button_zoom.png', 'layout')?>" /></a></div>
            </figure>
        </li>                 
    </ul>
</div>
<? endif; ?> 
</div>   
        
<div id="SidebarContent">   
    <div class="menueBox">
        <h1 class="first">Die 10 letzten News</h1>
        <ul>
<? foreach($latest_news as $news) : 
    $url = $url_back.'/'.$news->id;
    if($url == current_url()) $class = ' class="active"'; else $class = '';
?>                
            <li><a href="<?=$url?>"<?=$class?>><?=$news->title?></a></li>
<? endforeach; ?>                    
        </ul>
    </div>
</div>
<hr class="clear" />