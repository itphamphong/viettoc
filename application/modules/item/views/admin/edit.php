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
                <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                    $item_lang = $this->m_item->show_detail_item_id_lang($item->id, $lang->name);
                    ?>
                    <div class="col-xs-12">
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Tên sản phẩm</label>

                            <div class="col-sm-10">
                                <input class="form-control" data-url="#item_link_<?php echo $lang->name ?>" onblur="ChangeUrl(this)" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_" . $lang->name,isset($item_lang->item_name)?$item_lang->item_name:'#') ?>">
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Mã sản phẩm</label>

                            <div class="col-sm-6">
                                <input class="form-control" type="text" placeholder="Mã sản phẩm" name="item_code" value="<?php echo set_value("item_code",$item->item_code) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Giá gốc</label>

                            <div class="col-sm-6">
                                <input class="form-control mask_currency_vn" type="text" name="value" value="<?php echo set_value("value", $item->value) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Giá bán</label>

                            <div class="col-sm-6">
                                <input class="form-control mask_currency_vn" type="text" name="price" value="<?php echo set_value("price",$item->price) ?>">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Tồn kho</label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="number" value="<?php echo set_value("number", $item->number) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Thứ tự</label>

                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight", $item->item_weight) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Hiển thị</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option value="0" <?php echo set_select('status', 0, ($item->item_status==0)?TRUE:''); ?>>Không</option>
                                    <option value="1" <?php echo set_select('status', 1, ($item->item_status==1)?TRUE:''); ?>>Có</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label class="col-xs-2 control-label normal">Trạng thái</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <?php foreach ($this->m_item->show_list_item_status() as $status) {
                                        $params_status = array(
                                            "where" => array('item_id' => $item->id, 'status_id' => $status->id),
                                            "table" => "tmp_item_status"
                                        );
                                        $count_status = $this->global_function->count_tableWhere($params_status);
                                        ?>
                                        <div class="checkbox-inline">
                                            <label class="normal">
                                                <input type="checkbox" <?php if ($count_status > 0) echo 'checked' ?> value="<?php echo $status->id ?>"
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
                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 2, 'category.category_status' => '1', 'category.category_top' => 0)) as $row) {
                    $params = array(
                        "where" => array('item_id' => $item->id, 'category_id' => $row->id),
                        "table" => "item_category"
                    );
                    $count_p = $this->global_function->count_tableWhere($params);
                    ?>
                    <div class="text-left col-xs-4" style="list-style: none">
                        <div class="checkbox col-xs-12">
                            <label class="normal col-xs-12">
                                <input <?php if ($count_p > 0) echo 'checked' ?> type="checkbox" value="<?php echo $row->id ?>" name="category[]" data-id="<?php echo $row->id ?>"
                                                                                 data-url="<?php echo site_url('admin/item/load_tmp') ?>"><strong><?php echo $row->category_name ?></strong>
                            </label>

                            <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 2, 'category.category_status' => '1', 'category.category_top' => $row->id)) as $r) {
                                $params_child = array(
                                    "where" => array('item_id' => $item->id, 'category_id' => $r->id),
                                    "table" => "item_category"
                                );
                                $count_child = $this->global_function->count_tableWhere($params_child);
                                ?>
                                <label class="normal col-xs-12">
                                    <input <?php if ($count_child > 0) echo 'checked' ?> type="checkbox" value="<?php echo $r->id ?>" name="category[]"
                                                                                         data-id="<?php echo $r->id ?>"
                                                                                         data-url="<?php echo site_url('admin/item/load_tmp') ?>">|--<?php echo $r->category_name ?>
                                </label>
                                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 2, 'category.category_status' => '1', 'category.category_top' => $r->id)) as $rr) {
                                    $params_child2 = array(
                                        "where" => array('item_id' => $item->id, 'category_id' => $rr->id),
                                        "table" => "item_category"
                                    );
                                    $count_child2 = $this->global_function->count_tableWhere($params_child2);
                                    ?>
                                    <label class="normal col-xs-12">
                                        <input <?php if ($count_child2 > 0) echo 'checked' ?> type="checkbox" value="<?php echo $rr->id ?>" name="category[]"
                                                                                              data-id="<?php echo $rr->id ?>"
                                                                                              data-url="<?php echo site_url('admin/item/load_tmp') ?>">&nbsp;
                                        &nbsp;|----<?php echo $rr->category_name ?>
                                    </label>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item hide">
                <div class="title col_full fleft">THƯƠNG HIỆU</div>
                <div class="clear he1"></div>
                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 3, 'category.category_status' => '1')) as $row) {
                    $params = array(
                        "where" => array('item_id' => $item->id, 'category_id' => $row->id),
                        "table" => "item_category"
                    );
                    $count_p = $this->global_function->count_tableWhere($params);
                    ?>
                    <div class="text-left col-xs-4" style="list-style: none">
                        <div class="checkbox col-xs-12">
                            <label class="normal col-xs-12">
                                <input <?php if($count_p>0)  echo 'checked' ?> type="checkbox" value="<?php echo $row->id ?>" name="category[]" data-id="<?php echo $row->id ?>"
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
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $item_lang = $this->m_item->show_detail_item_id_lang($item->id, $lang->name);
                        ?>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thông số kĩ thuật</label>

                            <div class="col-sm-10 ">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_summary_" . $lang->name,'value'=>$item_lang->item_summary)) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Chi tiết</label>

                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_description_" . $lang->name,'value'=>$item_lang->item_description)) ?>

                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Video</label>

                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_video_" . $lang->name,'value'=>$item_lang->item_video)) ?>

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
                <?php $this->load->view("back/inc/choose_upload",array('choose'=>$item->choose_upload,'picture'=>$item->picture,"folder"=>"product")) ?>
                <div class="clear he3"></div>
                <div class="clear h1"></div>
                <div class="col-xs-12">
                    <div class="input-group col-xs-6">
                        <span class="input-group-addon">Alt</span>
                        <input type="text" class="form-control" name="alt_picture" placeholder="Nhập thông tin alt hình đại diện" value="<?php echo $item->alt_picture?>">
                    </div>
                    <div class="clear h1"></div>
                </div>
                <div class="col-xs-12">
                    <p class="sub-title">
                        <i class="fa fa-gg-circle"></i>HÌNH CHẠY SLIDE
                    </p>
                </div>
                <div class="clear he3"></div>
                <?php $this->load->view("back/inc/upload_img") ?>
                <input type="hidden" name="old_pic" value="<?php echo $item->picture?>">

            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item hide">
                <div class="title col_full fleft">TÀI LIỆU</div>
                <div class="list-btn pull-right">
                    <div class="i-btn i-add" style="margin: 10px" onclick="AddMoreFile()">Thêm mới</div>
                </div>
                <div class="clear he1"></div>
                    <?php
                    $list_doc=$this->global_function->list_tableWhere(array('item_id'=>$item->id),'item_doc');
                    foreach($list_doc as $doc){
                    ?>
                    <div class="col-xs-12">
                        <a class="pull-left" href="<?php echo site_url('admin/item/delete_doc/'.$doc->id."/".$item->id)?>"> <i class="fa  fa-minus-circle"></i> </a>
                        <div class="col-xs-10">
                           <a href="<?php echo base_url()."uploads/Images/doc/".$doc->doc_file ?>">Tải file (<?php echo !empty($doc->doc_name)?$doc->doc_name:$doc->doc_file?>)</a>
                        </div>
                    </div>
                    <?php }?>
                <div style="clear: both; height: 10px"></div>
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
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $item_lang = $this->m_item->show_detail_item_id_lang($item->id, $lang->name);
                        $seo=$this->m_item->show_detail_meta_seo_id_lang($item->id, $lang->name);
                        ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ URL</label>

                            <div class="col-sm-6">
                                <input class="  form-control" id="item_link_<?php echo $lang->name ?>" type="text" name="item_link_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("item_link_" . $lang->name,$item_lang->item_link) ?>">
                                <?php echo form_error("item_link_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ tiêu đề</label>

                            <div class="col-sm-6">
                                <input maxlength="70" class="maxlength_defaultconfig form-control" type="text" name="name_seo_<?php echo $lang->name ?>" value="<?php echo set_value("name_seo_" . $lang->name,isset($seo->name_seo)?$seo->name_seo:"") ?>">
                                <?php echo form_error("name_seo_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ từ khóa</label>

                            <div class="col-sm-6 ">
                                <textarea maxlength="200"  name="meta_keywords_<?php echo $lang->name ?>" id="meta_keywords_<?php echo $lang->name ?>"
                                          class="maxlength_defaultconfig form-control"><?php echo set_value("meta_keywords_" . $lang->name,isset($seo->meta_keywords)?$seo->meta_keywords:"") ?></textarea>
                                <?php echo form_error("meta_keywords_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ mô tả</label>

                            <div class="col-sm-6 ">
                                <textarea maxlength="200" name="meta_descriptions_<?php echo $lang->name ?>" id="meta_descriptions_<?php echo $lang->name ?>"
                                          class="form-control maxlength_defaultconfig"><?php echo set_value("meta_descriptions_" . $lang->name,isset($seo->meta_descriptions)?$seo->meta_descriptions:"") ?></textarea>
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
<script>
    jQuery(document).ready(function() {
        <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){?>
        generate_slug('input[id="name_<?php echo $lang->name ?>"]', 'input[id="item_link_<?php echo $lang->name ?>"]');
        <?php }?>
        FormFileUploadEdit.init(<?php echo $item->id?>);
    });

</script>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.jquery.js"></script>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/prism.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.css"/>
<script>
    jQuery(document).ready(function() {
        jQuery(".chosen-select").chosen();
    });

</script>



