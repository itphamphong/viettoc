<?php     foreach($list as $i){

    $status=$this->general->get_tableWhere(array("id"=>$i->status),"order_status");
    $tong=$this->m_order->sum_total($i->id);
    ?>
    <tr class="tr-product">
        <td><input type="checkbox" value="check_item[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"  /></td>
        <td class="text-left"><?php echo $i->code_booking?></td>

        <td><?php echo date("d-m-Y",strtotime($i->date_create))?></td>
        <td><?php echo isset($i->full_name)?$i->full_name:""?></td>

        <td><?php echo isset($status->name_vn)?$status->name_vn:"";?></td>
        <td><?php if($tong==0) echo "Liên hệ";else echo  number_format($tong,0,",",".")." vnđ"?> </td>
        <td  class="text-left" width="20%"><?php echo wordwrap($i->notice,100,"<br>")?></td>

    </tr>
<?php }?>