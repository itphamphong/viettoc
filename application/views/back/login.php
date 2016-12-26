<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/reset.css"/>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/col.css"/>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/bootstrap.min.css"/>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/docs.min.css"/>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url() ?>themes/back/css/default.css"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/font-awesome/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>themes/back/assets/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>themes/back/assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>themes/back/assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
<script type="application/javascript" src="<?php echo base_url() ?>themes/back/js/jquery-1.8.2.min.js"></script>
<!-- BEGIN LOGIN -->
<body class="login">
<div class="logo">
    <a href="index.html">
        <img src="<?php echo base_url() ?>themes/back/images/logo.png" alt="" />
    </a>
</div>
<div class="content">
<!-- BEGIN LOGIN FORM -->
    <form action="<?=site_url('admin/login')?>" method="post" name="admin_login" enctype="application/x-www-form-urlencoded" class="login-form">
    <h3 class="form-title">Login to your account</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
			<span>
				 Enter any username and password.
			</span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="user"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="pass"/>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn green pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
</div>
</body>
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>themes/back/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>themes/back/assets/scripts/custom/login-soft.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        Login.init();
    });
</script>
<!-- END PAGE LEVEL SCRIPTS -->