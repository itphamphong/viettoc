<div class="col-center" id="tutor-singin">
    <div class="clear hg1"></div>
    <div id="form-signin-location">
        <form action="" method="post">
            <div class="col-left-blogin">
                    <div class="form-group">
                        <input type="text" class="text-input " placeholder="Full Name" name="full_name" value="<?php echo set_value('full_name') ?>">
                        <?php echo form_error('full_name') ?>
                    </div>
                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <input type="text" class="text-input " placeholder="User name" name="user_name" value="<?php echo set_value('user_name') ?>">
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
                        <input type="password" class="text-input " name="confim_pass"
                               placeholder="<?php echo $this->global_function->show_config_language('lang_confim_pass', $lang) ?>">
                        <?php echo form_error('confim_pass') ?>
                    </div>
                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <input type="text" class="text-input " name="phone" value="<?php echo set_value('phone') ?>"
                               placeholder="<?php echo $this->global_function->show_config_language('lang_phone', $lang) ?>">
                        <?php echo form_error('phone') ?>
                    </div>
                    <div class="clear hg1"></div>
                    <select name="buyer_id" class="text-input">
                        <option value="1">Teacher</option>
                        <option value="0">Student</option>
                    </select>
                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <a class="i-btn btn-continue" onclick="$('#btn-singup').trigger('click')">Singup</a>
                        <input type="submit" class="hide" name="ok" id="btn-singup">
                    </div>
            </div>
            <div class="col-right-login">
                <div class="clear hg5"></div>
                <div class="i-btn btn-face"><i class="fa fa-facebook"></i><?php echo $this->global_function->show_config_language('lang_sign_in_with_facebook', $lang) ?></div>
                <div class="clear hg1"></div>
                <div class="i-btn btn-google"><i class="fa fa-google-plus"></i> <?php echo $this->global_function->show_config_language('lang_sign_in_with_google', $lang) ?></div>
            </div>
        </form>
    </div>
</div>