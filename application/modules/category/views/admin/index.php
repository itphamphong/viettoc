<div class="col_full fleft">
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
        <div class="col-xs-6 list-btn fright">
            <a class="i-btn i-add"  href="<?php echo site_url("admin/category/add/".$type)?>">Thêm mới</a>
            <p style="display:none">
                <input class="a_button_act a_update" name="update" style="cursor: pointer" type="submit"	value="Cập nhật" />
            </p>
            <p style="display:none">
                <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
            </p>
            <span class="i-btn i-save-continues" onclick="$('.a_update').trigger('click')">Cập nhật</span>
            <a class="i-btn i-delete" onclick="Delete()">Xoá</a>
        </div>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">
                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    <th>Tên</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                <?php  foreach ($category as $i) {

                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                        <td class="text-left"><?php echo $i->category_name?></td>

                        <td>
                            <span title="Sửa" class="change_weight" onclick="ChangeW(this)"><?php echo $i->category_weight?></span>
                            <div class="col-center">
                                <input type="text" name="weight[]" class="weight form-control" value="<?php echo $i->category_weight?>">
                            </div>
                        </td>
                        <td>  <?php if($i->category_status==1){?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/category/active") ?>">
                                    <?php echo ACTIVE ?>
                                </div>
                            <?php }else{?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/category/active") ?>">
                                    <?php echo NO_ACTIVE ?>
                                </div>
                            <?php }?>
                        </td>
                        <td class=" ">
                            <a href="<?php echo base_url()?>admin/category/edit/<?php echo $type."/". $i->id ?>" class="btn  btn-sm i-btn  ">
                                <i class="fa  icon-black"></i> Sửa
                            </a>
                            <a href="<?php echo base_url()?>admin/category/delete/<?php echo $type."/".$i->id ?>"  class="btn  btn-sm i-btn">
                                <i class="fa  icon-black "></i> Xoá
                            </a>
                        </td>
                    </tr>
                    <?php   foreach ($this->a_category->show_list_category_parent($i->id) as $j) {?>
                        <tr class="tr-product">
                            <td><input type="checkbox" value="check_item[<?php echo $j->id ?>]" name="checkall[<?php echo $j->id ?>]" class="checkall"  /></td>
                            <td class="text-left">|--<?php echo $j->category_name?></td>

                            <td>
                                <span title="Sửa" class="change_weight" onclick="ChangeW(this)"><?php echo $j->category_weight?></span>
                                <div class="col-center">
                                    <input type="text" name="weight[]" class="weight form-control" value="<?php echo $j->category_weight?>">
                                </div>
                            </td>
                            <td>  <?php if($j->category_status==1){?>
                                    <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $j->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/category/active") ?>">
                                        <?php echo ACTIVE ?>
                                    </div>
                                <?php }else{?>
                                    <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $j->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/category/active") ?>">
                                        <?php echo NO_ACTIVE ?>
                                    </div>
                                <?php }?>
                            </td>
                            <td class=" ">
                                <a href="<?php echo base_url()?>admin/category/edit/<?php echo $type."/". $j->id ?>" class="btn  btn-sm i-btn">
                                    <i class="fa  icon-black"></i> Sửa
                                </a>
                                <a href="<?php echo base_url()?>admin/category/delete/<?php echo $type."/".$j->id ?>"  class="btn  btn-sm i-btn">
                                    <i class="fa  icon-black "></i> Xoá
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                <?php }?>
            </table>
        </div>
    </form>
</div>