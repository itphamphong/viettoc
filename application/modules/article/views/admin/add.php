<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/article/index/".$type))?>
    <div class="clear he1"></div>
    <div class="col_full fleft bs-example-bg-classes" >
        <p class="bg-warning">
            <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){?>
                <?php echo form_error("name_".$lang->name)?>
            <?php }?>
        </p>
    </div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <?php $this->load->view("back/inc/menu_lang")?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal"> Tên bài viết </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>" value="<?php echo set_value("name_".$lang->name,"#")?>">
                            </div>
                        </div>
                        <div class="form-group  col-lang col-<?php echo $lang->name; ?>">
                            <label class="col-xs-2 control-label normal">Mô tả ngắn</label>
                            <div class="col-sm-10 ">
                                <?php $this->load->view("back/inc/editor_small", array("name" => "item_summary_".$lang->name)) ?>  </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thông tin chi tiết </label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_description_".$lang->name)) ?>
                            </div>
                        </div>
                    <?php }?>
                    <div class="clear"></div>
                    <div class="form-group ">
                        <label class="col-xs-2 control-label normal">Nhóm</label>
                        <div class="col-sm-10">
                            <div class="multiple-chosen ">
                                <select name="term_id[]" multiple class="chosen-select" style="width:100%;">
                                    <option value="0" disabled>Click chọn nhiều danh mục</option>
                                    <?php foreach ($list_cate as $rows) { ?>
                                        <option value="<?php echo $rows->id ?>" selected>
                                            <?php echo $rows->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div style="clear: both; height: 10px"></div>
                        <div class="col-xs-4"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label class="col-xs-4 control-label normal">Thứ tự</label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight",$weight)?>">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label class="col-xs-2 control-label normal">Hiện thị</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option value="0">Không</option>
                                    <option value="1" selected>Có</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3 hide">
                            <label class="col-xs-6 control-label normal">Hot</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="hot">
                                    <option value="0">Không</option>
                                    <option value="1">Có</option>
                                </select>
                            </div>
                        </div>
                        </div>
                    <div class="form-group hide">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Khuc vực</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="location_id">
                                    <?php foreach ($this->m_location->show_list_location_where(array("location.parent_id" => 0, 'location.status' => '1'), 0, 0, 'vn', 0) as $row) { ?>
                                        <option value="<?php echo $row->id ?>"
                                                style="color: #f00000"  ><?php echo $row->name ?></option>
                                        <?php foreach ($this->m_location->show_list_location_where(array("location.parent_id" => $row->id, 'location.status' => '1'), 0, 0, 'vn', 0) as $child) { ?>
                                            <option  value="<?php echo $child->id ?>" >
                                                |--<?php echo $child->name ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item ">
                <div class="title col_full fleft">HÌNH ẢNH SẢN PHẨM</div>
                <div class="clear he1"></div>
                <?php $this->load->view("back/inc/choose_upload") ?>
                <div class="clear h1"></div>
                <div class="col-xs-12">
                    <div class="input-group col-xs-6">
                        <span class="input-group-addon">Alt</span>
                        <input type="text" class="form-control" name="alt_picture" placeholder="Nhập thông tin alt hình đại diện">
                    </div>
                    <div class="clear h1"></div>
                </div>
                <div style="clear: both; height: 10px"></div>
            </div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/menu_lang")?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">SEO</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="col_full fleft bs-example-bg-classes" >
                        <p class="bg-warning">- Các yêu tố bên dưới hỗ trợ cho SEO Website lên các bộ máy tìm kiếm như Google, Bing, Yahoo, Ask,...</p>
                    </div>
                    <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ URL</label>

                            <div class="col-sm-6">
                                <input class="form-control" id="item_link_<?php echo $lang->name ?>" type="text"  name="item_link_<?php echo $lang->name ?>" value="<?php echo set_value("item_link_".$lang->name)?>">
                                <?php echo form_error("item_link_".$lang->name)?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ tiêu đề</label>

                            <div class="col-sm-6">
                                <input class="form-control" type="text"  name="name_seo_<?php echo $lang->name ?>" value="<?php echo set_value("name_seo_".$lang->name)?>">
                                <?php echo form_error("name_seo_".$lang->name)?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ từ khóa</label>

                            <div class="col-sm-6 ">
                                <textarea name="meta_keywords_<?php echo $lang->name ?>" id="meta_keywords_<?php echo $lang->name ?>" class="form-control"><?php echo set_value("meta_keywords_".$lang->name)?></textarea>
                                <?php echo form_error("meta_keywords_".$lang->name)?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ mô tả</label>

                            <div class="col-sm-6 ">
                                <textarea name="meta_descriptions_<?php echo $lang->name ?>" id="meta_descriptions_<?php echo $lang->name ?>" class="form-control"><?php echo set_value("meta_descriptions_".$lang->name)?></textarea>
                                <?php echo form_error("meta_descriptions_".$lang->name)?>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
            <?php $this->load->view("back/inc/list_hide_button")?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/category/index/".$type))?>
    <div class="clear he3"></div>
</div>
<div class="clear"></div>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.jquery.js"></script>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/prism.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.css"/>
<script>
    jQuery(document).ready(function() {
        jQuery(".chosen-select").chosen({max_selected_options: 1});
        <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){?>
        generate_slug('input[id="name_<?php echo $lang->name ?>"]', 'input[id="item_link_<?php echo $lang->name ?>"]');
        <?php }?>
    });

</script>



