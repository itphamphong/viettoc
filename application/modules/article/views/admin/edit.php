<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/article/index/" . $type)) ?>
    <div class="clear he1"></div>
    <div class="col_full fleft bs-example-bg-classes">
        <p class="bg-warning">
            <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) { ?>
                <?php echo form_error("name_" . $lang->name) ?>
            <?php } ?>
        </p>
    </div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $row = $this->m_article->show_detail_article_id($article->id, $lang->name);
                        ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Tên bài viết</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_" . $lang->name, (isset($row->article_name) ? $row->article_name : '')) ?>">
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name; ?>">
                            <label class="col-xs-2 control-label normal">Mô tả ngắn</label>
                            <div class="col-sm-10 ">
                                <?php $this->load->view("back/inc/editor_small", array("name" => "item_summary_" . $lang->name, "value" => (isset($row->article_summary) ? $row->article_summary : 'Đang cập nhật...'))) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label
                                class="col-xs-2 control-label normal">Thông tin chi tiết </label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_description_" . $lang->name, "value" => (isset($row->article_description) ? $row->article_description : 'Đang cập nhật...'))) ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                    <div class="form-group ">
                        <label class="col-xs-2 control-label normal">Danh mục tin</label>
                        <div class="col-sm-9">
                            <div class="multiple-chosen ">
                                <select name="term_id[]" multiple class="chosen-select" style="width:100%;">
                                    <option value="0" disabled>Click chọn nhiều danh mục</option>
                                    <?php foreach ($list_cate as $rows) {
                                        $params = array(
                                            "where" => array('article_id' => $article->id, 'term_id' => $rows->id),
                                            "table" => "articleterm"
                                        );
                                        $count = $this->global_function->count_tableWhere($params);
                                        ?>
                                        <option value="<?php echo $rows->id ?>" <?php if ($count > 0) { ?>  selected<?php } ?>>
                                            <?php echo $rows->name ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div style="clear: both; height: 10px"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label class="col-xs-4 control-label normal">Thứ tự</label>
                            <div class="col-xs-6">
                                <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight", $article->article_weight) ?>">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label class="col-xs-4 control-label normal">Hiện thị</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option value="0" <?php if ($article->article_status == 0){ ?>selected <?php } ?>>Không</option>
                                    <option value="1" <?php if ($article->article_status == 1){ ?>selected <?php } ?>>Có</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3 hide">
                            <label class="col-xs-6 control-label normal">Hot</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="hot">
                                    <option value="0" <?php if ($article->article_hot == 0){ ?>selected <?php } ?>>Không</option>
                                    <option value="1" <?php if ($article->article_hot == 1){ ?>selected <?php } ?>>Có</option>
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
                <?php $this->load->view("back/inc/choose_upload", array('choose' => $article->choose_upload, 'picture' => $article->picture, "folder" => "article")) ?>
                <div class="clear he3"></div>
                <div class="clear h1"></div>
                <div class="col-xs-12">
                    <div class="input-group col-xs-6">
                        <span class="input-group-addon">Alt</span>
                        <input type="text" class="form-control" name="alt_picture" placeholder="Nhập thông tin alt hình đại diện" value="<?php echo $article->alt_picture ?>">
                    </div>
                    <div class="clear h1"></div>
                </div>
                <div style="clear: both; height:10px;"></div>
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
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $seo = $this->global_function->show_detail_meta_seo_id_lang($id, $lang->name, "article");
                        $row = $this->m_article->show_detail_article_id($article->id, $lang->name);
                        ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ URL</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="item_link_<?php echo $lang->name ?>" name="item_link_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("item_link_" . $lang->name, isset($row->article_link) ? $row->article_link : "") ?>">
                                <?php echo form_error("name_seo_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ tiêu đề</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="name_seo_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_seo_" . $lang->name, isset($seo->name_seo) ? $seo->name_seo : "") ?>">
                                <?php echo form_error("name_seo_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ từ khóa</label>
                            <div class="col-sm-6 ">
                                <textarea name="meta_keywords_<?php echo $lang->name ?>" id="meta_keywords_<?php echo $lang->name ?>"
                                          class="form-control"><?php echo set_value("meta_keywords_" . $lang->name, isset($seo->meta_keywords) ? $seo->meta_keywords : "") ?></textarea>
                                <?php echo form_error("meta_keywords_" . $lang->name) ?>
                            </div>
                        </div>
                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ mô tả</label>
                            <div class="col-sm-6 ">
                                <textarea name="meta_descriptions_<?php echo $lang->name ?>" id="meta_descriptions_<?php echo $lang->name ?>"
                                          class="form-control"><?php echo set_value("meta_descriptions_" . $lang->name, isset($seo->meta_descriptions) ? $seo->meta_descriptions : "") ?></textarea>
                                <?php echo form_error("meta_descriptions_" . $lang->name) ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php $this->load->view("back/inc/list_hide_button") ?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/category/index/" . $type)) ?>
    <div class="clear he3"></div>
</div>
<div class="clear"></div>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.jquery.js"></script>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/prism.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.css"/>
<script>
    jQuery(document).ready(function () {
        jQuery(".chosen-select").chosen({max_selected_options: 1});
        <?php foreach($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang){?>
        generate_slug('input[id="name_<?php echo $lang->name ?>"]', 'input[id="item_link_<?php echo $lang->name ?>"]');
        <?php }?>
    });

</script>



