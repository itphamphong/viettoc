<div class="col_full fleft">
    <div class="clear he1"></div>
    <div class="col-xs-6 list-btn fright">
        <p style="display:none">
            <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
        </p>
        <a class="i-btn i-delete" onclick="Delete()">Xoá</a>

    </div>
    <div class="clear he1"></div>
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">

        <p style="display:none">
            <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
        </p>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">
                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    <th>Email</th>
                    <th>Ngày gửi</th>
                </tr>
                <tbody id="show_list_ajax">
                <?php     foreach($contact as $i){
                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                        <td class="text-left"><?php echo $i->email?></td>
                        <td class="text-left"><?php echo date('Y-m-d',strtotime($i->create_date))?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </form>
</div>
