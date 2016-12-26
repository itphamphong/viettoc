<div class="col_full fleft">
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
        <div class="col-xs-6 list-btn fright">
            <a class="i-btn i-add"  href="<?php echo site_url("admin/users/add/".$type)?>">Thêm mới</a>
            <a class="i-btn i-delete" onclick="Delete()">Xoá</a>

        </div>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">
                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Địa chỉ</th>
                    <th>Trạng thái</th>
                    <th>Action</th>
                </tr>
                <tbody id="load">
                <?php
                $x = 0;
                foreach ($list as $i) {
                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                        <td class="text-left">
                                <b><?php echo $i->full_name ?></b>
                                <br>
                                <i style="clear: both; font-size: 10px"><?php echo $i->email?></i>
                            </a>
                        </td>
                        <td style="text-align:center"><?php echo $i->cell_phone ?></td>
                        <td class="text-left">
                            <?php
                            echo wordwrap($i->address, 120, "<br />\n");
                            ?>
                        </td>
                        <td>
                            <?php if($i->status==1){?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/users/active") ?>">
                                    Đã kích hoạt
                                </div>
                            <?php }else{?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/users/active") ?>">
                                    Chưa kích hoạt
                                </div>
                            <?php }?>
                        </td>
                        <td class=" ">
                            <?php if($type==1){?>
                            <a href="<?php echo base_url()?>admin/users/course/<?php echo $type."/".$i->id ?>"  class="btn default btn-sm green">
                                <i class="fa  icon-black "></i> Quản lý khóa học
                            </a>
                            <?php }?>
                            <a data="<?php echo site_url("admin/users/change_pass/". $type."/".$i->id) ?>" onclick="ChangeAjax(this)"  class="btn default btn-sm green">Đổi mật khẩu</a>
                            <a href="<?php echo base_url()?>admin/users/edit/<?php echo $type."/".$i->id ?>"  class="btn default btn-sm green">
                                <i class="fa  icon-black "></i> Sửa thông tin
                            </a>
                            <a data="<?php echo site_url("admin/users/delete/". $type."/".$i->id) ?>" onclick="DeleteAjax(this)"  class="btn default btn-sm green">
                                <i class="fa  icon-black "></i> Xoá
                            </a>
                        </td>
                    </tr>
                    <?php $x++;  }?>
                <tr><td colspan="10"><?php echo $link ?></td></tr>
                </tbody>
            </table>
        </div>
    </form>
</div>