<div class="col-xs-12">
    <div class="col-center">
        <div class="col-xs-2 pad0">
            <?php $this->load->view('users/public/block_col_left') ?>
        </div>
        <div class="col-xs-10">
            <div class="round-title blue">Khách sạn</div>
            <table class="table">
                <thead>
                <th>Loại</th>
                <th>Mã booking</th>
                <th>Ngày đặt</th>
                </thead>
                <tbody>
                <?php foreach ($list as $l1) {
                    $list_item = $this->a_order->ItemOrderDetail($l1->id);
                    ?>
                    <tr class="tr-parent" onclick="ShowTr(this)" data="0">
                        <td>
                            <?php
                            if ($l1->type == 'hotel') echo "Phòng khách sạn";
                            else if ($l1->type == 'room') echo "Gói phòng khuyến mãi";
                            else if ($l1->type == 'tour') echo "Tour"
                            ?>
                        </td>
                        <td>
                            <?php echo $l1->code_booking ?>
                        </td>
                        <td>
                            <?php echo date('d-m-Y', strtotime($l1->date_create)) ?>
                        </td>
                    </tr>
                    <?php if (count($list_item) > 0) { ?>
                        <tr class="hide-tr">
                            <td colspan="3" class="pad0">
                                <?php
                                if ($l1->type == 'hotel') {
                                    ?>
                                    <table class="table table-child">
                                        <thead>
                                        <th>Tên phòng</th>
                                        <th>SL</th>
                                        <th>Giá phòng</th>
                                        <th>Giường phụ</th>
                                        <th>Tổng</th>
                                        </thead>
                                        <?php foreach ($list_item as $item) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($item->p_name, 20, "<br />\n"); ?></td>
                                                <td><?php echo $item->quantity ?></td>
                                                <td><?php echo $this->global_function->get_price($item->price) ?></td>
                                                <td><?php echo $item->num_bed . " x " . $this->global_function->get_price($item->price_bed) ?></td>
                                                <td class="red"><?php echo $this->global_function->get_price($item->total) ?></td>

                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php } else if ($l1->type == 'room') { ?>
                                    <table class="table table-child">
                                        <thead>
                                        <th>Gói khuyến mãi</th>
                                        <th>SL</th>
                                        <th>Giá phòng</th>
                                        <th>Tổng</th>
                                        </thead>
                                        <?php foreach ($list_item as $item) { ?>
                                            <tr>
                                                <td><i class="fa fa-gift red "></i><?php echo wordwrap($item->p_name, 20, "<br />\n"); ?></td>
                                                <td><?php echo $item->quantity ?></td>
                                                <td><?php echo $this->global_function->get_price($item->price) ?></td>
                                                <td class="red"><?php echo $this->global_function->get_price($item->total) ?></td>

                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php } else if ($l1->type == 'tour') { ?>
                                    <table class="table table-child">
                                        <thead>
                                        <th>Tên tour</th>
                                        <th>SL</th>
                                        <th>Số người</th>
                                        <th>Người lớn</th>
                                        <th>Trẻ em</th>
                                        <th>Khởi hành</th>
                                        <th>Giá</th>
                                        <th>Tổng</th>
                                        </thead>
                                        <?php foreach ($list_item as $item) { ?>
                                            <tr>
                                                <td><?php echo wordwrap($item->p_name, 20, "<br />\n"); ?></td>
                                                <td><?php echo $item->quantity ?></td>
                                                <td><?php echo $item->number ?></td>
                                                <td><?php echo $item->adults ?></td>
                                                <td><?php echo $item->child ?></td>
                                                <td><?php echo date("d-m-Y", strtotime($item->departure)) ?></td>
                                                <td><?php echo $this->global_function->get_price($item->price) ?></td>
                                                <td class="red"><?php echo $this->global_function->get_price($item->total) ?></td>

                                            </tr>
                                        <?php } ?>
                                    </table>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>