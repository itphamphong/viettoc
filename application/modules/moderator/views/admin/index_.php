<?php
$this->load->view('back/inc/messager', array('type_messager' => $this->input->get('messager'), 'id' => $this->input->get('id'), 'type' => $this->input->get('type')));
?>
<!-- Alternative Content Box Start -->
<div class="contentcontainer">
    <div class="headings altheading"><h2>Danh sách moderator</h2></div>
    <div class="contentbox">
        <form method="post" action=""	enctype="multipart/form-data">
            <div class="extrabottom">
                <ul>
                    <li>
                        <img src="theme_admin/img/icons/add.png" alt="Add" />
                        <a style="text-decoration: none;" href="admin/moderator/add">Thêm mới</a>
                    </li>
                    <li> <img src="theme_admin/img/icons/icon_approve.png" alt="Approve" />
                        <input class="a_button_act a_show" name="show" style="cursor: pointer" type="submit"	value="Hiện bài đã chọn" />
                    </li>
                    <li> <img src="theme_admin/img/icons/icon_unapprove.png" alt="Unapprove" />
                        <input class="a_button_act a_hide" name="hide" style="cursor: pointer" type="submit"	value="Ẩn bài đã chọn" />
                    </li>
                    <li> <img src="theme_admin/img/icons/icon_delete.png" alt="Delete" />
                        <p style="display:none">
                            <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
                        </p>
                        <a style=" cursor:pointer" class="delete" onclick="Delete()">Delete</a>
                    </li>
                </ul>
            </div>
            <table width="100%">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Action</th>
                        <th>Permission</th>
                        <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $x = 0;
                    foreach ($list as $i) {
                        ?>
                        <tr <?php if ($x % 2 == 0) { ?>class="alt"<?php } ?>>
                            <td style="text-align:center"><?php echo $i->user_id ?></td>
                            <td><b><?php echo $i->user_name ?></b></td>
                            <td > <?php echo $i->user_email ?></td>
                            <td >
                                <?php if ($i->type == 1) echo "Moderater";elseif ($i->type == 2) echo "Administrator" ?>
                            </td>
                            <td style="text-align:center;">
                                <a href="admin/moderator/edit/<?php echo $i->user_id ?>" title="Edit"><img src="theme_admin/img/icons/icon_edit.png" alt="Edit" /></a>
                                <?php if ($i->user_status == 1) { ?>
                                    <a href="admin/moderator/hide/<?php echo $i->user_id ?>" title=""><img src="theme_admin/img/icons/icon_approve.png" alt="Approve" /></a>
                                <?php } else { ?>
                                    <a href="admin/moderator/show/<?php echo $i->user_id ?>" title=""><img src="theme_admin/img/icons/icon_unapprove.png" alt="Unapprove" /></a>
                                <?php } ?>
                                <a data="" title="Delete" onclick="Alert('admin/moderator/delete/<?php echo $i->user_id ?>')"  style="cursor: pointer"><img src="theme_admin/img/icons/icon_square_close.png" alt="Delete" /></a>
                                <a href="admin/moderator/change_pass/<?php echo $i->user_id ?>" title="Đổi Mật Khẩu" id="<?= $i->user_id ?>" class="Edit"> Đổi mật khẩu</a>

                            </td>
                            <td style="text-align: center"><a href="admin/moderator/permission/<?php echo $i->user_id ?>" title=""><img src="themes/images/layout/permit.jpg" alt="Permission"  width="30"/></a></td>
                            <td style="text-align:center"><input type="checkbox" value="check_item[<?php echo $i->user_id ?>]" name="checkall[<?php echo $i->user_id ?>]" class="checkall"  /></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p style="color:#FF0000; font-weight:bold; text-align:center"><?php echo "Bạn chỉ được phép xóa các thư mục rỗng và không có bài viết" ?></p>
            <div style="clear: both;"></div>
            <p style="display:none">
                <input type="checkbox" value="check_item[0]" name="checkall[0]" class="checkall"   checked="checked"/>
            </p>
        </form>
        <div style="clear: both"></div>
        <?php echo $link ?>
    </div>
</div>
<la
