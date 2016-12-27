<?php $this->load->view('front/block/menu_top',array('home'=>'page-menu'))?>
<?php
$category = $this->a_item->show_detail_item_cate(array('item_id' => $detail->id, "category_top !=" => 0), $lang);
$parent = $this->a_category->show_detail_category_where(array('category_id' => $category->category_top), $lang);
?>
<div class="default_width">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="breadcrumb">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_url()?>">Trang chủ</a></li>
                        <li><a href="<?php echo site_url($parent->category_link)?>"><?php echo $parent->category_name?></a></li>
                        <li><a href="<?php echo site_url($parent->category_link."/".$category->category_link)?>"><?php echo $category->category_name?></a></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <header class="prod-detail-title col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h1><?php echo $detail->item_name?></h1>
            </header>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-9 col-xs-9">

                        <div id="sync1" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                            <?php
                            foreach ($list_images as $list) {
                                ?>
                                <div class="item"><img src="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>" alt=""></div>
                            <?php } ?>
                        </div>
                        <div id="sync2" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
                            <?php
                            foreach ($list_images as $list) {
                                ?>
                                <div class="item"><img src="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>" alt=""></div>
                            <?php } ?>
                        </div>
                    </div>
                    <!--end sync-->


                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3">
                        <section class="prod-code prod-bt">
                            Mã sản phẩm: <label> <?php echo $detail->item_code?></label>
                        </section>
                        <section class="prod-price prod-bt"><p class="price"><?php echo $this->global_function->get_price($detail->price) ?></p></section>
                        <!--<section id="pro-colr" class="prod-color"> <span class="order-step">1</span><span> <strong>Chọn màu</strong></span><div class="attr"><span>Bạn vui lòng chọn màu sắc <i class="close">X</i>
                        <ul class="color" id="ui_product_style">--><!--</ul></span></div>
						</section>-->
                        <section id="quality-box" class="fea-row">
                            <!--<span class="order-step">2</span>--><span> <strong>Số lượng</strong></span>
                            <select id="quantity" class="inp quali-val">
                                <?php for($i=1;$i<10;$i++){?>
                                <option value="<?php echo $i?>"><?php echo $i?></option>
                               <?php }?>
                            </select>
                        </section>
                        <section>
                            <span class="cart">
                            <a id="addToCart" class="btnCart btn btn-danger my-cart-btn" data-id="<?php echo $detail->id?>" onclick="AddCartDetail(this)" data-url="<?php echo site_url('add-cart')?>" data-cart="<?php echo site_url('cart')?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Mua
                                ngay </a>
                            </span>
                        </section>
                        <section class="highlight">
                            <div id="highlight"></div>
                        </section>
                    </div><!--end col-3-->
                </div>
            </div><!--end col-9-->
        </div><!--end div row-->
        <div class="row">
            <div id="exTab2" class="container">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#1" data-toggle="tab">ĐẶC ĐIỂM NỔI BẬT</a>
                    </li>
                    <li>
                        <a href="#2" data-toggle="tab">THÔNG SỐ</a>
                    </li>
                    <li>
                        <a href="#3" data-toggle="tab">VIDEO</a>
                    </li>
                </ul>
                <div class="tab-content ">
                    <div class="tab-pane active" id="1">
                        Đặc điểm nổi bật1
                    </div>
                    <div class="tab-pane" id="2">
                        Thông số
                    </div>
                    <div class="tab-pane" id="3">
                        Video
                    </div>
                </div>
            </div><!--end ExTb-->
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <!--code block here-->
    </div>
</div><!--row-->
<div style="clear: both"></div>