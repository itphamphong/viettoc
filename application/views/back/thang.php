<option <? if($thang==-1) echo 'selected="selected"'; ?> value="-1">Xem tất cả</option>         
<? if($thang!=-1) {for($i=1;$i <= $ngay;$i++) { ?>
<option value="<?=$i?>"  > <?=$i?> </option>
<? } } ?>