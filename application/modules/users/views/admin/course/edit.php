<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/users/index/")) ?>
    <div class="clear he1"></div>
    <div class="col_full fleft bs-example-bg-classes">
        <p class="bg-warning">
            <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) { ?>
                <?php echo form_error('course_name_' . $lang->name) ?>
                <?php echo form_error('note_1' . $lang->name) ?>
                <?php echo form_error('note_2' . $lang->name) ?>
            <?php } ?>
        </p>
    </div>
    <div class="clear he1"></div>
    <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
    <div class="col-lx-12 pr0">

            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $row = $this->a_user->get_a_course(array('course.id' => isset($course->id) ? $course->id : 0), $lang->name);
                        ?>
                        <div class="form-group  col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal text-right"><?php echo 'Khóa học' ?></label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="course_name_<?php echo $lang->name ?>" value="<?php echo set_value('course_name_' . $lang->name, $row->course_name) ?>">
                            </div>
                            <div class="clear"></div>

                        </div>
                        <div class="clear"></div>
                        <div class="form-group  col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal text-right"><?php echo 'Ghi chú 1' ?></label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="course_note_1_<?php echo $lang->name ?>" value="<?php echo set_value('course_note_1_' . $lang->name, $row->note_1) ?>">
                            </div>
                            <div class="clear"></div>

                        </div>
                        <div class="form-group  col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal text-right"><?php echo 'Ghi chú 2' ?></label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="course_note_2_<?php echo $lang->name ?>" value="<?php echo set_value('course_note_2_' . $lang->name, $row->note_2) ?>">
                            </div>
                            <div class="clear"></div>

                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">
                                <label class="col-xs-8 control-label normal">Thông tin lession</label>
                            </label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "info_" . $lang->name,'value'=>isset($row->info) ? $row->info : "")) ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php $type_teach=explode(',',$course->type_teach); ?>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal text-right"><?php echo 'Hình thức học' ?></label>
                        <div class="col-xs-6">
                            <ul class="type-teach course-type">
                                <?php foreach ($list_degree as $de) { ?>
                                    <li class="checkbox-inline"><input  <?php if (in_array($de->id, $type_teach, true)) echo 'checked' ?> type="checkbox" name="type_teach[]" id="tOnline-<?php echo  $de->id?>" value="<?php echo $de->id?>"  >
                                        <label for="tOnline-<?php echo $de->id?>"><?php echo $de->degree_name?></label>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal text-right"><?php echo 'Youtube' ?></label>
                        <div class="col-xs-6">
                            <input class="form-control" type="text" name="youtube" value="<?php echo $course->youtube?>">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal text-right"><?php echo 'Chi phí ($/1h)' ?></label>
                        <div class="col-xs-6">
                            <input class="form-control" type="text" name="fee" value="<?php echo $row->fee?>">
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Chủ đề</label>
                        <div class="col-sm-6">
                            <select class="form-control select-input" name="subject_id">
                                <option value="0"><?php echo $this->global_function->show_config_language('lang_subject', 'vn') ?></option>

                                <?php foreach ($list_browse as $brows) {
                                    $list_child = $this->m_browse_lession->show_list_browse_lession_where(array("browse_lession.browse_lession_type" => 1, "browse_lession.browse_lession_top" => $brows->id, 'browse_lession_status' => 1), 'vn');

                                    ?>
                                    <optgroup label="<?php echo $brows->browse_lession_name ?>">
                                        <?php foreach ($list_child as $child) { ?>
                                            <option <?php if(isset($course->subject_id) && $course->subject_id==$child->id) echo 'selected'?>  value="<?php echo $child->id ?>"><?php echo $child->browse_lession_name ?></option>
                                        <?php } ?>
                                    </optgroup>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

    </div>
    <div class="clear he1"></div>
    <div class="col_full fleft info-item ">
        <div class="title col_full fleft">AVATAR</div>
        <div class="clear he1"></div>
        <div class="col-xs-6">
            <div class="inline_avatar user-avatar">
                <img
                    src="<?php echo base_url() ?>timthumb.php?src=<?php echo base_url() ?>uploads/Images/users/<?php echo $user->user_name . "/course/" . $course->picture ?>&amp;h=175&amp;w=270&amp;zc=1"
                    width="270" height="175" onerror="this.src='<?php echo base_url() ?>themes/back/images/text.png';">
            </div>
            <div style="clear: both; height: 10px"></div>
            <input type="file" name="course-avatar">
            <input type="hidden" name="course-avatar-old" value="<?php echo isset($course->picture) ? $course->picture : "" ?>">
            <input type="text" name="alt-course" placeholder="Alt text" value="<?php echo set_value('alt-course',isset($course->alt_picture) ? $course->alt_picture : "")  ?>">

        </div>
        <div class="col-xs-6">
            <div class="inline_avatar user-avatar">
                <img
                    src="<?php echo base_url() ?>timthumb.php?src=<?php echo base_url() ?>uploads/Images/users/<?php echo $user->user_name . "/course/" . $course->large_picture ?>&amp;h=175&amp;w=270&amp;zc=1"
                    width="270" height="175" onerror="this.src='<?php echo base_url() ?>themes/back/images/text.png';">
            </div>
            <div style="clear: both; height: 10px"></div>
            <input type="file" name="large-picture" >
            <input type="hidden" name="large-picture-old" value="<?php echo isset($course->large_picture) ? $course->large_picture : "" ?>">
            <input type="text" name="alt-large-picture" placeholder="Alt text" value="<?php echo set_value('alt-large-picture',isset($course->alt_large_picture) ? $course->alt_large_picture : "")  ?>">

        </div>
        <div style="clear: both; height: 10px"></div>
    </div>
    <div class="clear he1"></div>
    <div class="col_full fleft info-item ">
        <div class="title col_full fleft">THỜI GIAN RẢNH</div>
        <div class="clear he1"></div>
        <div class="col-xs-12">
        <table id="check-time-work" class="table">
            <tr class="title-time">
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
                        "where" => array('course_id' =>$course->id,'day'=>$i),
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
            </div>
        <?php $this->load->view("back/inc/list_hide_button") ?>
        <input type="submit" name="ok" id="btn-submit-course" style="display: none">
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/users/index/")) ?>
    <div class="clear he3"></div>
    <div class="clear he1"></div>

    </form>
</div>
<script>

    function AddTime(e){
        var id=$(e).attr('data-id');
        $.post('<?php echo site_url("vn/load-time-ajax")?>',{id:id},function(data){
            $(e).parent().find('.round-add-time').append(data);
        })
    }
    function DeleteTime(e){
        $(e).parent().parent().remove();
    }
</script>

