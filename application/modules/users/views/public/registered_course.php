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
            <?php $this->load->view('users/public/block_col_left', array('user' => $user,'left_active'=>'registered-course')) ?>
        </div>
        <div class="users-col-right">

            <div class="round-tutor" id="load-round-page">

                <?php
                $x = 0;
                foreach ($list_course as $row) {
                    $subject=$this->m_browse_lession->show_detail_browse_lession_id($row->subject_id,$lang);
                    ?>
                    <div class="i-tutor <?php if (($x + 1) % 4 == 0) echo 'last' ?>">
                        <a href="<?php echo site_url($lang . "/edit-course/".$row->id) ?>" class="round-img">
                            <img src="<?php echo base_url() ?>timthumb.php?src=<?php echo base_url() ?>uploads/Images/users/<?php echo $user->user_name."/course/".$row->picture ?>&amp;h=175&amp;w=270&amp;zc=1" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';">
                        </a>
                        <p class="text-info"><i class="fa fa-bookmark"></i><?php echo $row->course_name?></p>
                        <p class="text-info"><i class="fa fa-flag"></i><?php echo isset($subject->browse_lession_name)?$subject->browse_lession_name:''?></p>
                        <p class="text-info text-blue"><i class="fa fa-file-o"></i><?php echo $row->note_1 ?></p>
                        <p class="text-info last"><i class="fa fa-users"></i><?php echo $row->note_2 ?></p>
                        <p class="action"><a href="<?php echo site_url($lang . "/edit-course/".$row->id) ?>"><i class="fa fa-edit  "></i></a><a  data="<?php echo site_url($lang."/delete-course/".$row->id) ?>" onclick="DeleteAjax(this)"><i class="fa fa-close "></i></a></p>
                    </div>
                    <?php
                    $x++;
                } ?>
            </div>
            <div class="clear hg1"></div>
            <a class="i-btn btn-save-change" href="<?php echo site_url($lang.'/add-course/0')?>"><i class="fa  fa-plus"></i><?php echo $this->global_function->show_config_language('lang_add', $lang) ?></a>

        </div>
    </div>
</div>