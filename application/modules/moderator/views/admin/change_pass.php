<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/moderator/index/"))?>
    <div class="clear he1"></div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">

        <?php
        $this->load->view('back/inc/messager', array('type_messager' => $this->input->get('messager')));
        ?>
        <form class="form-horizontal"  method="post" enctype="multipart/form-data">
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">THÔNG TIN TÀI KHOẢN</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Mật khẩu mới</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="password" name="new_pass" value="<?php echo set_value("new_pass")?>">
                        </div>
                        <?php echo form_error('new_pass'); ?>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Xác nhận lại mật khẩu</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="password" name="re_new_pass" value="<?php echo set_value("re_new_pass")?>">
                        </div>
                        <?php echo form_error('re_new_pass'); ?>
                    </div>
                </div>
            </div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/list_hide_button")?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/moderator/index/"))?>
    <div class="clear he3"></div>
</div>
<div class="clear"></div>




