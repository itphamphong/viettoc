<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin")) ?>
    <div class="clear he1"></div>
    <div class="col_full fleft bs-example-bg-classes">
    </div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">THÔNG TIN</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Developing</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="facebook" value="<?php echo set_value("facebook",$info->facebook)?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-xs-2 control-label normal">Strategy</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="twitter" value="<?php echo set_value("twitter",$info->twitter)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Google +</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="google" value="<?php echo set_value("google",$info->google)?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-xs-2 control-label normal">linkIn</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="linkin" value="<?php echo set_value("linkin",$info->linkin)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Youtube</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="youtube" value="<?php echo set_value("youtube",$info->youtube)?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Website</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="website" value="<?php echo set_value("website",$info->website)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Email</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="email" value="<?php echo set_value("email",$info->email)?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-xs-2 control-label normal">Fax</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="fax" value="<?php echo set_value("email",$info->fax)?>">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="col-xs-2 control-label normal">Phone</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="phone" value="<?php echo set_value("phone",$info->phone)?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Holine</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="text"  name="hotline" value="<?php echo set_value("hotline",$info->hotline)?>">
                        </div>
                    </div>

                </div>
            </div>
            <div class="clear he1"></div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/list_hide_button") ?>

        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/company")) ?>
    <div class="clear he3"></div>
</div>