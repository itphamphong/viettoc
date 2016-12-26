<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top')?>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php $this->load->view('front/block/breadcrumb',$breadcrumb)?>
        <div class="clear h2"></div>
        <div id="col-right" class="col-xs-12">
            <div class="title"><?php echo "Promotion"?></div>
            <?php foreach($list as $p){
                if ($p->choose_upload == 1) {
                    $src = base_url() . "uploads/Images/product/" . $p->picture;
                } else if ($p->choose_upload == 2) {
                    $src = base_url() . $p->picture;
                } else $src = '';
                $cate=$this->a_item->show_detail_item_cate(array('item_id'=>$p->id),$lang);
                $parent=$this->a_category->show_list_category_parent((isset($cate->id)?$cate->id:0),$lang);
                if(isset($parent->category_link)){
                    ?>
                    <div class="col-sm-3  col-xs-6 col-sml-12 i-item">
                        <a  class="info" href="<?php echo site_url($lang."/".$parent->category_link."/".$cate->category_link."/".$p->item_link)?>">
                            <div class="r-img i-cate">
                                <img src="<?php echo $src;?>"  onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';">
                            </div>
                            <div class="top"></div>
                            <div class="pname">
                                <?php echo $p->item_name?>
                            </div>
                            <div class="bottom"></div>
                            <div class="pname">
                                <?php if($p->value>0){?>
                                    <div class="col-sm-6 col-xs-12 value"><?php echo $this->global_function->get_price($p->value) ?></div>
                                    <div class="col-sm-6 col-xs-12 price"><?php echo $this->global_function->get_price($p->price) ?></div>
                                <?php }else{?>
                                    <div class="col-sm-12"><?php echo $this->global_function->get_price($p->price) ?></div>
                                <?php }?>
                            </div>
                        </a>
                        <div class="i-btn btn-cart" onclick="AddCartAjax(this)" data-id="<?php echo $p->id?>" data-url="<?php echo site_url('add-cart')?>"> <i class="fa  fa-shopping-cart"></i> Giỏ hàng</div>
                        <a class="i-btn btn-view pull-right" href="<?php echo site_url($lang."/".$parent->category_link."/".$cate->category_link."/".$p->item_link)?>"> <i class="fa fa-sign-in"></i> Chi tiết</a>
                    </div>
                <?php }}?>
        </div>
    </div>
</div>