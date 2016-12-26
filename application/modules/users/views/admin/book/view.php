<div class="col_full fleft">
    <form name="them" method="post" id="them" action="" enctype="multipart/form-data">
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">THÔNG TIN SINH VIÊN</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="deatail-book">
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Mã Booking:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->booking_code ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Tên khóa học:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->course_name ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Chủ đề:</div>
                            <div class="col-xs-8"><strong><?php echo isset($subject->browse_lession_name) ? $subject->browse_lession_name : '' ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Ngày đặt:</div>
                            <div class="col-xs-8"><strong><?php echo date('d-m-Y', strtotime($detail->create_date)) ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Giá:</div>
                            <div class="col-xs-8"><strong>$ <?php echo $detail->price ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Hình thức học:</div>
                            <div class="col-xs-8">
                                <strong>
                                    <?php if ($detail->type_teach == 1) echo 'Online'; else if ($detail->type_teach == 2) echo 'In-house'; else echo 'In-class' ?>
                                </strong>
                            </div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Thời gian đăng ký:</div>
                            <div class="col-xs-8">
                                <strong>

                                    <?php echo str_replace(',', '<br>', $detail->time_work) ?>

                                </strong>
                            </div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Họ tên:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->full_name ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Email:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->email ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Điện thoại:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->phone ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Địa chỉ:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->address ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Ghi chú 1:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->message ?></strong></div>
                        </div>
                        <div class="col-xs-12 i-detail">
                            <div class="col-xs-2">Ghi chú 2:</div>
                            <div class="col-xs-8"><strong><?php echo $detail->note ?></strong></div>
                        </div>
                        <form action="" method="post">
                            <div class="col-xs-12 i-detail">
                                <div class="col-xs-2">Tình trạng booking:</div>
                                <div class="col-xs-8">
                                    <?php foreach ($status as $st) { ?>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" id="inlineRadio<?php echo $st->id ?>"
                                                   value="<?php echo $st->id ?>" <?php if ($st->id == $detail->status) { ?> checked <?php } ?>> <?php echo $st->name_vn ?>
                                        </label>
                                    <?php } ?>
                                </div>
                                <div style="display: none">
                                    <input type="submit" name="ok" id="ok">
                                    <input type="submit" name="ok-continues" id="ok-continues">
                                    <input type="reset" id="btn-reset">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div style="clear: both; height: 10px"></div>

                    <div class="col-xs-6 list-btn">
                        <a class="i-btn i-delete" href="<?php echo site_url("admin/users/book_tutor") ?>">Quay lại</a>
                        <span class="i-btn i-save" onclick="$('#ok').trigger('click')">Lưu</span>
                        <span class="i-btn i-save-continues" onclick="$('#ok-continues').trigger('click')">Lưu và tiếp tục</span>
                    </div>
                    <div style="clear: both; height: 10px"></div>
                </div>
            </div>
        </div>
    </form>
</div>