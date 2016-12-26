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
        <form action="" method="post" enctype="multipart/form-data">
            <div class="users-col-right add-course">
                <?php if(!empty($msg)){?>
                    <div class="bg-success"><?php echo $msg?></div>
                <?php }?>
                <p class="title-tab"><?php echo $this->global_function->show_config_language('lang_course_information', $lang) ?></p>
                <div class="left-course i-three col_full">
                        <div class="inline_avatar course-avatar">
                            <img src="<?php echo base_url() ?>uploads/Images/users/<?php echo $user->user_name . "/course/" . (isset($course->picture) ? $course->picture : "") ?>"
                                 onerror="this.src='<?php echo base_url() ?>themes/back/images/text.png';" width="270" href="175">

                        </div>
                        <input type="text" name="alt-course" placeholder="Alt text"
                               value="<?php echo set_value('alt-course', isset($course->alt_picture) ? $course->alt_picture : "") ?>">
                        <input type="hidden" name="course-avatar-old" value="<?php echo isset($course->picture) ? $course->picture : "" ?>"/>
                    <div class="clear hg1"></div>
                    <div class="i-two">
                        <input type="file" name="course-avatar" id="course-avatar" style="display: none" onchange="return checkup('course-avatar')">
                        <div class="i-btn btn-course" onclick="$('#course-avatar').trigger('click')"><i class="fa fa-picture-o"></i>UPLOAD AVATAR</div>
                        <p>Format: *jpg, *png,<br>
                            Size: 770 x 528 Pixel <br>
                            Max: < 500 Kb</p>
                    </div>
                </div>
                <div class="left-course i-three col_full">
                    <div class="i-one">
                        <div class="inline_avatar large-picture">
                            <img
                                src="<?php echo base_url() ?>uploads/Images/users/<?php echo $user->user_name . "/course/" . (isset($course->large_picture) ? $course->large_picture : '') ?>"
                                onerror="this.src='<?php echo base_url() ?>themes/back/images/text.png';" width="270" href="175">
                            <input type="hidden" name="large-picture-old" value="<?php echo isset($course->large_picture) ? $course->large_picture : "" ?>"/>
                        </div>
                        <input type="text" name="alt-large-picture" placeholder="Alt text"
                               value="<?php echo set_value('alt-large-picture', isset($course->alt_large_picture) ? $course->alt_large_picture : "") ?>">
                    </div>
                    <div class="clear hg1"></div>
                    <div class="i-two">
                        <input type="file" name="large-picture" id="large-picture" onchange="return checkup('large-picture')" style="display: none">
                        <div class="i-btn btn-course" onclick="$('#large-picture').trigger('click')"><i class="fa fa-picture-o"></i>UPLOAD PHOTO</div>
                        <p>Format: *jpg, *png,<br>
                            Size: 270 x 150 Pixel<br>
                            Max: < 500 Kb</p>
                    </div>
                </div>
                <div class="clear hg5"></div>
                <div class="col_full">
                    <div class="round-error">
                        <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) { ?>
                            <?php echo form_error('course_name_' . $rlang->name) ?>
                            <?php echo form_error('subject_' . $rlang->name) ?>
                            <?php echo form_error('course_note_1_' . $rlang->name) ?>
                            <?php echo form_error('course_note_2_' . $rlang->name) ?>
                        <?php } ?>
                    </div>
                    <?php $this->load->view("front/block/menu_lang") ?>
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                        $row_course=$this->a_user->get_a_course(array('course.id'=>isset($course->id)?$course->id:0),$rlang->name);

                        ?>
                        <div class="round-input col_full col-lang col-<?php echo $rlang->name ?>">
                            <span><i class="fa  fa-file-text-o "></i></span>
                            <input type="text" name="course_name_<?php echo $rlang->name ?>" value="<?php echo set_value('course_name_'.$rlang->name,isset($row_course->course_name)?$row_course->course_name:"")?>"
                                   placeholder="<?php echo $this->global_function->show_config_language('lang_course_name', $lang) ?>">
                        </div>
                    <?php } ?>
                    <div class="round-input col_full">
                        <span><i class="fa  fa-bookmark"></i></span>
                        <select class="select-input" name="subject_id">
                            <option value="0"><?php echo $this->global_function->show_config_language('lang_subject', $lang) ?></option>

                            <?php foreach ($list_browse as $brows) {
                                $list_child = $this->m_browse_lession->show_list_browse_lession_where(array("browse_lession.browse_lession_type" => 1, "browse_lession.browse_lession_top" => $brows->id, 'browse_lession_status' => 1), $lang);

                                ?>
                                <optgroup label="<?php echo $brows->browse_lession_name ?>">
                                    <?php foreach ($list_child as $child) { ?>
                                        <option <?php if(isset($course->subject_id) && $course->subject_id==$child->id) echo 'selected'?>  value="<?php echo $child->id ?>"><?php echo $child->browse_lession_name ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                    </div>
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) { ?>
                        <div class="round-input col_full col-lang col-<?php echo $rlang->name ?>">
                            <span><i class="fa  fa-users"></i></span>
                            <input type="text" name="course_note_1_<?php echo $rlang->name ?>" value="<?php echo set_value('course_note_1_'.$rlang->name,isset($row_course->note_1)?$row_course->note_1:"")?>"
                                   placeholder="<?php echo $this->global_function->show_config_language('lang_course_note_1', $lang) ?>">
                        </div>

                        <div class="round-input col_full col-lang col-<?php echo $rlang->name ?>">
                            <span><i class="fa  fa-check"></i></span>
                            <input type="text" name="course_note_2_<?php echo $rlang->name ?>" value="<?php echo set_value('course_note_2_'.$rlang->name,isset($row_course->note_2)?$row_course->note_2:"")?>"
                                   placeholder="<?php echo $this->global_function->show_config_language('lang_course_note_2', $lang) ?>">
                        </div>

                    <?php } ?>
                    <div class="clear hg1"></div>
                    <?php if(isset($course->id)){
                        $type_teach=explode(',',$course->type_teach); ?>
                        <ul class="type-teach course-type">
                            <?php foreach ($list_degree as $row) { ?>
                            <li><input type="checkbox" name="type_teach[]" id="tOnline" value="<?php echo $row->id?>" <?php if(in_array($row->id, $type_teach,true)) echo 'checked'?> ><label for="tOnline"><?php echo $row->degree_name ?></label></li>
                            <?php }?>
                        </ul>
                    <?php }else {?>
                        <ul class="type-teach">
                            <?php foreach ($list_degree as $row) { ?>
                                <li><input type="checkbox" name="type_teach[]" id="tOnline" value="<?php echo $row->id?>" ><label for="tOnline"><?php echo $row->degree_name ?></label></li>
                            <?php }?>
                        </ul>
                    <?php }?>
                </div>

                <div class="clear hg1"></div>
                <p class="title-tab"><?php echo $this->global_function->show_config_language('lang_course_content', $lang) ?></p>
                <div class="left-course">

                </div>
                <div class="right-course">
                    <div class="round-input col_full">
                        <span><i class="fa  fa-youtube-play"></i></span>
                        <input type="text" name="youtube" value="<?php echo set_value('youtube',isset($course->youtube)?$course->youtube:'')?>" placeholder="<?php echo 'Link Youtube' ?>">
                    </div>
                </div>
                <div class="clear hg1"></div>
                <?php $this->load->view("front/block/menu_lang") ?>
                <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) { ?>
                    <div class="round-input col_full textarea col-lang col-<?php echo $rlang->name ?>">
                        <span class="span-i"><i class="fa fa-commenting-o"></i></span>
                        <div class="info-textarea">
                        <textarea type="text" class="info" id="info-<?php echo $rlang->name ?>" name="info_<?php echo $rlang->name ?>" cols="50" style="width: 100%; height:345px"
                                  placeholder="<?php echo $this->global_function->show_config_language('lang_info', $lang) ?>"><?php echo set_value('info_'.$rlang->name,isset($row_course->info)?$row_course->info:'')?></textarea>
                        </div>
                    </div>
                <?php } ?>
                <div class="clear hg1"></div>
                <p class="title-tab"><?php echo $this->global_function->show_config_language('lang_about_course', $lang) ?></p>
                <div class="round-input">
                    <span><i class="fa fa-dollar"></i></span>
                    <input type="text" name="fee" value="<?php echo set_value('fee',isset($course->fee)?$course->fee:0)?>" placeholder="<?php echo '$ Fee Each Hour' ?>" id="fee" onblur="ChangeFee()">
                </div>
                <div class="clear hg1"></div>
                <p class="ptitle-course">THESE a lesson packages</p>
                <ul id="list-course">
                    <?php
                    $x = 1;
                    foreach ($utility as $u) {
                        ?>
                        <li class="li-course" data-id="<?php echo $u->name ?>">
                            <span class="icon"><i class="fa  fa-clock-o"></i></span>
                            <p><strong><?php echo $u->name ?></strong> <br>HOUR</p>
                            <p class="price">
                                $<i class="i-fee"></i> x <?php echo $u->name ?> hour = $<span class="i-price"></span>
                            </p>
                        </li>
                    <?php } ?>
                </ul>
                <p class="title-tab"><?php echo $this->global_function->show_config_language('lang_availability', $lang) ?></p>
                <div class="clear hg1"></div>
                <table id="check-time-work">
                    <tr class="title">
                        <td>
                            <i class="fa fa-check-square-o"></i>
                            <br>Monday
                        </td>
                        <td>
                            <i class="fa fa-check-square-o"></i>
                            <br>Tuesday
                        </td>
                        <td>
                            <i class="fa fa-check-square-o"></i>
                            <br>Wednesday
                        </td>
                        <td>
                            <i class="fa fa-check-square-o"></i>
                            <br>Thusday
                        </td>
                        <td>
                            <i class="fa fa-check-square-o"></i>
                            <br>Friday
                        </td>
                        <td>
                            <i class="fa fa-check-square-o"></i>
                            <br>Saturday
                        </td>
                        <td>
                            <i class="fa fa-check-square-o"></i>
                            <br>Sunday
                        </td>
                    </tr>
                    <tr>
                        <?php for ($i = 0; $i < 7; $i++) {
                            $params = array(
                                "where" => array('course_id' => isset($course->id)?$course->id:0,'day'=>$i),
                                "table" => "course_available_time"
                            );
                            $count_list_tmp = $this->global_function->get_list_table_where($params);
                            ?>
                            <td valign="top">
                                <div class="round-add-time">
                                    <?php
                                    if(count($count_list_tmp)>0){
                                    foreach($count_list_tmp as $tmp){?>
                                        <p>
                                    <div class="i-time">
                                        <i class="fa  fa-caret-square-o-down"></i>
                                        <select name="start_time[]">
                                            <?php foreach ($list as $row) { ?>
                                                <option  <?php if($tmp->start_time==$row->id) echo 'selected'?>  value="<?php echo $row->id ?>"><?php echo $row->time_work_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="i-time fright">
                                        <i class="fa  fa-caret-square-o-down"></i>
                                        <select name="end_time[]">
                                            <?php foreach ($list as $row) { ?>
                                                <option <?php if($tmp->end_time==$row->id) echo 'selected'?>  value="<?php echo $row->id ?>"><?php echo $row->time_work_name ?></option>
                                            <?php } ?>
                                        </select>
                                        <i class="i-delete fa fa-minus-circle" onclick="DeleteTime(this)"> </i>
                                    </div>
                                    <div class="clear"></div>
                                    <input type="hidden" name="day[]" value="<?php echo $i ?>">
                                    <?php }}else{?>
                                        <div class="i-time">
                                            <i class="fa  fa-caret-square-o-down"></i>
                                            <select name="start_time[]">
                                                <?php foreach ($list as $row) { ?>
                                                    <option    value="<?php echo $row->id ?>"><?php echo $row->time_work_name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="i-time fright">
                                            <i class="fa  fa-caret-square-o-down"></i>
                                            <select name="end_time[]">
                                                <?php foreach ($list as $row) { ?>
                                                    <option  value="<?php echo $row->id ?>"><?php echo $row->time_work_name ?></option>
                                                <?php } ?>
                                            </select>
                                            <i class="i-delete fa fa-minus-circle" onclick="DeleteTime(this)"> </i>
                                        </div>
                                        <div class="clear"></div>
                                        <input type="hidden" name="day[]" value="<?php echo $i ?>">
                                    <?php }?>
                                </div>
                                <p class="add-time" onclick="AddTime(this)" data-id="<?php echo $i ?>"><i class="fa  fa-plus-circle"></i>Add time</p>


                            </td>
                        <?php } ?>
                    </tr>
                </table>
                <input type="submit" name="ok" id="btn-submit-course" style="display: none">
                <div class="i-btn btn-save-change" onclick="$('#btn-submit-course').trigger('click')"><i
                        class="fa  fa-plus"></i><?php echo $this->global_function->show_config_language('lang_save_changes', $lang) ?></div>

            </div>
        </form>
    </div>
</div>
<script type="application/javascript">
    bkLib.onDomLoaded(function () {
        //nicEditors.allTextAreas() ;
        new nicEditor({maxHeight: 345}).panelInstance('info-vn');
        new nicEditor({maxHeight: 345}).panelInstance('info-en');

    });
    $(document).ready(function () {
        DefaultLang();
        ChangeFee();

    });
    function ChangeFee(){
        $("#list-course li").each(function () {
            var fee = $("#fee").val();
            var price = $(this).attr('data-id');
            $(this).find(".i-fee").html(fee);
            $(this).find('.i-price').html(fee*price);

        });
    }
</script>
<script>

    function AddTime(e){
        var id=$(e).attr('data-id');
        $.post('<?php echo site_url($lang."/load-time-ajax")?>',{id:id},function(data){
            $(e).parent().find('.round-add-time').append(data);
        })
    }
    function DeleteTime(e){
        $(e).parent().parent().remove();
    }
</script>

