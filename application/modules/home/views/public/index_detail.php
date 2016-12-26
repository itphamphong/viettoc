<ul id="navigationMenu">
    <li class="active">
        <a class="home" href="http://lavamedia.com.vn/">
            <i class="fa fa-home"></i>
            <span>TRANG CHỦ</span>
        </a>
    </li>
    <li>
        <a class="portfolio" href="http://lavamedia.com.vn/tin-tuc.html">
            <i class="fa   fa-share-alt"></i>
            <span>SẢN PHẨM</span>
        </a>
    </li>
    <li>
        <a class="portfolio" href="#">
            <i class="fa  fa-gg"></i>
            <span>LIÊN HỆ</span>
        </a>
    </li>
    <li>
        <a class="contact" href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>GIỎ HÀNG</span>
        </a>
    </li>
</ul>
<div id="header">
    <div class="container">
        <div class="col-xs-3" id="logo">
            <img src="<?php echo base_url() ?>themes/front/images/logo.png">
        </div>
        <div class="col-xs-9">
            <ul id="menu-top-right">
                <li><a href="#">Hotline: 0937 33 44 11</a></li>
                <li><a href="#"> Video Library</a></li>
                <li><a href="#">Resource Library</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
            <div class="clear"></div>
            <ul id="menu-language">
                <li><a class="active" href="#"> <img src="<?php echo base_url() ?>themes/front/images/en.png"></a></li>
                <li><a href="#"> <img src="<?php echo base_url() ?>themes/front/images/vn.png"></a></li>
            </ul>
            <div id="menu-search">
                <label class="text-right">Search:</label>
                <div class="round-input-search">
                    <span><i class="fa  fa-search"></i></span>
                    <input type="text">
                </div>

            </div>
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
<div id="content">
    <div class="container">
        <ul id="breadcrumb">
            <li><a href="#">Trang chủ</a> <i class="fa fa-angle-right "></i></li>
            <li><a href="#">Thiết bị nhà hàng & khách sạn </a> <i class=" fa fa-angle-right "></i></li>
            <li><a href="#">Máy làm đá</a></li>
        </ul>
        <div class="clear h2"></div>
        <div id="col-left" class="col-xs-3">
            <div class="title">
                MÔ HÌNH KINH DOANH
            </div>
            <div class="box">
                <ul>
                    <li class="active" c><a href="#"> <i class="fa fa-gg"></i> Nhà hàng - khách sạn</a></li>
                    <li><a href="#"><i class="fa fa-gg"></i> Nhà hàng - khách sạn</a></li>
                    <li><a href="#"><i class="fa fa-gg"></i> Nhà hàng - khách sạn</a></li>
                </ul>
            </div>
            <div class="clear "></div>
            <div class="title">
                SẢN PHẨM
            </div>
            <div class="box">
                <ul>
                    <li class="active" c><a href="#"> <i class="fa   fa-share-alt-square"></i> Nhà hàng - khách sạn</a></li>
                    <li><a href="#"><i class="fa   fa-share-alt-square"></i> Nhà hàng - khách sạn</a></li>
                    <li><a href="#"><i class="fa   fa-share-alt-square"></i> Nhà hàng - khách sạn</a></li>
                </ul>
            </div>
            <div class="clear "></div>
            <div class="title">
                THƯƠNG HIỆU
            </div>
            <div class="box">
                <ul>
                    <li class="active" c><a href="#"> <i class="fa   fa-share-alt-square"></i> Nhà hàng - khách sạn</a></li>
                    <li><a href="#"><i class="fa   fa-share-alt-square"></i> Nhà hàng - khách sạn</a></li>
                    <li><a href="#"><i class="fa   fa-share-alt-square"></i> Nhà hàng - khách sạn</a></li>
                </ul>
            </div>
            <div class="clear "></div>
            <div class="title">
                TÌM KIẾM NHIỀU NHẤT
            </div>
            <ul class="list-tags">
                <li><a href="#">dessert</a> | </li>
                <li><a href="#">kitchen tools</a> |</li>
            </ul>
        </div>
        <div id="col-right" class="col-xs-9 item-detail">
            <div class="title"> <span class="text-cart pull-right"><i class="fa fa-shopping-cart"></i> Giỏ hàng</span></div>
            <div class="col-xs-6">
                <div class="slide-img">
                    <div class="feature-img">
                        <?php
                        for ($i=1;$i<3;$i++) {
                            ?>
                            <div class="item">
                                <a  rel="group1" class="group" href="<?php echo base_url() ?>themes/front/images/<?php echo $i?>.jpg"><img class="img-responsive" src="<?php echo base_url() ?>themes/front/images/a_03.jpg" alt="" width="340" height="340"></a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="slide-item">
                        <?php
                        for ($i=0;$i<10;$i++) {
                            ?>
                            <div class="item">
                                <div class="col-xs-12">
                                    <img  class="img-responsive" src="<?php echo base_url() ?>themes/front/images/a_03.jpg" alt="">
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 ">
                <h1 class="title">Scotsman CU50PA-1 Undercounter Top Hat Ice Maker</h1>
                <p class="text-info">
                    Xuất xứ: Mỹ <br/>
                    Điện áp: 3 ph/220 V/50 Hz<br/>
                    Kích thước: 820 x 520 x 1460 mm<br/>
                    Tình trạng: Còn hàng<br/>
                </p>
                <div class="round-cart">
                    <input type="text" value="1">
                    <i class="fa fa-caret-square-o-up"></i>
                    <i class="fa fa-caret-square-o-down"></i>
                </div>
                <div class="i-btn btn-cart"> <i class="fa  fa-shopping-cart"></i> Giỏ hàng</div>
                <div class="clear"></div>
                <p>Vui lòng liên hệ với chúng tôi để biết thêm thông tin chi tiết về sản phẩm</p>
                <div class="clear"></div>
                <img src="<?php echo base_url() ?>themes/front/images/l7.png" class="center-block">
            </div>
            <div class="clear"></div>
            <div class="title-tab">OVERVIEW</div>
        </div>
    </div>
</div>
<div id="footer">
    <div class="container">
        <p class="title">CÔNG TY CỔ PHẦN THƯƠNG MẠI VÀ CÔNG NGHỆ THỰC </p>
        <div class="col-xs-6">
            Trụ sở chính<br>
            Đ/c: Tầng 11, Tòa nhà SUDICO, Đường Mễ Trì, P. Mỹ Đình 1,<br>
            Q. Nam Từ Liêm, Hà Nội, Việt Nam<br>
            Điện thoại: 04 35 377 010/011 - Fax: 04 35 377 009
            <ul id="menu-social-footer">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa  fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube-play "></i></a></li>
            </ul>
        </div>
        <div class="col-xs-6">
            <div class="col-xs-6 i-support">
                <img src="<?php echo base_url() ?>themes/front/images/i-skype.png">
                <span class="">Nguyên liệu <br>
                08 6258 7700</span>
            </div>
            <div class="col-xs-6 i-support">
                <img src="<?php echo base_url() ?>themes/front/images/i-skype.png">
                <span class="">Máy móc <br>
                08 6258 7700</span>
            </div>
            <div class="col-xs-6 i-support">
                <img src="<?php echo base_url() ?>themes/front/images/i-skype.png">
                <span class="">Kỹ thuật <br>
                08 6258 7700</span>
            </div>
            <div class="col-xs-6 i-support">
                <img src="<?php echo base_url() ?>themes/front/images/i-skype.png">
                <span class="">Kế toán <br>
                08 6258 7700</span>
            </div>
        </div>
    </div>
</div>
<div id="copyright">
    <div class="container">
        <div class="text-copy">© Copyright FBS 2016. All rights reserved.</div>
        <a class="i-lava" href="http://www.lavaweb.vn/" target="_blank">
            <img src="<?php echo base_url()?>themes/front/images/logo-lava.png" alt=""/>
                <span>Designed and Developed by<br>
                096 888 77 00 - lavaweb.vn</span>

        </a>
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