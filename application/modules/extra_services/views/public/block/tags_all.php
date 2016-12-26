<div class="title-left col_full fleft"><?PHP echo $l->lang_utility[$lang]?></div>
<ul class="utility">
    <?php foreach ($list_utility as $utility) { ?>
        <li><a href="<?php echo site_url($lang."/utility/".$utility->utility_link)?>" title="<?php echo $utility->name ?>"><?php echo $utility->name ?></a></li>
    <?php } ?>
</ul>