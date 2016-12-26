<div class="col-center" id="tutor-singin">
    <div class="clear hg1"></div>
    <ul id="nav-breadcrumb">
        <li><a href="<?php echo site_url() ?>">  <?php echo $this->global_function->show_config_language('lang_home', $lang) ?></a><i class="fa fa-angle-right "></i></li>
        <li>
            <a class="last">
                <?php echo $this->global_function->show_config_language('lang_account_manager', $lang) ?>
            </a>
        </li>
        <li class="fright"><a href="<?php echo site_url($lang."/my-info")?>"><i class="fa fa-arrow-circle-o-left"></i> <?php echo $this->global_function->show_config_language('lang_back', $lang) ?></a></li>


    </ul>
    <div class="clear hg1"></div>

    <div id="form-signin-location">
        <div class="users-col-left">
            <?php $this->load->view('users/public/block_col_left', array('user' => $user,'left_active'=>'change_password')) ?>
        </div>
        <div class="users-col-right">
            <div class="round-tutor" id="load-round-page">
                <?php if(!empty($msg)){?>
                    <div class="bg-success"><?php echo $msg?></div>
                <?php }?>

                <form action="" method="post">
                    <div class="round-input">
                        <span><i class="fa  fa-key "></i></span>
                        <input type="text" name="old_password"  placeholder="<?php echo $this->global_function->show_config_language('lang_old_password', $lang) ?>">
                    </div>
                    <div class="clear"></div>
                    <p><?php echo form_error('old_password')?></p>
                    <div class="clear"></div>
                    <div class="round-input">
                        <span><i class="fa  fa-key "></i></span>
                        <input type="text" name="new_password"  placeholder="<?php echo $this->global_function->show_config_language('lang_password', $lang) ?>">
                    </div>
                    <div class="clear"></div>
                    <p><?php echo form_error('new_password')?></p>
                    <div class="clear"></div>
                    <div class="round-input">
                        <span><i class="fa  fa-key "></i></span>
                        <input type="text" name="re_password"  placeholder="<?php echo $this->global_function->show_config_language('lang_confirm_password', $lang) ?>">
                    </div>
                    <div class="clear"></div>
                    <p><?php echo form_error('re_password')?></p>
                    <input type="submit" id="btn-submit-f-myinfo" name="ok" style="display: none">
                </form>
            </div>
            <div class="clear hg1"></div>

            <div class="i-btn btn-save-change fleft"  onclick="$('#btn-submit-f-myinfo').trigger('click')"><i class="fa  fa-plus"></i><?php echo $this->global_function->show_config_language('lang_update', $lang) ?></div>

        </div>
    </div>
</div>