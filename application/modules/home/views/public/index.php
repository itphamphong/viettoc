<?php $this->load->view('front/block/menu_top',array('home'=>1))?>
<!--end menu & slide--><!--advertise-->
<section class="gt-2ad">
    <div class=" default_width">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                </div>

            </div>
        </div>
    </div>
</section>
<!--end advertise--> <!--new product-->
<?php echo modules::run('item/item/Hot', $lang) ?>
<!--end new product--><!--advertise-->

<?php foreach ($list_cate as $cate) {
    $list_child = $this->a_category->show_list_category_page(array("category_top" => $cate->id, "category_status" => 1), $lang, 0);
    $params = array(
        'lang' => $lang,
        'status' => 2,
        'category_id' => $cate->id
    );
    $list_item = $this->a_item->show_list_item_params($params);
    ?>
    <section class="gt-2ad">
        <div class=" default_width">
            <div class="container">
                <div class="row">
                    <?php echo modules::run('banner/banner/Line', 1, $cate->id, $lang) ?>
                </div>
            </div>
        </div>
    </section>
    <!--end advertise--><!--new product-->
    <section class="gt-group">
        <div class="default_width">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-h">
                        <?php
                        if ($cate->choose_upload == 1) {
                            $src = base_url() . "uploads/Images/product/" . $cate->picture;
                        } else if ($cate->choose_upload == 2) {
                            $src = base_url() . $list->picture;
                        }
                        ?>
                        <i class="ui-head ui-icon1 nobg"> <img src="<?php echo $src ?>" width="26"></i>
                        <span><?php echo $cate->category_name ?></span>
                        <ul class="ui-h-more">
                            <?php foreach ($list_child as $child) { ?>
                                <li><a href="#"><?php echo $child->category_link ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-gt-block">
                        <?php foreach ($list_item as $item) { ?>
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                                <div class="ui-block">
                                    <div class="ui-img-block">
                                        <?php $this->load->view('front/block/load_picture', array("item" => $item, 'folder' => 'product')); ?>
                                    </div>
                                    <div class="ui-hyperlink">
                                        <a href="#">
                                            <?php echo $item->item_name ?>
                                        </a>
                                    </div>
                                    <div class="ui-price"><?php echo $this->global_function->get_price($item->price) ?> VNĐ</div>
                                    <div class="ui-quick">
                                        <div class="quickview">
                                            <a href="#" class="fa fa-eye"><span>Quick view</span></a>
                                        </div>
                                        <div class="wishlist">
                                            <a href="#" class="fa fa-heart"><span>Wish List</span></a>
                                        </div>
                                        <div class="shoping">
                                            <a class="fa fa-shopping-cart my-cart-btn" ><span>Add cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-lg-12-->
                        <?php } ?>
                    </div><!--end col-lg-12-->
                </div>
            </div>
        </div>
    </section>
    <!--end new product--><!--advertise-->
<?php } ?>
<!--end advertise-->
<section class="gt-warranty">
    <div class="default_width">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 hidden-xs">
                    <h3>Những điều bạn cần biết</h3>
                    <ul class="ui-l-footer">
                        <li><a href="#">Tin tức</a></li>
                        <li><a href="#">Hỗ trợ khách hàng</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 hidden-xs">
                    <div class="fb-like-box"><img src="http://phanviettoc.com/template/img/fblike.JPG"></div>
                    <h3>HỆ THỐNG CỬA HÀNG</h3>
                    <ul class="ui-l-footer">
                        <li><a href="#">24B Hẻm 1358 , Quang Trung , Phường 14 ,<br>Gò Vấp, TP HCM - 0912345678</a></li>
                        <li><a href="#">52/53B Lạc Long Quân , Phường 9 , <br>Tân Bình, TP HCM - 0912345678</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 hidden-xs">
                    <h3>
                        <span>ĐẶT HÀNG ONLINE</span>GIAO HÀNG TẬN NƠI
                    </h3>

                    <ul class="ui-l2-footer">
                        <li><span>1</span>Đổi mới trong vòng 15 ngày nếu sản phẩm bị lỗi do nhà sản xuất</li>
                        <li><span>2</span>Thanh toán trực tiếp hoặc ATM, VISA, MASTER CARD</li>
                    </ul>
                    <div class="f-hotline">
                        <div class="f-hotline-inner">
                            <span class="i-hot"><i class="fa fa-phone"></i></span>
                            <h4>
                                <span>Hà nội</span> 0912 34 56 78
                            </h4>
                        </div>
                    </div>
                    <br>
                    <div class="f-hotline">
                        <div class="f-hotline-inner">
                            <span class="i-hot"><i class="fa fa-phone"></i></span>
                            <h4>
                                <span>TP. HCM</span>0912 34 56 788
                            </h4>
                        </div>
                    </div>

                </div>
            </div><!--end row-->

            <br>
            <nav class="row ui-nav">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Sơ đồ web</a></li>
                        <li><a href="#">Quy định sử dụng</a></li>
                        <li><a href="#">Chính sách bảo hành</a></li>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Hướng dẫn mua hàng từ xa</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                    </ul>
                </div>
            </nav>

        </div>
    </div>
</section>