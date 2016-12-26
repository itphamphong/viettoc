<?php
$CI=&get_instance();
$CI->load->model(array('item/a_item','category/a_category'));
$menu=$CI->a_item->show_list_category_where(array("category.category_type" =>1, 'category.category_status' => '1'),$lang,4);
?>

<ul id="menu-top">
    <li >
        <a class="home" href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_home', $lang,'url')) ?>">

           <?php echo $this->global_function->show_config_language('lang_home', $lang) ?>
        </a>
    </li>
    <li  class=" <?php if($this->uri->segment(2)==$this->global_function->show_config_language('lang_about', $lang,'url')) echo 'active'?>">
        <a  href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_about', $lang,'url')) ?>">

            <?php echo $this->global_function->show_config_language('lang_about', $lang) ?>
        </a>
    </li>
    <li  class=" <?php if($this->uri->segment(2)==$this->global_function->show_config_language('lang_product', $lang,'url')) echo 'active'?>">
        <a  >
            <?php echo $this->global_function->show_config_language('lang_product', $lang) ?>
        </a>
        <ul class="sub-menu">
            <?php foreach($menu as $m){
                $list_cate_child = $CI->a_category->show_list_category_page(array("category_parent.parent_id" => isset($m->id)?$m->id:0, "category_status" => 1), $lang, 0);

                ?>
                <li class=" <?php if($this->uri->segment(2)==$m->category_link) echo 'active'?>">
                    <a  href="<?php echo site_url($lang."/".$m->category_link )?>"><?php echo $m->category_name ?> <i class="fa  fa-angle-right"></i> </a>
                    <ul class="sub-child">
                        <?php foreach($list_cate_child as $child){?>
                            <li>
                                <a  href="<?php echo site_url($lang."/".$child->category_link )?>"><?php echo $child->category_name ?></a>
                            </li>
                        <?php }?>
                    </ul>
                </li>
            <?php }?>
        </ul>
    </li>
    <li  class=" <?php if($this->uri->segment(2)==$this->global_function->show_config_language('lang_project', $lang,'url')) echo 'active'?>">
        <a  href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_project', $lang,'url')) ?>">

            <?php echo $this->global_function->show_config_language('lang_project', $lang) ?>
        </a>
    </li>
    <li  class=" <?php if($this->uri->segment(2)==$this->global_function->show_config_language('lang_news', $lang,'url')) echo 'active'?>">
        <a  href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_news', $lang,'url')) ?>">

            <?php echo $this->global_function->show_config_language('lang_news', $lang) ?>
        </a>
    </li>
    <li class=" <?php if($this->uri->segment(2)==$this->global_function->show_config_language('lang_service', $lang,'url')) echo 'active'?>">
        <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_service', $lang,'url')) ?>">
            <?php echo $this->global_function->show_config_language('lang_service', $lang) ?>
        </a>
    </li>
    <li class="<?php if($this->uri->segment(2)==$this->global_function->show_config_language('lang_customer', $lang,'url')) echo 'active'?>">
        <a href="<?php echo site_url($lang."/promotion") ?>">
            <?php echo "Promotion"?>
        </a>
    </li>
    <li class="<?php if($this->uri->segment(2)==$this->global_function->show_config_language('lang_contact_us', $lang,'url')) echo 'active'?>">
        <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_contact_us', $lang,'url')) ?>">
            <?php echo $this->global_function->show_config_language('lang_contact_us', $lang) ?>
        </a>
    </li>
</ul>