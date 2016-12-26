<div class="col_full fleft">
        <form name="them" method="post" id="them" action=""	enctype="multipart/form-data">
            <div class="clear he1"></div>
            <div class="col-lx-12 pr0">
                <table class="table table-bordered">
                    <tr class="tr-product">
                        <th><input name="" type="checkbox" value="" id="checkboxall" /></th>
                        <th>ID</th>
                        <th>Tên sinh viên</th>
                        <th>Điện thoại</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Khóa học đã chọn</th>
                        <th>Ngày đặt</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                    <?php foreach($list as $row){?>
                        <tr>
                            <td></td>
                            <td><?php echo $row->booking_code?></td>
                            <td><?php echo $row->full_name?></td>
                            <td><?php echo $row->phone?></td>
                            <td><?php echo $row->email?></td>
                            <td><?php echo $row->address?></td>
                            <td><?php echo $row->course_name?></td>
                            <td><?php echo date('d-m-Y',strtotime($row->create_date))?></td>
                            <td>
                                <a href="<?php echo base_url()?>admin/users/book_detail/<?php echo $row->id?>"  class="btn default btn-sm green">
                                    <i class="fa  icon-black "></i> Xem
                                </a>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </form>
</div>