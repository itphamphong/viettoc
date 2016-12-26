<div id="info-user">
    <?PHP $this->load->view("notice/public/block_col_left")?>
    <div id="right-col-user" >
        <div class="title-cart"><?php echo $l->lang_order_info[$lang] ?></div>
        <p><a  onclick='printDiv("contentbox")' ><img src="<?php echo base_url()?>themes/images/layout/print.png"   style="float: right; cursor: pointer"></a></p>
        <div class="contentbox" id="contentbox">
            <p class="title-order">THÔNG TIN ĐƠN HÀNG  </p>
            <div class="i-title">
                <p class="">Mã đơn hàng: <span><?php echo $detail->code_booking?></span></p>
                <p>Ngày đặt hàng: <span><?php echo date("d-m-Y",strtotime($detail->date_create))?></span></p>
            </div>
            <?php
            $this->load->view('front/inc/messager', array('type_messager' => $this->input->get('messager')));
            ?>
            <table id="info-order">
                <th><?php echo $l->lang_code_product[$lang]?></th>
                <th><?php echo $l->lang_product[$lang]?></th>
                <th><?php echo $l->lang_quantity[$lang]?></th>
                <th><?php echo $l->lang_gif[$lang]?></th>
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
                        <td><?php echo $list->item_code?></td>
                        <td>
                            <img src="<?php echo base_url().$list->picture?>" width="50">
                            <br>
                            <i><?php echo $list->p_name?></i>
                        </td>
                        <td><?php echo  $list->quantity?></td>
                        <td><?php echo $list->gif?></td>

                        <td><?php echo  number_format($list->price,0,",",".")?> vnđ</td>

                        <td><?php echo  number_format($list->price*$list->quantity,0,",",".")?> vnđ</td>

                    </tr>
                    <?php $x++;}?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="red align-right"><?php echo "Tổng tiền"?>: </td>
                    <td class="red bold"><?php echo  number_format($tong,0,",",".")?> vnđ</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="red align-right"><?php echo "Điểm thưởng"?>: </td>
                    <td class="red bold">
                        <?php
                        if($point>=D_MONEY){
                            echo  round($point/D_MONEY,2);
                        }else{ echo "0";}
                        ?>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php
            if ($detail->type_account == 1) {
                $buyer = $this->a_general->get_row("users",array("id" => $detail->buyer_id));
                $recipient_id = $this->a_general->get_row("users",array("buyer_id" => $detail->buyer_id));
            }else{
                $buyer = $this->a_general->get_row("user_buy",array("id" => $detail->buyer_id));
                $recipient_id = $this->a_general->get_row("user_buy",array("id" => $detail->recipient_id,"buyer_id"=>$detail->buyer_id));
            }

                $check_user=$this->a_general->get_row("tbl_user", array("user_id" => $this->session->userdata("mod")->user_id, "user_status" => 1,"store_id"=>$detail->change_store_id));

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
                    echo ", " .(isset($agent->name_vn)?$agent->name_vn:"..." ). ", " . (isset($city->name_vn)?$city->name_vn:"...");
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
                    $city_two = $this->a_general->get_row("location",array("id" => $recipient_id->city_id));
                    $agent_two = $this->a_general->get_row("location",array("id" => $recipient_id->agent_id));
                    echo ", " . $agent_two->name_vn . ", " . $city_two->name_vn;
                    ?>
                </p>

            </div>
            <div class="c10"></div>
            <div class="line-orange"></div>
            <div id="store-order">
                <p class="note-important"><?php echo $l->lang_note[$lang] ?></p>
                <p class="note-cart"><?php echo $detail->note ?></p>
            <?php $store = $this->a_store->get_detail_where(array("store.id" => isset($detail->store_id) ? $detail->store_id : 0),"vn");
            if (isset($store->id)) {
                ?>

                    <p class="bold"><?php echo $l->lang_info_store[$lang] ?></p>

                    <p><?php echo "<strong>" . $l->lang_store[$lang] . ":</strong> " . $store->store_name ?></p>

                    <p><?php echo "<strong>" . $l->lang_address[$lang] . ": </strong>" . $store->address_map ?></p>

                    <p><?php echo "<strong>" . $l->lang_phone[$lang] . ": </strong>" . $store->phone ?></p>

            <?php } ?>
            </div>

        </div>
        <?php if($detail->store_id!=$detail->change_store_id){
        if(isset($check_user->user_id)){
            $store_process = $this->a_store->get_detail_where(array("store.id" => isset($detail->store_id) ? $detail->store_id : 0),"vn");
            $title=$l->lang_store_change[$lang];
        }else{
            $store_process = $this->a_store->get_detail_where(array("store.id" => isset($detail->change_store_id) ? $detail->change_store_id : 0),"vn");
            $title=$l->lang_store_process[$lang];
        }
            ?>
            <div class="c10"></div>
            <div id="store-order" style="width: 98%">
                <div class="c10"></div>
                <div class="title-cate"><?php echo $title?></div>
            <p class="note-cart"><?php echo $detail->change_store_note ?></p>
           <?php if (isset($store_process->id)) {
                ?>

                <p><?php echo "<strong>" . $l->lang_store[$lang] . ":</strong> " . $store_process->store_name ?></p>

                <p><?php echo "<strong>" . $l->lang_address[$lang] . ": </strong>" . $store_process->address_map ?></p>

                <p><?php echo "<strong>" . $l->lang_phone[$lang] . ": </strong>" . $store_process->phone ?></p>

            </div>
            <?php }?>
        <?php }?>
        <div class="c10"></div>
        <?php if(isset($check_user->user_id)){?>

        <form action="" method="post">
            <ul id="list-status">
                <?php foreach($status as $st){?>
                    <li><input type="radio" name="status" <?php if($st->id==$detail->status){?> checked <?php }?> value="<?php echo $st->id?>"><?php echo $st->name_vn?></li>
                <?php }?>
            </ul>
            <div style="clear: both; height: 10px"></div>
            <div style="float:left; margin-left: 10px"><strong>Mã khách hàng:</strong><input type="text" name="code_member" value="<?php echo isset($detail->code_member)?$detail->code_member:""?>"></div>
            <div style="clear: both; height: 10px"></div>
            <input type="submit" class="btn right mright_10" value="Cập nhật" name="ok" />
        </form>
        <?php }?>
    </div><!-- right-col-user-->
</div><!-- info-user-->
<script language="javascript">
    function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;

        //Reset the page's HTML with div's HTML only
        document.body.innerHTML =
            "<html><head><title></title></head><body>" +
            divElements + "</body>";

        //Print Page
        window.print();

        //Restore orignal HTML
        document.body.innerHTML = oldPage;


    }
</script>