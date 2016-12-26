<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <div class="col-xs-6 list-btn">
        <a class="i-btn i-delete" href="<?php echo base_url() ?>admin/item">Hủy</a>
        <span class="i-btn i-reset" onclick="$('#btn-reset').trigger('click')">Nhập lại</span>
        <span class="i-btn i-save" onclick="$('#ok').trigger('click')">Lưu</span>
        <span class="i-btn i-save-continues" onclick="$('#ok-continues').trigger('click')">Lưu và tiếp tục</span>
    </div>
    <div class="clear he1"></div>
    <div class="col_full fleft bs-example-bg-classes">
        <p class="bg-warning">
            <?php echo form_error("item_code") ?>
            <?php echo form_error("value") ?>
        </p>
    </div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">THÔNG TIN SẢN PHẨM</div>
                <div class="clear he1"></div>
                <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) { ?>
                    <div class="col-xs-12">
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Tên sản phẩm</label>
                            <div class="col-sm-10">
                                <input class="form-control" data-url="#item_link_<?php echo $lang->name ?>" onblur="ChangeUrl(this)" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_" . $lang->name, "#") ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Mã sản phẩm</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" placeholder="Mã sản phẩm" name="item_code" value="<?php echo set_value("item_code", $code) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Giá gốc</label>
                            <div class="col-sm-6">
                                <input class="form-control mask_currency_vn" type="text" name="value" value="<?php echo set_value("value", 0) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Giá bán</label>
                            <div class="col-sm-6">
                                <input class="form-control mask_currency_vn" type="text" name="price" value="<?php echo set_value("price", 0) ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Tồn kho</label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="number" value="<?php echo set_value("number", 1) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Thứ tự</label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight", $weight) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Hiển thị</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option value="0" <?php echo set_select('status', 0, (isset($_POST['status']) && $_POST['status'] == 0) ? TRUE : ''); ?>>Không</option>
                                    <option
                                        value="1" <?php echo set_select('status', 1, (!isset($_POST['status']) || (isset($_POST['status']) && $_POST['status'] == 1)) ? TRUE : ''); ?>>
                                        Có
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="col-xs-2 control-label normal">Trạng thái</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <?php foreach ($this->m_item->show_list_item_status() as $status) { ?>
                                        <div class="checkbox-inline">
                                            <label class="normal">
                                                <input type="checkbox" value="<?php echo $status->id ?>"
                                                       name="item_status[]" <?php echo set_checkbox('item_status[]', $status->id); ?>><?php echo $status->item_status_name ?>
                                            </label>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear he1"></div>
            <!-- Nhóm sản phẩm-->
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">NHÓM SẢN PHẨM</div>
                <div class="clear he1"></div>
                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 2, 'category.category_status' => '1')) as $row) {
                    ?>
                    <div class="text-left col-xs-4" style="list-style: none">
                        <div class="checkbox col-xs-12">
                            <label class="normal col-xs-12">
                                <input type="checkbox" value="<?php echo $row->id ?>" name="category[]" data-id="<?php echo $row->id ?>"
                                       data-url="<?php echo site_url('admin/item/load_tmp') ?>"><strong><?php echo $row->category_name ?></strong>
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="clear he1"></div>
            <!-- Nhóm sản phẩm-->
            <div class="col_full fleft info-item hide">
                <div class="title col_full fleft">THƯƠNG HIỆU</div>
                <div class="clear he1"></div>
                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 3, 'category.category_status' => '1')) as $row) {
                    ?>
                    <div class="text-left col-xs-4" style="list-style: none">
                        <div class="checkbox col-xs-12">
                            <label class="normal col-xs-12">
                                <input type="checkbox" value="<?php echo $row->id ?>" name="category[]" data-id="<?php echo $row->id ?>"
                                       data-url="<?php echo site_url('admin/item/load_tmp') ?>"><strong><?php echo $row->category_name ?></strong>
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">NỘI DUNG SẢN PHẨM</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) { ?>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thông số kĩ thuật</label>
                            <div class="col-sm-10 ">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_summary_" . $lang->name)) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Chi tiết</label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_description_" . $lang->name)) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Video</label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_video_" . $lang->name)) ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear he1"></div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">HÌNH ẢNH SẢN PHẨM</div>
                <?php $this->load->view("back/inc/choose_upload") ?>
                <div class="clear h1"></div>
                <div class="col-xs-12">
                    <div class="input-group col-xs-6">
                        <span class="input-group-addon">Alt</span>
                        <input type="text" class="form-control" name="alt_picture" placeholder="Nhập thông tin alt hình đại diện">
                    </div>
                    <div class="clear h1"></div>
                </div>

                <div class="clear he3"></div>
                <div class="col-xs-12">
                    <p class="sub-title">
                        <i class="fa fa-gg-circle"></i>HÌNH CHẠY SLIDE
                    </p>
                </div>
                <?php $this->load->view("back/inc/upload_img") ?>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item hide">
                <div class="title col_full fleft">TÀI LIỆU</div>
                <div class="list-btn pull-right">
                    <div class="i-btn i-add" style="margin: 10px" onclick="AddMoreFile()">Thêm mới</div>
                </div>
                <div class="clear he1"></div>
                <div class="round-file">
                    <div class="col-xs-12">
                        <div class="pull-left"> <i class="fa  fa-minus-circle" onclick="$(this).parent().parent().remove()"></i> </div>
                        <div class="col-xs-2">
                            <input type="file" name="doc[]">
                        </div>
                        <div class="col-xs-6">
                            <div class="input-group col-xs-6">
                                <span class="input-group-addon">Tên file</span>
                                <input type="text" class="form-control" name="name_doc[]" placeholder="Nhập tên file hiển thị">
                            </div>
                            <div class="clear h1"></div>
                        </div>
                        <input type="hidden" name="doc_id[]" value="1">
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">SEO</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="col_full fleft bs-example-bg-classes">
                        <p class="bg-warning">- Các yêu tố bên dưới hỗ trợ cho SEO Website lên các bộ máy tìm kiếm như Google, Bing, Yahoo, Ask,...</p>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Từ khóa tìm kiếm</label>

                        <div class="col-sm-6">
                            <div class="multiple-chosen ">
                                <select name="tag_id[]" multiple class="chosen-select" style="width:100%;">
                                    <option value="0" disabled>Click chọn nhiều danh mục</option>
                                    <?php foreach ($this->m_tags->show_list_tags_where(array('tags.status' => 1), 0, 0, 'vn', 0) as $rows) { ?>
                                        <option value="<?php echo $rows->id ?>">
                                            <?php echo $rows->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) { ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ URL</label>

                            <div class="col-sm-6">
                                <input class="  form-control" id="item_link_<?php echo $lang->name ?>" type="text" name="item_link_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("item_link_" . $lang->name) ?>">
                                <?php echo form_error("item_link_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ tiêu đề</label>

                            <div class="col-sm-6">
                                <input maxlength="70" class="maxlength_defaultconfig form-control" type="text" name="name_seo_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_seo_" . $lang->name) ?>">
                                <?php echo form_error("name_seo_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ từ khóa</label>

                            <div class="col-sm-6 ">
                                <textarea maxlength="200" name="meta_keywords_<?php echo $lang->name ?>" id="meta_keywords_<?php echo $lang->name ?>"
                                          class="maxlength_defaultconfig form-control"><?php echo set_value("meta_keywords_" . $lang->name) ?></textarea>
                                <?php echo form_error("meta_keywords_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ mô tả</label>

                            <div class="col-sm-6 ">
                                <textarea maxlength="200" name="meta_descriptions_<?php echo $lang->name ?>" id="meta_descriptions_<?php echo $lang->name ?>"
                                          class="form-control maxlength_defaultconfig"><?php echo set_value("meta_descriptions_" . $lang->name) ?></textarea>
                                <?php echo form_error("meta_descriptions_" . $lang->name) ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div style="display: none">
                <input type="submit" name="ok" id="ok">
                <input type="submit" name="ok-continues" id="ok-continues">
                <input type="reset" id="btn-reset">
            </div>
        </form>
    </div>
    <div class="clear he3"></div>
    <div class="col-xs-6 list-btn">
        <a class="i-btn i-delete" href="<?php echo base_url() . "admin/item" ?>">Hủy</a>
        <span class="i-btn i-reset" onclick="$('#btn-reset').trigger('click')">Nhập lại</span>
        <span class="i-btn i-save" onclick="$('#ok').trigger('click')">Lưu</span>
        <span class="i-btn i-save-continues" onclick="$('#ok-continues').trigger('click')">Lưu và tiếp tục</span>
    </div>
    <div class="clear he3"></div>
</div>
<input type="hidden" value="0" id="item_id">
<input type="hidden" value="<?php echo site_url('admin/item/load_tmp') ?>" id="url_load">
<div class="clear"></div>
<script>
    jQuery(document).ready(function () {
        FormFileUpload.init('<?php echo base_url("admin/item")?>/');
    });
</script>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.jquery.js"></script>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/prism.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.css"/>
<script>
    jQuery(document).ready(function () {
        jQuery(".chosen-select").chosen();
    });

</script>

