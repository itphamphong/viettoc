<?php
$this->load->view('back/inc/messager', array('type_messager' => $this->input->get('messager'), 'id' => $this->input->get('id'), 'type' => $this->input->get('type')));
?>
<!-- Alternative Content Box Start -->
<div class="contentcontainer">
    <div class="headings altheading"><h2>Danh sách users</h2></div>
    <div class="contentbox">
        <form method="post" action=""	enctype="multipart/form-data">
            <div class="extrabottom">
                <ul>
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
                        <th>Email</th>
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
                            <td><b><?php echo $i->email?></b></td>
                            
                            <td style="text-align:center;">                             
                                <a data="" title="Delete" onclick="Alert('admin/users/delete_blacklist/<?php echo $i->id ?>')"  style="cursor: pointer"><img src="theme_admin/img/icons/icon_square_close.png" alt="Delete" /></a>

                            </td>
                            <td style="text-align:center"><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
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
