<?php
$list_cate=$this->a_item->show_list_category_where(array("category.category_type" =>1, 'category.category_status' => '1'),$lang);
$category=$this->a_category->show_detail_category_where(array("category_link"=>$urlp,'category_type'=>1),$lang);
if(isset($category->id)){
    $list_cate_child = $this->a_category->show_list_category_page(array("category_parent.parent_id" => isset($category->id)?$category->id:0, "category_status" => 1), $lang, 0);
}else{
    $list_cate_child = $this->a_category->show_list_category_page(array("category_status" => 1), $lang, 0);

}
$list_brand=$this->a_item->show_list_category_where(array("category.category_type" =>3, 'category.category_status' => '1'),$lang);

$CI=&get_instance();
$CI->load->model("tags/a_tags");
$list_tag=$CI->a_tags->show_list_tags_where(array("tags.status"=>1),1,1,$lang,0);
?>
<div id="col-left" class="col-xs-3">
    <div class="title">
        <?php echo $this->global_function->show_config_language('lang_model', $lang) ?>
    </div>
    <div class="box">
        <ul>
            <?php foreach($list_cate as $cate){?>
            <li class="<?php if($urlp==$cate->category_link) echo 'active'?>"><a href="<?php echo site_url($lang."/".$cate->category_link)?>"> <i class="fa fa-gg"></i><?php echo $cate->category_name?></a></li>
          <?php }?>
        </ul>
    </div>
    <div class="clear "></div>
    <div class="title">
        <?php echo $this->global_function->show_config_language('lang_product', $lang) ?>
    </div>
    <div class="box box-two">
        <ul>
            <?php foreach($list_cate_child as $child){?>
            <li class="<?php if($child->category_link==$urlc) echo 'active'?>"><a href="<?php echo site_url($lang."/".$urlp."/".$child->category_link)?>"> <i class="fa   fa-share-alt-square"></i><?php echo $child->category_name?></a></li>
           <?php }?>
        </ul>
    </div>
    <div class="clear "></div>
    <div class="title">
        <?php echo $this->global_function->show_config_language('lang_brand', $lang) ?>
    </div>
    <div class="box box-two">
        <ul>
            <?php foreach($list_brand as $brand){?>
            <li class=""><a href="<?php echo site_url($lang."/".$urlp."/".$brand->category_link)?>"> <i class="fa   fa-share-alt-square"></i> <?php echo $brand->category_name?></a></li>
           <?php }?>
        </ul>
    </div>
    <div class="clear "></div>

    <?php if(!empty($list)){?>
        <div class="title">
            <?php echo $this->global_function->show_config_language('lang_product_h', $lang) ?>
        </div>
        <div class="clear "></div>
    <div id="col-right">
    <?php foreach($list as $p){
        if ($p->choose_upload == 1) {
            $src = base_url() . "uploads/Images/product/" . $p->picture;
        } else if ($p->choose_upload == 2) {
            $src = base_url() . $p->picture;
        } else $src = '';
        ?>
        <div class="i-item">
            <div class="r-img">
            <img src="<?php echo $src;?>"  onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';">
            </div>
                <a  class="info" href="<?php echo site_url($lang."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$p->item_link)?>">
                <div class="top"></div>
                <?php echo $p->item_name?>
                <div class="bottom"></div>
            </a>
            <div class="i-btn btn-cart" onclick="AddCartAjax(this)" data-id="<?php echo $p->id?>" data-url="<?php echo site_url('add-cart')?>"> <i class="fa  fa-shopping-cart"></i> Giỏ hàng</div>

            <a class="i-btn btn-view pull-right" href="<?php echo site_url($lang."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$p->item_link)?>"> <i class="fa fa-sign-in"></i> Chi tiết</a>
        </div>
        <div class="clear" style="margin-bottom:20px"></div>
    <?php }?>
    </div>
    <?php }?>
    <div class="clear "></div>
    <div class="title">
        <?php echo $this->global_function->show_config_language('lang_most_tag', $lang) ?>
    </div>
    <ul class="list-tags">
        <?php foreach($list_tag as $tag){

            ?>
        <li>
            <?php if(!empty($tag->tags_link)){?>
            <a href="<?php echo $tag->tags_link?>"><?php echo $tag->name?></a>
            <?php }else{?>
                <a ><?php echo $tag->name?></a>
            <?php }?>
            | </li>
        <?php }?>
    </ul>
</div>