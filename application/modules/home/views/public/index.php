<!--run on smartphone-->
<section id="pav-mainnav" class="hidden-lg hidden-md">
    <div class="container">
        <div class="mainnav-wrap">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 row-offcanvas row-offcanvas-left" style="z-index:1000;">
                    <div class="ui-toggle">
                        <p class="pull-left">
                            <a href="javascript:" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        </p></div>

                    <div class="col-xs-10 col-sm-10 sidebar-offcanvas" id="sidebar" style="z-index:1000;">
                        <div class="list-group"><a href="#" class="list-group-item">Apple Store</a><a href="#" class="list-group-item">Đồng hồ thông minh</a><a href="#"
                                                                                                                                                                class="list-group-item">Vòng
                                đeo sức khỏe</a><a href="#" class="list-group-item">Âm thanh</a><a href="#" class="list-group-item">Thiết bị thể thao</a><a href="#"
                                                                                                                                                            class="list-group-item">Đồ
                                chơi hi-tech</a><a href="#" class="list-group-item">Thời trang</a><a href="#" class="list-group-item">Phụ kiện</a><a href="#"
                                                                                                                                                     class="list-group-item">Hàng đã
                                qua sử dụng</a></div>
                    </div><!--/.sidebar-offcanvas-->

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="z-index:10">
                    <div id="search" class="pull-right">
                        <form id="search-form" action="" method="get">
                            <input type="text" name="q" placeholder="Tìm kiếm">
                            <input type="submit" class="button-search" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--run on smartphone--><!--end logo & search-->
<?php
$CI =& get_instance();
$CI->load->model('category/a_category');
$list_cate = $CI->a_category->show_list_category_where(array('category.category_status' => 1));
?>
<section>
    <div class=" default_width">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <ul class="ui-menu-categories">
                        <li>DANH MỤC SẢN PHẨM<i class="fa fa-bars"></i></li>
                        <?php foreach ($list_cate as $cate) {
                            if ($cate->choose_upload == 1) {
                                $src = base_url() . "uploads/Images/product/" . $cate->picture;
                            } else if ($cate->choose_upload == 2) {
                                $src = base_url() . $list->picture;
                            }
                            $list_child = $this->a_category->show_list_category_parent($cate->id);
                            ?>
                            <li class="h">
                                <span>
                                    <img src="<?php echo $src ?>">
                                </span>
                                <a href="<?php echo $cate->category_link ?>">
                                    <?php echo $cate->category_name ?><i class="fa fa-angle-right hidden-xs"></i>
                                </a>
                                <?php if (count($list_child)) { ?>
                                    <ul>
                                        <?php foreach ($list_child as $child) {
                                            if ($child->choose_upload == 1) {
                                                $src_child = base_url() . "uploads/Images/product/" . $child->picture;
                                            } else if ($child->choose_upload == 2) {
                                                $src_child = base_url() . $child->picture;
                                            }
                                            ?>
                                            <li>
                                                <span><img src="<?php echo $src_child ?>"></span>
                                                <a href=""><?php echo $child->category_name ?><i class="hidden-xs"></i>
                                                </a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="ui-policy">
                        <a target="_blank" href="#" class="si nth1">Giao toàn Quốc</a>
                        <a target="_blank" href="#" class="si nth2">Miễn phí vận chuyển</a>
                        <a target="_blank" href="#" class="si nth3">Miễn phí cà thẻ VISA, MASTER, ATM</a>
                    </div>
                    <?php echo modules::run('banner/Banner/Top', $lang) ?>
                </div>
            </div>
        </div>
    </div>
</section>
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
    $list_child = $this->a_category->show_list_category_parent($cate->id);
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