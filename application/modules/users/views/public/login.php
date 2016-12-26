<div class="col-center" id="tutor-singin">
    <div class="clear hg1"></div>
    <div id="form-signin-location">
        <p class="p-title"><?php echo $this->global_function->show_config_language('lang_required_login', $lang) ?></p>
        <hr>
        <div class="clear hg1"></div>
        <form action="" method="post">
            <?php if (!empty($msg)) { ?>
                <p class="bg-warning col-xs-12 pad1"><?php echo $msg ?></p>
            <?php } ?>
            <div class="col-left-blogin">
                <div class="form-group">
                    <input type="text" class="text-input" placeholder="User name" name="user_name">
                    <?php echo form_error('user_name') ?>
                </div>
                <div class="clear hg1"></div>
                <div class="form-group">
                    <input type="password" class="text-input " name="password"
                           placeholder="<?php echo $this->global_function->show_config_language('lang_password', $lang) ?>">
                    <?php echo form_error('password') ?>
                </div>
                <div class="clear hg1"></div>
                <div class="form-group">
                    <a class="i-btn btn-continue" onclick="$('#btn-singup').trigger('click')"><?php echo $title ?></a>
                    <div class="clear hg1"></div>
                    <p><i class="fa  fa-sign-in"></i><?php echo $this->global_function->show_config_language('lang_required_register', $lang) ?><a class="link-btn-signup" href="<?php echo site_url($lang."/singup")?>">&nbsp;tại đây</a></p>
                    <input type="submit" class="hide" name="ok" id="btn-singup">
                </div>
            </div>
            <div class="col-right-login">
                <div class="i-btn btn-face"><i class="fa fa-facebook"></i><?php echo $this->global_function->show_config_language('lang_sign_in_with_facebook', $lang) ?></div>
                <div class="clear hg1"></div>
                <div class="i-btn btn-google"><i class="fa fa-google-plus"></i> <?php echo $this->global_function->show_config_language('lang_sign_in_with_google', $lang) ?></div>
            </div>
    </div>
</div>