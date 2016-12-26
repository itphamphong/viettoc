
<?php foreach ($item as $i) {
    $thumb = $this->m_item->show_thumb($i->id);
    ?>
    <tr class="tr-product">
        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"/></td>

        <td>
            <?php if (file_exists('uploads/san-pham/' . (isset($thumb->name) ? $thumb->name : ""))) { ?>
                <img width="100" src="<?php echo base_url() ?>uploads/san-pham/<?php echo isset($thumb->name) ? $thumb->name : ""; ?>" style="float: none"
                     onerror="this.src='<?php echo base_url() ?>no-images.jpg';"/>
            <?php } ?>
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
                    Đã kích hoạt
                </div>
            <?php } else { ?>
                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id ?>" data="1" onclick="Active(this)"
                     data-url="<?php echo base_url("admin/item/active") ?>">
                    Chưa kích hoạt
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
