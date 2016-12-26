<div class="col_full fleft">
    <form name="them" method="post" id="them" action="" enctype="multipart/form-data">
        <div class="col_full fleft bg-search">
            <div class="col-xs-8">
                <div class="col-xs-4">
                    <input class="form-control" name="key" id="key" placeholder="Tên sản phẩm">
                </div>
                <div class="col-xs-3 pl0">
                    <select name="status" id="status" class="form-control">
                        <option value="null">Chọn tình trạng</option>
                        <option value="1">Đã kích hoạt</option>

                        <option value="0"> Chưa kích hoạt</option>


                    </select>
                </div>
                <div class="col-xs-3 pl0">
                    <select name="check_category" id="category_id" class="form-control">
                        <option value="0"> Tất cả</option>
                        <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 1, 'category.category_status' => '1', 'category.category_top' => 0)) as $row) {
                            ?>
                            <option class="check_item" value="<?php echo $row->id ?>"><?php echo $row->category_name ?></option>
                            <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 1, 'category.category_status' => '1', 'category.category_top' => $row->id)) as $child) {
                                ?>
                                <option class="check_item" value="<?php echo $child->id ?>">|--<?php echo $child->category_name ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-xs-2 pl0"><input type="button" class="btn fleft" value="Tìm kiếm" name="ok" id="btn_search"/></div>
            </div>
            <div class="col-xs-4 list-btn fright">
                <a class="i-btn i-add" href="<?php echo site_url("admin/item/add") ?>">Thêm mới</a>
                <p style="display:none">
                    <input class="a_button_act a_update" name="update" style="cursor: pointer" type="submit" value="Cập nhật"/>
                </p>
                <p style="display:none">
                    <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit" value="Delete"/>
                </p>
                <span class="i-btn i-save-continues" onclick="$('.a_update').trigger('click')">Cập nhật</span>
                <a class="i-btn i-delete" onclick="Delete()">Xoá</a>

            </div>
        </div>
        <div class="clear he1"></div>

        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">
                    <th><input name="" type="checkbox" value="" id="checkboxall"/></th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th>Nổi bật</th>
                    <th>Promotion</th>
                    <th>Hành động</th>
                </tr>
                <tbody id="show_list_ajax">
                <?php foreach ($item as $i) {
                    $thumb = $this->m_item->show_thumb($i->id);
                $upload=$i->choose_upload;
                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"/></td>

                        <td class="index-pic">
                            <?php if ($upload == 1) {?>
                                <img src="<?php echo base_url() ?>uploads/Images/product/<?php echo $i->picture?>" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';"  alt=""/>
                            <?php }else if($upload==2){?>
                                <img src="<?php echo base_url()?><?php echo $i->picture?>" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';" alt=""/>
                            <?php }else if($upload==3){?>
                                <i class="<?php echo $i->picture?>"></i>
                            <?php }?>
                        </td>
                        <td class="text-left"><?php echo wordwrap($i->item_name, 20, "<br />\n") ?></td>

                        <td>
                            <span title="Sửa" class="change_value" onclick="ChangeP(this)"><?php echo number_format($i->price, 0, ",", ".") ?></span>
                            <div class="col-center">
                                <input type="text" name="price[]" class="price form-control" value="<?php echo $i->price ?>"></div>
                        </td>
                        <td>
                            <span title="Sửa" class="change_weight" onclick="ChangeW(this)"><?php echo $i->item_weight ?></span>
                            <div class="col-center">
                                <input type="text" name="weight[]" class="weight form-control" value="<?php echo $i->item_weight ?>">
                            </div>
                        </td>
                        <td>  <?php if ($i->item_status == 1) { ?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id ?>" data="0" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/item/active") ?>">
                                    <?php echo ACTIVE?>
                                </div>
                            <?php } else { ?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id ?>" data="1" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/item/active") ?>">
                                    <?php echo NO_ACTIVE?>
                                </div>
                            <?php } ?>
                        </td>
                        <td>  <?php if ($i->item_hot == 1) { ?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id ?>" data="0" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/item/hot") ?>">
                                    <?php echo ACTIVE?>
                                </div>
                            <?php } else { ?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id ?>" data="1" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/item/hot") ?>">
                                    <?php echo NO_ACTIVE?>
                                </div>
                            <?php } ?>
                        </td>
                        <td>  <?php if ($i->promotion == 1) { ?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id ?>" data="0" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/item/promotion") ?>">
                                    <?php echo ACTIVE?>
                                </div>
                            <?php } else { ?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id ?>" data="1" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/item/promotion") ?>">
                                    <?php echo NO_ACTIVE?>
                                </div>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url() ?>admin/item/copy/<?php echo $i->id ?>" class="btn default btn-sm green hide ">
                                <i class="fa  icon-black"></i> Copy
                            </a>
                            <a href="<?php echo base_url() ?>admin/item/edit/<?php echo $i->id ?>" class="btn default btn-sm green ">
                                <i class="fa  icon-black"></i> Sửa
                            </a>
                            <a href="<?php echo base_url() ?>admin/item/delete/<?php echo $i->id ?>" class="btn default btn-sm green">
                                <i class="fa  icon-black "></i> Xoá
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="10"><?php echo $link ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $("#btn_search").click(function () {
            var key = $("#key").val();
            var category_id = $("#category_id option:selected").val();
            var status = $("#status option:selected").val();
            $.post("<?php echo base_url()?>admin/item/list_ajax", {key: key, category_id: category_id, status: status}, function (data) {
                $('#show_list_ajax').html(data);
            });
        });

    });
</script>