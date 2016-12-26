<div class="form-group">
    <label class="col-xs-2 control-label normal">Kích thước</label>

    <div class="col-sm-6">
        <div class="multiple-chosen ">
            <select name="size_id[]" multiple class="chosen-select" style="width:100%;">
                <option value="0" disabled>Click chọn nhiều</option>
                <?php foreach ($size as $s) {
                    $params = array(
                        "where" => array('item_id' => $item_id, 'tmp_id' => $s->id, "value" => "size"),
                        "table" => "item_tmp"
                    );
                    $count_s = $this->global_function->count_tableWhere($params);
                    ?>
                    <option value="<?php echo $s->id ?>" <?php if ($count_s > 0){ ?>selected <?php } ?>><?php echo $s->category_name ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-xs-8">
        <label class="col-xs-3 control-label normal">Màu sắc</label>

        <div class="col-sm-9">
            <?php foreach ($color as $c) {
                $params_c = array(
                    "where" => array('item_id' => $item_id, 'tmp_id' => $c->id, "value" => "color"),
                    "table" => "item_tmp"
                );

                $count_c = $this->global_function->count_tableWhere($params_c);
                $d=$this->global_function->get_tableWhere(array('tmp_id'=>$c->id,'item_id'=>$item_id,'value'=>'color'),'item_tmp');
                ?>
                <div class=" pad0 col-xs-8">
                    <div class="checkbox-inline">
                        <label class="normal">
                            <input type="checkbox" <?php if($count_c>0) echo 'checked'?>  value="<?php echo $c->id ?>" name="color_id[]"><?php echo $c->category_name ?>
                        </label>
                    </div>
                    <input type="file" name="bg_<?php echo $c->id ?>">
                </div>
                <div class="col-xs-4">
                    <?php

                    if(isset($d->id)) {
                        if (isset($d->picture)) {
                            ?>
                            <img src="<?php echo base_url() ?>uploads/color/<?php echo(isset($d->picture) ? $d->picture : '') ?>" width="100">
                            <i class="fa  fa-minus-circle" onclick="DeletePic(this)" data-url="<?php echo base_url('admin/item/DeletePic') ?>/<?php echo $d->id ?>"></i>
                        <?php }
                    }?>
                    <input type='hidden' name="old_<?php echo $c->id ?>" value="<?php echo isset($d->picture)?$d->picture:'NULL'; ?>">

                </div>

            <?php } ?>
        </div>
    </div>
</div>