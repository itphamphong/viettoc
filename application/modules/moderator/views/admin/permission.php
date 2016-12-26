<div class="col_full fleft">
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
    <div class="col-xs-6 list-btn">
        <a class="i-btn i-delete"  onclick="DAll()">Hủy tất cả</a>
        <span class="i-btn i-reset" onclick="PAll()">Cho phép tất cả</span>
        <span class="i-btn i-save" onclick="$('#ok').trigger('click')">Lưu</span>
        <span class="i-btn i-save-continues" onclick="$('#ok-continues').trigger('click')">Lưu và tiếp tục</span>
    </div>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered permission">
                <tr class="tr-product">
                    <th>Modules</th>
                    <th>Xem</th>
                    <th>Thêm</th>
                    <th>Sửa</th>
                    <th>Xóa</th>

                </tr>
                <tbody>
                <?php foreach($list_permission as $table){

                    ?>
                <tr>

                    <td class="w200"><label><?php echo $table->name?></label></td>
                    <td class="text-center">
                        <input  class="check_permission toggle hide" id="view_<?php echo $table->value?>" type="checkbox" name="level[]" value="view_<?php echo $table->value?>" <?php if ($this->general->Checkpermission_check($id, "view_".$table->value) == 1) { ?>  checked="checked"<?php } ?>>
                        <label class="checkbox-inline btn default btn-status status" for="view_<?php echo $table->value?>">
                            Chưa cấp quyền
                        </label>
                        <label class="checkbox-inline btn default btn-status no-status" for="view_<?php echo $table->value?>">
                            Cho phép
                        </label>
                    </td>
                    <td class="text-center">
                        <input  class="check_permission toggle hide" id="add_<?php echo $table->value?>" type="checkbox" name="level[]" value="add_<?php echo $table->value?>" <?php if ($this->general->Checkpermission_check($id, "add_".$table->value) == 1) { ?>  checked="checked"<?php } ?>>
                        <label class="checkbox-inline btn default btn-status status" for="add_<?php echo $table->value?>">
                            Chưa cấp quyền
                        </label>
                        <label class="checkbox-inline btn default btn-status no-status" for="add_<?php echo $table->value?>">
                            Cho phép
                        </label>
                    </td>
                    <td class="text-center">
                        <input  class="check_permission toggle hide" id="edit_<?php echo $table->value?>" type="checkbox" name="level[]" value="edit_<?php echo $table->value?>" <?php if ($this->general->Checkpermission_check($id, "edit_".$table->value) == 1) { ?>  checked="checked"<?php } ?>>
                        <label class="checkbox-inline btn default btn-status status" for="edit_<?php echo $table->value?>">
                            Chưa cấp quyền
                        </label>
                        <label class="checkbox-inline btn default btn-status no-status" for="edit_<?php echo $table->value?>">
                            Cho phép
                        </label>
                    </td>

                    <td class="text-center">
                        <input  class="check_permission toggle hide" id="delete_<?php echo $table->value?>" type="checkbox" name="level[]" value="delete_<?php echo $table->value?>" <?php if ($this->general->Checkpermission_check($id, "delete_".$table->value) == 1) { ?>  checked="checked"<?php } ?>>
                        <label class="checkbox-inline btn default btn-status status" for="delete_<?php echo $table->value?>">
                            Chưa cấp quyền
                        </label>
                        <label class="checkbox-inline btn default btn-status no-status" for="delete_<?php echo $table->value?>">
                            Cho phép
                        </label>
                    </td>
                </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    <?php $this->load->view("back/inc/list_hide_button")?>
    </form>
</div>