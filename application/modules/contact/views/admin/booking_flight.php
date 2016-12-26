<div style="clear: both;"></div>
		</form>
	</div><div class="col_full fleft">
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
                        <th >ID</th>
                        <th >Họ tên</th>
                        <th >Điện thoại</th>
                        <th >CMND</th>
                        <th >Địa chỉ</th>

                        <th>Khởi hành</th>
                        <th>Điểm đến</th>
                        <th>Ngày gửi</th>
                        <th>Ghi chú</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="show_list_ajax">
                    <?php     foreach($contact as $i){
                        ?>
                        <tr class="tr-product">
                            <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                            <td><?php echo $i->id?></td>
                            <td class="text-left">
                               <?php echo $i->name?><br>
                                Người lớn: <?php echo $i->adults?>- Trẻ em: <?php echo $i->child?>- Em bé:<?php echo $i->baby?>

                            </td>
                            <td class="text-left">
                                <?php echo $i->phone?>
                            </td>
                            <td class="text-left">
                                <?php echo $i->cmnd?>
                            </td>
                            <td class="text-left">
                                <?php echo $i->address?>
                            </td>
                            <td class="text-left">
                                <?php echo $i->departure ?><br>
                                Ngày:<?php echo date('H:i:s',strtotime($i->date_lang_departure))?>
                            </td>
                            <td class="text-left">
                                <?php echo $i->destination?>
                            </td>
                            <td style="text-align:center"><?php echo date('H:i:s',strtotime($i->date_reseive))?></td>
                            <td class="text-left"><?php echo $this->global_function->catchuoi($i->note,100)?></td>

                            <td>
                                <a href="<?php echo base_url()?>admin/contact/delete_booking/<?php echo $i->id ?>"  class="btn default btn-sm green">
                                    <i class="fa  "></i> Xoá
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>

</div>

<?  echo $link ?>
<!-- Alternative Content Box End -->

