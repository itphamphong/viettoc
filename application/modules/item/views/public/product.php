<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top')?>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php $this->load->view('front/block/breadcrumb',$breadcrumb)?>
        <div class="clear h2"></div>
        <?php $this->load->view('menu_left',array('urlp'=>$this->uri->segment(2),'urlc'=>$category->category_link))?>
        <div id="col-right" class="col-sm-9  col-xs-12">
            <div class="title"><?php echo $category->category_name?> <a href="<?php echo site_url($lang."/cart")?>" class="text-cart pull-right"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                    <?php if($this->cart->total_items() >0){ ?><i id="num-cart">(<?php echo $this->cart->total_items();?>)</i><?php }?></a></div>
            <?php foreach($list_product as $p){
                if ($p->choose_upload == 1) {
                    $src = base_url() . "uploads/Images/product/" . $p->picture;
                } else if ($p->choose_upload == 2) {
                    $src = base_url() . $p->picture;
                } else $src = '';
                ?>
                <div class="col-sm-4  col-xs-6 col-sml-12 i-item">
                    <a  class="info" href="<?php echo site_url($lang."/".$this->uri->segment(2)."/".$category->category_link."/".$p->item_link)?>">
                        <div class="r-img">
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
                                <div class="col-sm-12 price"><?php echo $this->global_function->get_price($p->price) ?></div>
                            <?php }?>
                        </div>
                    </a>
                    <div class="i-btn btn-cart" onclick="AddCartAjax(this)" data-id="<?php echo $p->id?>" data-url="<?php echo site_url('add-cart')?>"> <i class="fa  fa-shopping-cart"></i> Giỏ hàng</div>
                    <a class="i-btn btn-view pull-right" href="<?php echo site_url($lang."/".$this->uri->segment(2)."/".$category->category_link."/".$p->item_link)?>"> <i class="fa fa-sign-in"></i> Chi tiết</a>
                </div>
            <?php }?>
        </div>
    </div>
</div>