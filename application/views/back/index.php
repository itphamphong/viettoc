<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope="itemscope" itemtype="http://schema.org/NewsArticle">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/reset.css"/>
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/col.css"/>
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/docs.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
    <link href="<?php echo base_url() ?>themes/back/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>themes/back/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>themes/back/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url() ?>themes/back/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
    <!-- BEGIN THEME STYLES -->
    <link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/default.css"/>
    <!-- END THEME STYLES -->
    <script type="application/javascript" src="<?php echo base_url() ?>themes/back/js/jquery-1.8.2.min.js"></script>
    <script type="application/javascript" src="<?php echo base_url() ?>themes/back/js/function.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>editor/ck/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>editor/find/ckfinder.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/back/js/generate_slug.js"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/scripts/custom/components-form-tools.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/back/assets/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/plugins/flot/jquery.flot.categories.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/scripts/core/app.js"></script>
    <script src="<?php echo base_url() ?>themes/back/assets/scripts/custom/ecommerce-index.js"></script>




    <script>
        jQuery(document).ready(function () {
            // initiate layout and plugins
            App.init();
            startTime();
            ComponentsFormTools.init();
        });
    </script>
</head>
<title>Control Panel -Lava Media</title>
<body class="login">
<div class="col_full fleft" id="header">
    <div class="col-xs-12  m_auto">
        <div class="col-xs-2 text-center" style="padding-left: 0px;">
            <a href="<?php echo site_url('admin') ?>">
                <img src="<?php echo base_url() ?>themes/back/images/logo.png" alt=""/>
            </a>
        </div>
        <p class="col-xs-10 pr0">
            <a href="<?php echo site_url('admin') ?>" target="_blank">
                <i class="fa fa-home"></i> Trang chủ &nbsp; &nbsp;&nbsp; &nbsp;
            </a>
            <a href="<?php echo site_url('admin') ?>" target="_blank">
                <i class="fa fa-bell"></i> Thông báo &nbsp; &nbsp;&nbsp; &nbsp;
            </a>
            <a href="<?php echo base_url() ?>admin/change-my-pass" title="" style="color: #fff">
                <i class="fa  fa-user "></i> Tài khoản &nbsp; &nbsp;&nbsp; &nbsp;
            </a>
            <a href="<?php echo site_url('admin') ?>" target="_blank">
                <i class="fa fa-area-chart"></i> Thống kê &nbsp; &nbsp;&nbsp; &nbsp;
            </a>
            <a href="<?php echo site_url() ?>" target="_blank">
                <i class="fa fa-desktop"></i> Xem website &nbsp; &nbsp;&nbsp; &nbsp;
            </a>
            <a href="<?php echo site_url() ?>" target="_blank">
                <i class="fa fa-info-circle"></i> Trợ giúp &nbsp; &nbsp;&nbsp; &nbsp;
            </a>
            <a id="sign-out" href="<?php echo site_url('admin/logout') ?>"><i class="fa fa-sign-out"></i>Thoát</a>
        </p>
    </div>
    <div class="clear h1"></div>
</div>
<input type="hidden" id="link-change-url" value="<?php echo base_url()?>admin/users/url_title"/>
<div class="fleft col-xs-2 col-sm-2 pl0" id="col-left">
    <div class="clear" style="background: #fff"></div>
    <?php $this->load->view("back/inc/menu") ?>
</div>
<div class="fright col-xs-10 col-sm-10" id="r-right">
    <div class="col_full fleft" id="col-right">
        <div class="col-title fleft col_full  nav-breadcrumb"><?php echo isset($breadcrumb) ? $breadcrumb : "" ?> <div
                class="i-lock"><span id="txt"></span><?php echo " - " . date('d-m-Y')?></div></div>
        <div class="clear he1"></div>
        <?php echo $content ?>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<div class="footer">
    <div class="footer-inner col-xs-10">
        2016 © Design by <a href="http://lavaweb.vn/" target="_blank">Lavaweb.vn.</a>
    </div>
    <div class="footer-tools col-xs-2 text-right" style="padding-right: 0px">
        <i class="fa fa-chevron-up pull-right scroll_top" onclick="Sroll()"></i>
    </div>
</div>
<div class="clear"></div>
</body>
</html>
<script type="application/javascript">
    Autoheight();
</script>