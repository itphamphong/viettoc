<div id="info-user">
    <?PHP $this->load->view("notice/public/block_col_left")?>
    <div id="right-col-user" >
        <div class="title-cart"><?php echo $l->lang_order_info[$lang] ?></div>
            <table width="100%" id="info-order">
                <thead>
                <tr>
                    <th ><?php echo $l->lang_code_booking[$lang]?></th>
                    <th><?php echo $l->lang_date_buy[$lang]?></th>
                    <th><?php echo $l->lang_total_money[$lang]?></th>
                    <th><?php echo $l->lang_status_order[$lang]?></th>
                    <th><?php echo $l->lang_view_detail[$lang]?></th>
                    <th class="show_qtip"><?php echo $l->lang_store_process[$lang]?></th>
                </tr>
                </thead>
                <tbody id="show_list_ajax">
                <?php
                $x=0;
                foreach($list as $i){
                    $status=$this->a_general->get_row("order_status",array("id"=>$i->status));
                    $total=$this->a_order->sum_total_order($i->id);
                    switch($i->status){
                        case 1:$style="font-weight:bold";break;
                        case 2:$style="font-style: italic";break;
                        case 3:$style="font-style: italic";break;
                        case 4:$style="opacity: 0.5";break;
                        default:$style="font-weight:bold";break;
                    }
                    $check_user=$this->a_general->get_row("tbl_user", array("user_id" => $this->session->userdata("mod")->user_id, "user_status" => 1,"store_id"=>$i->change_store_id));
                    if(isset($check_user->user_id)){
                        $store_name=$this->a_store->get_detail_where(array("store.id"=>$i->store_id),$lang);
                        $from=$l->lang_from_change[$lang].": ";

                    }else{
                        $store_name=$this->a_store->get_detail_where(array("store.id"=>$i->change_store_id),$lang);
                        $from='';

                    }
                    ?>
                    <tr  class="<?php if ($x % 2 == 0) { ?>alt<?php } ?> <?php if($i->store_id!=$i->change_store_id && (!isset($check_user->user_id))){?> changed <?php } ?>" style="<?php echo $style?>">
                        <td><a  href="<?php echo site_url($lang."/".$l->lang_url_detail_order_store[$lang]."/".$i->id)?>"><?php echo $i->code_booking?></a></td>
                        <td><?php echo date("d-m-Y H:i:s",strtotime($i->date_create))?></td>
                        <td><?php echo number_format($total,0,",",".")?> vnđ</td>
                        <td><?php
                            echo isset($status->name_vn)?$status->name_vn:"";
                            if($i->status==1){
                            ?>
                               <span class="r-cancel" id="cancel_<?php echo $i->id?>">| <a class="cancel" data-id="<?php echo $i->id?>" data-type="4" onclick="Cancel(this)"><?php echo $l->lang_cancel[$lang]?></a></span>
                        <?php }else if($i->status==4){?>
                                <span class="r-cancel" id="cancel_<?php echo $i->id?>">| <a class="cancel" data-id="<?php echo $i->id?>" data-type="1"  onclick="Cancel(this)"><?php echo $l->lang_restore[$lang]?></a></span>
                         <?php }?>
                        </td>
                        <td style="text-align:center">
                            <a href="<?php echo site_url($lang."/".$l->lang_url_detail_order_store[$lang]."/".$i->id)?>" title="Chỉnh sửa" class="i-detail-order">

                            </a>
                        </td>
                        <td>
                         <?php if($i->store_id==$i->change_store_id){?>
                        <a href="<?php echo site_url($lang."/".$l->lang_url_change_store[$lang]."/".$i->id)?>" class="change"><?php echo $l->lang_change_store[$lang]?></a>
                        <?php }else{
                             echo "<p class='red'>".$from.(isset($store_name->id)?$store_name->store_name:"...")."</p>"
                        ?>

                        <?php }?>
                        </td>
                    </tr>
                    <?php $x++;}?>
                </tbody>
            </table>
            <?  echo $link ?>
    </div><!-- right-col-user-->
</div><!-- info-user-->
<script>
    $(document).ready(function () {
        $(".i-delete-order").click(function () {
            $(".i-delete-order").removeClass("active");
            $(".r-cancel").hide();
            $("#show_list_ajax tr").removeClass("active");
            var id = $(this).attr("data-id");
            $("#cancel_" + id).fadeIn(500);
            $(this).addClass("active");
            $(this).parent().parent().addClass("active");
        })
    })
    function Cancel(e){
        var id=$(e).attr("data-id");
        var type=$(e).attr("data-type");
        $.post("update-type-order",{id:id,type:type},function(data){
            window.location.reload();
        })
    }
</script>
