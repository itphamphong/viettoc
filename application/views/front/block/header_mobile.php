<?php
$CI =& get_instance();
$CI->load->model('item/a_item');
$menu = $CI->a_item->show_list_category_where(array("category.category_type" => 1, 'category.category_status' => '1'), $lang, 4);
?>
<div class="round-header-mobile">
    <div class="container">
        <div class="clear he2"></div>
        <div class="col-xs-5">
            <a href="<?php echo site_url() ?>"><img src="<?php echo $logo['picture'] ?>"></a>
        </div>
        <div class="col-xs-7 text-right pad0">
            <a class="hotline">Hotline: <?php echo $info->hotline ?></a>
            <div class="clear"></div>
            <ul id="menu-social">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa  fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="clear"></div>
<div id="notification">  <?php echo $this->global_function->show_config_language('lang_add_cart_successfull', $lang) ?></div>
<ul id="navigationMenu">
    <li class="active">
        <a class="home" href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_home', $lang, 'url')) ?>">
            <i class="fa fa-home"></i>
            <span><?php echo $this->global_function->show_config_language('lang_home', $lang) ?></span>
        </a>
    </li>


    <li>
        <a class="portfolio" href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_product', $lang, 'url')) ?>">
            <i class="fa   fa-share-alt"></i>
            <span><?php echo $this->global_function->show_config_language('lang_product', $lang) ?></span>
        </a>
    </li>
    <li>
        <a class="portfolio" href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_contact_us', $lang, 'url')) ?>">
            <i class="fa  fa-gg"></i>
            <span><?php echo $this->global_function->show_config_language('lang_contact_us', $lang) ?></span>
        </a>
    </li>
    <li>
        <a class="portfolio" href="<?php echo site_url($lang . "/cart") ?>">
            <i class="fa fa-shopping-cart"></i>
            <span><?php echo $this->global_function->show_config_language('lang_cart', $lang) ?></span>
        </a>
    </li>
</ul>
<input id="toggle" type="checkbox" name="menu-checked" class="hide">
<label id="round-hide" for="toggle"></label>
<div id="menu-mobile">

    <div class="col-xs-2">
        <label for="toggle" id="menu-icon" class="col-sm-hide"></label>
    </div>
    <div class="col-xs-7 pad0">
        <div id="menu-search">
            <form action="<?php echo site_url($lang . "/search-key") ?>" method="post">
                <div class="round-input-search">
                    <span><i class="fa  fa-search"></i></span>
                    <input type="text" name="key">
                </div>
                <input type="submit" name="ok" style="display: none">
            </form>

        </div>
    </div>
    <div class="col-xs-3">
        <ul id="menu-language">
            <li><a class="active" href="#"> <img src="<?php echo base_url() ?>themes/front/images/en.png"></a></li>
            <li><a href="#"> <img src="<?php echo base_url() ?>themes/front/images/vn.png"></a></li>
        </ul>
    </div>
</div>
<div id="r-menu">
    <nav id="cssmenu" class="sidebar-menu sidebar-effect">
        <ul class="i-menu ">
            <li class="">
                <a>
                    <?php echo $this->global_function->show_config_language('lang_product', $lang) ?>
                </a>
            </li>
            <?php foreach ($menu as $m) {
                $child = $CI->a_category->show_list_category_page(array("category_parent.parent_id" => isset($m->id)?$m->id:0, "category_status" => 1), $lang, 0);
                ?>
                <li class=" <?php if ($this->uri->segment(2) == $m->category_link) echo 'active' ?>" data-id="<?php echo $m->id?>" onclick="MenuChild(this)">
                    <a >|--<?php echo $m->category_name ?></a>
                </li>
                <?php foreach ($child as $c) { ?>
                    <li class="parent parent-<?php echo $m->id?> <?php if ($this->uri->segment(2) == $c->category_link) echo 'active' ?>">
                    <a href="<?php echo site_url($lang . "/" .$m->category_link."/". $c->category_link) ?>">|----<?php echo $c->category_name ?></a>
                    </li>

                <?php } ?>
            <?php } ?>
            <li class=" <?php if ($this->uri->segment(2) == $this->global_function->show_config_language('lang_service', $lang, 'url')) echo 'active' ?>">
                <a href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_service', $lang, 'url')) ?>">
                    <?php echo $this->global_function->show_config_language('lang_service', $lang) ?>
                </a>
            </li>
            <li class="<?php if ($this->uri->segment(2) == $this->global_function->show_config_language('lang_customer', $lang, 'url')) echo 'active' ?>">
                <a href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_customer', $lang, 'url')) ?>">
                    <?php echo $this->global_function->show_config_language('lang_customer', $lang) ?>
                </a>
            </li>
            <li><a href="<?php echo site_url($lang . "/video") ?>"> Video Library</a></li>
            <li><a href="#">Resource Library</a></li>
            <li class="<?php if ($this->uri->segment(2) == $this->global_function->show_config_language('lang_contact_us', $lang, 'url')) echo 'active' ?>">
                <a href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_contact_us', $lang, 'url')) ?>">
                    <?php echo $this->global_function->show_config_language('lang_contact_us', $lang) ?>
                </a>
            </li>

        </ul>

    </nav>

</div>
<script>
    function MenuChild(e){
        $('.parent').hide();
        var id=$(e).attr('data-id');
        $(".parent-"+id).show();
    }
</script>