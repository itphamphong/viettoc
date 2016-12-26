<div class="col_full fleft">
    <div class="col-lx-12 pr0">
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">THÔNG TIN NGƯỜI MUA HÀNG</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                        <p><strong>Họ & tên:</strong><?php echo isset($detail->full_name) ? $detail->full_name : "" ?></p>

                        <p><strong>Email: </strong><?php echo isset($detail->email) ? $detail->email : "" ?></p>

                        <p><strong>Điện thoại di động :</strong><?php echo isset($detail->cell_phone) ? $detail->cell_phone : "" ?></p>

                        <p><strong>Địa chỉ:</strong> <?php echo isset($detail->address) ? $detail->address : "" ?>
                        </p>
                </div>
            </div>
            <div class="clear he1"></div>
        <div class="col_full fleft info-item">
            <div class="title col_full fleft">CHI TIẾT ĐƠN HÀNG</div>
            <div class="clear he1"></div>
            <div class="col-xs-12">
                <table style="width: 100%" class="table">
                    <thead>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    </thead>
                    <tbody>
                    <?php
                    $point=0;
                    $x=0;
                    $tong=$this->m_order->sum_total($detail->id);
                    foreach($list_item as $list){
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
                        <td><?php echo  number_format($tong,0,",",".")?> vnđ</td>
                    </tr>
                    </tbody>
                </table>
                <form action="" method="post">
                <?php foreach($status as $st){?>
                    <label class="radio-inline">
                        <input type="radio" name="status" id="inlineRadio<?php echo $st->id ?>" value="<?php echo $st->id?>" <?php if($st->id==$detail->status){?> checked <?php }?>> <?php echo $st->name_vn?>
                    </label>
                <?php }?>
                    <div  style="display: none">
                        <input type="submit" name="ok" id="ok">
                        <input type="submit"  name="ok-continues" id="ok-continues">
                        <input type="reset" id="btn-reset">
                    </div>
                </form>
                <div style="clear: both; height: 10px"></div>
            </div>
        </div>
    </div>
    <div class="clear he1"></div>
    <div class="col-xs-6 list-btn">
        <a class="i-btn i-delete" href="<?php echo site_url("admin/order")?>">Quay lại</a>
        <span class="i-btn i-save" onclick="$('#ok').trigger('click')">Lưu</span>
        <span class="i-btn i-save-continues" onclick="$('#ok-continues').trigger('click')">Lưu và tiếp tục</span>
    </div>
</div>
<div class="clear he1"></div>