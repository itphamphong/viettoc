<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top')?>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php $this->load->view('front/block/breadcrumb',$breadcrumb)?>
        <div class="clear h2"></div>
        <?php $this->load->view('menu_left',array('urlp'=>$this->uri->segment(2),'urlc'=>$this->uri->segment(3),'list'=>$list_hot))?>
        <div id="col-right" class="col-sm-9 col-xs-12 item-detail">
            <div class="title"> <a href="<?php echo site_url($lang."/cart")?>" class="text-cart pull-right"><i class="fa fa-shopping-cart"></i> Giỏ hàng
                    <?php if($this->cart->total_items() >0){ ?><i id="num-cart">(<?php echo $this->cart->total_items();?>)</i><?php }?></a></div>
            <div class="col-sm-6 col-xs-12 text-center pad0">
                <div class="slide-img">
                    <div class="feature-img">
                        <?php
                        foreach ($list_images as $list) {
                            ?>
                            <div class="item">
                                <a  rel="group1" class="group" href="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>">
                                    <div class="round-img" style="background: url('<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>')">

                                    </div>
                                    <img class="parent img-responsive" src="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>" alt="" style="display: none">
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="slide-item">
                        <?php
                        foreach ($list_images as $list) {
                            ?>
                            <div class="item">
                                <div class="col-xs-12"  style="padding-left: 0px">
                                    <img  class="img-responsive" src="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>" alt="" width="113">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12 ">
                <h1 class="title text-right"><?php echo $detail->item_name?></h1>
                <div class="pull-right">
                <?php $this->load->view('front/block/social')?>
                </div>
                <div  class="clear h1"></div>
                <div class="pname_detail text-left row">
                    <?php if($detail->value>0){?>
                        <div class="col-xs-12 value"><?php echo $this->global_function->get_price($detail->value) ?></div>
                        <div class="col-xs-12 price"><?php echo $this->global_function->get_price($detail->price) ?></div>
                    <?php }else{?>
                        <div class="col-sm-12"><?php echo $this->global_function->get_price($detail->price) ?></div>
                    <?php }?>
                </div>
                <p class="text-info">
                  <?php echo nl2br($detail->item_summary)?>
                    </p>
                    Tình trạng: <?php if($detail->number >0) echo 'Còn hàng';else echo 'Hết hàng'?><br/>
                <div class="round-cart rquantity">
                    <input type="text" value="1" class="quantity" id="quantity">
                    <i class="fa fa-caret-square-o-up button" data="1" onclick="ButtonQuantity(this)"></i>
                    <i class="fa fa-caret-square-o-down button" data="0" onclick="ButtonQuantity(this)"></i>
                </div>
                <div class="i-btn i-btn-detail btn-cart" data-id="<?php echo $detail->id?>" onclick="AddCartDetail(this)" data-url="<?php echo site_url('add-cart')?>" data-cart="<?php echo site_url($lang.'/cart')?>">
                    <i class="fa  fa-shopping-cart"></i> Giỏ hàng</div>
                <div class="clear"></div>
                <p>Vui lòng liên hệ với chúng tôi để biết thêm thông tin chi tiết về sản phẩm</p>
                <div class="clear"></div>
                <?php
                $src='';
                if(isset($brand->id)){
                    if ($brand->choose_upload == 1) {
                        $src = base_url() . "uploads/Images/product/" . $brand->picture;
                    } else if ($brand->choose_upload == 2) {
                        $src = base_url() . $brand->picture;
                    } else $src='';
                }
                ?>
                <div class="r-img">
                    <img src="<?php echo $src;?>" class="center-block">
                </div>

            </div>
            <div class="clear"></div>
            <div class="title-tab"><?php echo $this->global_function->show_config_language('lang_overview', $lang) ?></div>
            <?php echo $detail->item_description?>
            <div class="clear"></div>
            <div class="title-tab"><?php echo $this->global_function->show_config_language('lang_specification', $lang) ?></div>
            <?php
            $list_doc=$this->global_function->list_tableWhere(array('item_id'=>$detail->id),'item_doc');
            foreach($list_doc as $doc){
            ?>
                <p> <a  class="doc" href="<?php echo base_url()."uploads/Images/doc/".$doc->doc_file ?>"><?php echo $doc->doc_name?> <i class="fa fa-file-archive-o"></i></a></p>
            <?php }?>
            <div class="clear"></div>
            <div class="title-tab"><?php echo $this->global_function->show_config_language('lang_other_products', $lang) ?></div>
            <div class="clear h1"></div>
            <?php foreach($list_other_product as $p){
                if ($p->choose_upload == 1) {
                    $src = base_url() . "uploads/Images/product/" . $p->picture;
                } else if ($p->choose_upload == 2) {
                    $src = base_url() . $p->picture;
                } else $src = '';
                ?>
                <div class="col-sm-4  col-xs-6 col-sml-12 i-item">
                    <div class="r-img">
                    <img src="<?php echo $src;?>"  onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';">
                        </div>
                    <a  class="info" href="<?php echo site_url($lang."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$p->item_link)?>">
                        <div class="top"></div>
                        <div class="pname">
                            <?php echo $p->item_name?>
                        </div>
                        <div class="bottom"></div>
                    </a>
                    <div class="i-btn btn-cart" onclick="AddCartAjax(this)" data-id="<?php echo $p->id?>" data-url="<?php echo site_url('add-cart')?>"> <i class="fa  fa-shopping-cart"></i> Giỏ hàng</div>

                    <a class="i-btn btn-view pull-right" href="<?php echo site_url($lang."/".$this->uri->segment(2)."/".$this->uri->segment(3)."/".$p->item_link)?>"> <i class="fa fa-sign-in"></i> Chi tiết</a>
                </div>
            <?php }?>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/owl-carousel/owl.carousel.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>themes/front/js/owl-carousel/owl.carousel.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>themes/front/js/owl-carousel/owl.theme.css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>themes/front/js/owl-carousel/owl.transitions.css"/>
<script>
    $(document).ready(function(){
        Slide_detail_product();
        $("a.group").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	600,
            'speedOut'		:	200,
            'overlayShow'	:	false
        });
    });
</script>