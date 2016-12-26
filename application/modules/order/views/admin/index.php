<div class="col_full fleft">
    <div class="clear he1"></div>
    <div class="col-xs-6 list-btn fright">
        <span class="btn default btn-sm red" onclick="Delete()"><i class="fa fa fa-times"></i> Hủy</span>


    </div>
    <div class="clear he1"></div>
    <form action="" method="get" id="f_reports " class="form-search">
        <div class="col_full fleft bg-search">
            <div class="col-xs-4">
                <input class="form-control"  name="key" id="key" placeholder="Mã đơn hàng, phone, email">
            </div>
            <div  class="col-xs-2 pl0">
                <select name="status" id="status" class="form-control">
                    <option value="0">Chọn tình trạng</option>
                    <?php foreach ($status as $st) { ?>
                        <option value="<?php echo $st->id ?>"><?php echo $st->name_vn ?></option>
                    <?php } ?>
                </select>
            </div>
            <div  class="col-xs-2 pl0">
                <input type="text" id="start_datetimepicker" name="date_one" class="form-control" placeholder="Mua từ"/>
            </div>
            <div class="col-xs-2 pl0">
                <input type="text" id="end_datetimepicker" name="date_two" class="form-control" placeholder="Đến ngày"/>
            </div>
            <div class="col-xs-2 pl0">  <input type="button" class="btn fleft" value="Tìm kiếm" name="ok"   id="btn_search" /></div>
        </div>

    </form>
    <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">

        <p style="display:none">
            <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit"	value="Delete" />
        </p>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered">
                <tr class="tr-product">
                    <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tên người mua</th>
                    <th>Tình trạng</th>
                    <th>Tổng tiền</th>
                    <th>Ghi chú</th>
                </tr>
                <tbody id="show_list_ajax">
                <?php     foreach($list as $i){
                    $status=$this->general->get_tableWhere(array("id"=>$i->status),"order_status");
                    $tong=$this->m_order->sum_total($i->id);
                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
                        <td class="text-left"><a href="<?php echo base_url()?>admin/order/view/<?php echo $i->id?>"><?php echo $i->code_booking?></a></td>

                        <td><?php echo date("d-m-Y",strtotime($i->date_create))?></td>
                        <td><?php echo isset($i->full_name)?$i->full_name:""?></td>
                        <td><?php echo isset($status->name_vn)?$status->name_vn:"";?></td>
                        <td><?php if($tong==0) echo "Liên hệ";else echo  number_format($tong,0,",",".")." vnđ"?> </td>
                        <td  class="text-left" width="20%"><?php echo wordwrap($i->notice,100,"<br>")?></td>

                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </form>
</div>
<script src="<?php echo base_url() ?>themes/back/js/datetimepicker-master/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/js/datetimepicker-master/jquery.datetimepicker.css"/>
<script>
    $(document).ready(function(){
        $('#start_datetimepicker').datetimepicker({
            format:'Y/m/d H:i:00',
            lang:'vi',
            timepicker:false,
        });
        $('#end_datetimepicker').datetimepicker({
            format:'Y/m/d H:i:00',
            lang:'vi',
            timepicker:false,
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_search").click(function(){
            var date_one=$('input[name="date_one"]').val();
            var date_two=$('input[name="date_two"]').val();
            var order_status=$("#status").val();
            var store_id=$("#store_id").val();
            var key=$("#key").val();
            if(date_one =='' && date_two=='' && order_status==0 && store_id==0 && key==''){
                alert("Bạn chưa chọn thuộc tính !");
                return false;
            }
            $('#show_list_ajax').html("<tr><td colspan='7' style='text-align: center;'><img src='themes/images/layout/loading.gif' style='margin:auto'/></td></tr>");
            $.post("<?php echo base_url()?>admin/order/list_ajax", {date_one:date_one,date_two:date_two,order_status:order_status,store_id:store_id,key:key},function(data){
                $('#show_list_ajax').html(data);
            });


        })
    });
</script>
