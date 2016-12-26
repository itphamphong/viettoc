<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/moderator/index/"))?>
    <div class="clear he1"></div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Tên</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="name" value="<?php echo set_value("name",$permission->name)?>">
                        </div>
                        <?php echo form_error('name'); ?>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Value</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text" name="value" value="<?php echo set_value("value",$permission->value)?>">
                        </div>
                        <?php echo form_error('value'); ?>
                    </div>

                    <div class="clear"></div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Hiện thị</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option value="0" <?php if($permission->status==0){?> selected <?php }?>>Không</option>
                                    <option value="1" <?php if($permission->status==1){?> selected <?php }?>>Có</option>
                                </select>
                            </div>
                        </div>
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



