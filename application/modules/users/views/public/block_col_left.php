<div class="box-search-left fleft col_full">
    <div class="avatar">
        <div class="inline_avatar user-avatar">
        <img src="<?php echo base_url() ?>timthumb.php?src=<?php echo base_url() ?>uploads/Images/users/<?php echo $user->user_name."/".$user->avatar ?>&amp;h=175&amp;w=270&amp;zc=1" width="270" height="175" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';">
        </div>
            <input onchange="return checkup('user-avatar')" type="file" name="img" id="user-avatar" style="display: none">
            <input type="hidden" name="old_img" value="<?php echo $user->avatar?>">
        <i class="fa fa-edit " id="edit-avatar" onclick="$('#user-avatar').trigger('click')"></i>
    </div>
    <p class="name"><?php echo $this->global_function->show_config_language('lang_user_name', $lang).": ".$user->user_name?></p>
    <div style="clear: both"></div>
    <ul class="checkbox box-account">
        <li class="<?php if(isset($left_active) && $left_active=='my-info') echo 'active'?>">
            <a href="<?php echo site_url($lang . "/my-info") ?>"><i class="fa  fa-briefcase"></i><?php echo $this->global_function->show_config_language('lang_profile', $lang)?></a>
        </li>
        <?php if($user->buyer_id==1){?>
        <li  class="<?php if(isset($left_active) && $left_active=='registered-course') echo 'active'?>">
            <a href="<?php echo site_url($lang . "/registered-course") ?>"><i class="fa fa-graduation-cap"></i>
                <?php echo $this->global_function->show_config_language('lang_registered_course', $lang)?>
            </a>
        </li>
        <li  class="<?php if(isset($left_active) && $left_active=='notification') echo 'active'?>">
            <a href="<?php echo site_url($lang . "/notification") ?>"><i class="fa fa-globe"></i>
                <?php echo $this->global_function->show_config_language('lang_notification', $lang)?>
                <span class="count"><?php echo $this->global_function->count_table(array('tutor_id'=>$user->id,'status'=>0),'user_book_tutor_count')?></span>
            </a>
        </li>
        <?php }?>
        <li  class="<?php if(isset($left_active) && $left_active=='change_password') echo 'active'?>">
            <a href="<?php echo site_url($lang . "/change-password") ?>"><i class="fa  fa-key"></i>
                <?php echo $this->global_function->show_config_language('lang_change_password', $lang)?>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url($lang . "/logout") ?>">
                <i class="fa fa-sign-out"></i>
                <?php echo $this->global_function->show_config_language('lang_sign_out', $lang)?>
            </a>
        </li>
    </ul>
</div>