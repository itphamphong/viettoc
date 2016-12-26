<div class="tab-language fleft col_full">
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$CI = &get_instance();
$lang = $CI->global_function->show_list_lang();
foreach ($lang as $l) {
    ?>
    <span class="i-tab i-lang-<?php echo $l->name ?> <?php if($l->default==1) {?>active <?php } ?>" data="<?php echo $l->name?>" onclick="Lang(this)"><?php echo $l->title_2?></span>
<?php } ?>
</div>
