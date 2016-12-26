<div class="col-center" id="tutor-singin">
    <div class="clear hg1"></div>
    <div id="form-signin-location">
        <div class="users-col-left">
            <?php $this->load->view('users/public/block_col_left',array('user'=>$user)) ?>
        </div>
        <div class="users-col-right">
            <form action="" method="post" enctype="multipart/form-data">
                <?php if (!empty($msg)) { ?>
                    <p class="bg-warning col-xs-12 pad1"><?php echo $msg ?></p>
                <?php } ?>
                <div class="col-xs-6 center-block" style="float: none">
                    <div class="form-group">
                        <input type="text" class="text-input large-input" placeholder="Full name" name="full_name" value="<?php echo $user->full_name ?>">
                        <?php echo form_error('full_name') ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="text-input large-input" placeholder="User name" name="user_name" value="<?php echo $user->user_name ?>">
                        <div class="clear hg1"></div>
                        <?php echo form_error('user_name') ?>
                    </div>
                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <input type="text" class="text-input large-input" placeholder="Email" name="email" value="<?php echo $user->email ?>">
                        <?php echo form_error('email') ?>
                    </div>
                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <input type="password" class="text-input large-input" name="password"
                               placeholder="<?php echo $this->global_function->show_config_language('lang_password', $lang) ?>">
                        <?php echo form_error('password') ?>
                    </div>
                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <input type="text" class="text-input large-input" value="<?php echo $user->cell_phone ?>" name="phone"
                               placeholder="<?php echo $this->global_function->show_config_language('lang_phone', $lang) ?>">
                        <?php echo form_error('phone') ?>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $this->session->userdata("user")->id?>">
                    <input type="hidden" name="lang_id" value="<?php echo $lang ?>">
                    <div class="clear hg1"></div>
                    <label>Avatar</label>
                    <img src="<?php echo base_url() ?>uploads/Images/users/<?php echo $user->avatar ?>" width="100">
                    <div class="clear hg1"></div>
                    <input type="file" name="img">
                    <input type="hidden" value="<?php echo $user->avatar ?>" name="old_img">
                    <div class="clear hg1"></div>
                    <label>Giới thiệu bản thân</label>
                    <textarea class="text-input no_bg" name="info" style="width: 100%; float: left; height: 500px"><?php echo $user->info ?></textarea>
                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <a class="i-btn btn-continue" onclick="$('#btn-singup').trigger('click')">Cập nhật</a>
                        <input type="submit" class="hide" name="ok" id="btn-singup">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>