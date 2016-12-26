<div class="col_full fleft">
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
        <div class="col-xs-6 list-btn fright">
            <a href="<?php echo base_url()?>admin/cate_video/add/<?php echo $type ?>" class="btn default btn-sm green">
                <i class="fa fa-plus icon-black"></i> Thêm mới
            </a>
            <span class="btn default btn-sm red" onclick="Delete()"><i class="fa fa fa-times"></i> Hủy</span>
            <p style="display:none">
                <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
            </p>

        </div>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">
                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    <th>Tên nhóm</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                <?php  foreach ($list as $i) {

                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                        <td class="text-left"><?php echo $i->name?></td>

                        <td><?php echo $i->weight?></td>
                        <td>  <?php if($i->status==1){?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/cate_video/active") ?>">
                                    <?php echo ACTIVE?>
                                </div>
                            <?php }else{?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/cate_video/active") ?>">
                                    <?php echo NO_ACTIVE?>
                                </div>
                            <?php }?>
                        </td>
                        <td class=" ">
                            <a href="<?php echo base_url()?>admin/cate_video/edit/<?php echo $type."/". $i->id ?>" class="btn  btn-sm i-btn">
                                <i class="fa fa-pencil icon-black"></i> Sửa
                            </a>
                            <a href="<?php echo base_url()?>admin/cate_video/delete/<?php echo $type."/".$i->id ?>"  class="btn  btn-sm i-btn">
                                <i class="fa fa-times icon-black "></i> Xoá
                            </a>
                        </td>
                    </tr>
                    <?php   foreach ($this->m_cate_video->show_list_cate_video_where(array("parent_id" => $i->id),1,1,"vn",0) as $j) {?>
                        <tr class="tr-product">
                            <td><input type="checkbox" value="check_item[<?php echo $j->id ?>]" name="checkall[<?php echo $j->id ?>]" class="checkall"  /></td>
                            <td class="text-left">|--<?php echo $j->name?></td>

                            <td><?php echo $j->weight?></td>
                            <td></td>
                            <td class=" ">
                                <a href="<?php echo base_url()?>admin/cate_video/edit/<?php echo $type."/". $j->id ?>" class="btn  btn-sm i-btn">
                                    <i class="fa fa-pencil icon-black"></i> Sửa
                                </a>
                                <a href="<?php echo base_url()?>admin/cate_video/delete/<?php echo $type."/".$j->id ?>"  class="btn  btn-sm i-btn">
                                    <i class="fa fa-times icon-black "></i> Xoá
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                <?php }?>
            </table>
        </div>
    </form>
</div>