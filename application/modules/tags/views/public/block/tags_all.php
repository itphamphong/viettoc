<div class="round-title"><?php echo $this->global_function->show_config_language('lang_search_tags', $lang) ?></div>
<ul class="tags col_full">
    <?php foreach ($list_tags as $tags) {
        if(!empty($tags->tags_link)){
        ?>
        <li><a href="<?php echo site_url($lang."/tags/".$tags->tags_link)?>" title="<?php echo $tags->name ?>"><?php echo $tags->name ?></a></li>
            <?php }else{?>
            <li><?php echo $tags->name ?></li>
            <?php }?>
    <?php } ?>
</ul>