<div class="col_full fleft">
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
        <div class="col-xs-6 list-btn fright <?php if($type==4) echo 'hide'?>">
            <a class="i-btn i-add"  href="<?php echo site_url("admin/article/add/".$type)?>">Thêm mới</a>
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
                    <th>Hình ảnh</th>
                    <th>Tên bài viết</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th class="<?php if($type==1) echo 'hide'?>">Nổi bật</th>
                    <th>Hành động</th>
                </tr>
                <?php  foreach ($item as $i) {
                    $name_en = $this->m_article->show_detail_article_id($i->id, 'vn');
                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_article[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>

                        <td >
                            <?php if ($i->choose_upload == 1) {?>
                                <img width="100" src="<?php echo base_url() ?>uploads/Images/<?php echo "article" ."/".$i->picture?>" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';"  alt=""/>
                            <?php }else if ($i->choose_upload == 2) {?>
                            <img  width="100" src="<?php echo base_url()?><?php echo $i->picture?>" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';" alt=""/>
                            <?php }else{?>
                                <i class="<?php echo $i->picture?>"></i>
                            <?php }?>

                        </td>
                        <td>  <?php if (isset($name_en->article_name)) echo wordwrap($name_en->article_name, 50, "<br />\n");; ?></td>
                        <td>
                            <span title="Sửa" class="change_weight" onclick="ChangeW(this)"><?php echo $i->article_weight?></span>
                            <div class="col-center">
                                <input type="text" name="weight[]" class="weight form-control" value="<?php echo $i->article_weight?>">
                            </div>
                        </td>
                        <td>  <?php if($i->article_status==1){?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/article/active") ?>">
                                    Đã kích hoạt
                                </div>
                            <?php }else{?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/article/active") ?>">
                                    Chưa kích hoạt
                                </div>
                            <?php }?>
                        </td>
                        <td class="<?php if($type==1) echo 'hide'?>">  <?php if($i->article_hot==1){?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id?>" data="0" onclick="Active(this)" data-url="<?php echo base_url("admin/article/hot") ?>">
                                    Đã kích hoạt
                                </div>
                            <?php }else{?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id?>" data="1" onclick="Active(this)" data-url="<?php echo base_url("admin/article/hot") ?>">
                                    Chưa kích hoạt
                                </div>
                            <?php }?>
                        </td>
                        <td class=" ">

                            <a href="<?php echo base_url()?>admin/article/edit/<?php echo $type."/". $i->id ?>" class="btn default btn-sm green ">
                                <i class="fa fa-pencil icon-black"></i> Sửa
                            </a>
                            <a href="<?php echo base_url()?>admin/article/delete/<?php echo  $type."/".$i->id ?>"  class="btn default btn-sm red <?php if($type==4) echo 'hide'?>">
                                <i class="fa fa-times icon-black "></i> Xoá
                            </a>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </form>
</div>