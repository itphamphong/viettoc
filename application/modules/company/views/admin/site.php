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
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ CHUNG</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $row = $this->general->show_company($lang->name);
                        ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Tên site</label>

                            <div class="col-sm-6 ">
                                <input class="form-control" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_" . $lang->name, $row->name) ?>">
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Meta keywords</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" type="text" id="meta_keywords_<?php echo $lang->name ?>" name="meta_keywords_<?php echo $lang->name ?>"
                                          style="height: 100px"><?php echo set_value("meta_keywords_" . $lang->name, $row->meta_keywords) ?></textarea>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Meta description</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" type="text" id="meta_descriptions_<?php echo $lang->name ?>" name="meta_descriptions_<?php echo $lang->name ?>"
                                          style="height: 100px"><?php echo set_value("meta_descriptions_" . $lang->name, $row->meta_descriptions) ?></textarea></div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-xs-2 control-label normal">Thông tin hỗ trợ</label>

                            <div class="col-sm-6">
                                <?php $this->load->view("back/inc/editor", array("name" => "info_support_" . $lang->name, "value" => $row->info_support)) ?>
                            </div>
                        </div>

                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Địa chỉ</label>

                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="address_<?php echo $lang->name ?>" name="address_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("address_" . $lang->name, $row->address) ?>">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-xs-2 control-label normal">Thời gian làm việc</label>

                            <div class="col-sm-6">
                                <textarea class="form-control" type="text" id="time_work_<?php echo $lang->name ?>" name="time_work_<?php echo $lang->name ?>"
                                          style="height: 100px"><?php echo set_value("time_work_" . $lang->name, $row->time_work) ?></textarea>
                            </div>
                        </div>

                        <div class="form-group col-lang col-<?php echo $lang->name ?> ">
                            <label class="col-xs-2 control-label normal">Thông tin liên hệ</label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor_small", array("name" => "about_company_" . $lang->name, 'value' => isset($row->about_company) ? $row->about_company : "")) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Mô hình kinh doanh</label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor_small", array("name" => "note_home_" . $lang->name, 'value' => isset($row->note_home) ? $row->note_home : "")) ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group ">
                        <label class="col-xs-2 control-label normal">Copyright</label>

                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="copyright" value="<?php echo set_value("copyright",$info->copyright) ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">HÌNH ẢNH</div>
                <div class="clear he1"></div>
                <?php
                foreach ($company_pic as $pic) {
                    ?>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal"><?php echo $pic->title ?></label>
                        <div class="col-sm-10 upload-<?php echo $pic->id?>">
                            <div class="col-xs-12 ">
                                <div class="radio-list">
                                    <label>
                                        <div class="radio" id="uniform-optionsRadios1<?php echo $pic->id ?>">
                                            <span><input data-class="upload-<?php echo $pic->id?>"  onchange="ChangeChoseUpload(this)" type="radio" name="optionsRadios-<?php echo $pic->name ?>" id="optionsRadios1<?php echo $pic->id ?>" value="1"  <?php if($pic->choose_upload==1){?>checked <?php }?>></span>
                                        </div>
                                        Chọn ảnh từ máy tính
                                    </label>
                                    <label>
                                        <div class="radio" id="uniform-optionsRadios2<?php echo $pic->id ?>">
                                            <span>
                                                <input data-class="upload-<?php echo $pic->id?>" onchange="ChangeChoseUpload(this)" type="radio" name="optionsRadios-<?php echo $pic->name ?>" id="optionsRadios2<?php echo $pic->id ?>" value="2" <?php if($pic->choose_upload==2){?>checked <?php }?>>
                                            </span>
                                        </div>
                                        Chọn ảnh từ thư viện
                                    </label>

                                </div>
                            </div>
                            <div class="col-xs-6">
                                <input type="file" name="<?php echo $pic->name ?>" class="chose_computer"  <?php if($pic->choose_upload==1){?> style="display: block" <?php }?>>
                                <input name="old_<?php echo $pic->name ?>" value="<?php echo $pic->name ?>" type="hidden">
                                <input type="hidden" name="<?php echo $pic->name ?>" id="<?php echo $pic->name ?>" class="txt" value="<?php echo $pic->value ?>"/>
                                <input onclick="BrowseServer('Images:/', '<?php echo $pic->name ?>')" type="button" name="btnChonFile" id="btnChonFile"
                                       value="Chọn ảnh từ thư viện" class="chose_web" <?php if($pic->choose_upload==2){?> style="display: block" <?php }?>/>
                                <div class="clear h1"></div>
                                Alt:<input type="text" name="alt_<?php echo $pic->name ?>" value="<?php echo $pic->alt ?>">
                            </div>
                            <div class="col-xs-6">
                                <div class="show-img show-img-<?php echo $pic->name ?>" style="width: 200px">
                                    <?php if($pic->choose_upload==1){?>
                                        <img src="<?php echo base_url()?>uploads/Images/config/<?php echo $pic->value?>">
                                    <?php }else{?>
                                    <img src="<?php echo $this->global_function->get_picture($pic->value) ?>">
                                    <?php }?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="old_<?php echo $pic->name?>" value="<?php echo $pic->value?>">
                <?php } ?>
            </div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/list_hide_button") ?>

        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/company")) ?>
    <div class="clear he3"></div>
</div>
<script>
    $(document).ready(function(){
        LoadChangeChoseUpload();
    });
</script>