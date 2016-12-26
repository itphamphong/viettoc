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
                        <th width="5%">ID</th>
                        <th width="20%">Người gửi</th>
                        <th width="40%">Nội dung</th>
                        <th>Ngày gửi</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="show_list_ajax">
                    <?php     foreach($contact as $i){
                        ?>
                        <tr class="tr-product">
                            <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                            <td><?php echo $i->id?></td>
                            <td class="text-left">
                               <?php echo $i->name?>
                                <?php if($i->status==0) echo '<i style="color:#B5D04E">[Chưa Đọc]</i>'?>
                            </td>
                            <td class="text-left"><?php echo $this->global_function->catchuoi($i->note,100)?></td>
                            <td style="text-align:center"><?php echo date('H:i:s d-m-Y',strtotime($i->date_reseive))?></td>
                            <td>
                                <a href="<?php echo base_url()?>admin/contact/view/<?php echo  $i->id ?>" class="btn default btn-sm green ">
                                    <i class="fa "></i> Xem
                                </a>
                                <a href="<?php echo base_url()?>admin/contact/delete/<?php echo $i->id ?>"  class="btn default btn-sm green">
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

