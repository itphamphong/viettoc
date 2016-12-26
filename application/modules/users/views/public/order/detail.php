<div id="info-user">
    <?PHP $this->load->view("public/block_col_left")?>
    <div id="right-col-user" >
        <div class="title-cart"><?php echo $l->lang_order_info[$lang] ?></div>
        <div class="contentbox">
            <p class="title-order">THÔNG TIN ĐƠN HÀNG</p>
            <div class="i-title">
            <p class="">Mã đơn hàng: <span><?php echo $detail->code_booking?></span></p>
            <p>Ngày đặt hàng: <span><?php echo date("d-m-Y",strtotime($detail->date_create))?></span></p>
            </div>
            <table id="info-order">
                <thead>
                <th><?php echo $l->lang_product[$lang]?></th>
                <th><?php echo $l->lang_quantity[$lang]?></th>
                <th><?php echo $l->lang_price[$lang]?></th>
                <th><?php echo $l->lang_totla_price[$lang]?></th>
                </thead>
                <tbody>
                <?php
                $point=0;
                $x=0;
                $tong=$this->a_order->sum_total_order($detail->id);
                foreach($list_item as $list){
                    if($list->point==1)
                    {
                        $point=$point+($list->total);
                    }
                    ?>
                    <tr  <?php if ($x % 2 == 0) { ?>class="alt"<?php } ?>>
                        <td><?php echo $list->p_name?></td>
                        <td><?php echo  number_format($list->price,0,",",".")?> vnđ</td>
                        <td><?php echo  $list->quantity?></td>
                        <td><?php echo  number_format($list->price*$list->quantity,0,",",".")?> vnđ</td>

                    </tr>
                    <?php $x++;}?>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="red align-right"><?php echo "Tổng tiền"?>: </td>
                    <td class="red bold"><?php echo  number_format($tong,0,",",".")?> vnđ</td>
                </tr>
                </tbody>
            </table>
            <?php
                $buyer = $this->a_general->get_row("users",array("id" => $detail->buyer_id));
                $recipient_id = $this->a_general->get_row("user_buy",array("id" => $detail->recipient_id));

            ?>

            <div class="c10"></div>
            <div class="line-orange"></div>
            <div class="col-one-order">
                <p><strong>THÔNG TIN NGƯỜI MUA HÀNG</strong></p>

                <p><strong><?php echo $l->lang_full_name[$lang]?>:</strong><?php echo isset($buyer->full_name) ? $buyer->full_name : "" ?></p>

                <p><strong>Email: </strong><?php echo isset($buyer->email) ? $buyer->email : "" ?></p>

                <p><strong><?php echo $l->lang_cellphone[$lang]?> :</strong><?php echo isset($buyer->cell_phone) ? $buyer->cell_phone : "" ?></p>

                <p><strong><?php echo $l->lang_landline[$lang]?>:</strong><?php echo isset($buyer->landline) ? $buyer->landline : "" ?></p>

                <p><strong><?php echo $l->lang_address[$lang]?>:</strong> <?php echo isset($buyer->address) ? $buyer->address : "" ?>
                    <?php
                    $city = $this->a_general->get_row("location",array("id" => $buyer->city_id));
                    $agent = $this->a_general->get_row("location",array("id" => $buyer->agent_id));
                    echo ", " . $agent->name_vn . ", " . $city->name_vn;
                    ?>
                </p>

            </div>
            <div class="col-one-order" style="float: right">
                <p><strong>THÔNG TIN NGƯỜI NHẬN HÀNG</strong></p>

                <p><strong><?php echo $l->lang_full_name[$lang]?>:</strong><?php echo isset($recipient_id->full_name) ? $recipient_id->full_name : "" ?></p>

                <p><strong>Email: </strong><?php echo isset($recipient_id->email) ? $recipient_id->email : "" ?></p>

                <p><strong><?php echo $l->lang_cellphone[$lang]?> :</strong><?php echo isset($recipient_id->cell_phone) ? $recipient_id->cell_phone : "" ?></p>

                <p><strong><?php echo $l->lang_landline[$lang]?>:</strong><?php echo isset($recipient_id->landline) ? $recipient_id->landline : "" ?></p>

                <p><strong><?php echo $l->lang_address[$lang]?>:</strong> <?php echo isset($recipient_id->address) ? $recipient_id->address : "" ?>
                    <?php
                    $city_two = $this->a_general->get_row("location",array("id" => isset($recipient_id->city_id)?$recipient_id->city_id:0));
                    $agent_two = $this->a_general->get_row("location",array("id" => isset($recipient_id->agent_id)?$recipient_id->agent_id:0));
                    echo ", " . (isset($agent_two->name_vn)?$agent_two->name_vn:'') . ", " . (isset($city_two->name_vn)?$city_two->name_vn:'');
                    ?>
                </p>

            </div>
            <div class="c10"></div>
            <div class="line-orange"></div>
            <div id="store-order">
                <p class="note-important"><?php echo $l->lang_note[$lang] ?></p>
                <?php echo $detail->note ?>
            <?php $store = $this->a_store->get_detail_where(array("store.id" => isset($recipient_id->store_id) ? $recipient_id->store_id : 0),"vn");
            if (isset($store->id)) {
                ?>

                    <p class="bold"><?php echo $l->lang_info_store[$lang] ?></p>

                    <p><?php echo "<strong>" . $l->lang_store[$lang] . ":</strong> " . $store->store_name ?></p>

                    <p><?php echo "<strong>" . $l->lang_address[$lang] . ": </strong>" . $store->address_map ?></p>

                    <p><?php echo "<strong>" . $l->lang_phone[$lang] . ": </strong>" . $store->phone ?></p>

            <?php } ?>
            </div>

        </div>
    </div><!-- right-col-user-->
</div><!-- info-user-->
<script>
    $(document).ready(function(){
        $("#cboxContent #cboxClose").live("click",function(){
            window.location.reload();
        });
        $("#cboxOverlay").click(function(){
            window.location.reload();
        });
    })
</script>
</script>