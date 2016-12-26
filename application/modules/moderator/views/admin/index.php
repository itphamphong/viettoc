<div class="col_full fleft">
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
        <div class="col-xs-6 list-btn fright">
            <a class="i-btn i-add"  href="<?php echo site_url("admin/moderator/add")?>">Thêm mới</a>
            <a class="i-btn i-delete" onclick="Delete()">Xoá</a>
            <p style="display:none">
                <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
            </p>
        </div>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">

                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Quyền</th>
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
                        <td class="text-left"><?php echo $i->user_name ?></td>
                        <td > <?php echo $i->user_email ?></td>
                        <td >
                            <?php if ($i->type == 1) echo "Moderater";elseif ($i->type == 2) echo "Administrator" ?>
                        </td>
                        <td>  <?php if($i->status==1){?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/moderator/active") ?>">
                                    Đã kích hoạt
                                </div>
                            <?php }else{?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/moderator/active") ?>">
                                    Chưa kích hoạt
                                </div>
                            <?php }?>
                        </td>
                        <td class=" ">
                            <a href="<?php echo base_url()?>admin/moderator/edit/<?php echo  $i->id ?>" class="btn default btn-sm green ">
                                <i class="fa fa-pencil icon-black"></i> Sửa
                            </a>
                            <a href="<?php echo base_url()?>admin/moderator/m_permission/<?php echo  $i->id ?>" class="btn default btn-sm green ">
                                <i class="fa fa-pencil icon-black"></i> Phân quyền
                            </a>
                            <a href="<?php echo base_url()?>admin/moderator/delete/<?php echo $i->id ?>"  class="btn default btn-sm red">
                                <i class="fa fa-times icon-black "></i> Xoá
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