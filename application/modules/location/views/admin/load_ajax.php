<?php foreach ($list as $i) {

    ?>
    <tr class="tr-product">
        <td><input type="checkbox" value="check_article[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"/></td>


        <td class="text-left"><?php echo $i->name ?></td>
        <td data-order="<?php echo $i->weight ?>">
            <span title="Sửa" class="change_weight" onclick="ChangeW(this)"><?php echo $i->weight ?></span>
            <div class="col-center">
                <input type="text" name="weight[]" class="weight form-control" value="<?php echo $i->weight ?>">
            </div>
        </td>

        <td data-order="<?php echo $i->status ?>">
            <?php if ($i->status == 1) { ?>
                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id ?>" data="0" onclick="Active(this)"
                     data-url="<?php echo base_url("admin/location/active") ?>">
                    Đã kích hoạt
                </div>
            <?php } else { ?>
                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id ?>" data="1" onclick="Active(this)"
                     data-url="<?php echo base_url("admin/location/active") ?>">
                    Chưa kích hoạt
                </div>
            <?php } ?>
        </td>
        <td>
            <a href="<?php echo base_url() ?>admin/location/edit/<?php echo $type . "/" . $i->id ?>" class="btn default btn-sm green ">
                <i class="fa fa-pencil icon-black"></i> Sửa
            </a>
            <a href="<?php echo base_url() ?>admin/location/delete/<?php echo $type . "/" . $i->id ?>" class="btn default btn-sm red">
                <i class="fa fa-times icon-black "></i> Xoá
            </a>
        </td>

    </tr>
<?php } ?>