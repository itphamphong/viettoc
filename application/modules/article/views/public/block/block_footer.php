<?php
$i=1;
foreach ($list as $row) { ?>
    <li class="title"><a href="<?php echo site_url($lang."/page/".$row->article_link)?>"><?php echo $row->article_name?></li>
<?php }?>
