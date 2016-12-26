<!DOCTYPE html>
<?php
$logo = $this->global_function->get_img_company('logo');
$favicon = $this->global_function->get_img_company('favicon');
$info = $this->global_function->show_company($lang);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- CSS Style -->
    <link href="<?php echo base_url() ?>themes/front/css/style.css" rel="stylesheet">
    <!-- Progress Bar CSS -->
    <link href="<?php echo base_url() ?>themes/front/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>themes/front/css/offcanvas.css" rel="stylesheet">

    <!-- Import Bootstrap core CSS -->
    <link href="<?php echo base_url() ?>themes/front/css/cp-settings.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/ionicons.min.css">
    <link rel="stylesheet" href="http://phanviettoc.com/template/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.css">


    <!-- JavaScript -->
    <script src="<?php echo base_url() ?>themes/front/js/jquery-ui-1.12.1.custom/jquery-migrate.js.download"></script>
    <script src="<?php echo base_url() ?>themes/front/js/jquery-ui-1.12.1.custom/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>themes/front/js/jquery-ui-1.12.1.custom/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>themes/front/js/jquery-ui-1.12.1.custom/offcanvas.js"></script>

    <!-- Carousel -->
    <link href="<?php echo base_url() ?>themes/front/js/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>themes/front/js/owl-carousel/owl.theme.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>themes/front/js/owl-carousel/owl.carousel.js"></script>
    <script src="<?php echo base_url() ?>themes/front/js/owl-carousel/ajax.js"></script>
<script>
    $(document).ready(function(){
        //alert($(window).width());
    })
</script>
</head>

<body>

<!-- Settings Panel -->
<input type="checkbox" name="cp-settings-toggle" id="cp-settings-toggle">
<label class="ion-android-cart" for="cp-settings-toggle">
    <ul class="" ><!-- nav nav-tabs tabs-left -->
        <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-cart-plus"></i><p>Giỏ hàng</p></a></li>
        <li><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i><p>Tài khoản</p></a></li>
        <li><a href="#messages" data-toggle="tab"><i class="fa fa-heart"></i><p>Yêu thích</p></a></li>
        <li><a href="#settings" data-toggle="tab"><i class="fa fa-eye"></i><p>Đã xem</p></a></li>
    </ul>
</label>


<div class="cp-settings-pannel">
    <div class="cp-settings tab-content">
        <div class="tab-pane active" id="home"></div>
        <div class="tab-pane" id="profile"></div>
        <div class="tab-pane" id="messages"></div>
        <div class="tab-pane" id="settings">Settings Tab.</div>
    </div>
</div>
<!-- End Settings Panel -->

<!--START PAGE-->
<div class="gt_wrapper">
<?php
$this->load->view('front/block/header', array('logo' => $logo, 'info' => $info));
?>
<?php echo $content ?>
<?php $this->load->view('front/block/footer',array('info' => $info)) ?>
</body>
</html>
<input type="hidden" id="url-site" value="<?php echo base_url() ?>">
<!--///////////////////////////////////////////////////////////////////////////////////////////////////
//
//		Scripts
//
///////////////////////////////////////////////////////////////////////////////////////////////////-->
<script type='text/javascript' src='<?php echo base_url() ?>themes/front/js/camera/scripts/jquery.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>themes/front/js/camera/scripts/jquery.mobile.customized.min.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>themes/front/js/camera/scripts/jquery.easing.1.3.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>themes/front/js/camera/scripts/camera.min.js'></script>
<script>
    jQuery(function () {

        jQuery('#camera_wrap_home').camera({
            height: '560px',
            loader: 'none',
            pagination: false,
            navigation: false,
            hover: false,
            opacityOnGrid: false,
        });

    });
</script>