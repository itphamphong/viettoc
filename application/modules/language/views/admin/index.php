<?php
$this->load->view('back/inc/messager', array('type_messager' => $this->input->get('messager'), 'id' => $this->input->get('id'), 'type' => $this->input->get('type')));
?>
<!-- Alternative Content Box Start -->
<div class="contentcontainer">
    <div class="headings altheading"><h2>Danh sách </h2></div>
    <div class="contentbox">
        <p>
            Nhóm:
            <select name="type_directory_id" id="type_directory_id">
                <option value="0">--Tất cả--</option>
                <?php foreach ($this->general->show_list_table(array("status" => 1), 1, 1, "type_directory") as $t) { ?>
                    <option value="<?php echo $t->id ?>" <?php if ($type == $t->id) { ?>  selected="selected"<?php } ?>><?php echo $t->name ?></option>
                <?php } ?>
            </select>
        </p>
        <form method="post" action=""	enctype="multipart/form-data">
            <div class="extrabottom">
                <ul>
                    <li>
                        <img src="theme_admin/img/icons/add.png" alt="Add" /> 
                        <a style="text-decoration: none;" href="admin/language/add">Thêm mới</a>
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
                        <th>Tên</th>
                        <th>Action</th>
                        <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $x = 0;
                    foreach ($list as $i) {
                        ?>
                        <tr <?php if ($x % 2 == 0) { ?>class="alt"<?php } ?>>
                            <td style="text-align:center"><?php echo $i->id ?></td>
                            <td><a><b><?php echo $i->language_name ?></b></a></td>
                            <td style="text-align:center;">
                                <a href="admin/language/edit/<?php echo $i->id ?>" title=""><img src="theme_admin/img/icons/icon_edit.png" alt="Edit" /></a>

                                <?php if ($i->status == 1) { ?>
                                    <a href="admin/language/hide/<?php echo $i->id ?>" title=""><img src="theme_admin/img/icons/icon_approve.png" alt="Approve" /></a>
                                <?php } else { ?>
                                    <a href="admin/language/show/<?php echo $i->id ?>" title=""><img src="theme_admin/img/icons/icon_unapprove.png" alt="Unapprove" /></a>
                                <?php } ?>

                                <a data="" title="" onclick="Alert('admin/language/delete/<?php echo $i->id ?>')" ><img src="theme_admin/img/icons/icon_delete.png" alt="Delete" /></a>
                            </td>
                            <td style="text-align:center"><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                        </tr>            
                        <?php
                        $x++;
                    }
                    ?>
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
<script type="text/javascript">
    $(document).ready(function() {
        $("#type_directory_id").change(function() {
            var id = $(this).val();
            window.location.href = "admin/language/" + id;
        })
    })
</script>