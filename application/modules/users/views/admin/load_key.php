<?php
$x = 0;
foreach ($list as $i) {
    $agent=$this->general->get_tableID($i->agent_id, "location");
    $city=$this->general->get_tableID($i->city_id, "location");
    ?>
    <tr <?php if ($x % 2 == 0) { ?>class="alt"<?php } ?>>
        <td style="text-align:center"><?php echo $x + 1 ?></td>
        <td><a data="" title="Permition" href="admin/users/edit/<?php echo $i->id ?>"  style="cursor: pointer"><b><?php echo $i->full_name ?></b></a></td>
        <td style="text-align:center"><?php echo $i->cell_phone ?></td>
        <td ><?php echo $i->address ?></td>
        <td ><?php echo $agent->name_vn?></td>
        <td ><?php echo $city->name_vn?></td>
        <td ><?php if($i->sex==1) echo "Nữ"; elseif($i->sex==2) echo "Nam"; else echo "Không xác định"?></td>
        <td><?php echo date("d-m-Y",strtotime($i->birthday))?></td>
        <td style="text-align:center;">
            <a href="admin/users/edit/<?php echo $i->id ?>" title=""><img src="theme_admin/img/icons/icon_edit.png" alt="Edit" /></a>
            <?php if ($i->status == 1) { ?>
                <a href="admin/users/hide/<?php echo $i->id ?>" title=""><img src="theme_admin/img/icons/icon_approve.png" alt="Approve" /></a>
            <?php } else { ?>
                <a href="admin/users/show/<?php echo $i->id ?>" title=""><img src="theme_admin/img/icons/icon_unapprove.png" alt="Unapprove" /></a>
            <?php } ?>

            <a data="" title="Delete" onclick="Alert('admin/users/delete/<?php echo $i->id ?>')"  style="cursor: pointer"><img src="theme_admin/img/icons/icon_square_close.png" alt="Delete" /></a>

        </td>
        <td style="text-align:center"><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
    </tr>
    <?php $x++;  }?>