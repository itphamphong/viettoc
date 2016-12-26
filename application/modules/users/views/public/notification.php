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
            <?php $this->load->view('users/public/block_col_left', array('user' => $user, 'left_active' => 'notification')) ?>
        </div>
        <div class="users-col-right">
            <ul id="list-notification">
                <?php
                $x = 1;
                foreach ($list as $row) {
                    $student = $this->a_user->get_user_name($row->users_id, 'full_name');
                    ?>
                    <li class="<?php if($row->status==1) echo 'read'?> <?php if ($x % 2 == 0) echo 'event' ?>"><i><?php echo $x ?>.</i>
                        <strong><?php echo $student->full_name . "</strong> " . $this->global_function->show_config_language('lang_notification_alert', $lang) ?>
                            <?php if($row->status==0){?>
                    <i class="fa fa-check" data-id="<?php echo $row->id?>" onclick="CheckNotification(this)" data-url="<?php echo site_url($lang."/check-notification")?>"></i>
                    <?php }?>
                    </li>
                    <?php $x++;
                } ?>
            </ul>
        </div>
    </div>
</div>