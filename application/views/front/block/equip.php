<?php
$CI=&get_instance();$CI->load->model('item/a_item');
$eqip=$CI->a_item->show_list_category_where(array("category.category_type" =>3, 'category.category_status' => '1'),$lang);
?>
<?php  if ($this->agent->is_mobile()) {?>
<div class="col-xs-12 about-home">
    <div class="clear h3"></div>
    <p class="title">  <?php echo $this->global_function->show_config_language('lang_eqip', $lang) ?></p>
    <div class="container">
        <div id="logo-eq">
            <?php foreach($eqip as $eq){
                if ($eq->choose_upload == 1) {
                    $src = base_url() . "uploads/Images/product/" . $eq->picture;
                } else if ($eq->choose_upload == 2) {
                    $src = base_url() . $cate->picture;
                } else $src = $eq->picture;
                ?>
            <div class="item">
                <a href="<?php echo site_url($lang."/".$eq->category_link)?>"><img src="<?php echo $src ?>"></a>
            </div>
            <?php }?>

        </div>
    </div>
</div>
<?php }else{?>
    <div class="col-xs-12 about-home">
        <div class="clear h3"></div>
        <p class="title">  <?php echo $this->global_function->show_config_language('lang_eqip', $lang) ?></p>
        <div class="container">
            <ul id="logo-eq">
                <?php foreach($eqip as $eq){
                    if ($eq->choose_upload == 1) {
                        $src = base_url() . "uploads/Images/product/" . $eq->picture;
                    } else if ($eq->choose_upload == 2) {
                        $src = base_url() . $cate->picture;
                    } else $src = $eq->picture;
                    ?>
                    <li>
                        <a href="<?php echo site_url($lang."/".$eq->category_link)?>"><img src="<?php echo $src ?>"></a>
                    </li>
                <?php }?>

            </ul>
        </div>
    </div>
<?php }?>
