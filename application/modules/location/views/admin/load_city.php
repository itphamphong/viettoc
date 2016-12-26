<option value="0">---Chọn---</option>
<?php foreach ($list as $a) { ?>
    <option value="<?php echo $a->id ?>"><?php echo $a->name ?></option>
<?php } ?>