<div class="col_full fleft">
    <?php  if($user->buyer_id==0) echo '<p class="text-center">Học viên không có chức năng này</p>';else{?>
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
        <div class="col-xs-6 list-btn fright">
            <a class="i-btn i-add"  href="<?php echo site_url("admin/users/add_course/".$type."/".$user->id)?>">Thêm mới</a>
            <p style="display:none">
                <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
            </p>
            <a class="i-btn i-delete" onclick="Delete()">Xoá</a>
        </div>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">
                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    <th>Tên khóa học</th>
                    <th>Chuyên ngành</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Người điều chỉnh</th>
                    <th>Action</th>
                </tr>
                <tbody>
                <?php
                $x = 0;
                foreach ($list_course as $row) {
                $subject=$this->m_browse_lession->show_detail_browse_lession_id($row->subject_id);
                ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_item[<?php echo $row->id ?>]" name="checkall[<?php echo $row->id ?>]" class="checkall"  /></td>
                        <td>
                            <img  height="100" src="<?php echo base_url() ?>timthumb.php?src=<?php echo base_url() ?>uploads/Images/users/<?php echo $user->user_name."/course/".$row->picture ?>&amp;h=175&amp;w=270&amp;zc=1" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';">
                        </td>
                        <td><?php echo $row->course_name?></td>
                        <td><?php echo date("d-m-Y",strtotime($row->created_date))?></td>
                        <td>
                            <?php if($row->course_status==1){?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $row->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/users/course_active") ?>">
                                    Đã kích hoạt
                                </div>
                            <?php }else{?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $row->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/users/course_active") ?>">
                                    Chưa kích hoạt
                                </div>
                            <?php }?>
                        </td>
                        <td>
                            <?php
                            $user_repair = $this->global_function->get_tableWhere(array("user_id" => $row->user_repair), "tbl_user");
                            echo isset($user_repair->user_loginname)?$user_repair->user_loginname:"";
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url()?>admin/users/edit_course/<?php echo $type."/".$user->id."/".$row->id ?>"  class="btn default btn-sm green">
                                <i class="fa  icon-black "></i> Sửa
                            </a>
                            <a data="<?php echo site_url("admin/users/delete_course/". $type."/".$user->id."/".$row->id) ?>" onclick="DeleteAjax(this)"  class="btn default btn-sm green">
                                <i class="fa  icon-black "></i> Xoá
                            </a>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
            </div>
    </form>
    <?php }?>
</div>