<div class="col_full fleft">

<form class="form-horizontal hide" id="fileupload" method="post" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $item->id ?>" id="item_id">
<?php $this->load->view("back/inc/menu_lang")?>
<div class="col_full fleft info-item">
    <div class="title col_full fleft">MÔ TẢ SẢN PHẨM</div>
    <div class="clear he1"></div>
    <div class="col-xs-12">
        <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
            $item_lang = $this->m_item->show_detail_item_id_lang($item->id, $lang->name);
            ?>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Tên sản phẩm</label>

                <div class="col-sm-10">
                    <input class="form-control" type="text"  id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>" value="<?php echo set_value("name_".$lang->name,isset($item_lang->item_name)?$item_lang->item_name:"")?>">
                </div>
            </div>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Chất liệu</label>

                <div class="col-sm-10">
                    <input class="form-control" type="text"  id="material_<?php echo $lang->name ?>" name="material_<?php echo $lang->name ?>" value="<?php echo set_value("material_".$lang->name,isset($item_lang->material)?$item_lang->material:"")?>">
                </div>
            </div>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Xuất xứ</label>

                <div class="col-sm-10">
                    <input class="form-control" type="text"  id="location_<?php echo $lang->name ?>" name="location_<?php echo $lang->name ?>" value="<?php echo set_value("location_".$lang->name,isset($item_lang->location)?$item_lang->location:"")?>">
                </div>
            </div>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Bảo hành</label>

                <div class="col-sm-10">
                    <input class="form-control" type="text"  id="guarantee_<?php echo $lang->name ?>" name="guarantee_<?php echo $lang->name ?>" value="<?php echo set_value("guarantee_".$lang->name,isset($item_lang->guarantee)?$item_lang->guarantee:"")?>">
                </div>
            </div>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Mô tả ngắn</label>

                <div class="col-sm-10 ">
                    <textarea name="item_summary_<?php echo $lang->name ?>" id="item_summary_<?php echo $lang->name ?>" class="form-control"><?php echo set_value("item_summary_".$lang->name,isset($item_lang->item_summary)?$item_lang->item_summary:"")?></textarea>
                </div>
            </div>
            <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Thông số kĩ thuật</label>

                <div class="col-sm-10">
                    <?php $this->load->view("back/inc/editor", array("name" => "item_description_".$lang->name,"value"=>isset($item_lang->item_description)?$item_lang->item_description:"")) ?>

                </div>
            </div>
            <div class="form-group col-lang col-lang hide">
                <label class="col-xs-2 control-label normal">Thông số kĩ thuật</label>

                <div class="col-sm-10">
                    <?php $this->load->view("back/inc/editor", array("name" => "item_info_".$lang->name,"value"=>isset($item_lang->item_info)?$item_lang->item_info:"")) ?>

                </div>
            </div>
            <div class="form-group hide">
                <label class="col-xs-2 control-label normal">Video</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" id="video<?php echo $lang->name ?>" name="video_<?php echo $lang->name ?>" value="<?php echo set_value("video_".$lang->name,isset($item_lang->video)?$item_lang->video:"")?>">
                </div>
            </div>
        <?php }?>
    </div>
</div>
<div class="clear he1"></div>
<div class="col_full fleft info-item">
    <div class="title col_full fleft">THÔNG TIN SẢN PHẨM</div>
    <div class="clear he1"></div>
    <div class="col-xs-12">
        <div class="form-group">
            <label class="col-xs-2 control-label normal">Mã sản phẩm</label>

            <div class="col-sm-3">
                <input class="form-control" type="text" placeholder="Mã sản phẩm"  name="item_code" value="<?php echo set_value("item_code",$item->item_code)?>">
            </div>
        </div>
        <div class="form-group ">
            <div class="col-xs-4 ">
                <label class="col-xs-6 control-label normal">Giá</label>

                <div class="col-sm-6">
                    <input class="form-control" type="text"  name="value" value="<?php echo set_value("value",$item->value)?>">
                </div>
            </div>
            <div class="col-xs-4">
                <label class="col-xs-6 control-label normal">Giá niêm yết</label>

                <div class="col-sm-6">
                    <input class="form-control" type="text" name="price" value="<?php echo set_value("price",$item->price)?>">
                </div>
            </div>

        </div>

        <div class="form-group">

            <div class="col-xs-4">
                <label class="col-xs-6 control-label normal">Nhãn hiệu</label>

                <div class="col-sm-6">
                    <select class="form-control" name="supplier">
                        <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 2, 'category.category_status' => '1', 'category.category_top' => 0)) as $row) { ?>
                            <option value="<?php echo $row->id ?>" <?php if($item->supplier_id==$row->id){?>selected <?php } ?>><?php echo $row->category_name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <label class="col-xs-6 control-label normal">Số lượng</label>

                <div class="col-xs-4">
                    <input class="form-control" type="text" name="number" value="<?php echo set_value("number",$item->number)?>">
                </div>
            </div>

            <div class="col-xs-4">
                <label class="col-xs-6 control-label normal">Thứ tự</label>

                <div class="col-xs-4">
                    <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight",$item->item_weight)?>">
                </div>
            </div>
            <div class="col-xs-4">
                <label class="col-xs-6 control-label normal">Hiển thị</label>
                <div class="col-sm-6">
                    <select class="form-control" name="status">
                        <option value="0" <?php if($item->item_status==0){?>selected <?php } ?>>Không</option>
                        <option value="1" <?php if($item->item_status==1){?>selected <?php } ?>>Có</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-8">
                <label class="col-xs-3 control-label normal">Tình trạng</label>

                <div class="col-sm-9">
                    <div class="checkbox-inline">
                        <label class="normal">
                            <input type="checkbox" value="1" name="item_status[]" <?php if(in_array(1,$item_status)){?> checked <?php }?>>Bán chạy
                        </label>
                    </div>
                    <div class="checkbox-inline">
                        <label class="normal">
                            <input type="checkbox" value="2" name="item_status[]" <?php if(in_array(2,$item_status)){?> checked <?php }?>>Mới cập nhật
                        </label>
                    </div>
                    <div class="checkbox-inline">
                        <label class="normal">
                            <input type="checkbox" value="3" name="item_status[]" <?php if(in_array(3,$item_status)){?> checked <?php }?>> Hot
                        </label>
                    </div>
                    <div class="checkbox-inline hide">
                        <label class="normal">
                            <input type="checkbox" value="4" name="item_status[]" <?php if(in_array(4,$item_status)){?> checked <?php }?> >Hết hàng
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-12">
                <label class="col-xs-2 control-label normal">Danh mục</label>
                <div class="col-sm-10">
                    <ul>
                        <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 1, 'category.category_status' => '1', 'category.category_top' => 0)) as $row) {
                            $params = array(
                                "where" => array('item_id' => $item->id, 'category_id' => $row->id),
                                "table" => "item_category"
                            );
                            $count_p = $this->global_function->count_tableWhere($params);
                            ?>
                            <li class="text-left" style="list-style: none">
                                <div class="checkbox">
                                    <label class="normal">
                                        <input type="checkbox" <?php if($count_p>0)  echo 'checked' ?>  value="<?php echo $row->id?>" name="category[]" onclick="LoadTmp(this)" data-id="<?php echo $row->id?>" data-url="<?php echo site_url('admin/item/load_tmp') ?>" ><strong><?php echo $row->category_name?></strong>
                                    </label>
                                </div>
                                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 1, 'category.category_status' => '1', 'category.category_top' => $row->id)) as $r) {
                                    $paramsc = array(
                                        "where" => array('item_id' => $item->id, 'category_id' => $r->id),
                                        "table" => "item_category"
                                    );
                                    $count_c = $this->global_function->count_tableWhere($paramsc);
                                    ?>
                                    <div class="checkbox-inline" style="margin-left: 0px">
                                        <label class="normal">
                                            <input type="checkbox" <?php if($count_c>0)  echo 'checked' ?> value="<?php echo $r->id?>" name="category[]" onclick="LoadTmp(this)" data-id="<?php echo $r->id?>" data-url="<?php echo site_url('admin/item/load_tmp') ?>">|--<?php echo $row->category_name?>
                                        </label>
                                    </div>
                                <?php }?>
                            </li>
                        <?php }?>
                    </ul>

                </div>
            </div>
        </div>
        <div id="load-tmp"></div>


    </div>
</div>
<div class="clear he1"></div>
<div class="col_full fleft info-item">
    <div class="title col_full fleft">HÌNH ẢNH SẢN PHẨM</div>
    <div class="clear he1"></div>
    <div class="col-xs-12">
        <div class="col_full fleft bs-example-bg-classes" >
            <p class="bg-warning">- Bạn có thế chọn nhiều file cùng một lúc bằng cách giữ thêm phím Ctrl. Bạn có thể kéo thả để sắp xếp thứ tự sau khi ảnh được tải lên.<br>
                - Sau khi upload hình ảnh hoàn tất, bạn phải chọn một ảnh làm ảnh đại diện sản phẩm.</p>
        </div>
        <div class="row fileupload-buttonbar">
            <div class="col-lg-7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn green  fileinput-button multiple-upload">
                                            <i class="fa fa-plus"></i>
                                            <span>
                                                Thêm nhiều ảnh...
                                            </span>
                                            <input type="file" name="files" multiple="" class="multiple-upload-file">
                                        </span>
                <button type="button" class="btn red delete">
                    <i class="fa fa-times"></i>
                                            <span>
                                                Xóa nhiều ảnh
                                            </span>
                </button>
                <input type="checkbox" class="toggle hide">
                <!-- The global file processing state -->
                                        <span class="fileupload-process">
                                        </span>
            </div>
            <!-- The global progress information -->
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;">
                    </div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">
                    &nbsp;
                </div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped clearfix">
            <tbody class="files">
            </tbody>
        </table>
    </div>
</div>
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script id="template-upload" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-upload fade">
                    <td>
                    <span class="preview"></span>
                    </td>
                    <td>
                    <p class="name">{%=file.name%}</p>
                    {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                    </td>
                    <td>
                    <p class="size">{%=o.formatFileSize(file.size)%}</p>
                    {% if (!o.files.error) { %}
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                    {% } %}
                    </td>
                    <td>
                    {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                    <button class="btn blue start btn-sm">
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                    </button>
                    {% } %}
                    {% if (!i) { %}
                    <button class="btn red cancel btn-sm">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                    </button>
                    {% } %}
                    </td>
                    </tr>
                    {% } %}
                </script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-download fade">
                    <td>
                    <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                    </span>
                    </td>
                    <td>
                    <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                    <input value="{%=file.id%}" name="image[]" type="hidden">
                    {% } %}
                    </span>
                    </td>
                    <td>
                   <span class="preview">
                    {% if (file.primary) { %}
                    <input value="{%=file.id%}" name="primary" type="radio" checked>
                    {% } else { %}
                     <input value="{%=file.id%}" name="primary" type="radio" >
                    {% } %}
                    </span>
                    </td>
                    <td>
                    <p class="name">
                    {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                    <span>{%=file.name%}</span>
                    {% } %}
                    </p>
                    {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                    </td>
                    <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                    </td>

                    <td>
                    {% if (file.deleteUrl) { %}
                    <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="fa fa-trash-o"></i>
                    <span>Delete</span>
                    </button>
                    <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                    <button class="btn yellow cancel btn-sm">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                    </button>
                    {% } %}
                    </td>
                    </tr>
                    {% } %}
                </script>
<div class="clear he1"></div>
<?php $this->load->view("back/inc/menu_lang")?>
<div class="col_full fleft info-item">
    <div class="title col_full fleft">SEO</div>
    <div class="clear he1"></div>
    <div class="col-xs-12">
        <div class="col_full fleft bs-example-bg-classes" >
            <p class="bg-warning">- Các yêu tố bên dưới hỗ trợ cho SEO Website lên các bộ máy tìm kiếm như Google, Bing, Yahoo, Ask,...</p>
        </div>
        <div class="form-group">
            <label class="col-xs-2 control-label normal">Từ khóa tìm kiếm</label>

            <div class="col-sm-6">
                <div class="multiple-chosen ">
                    <select name="tag_id[]" multiple class="chosen-select" style="width:100%;">
                        <option value="0" disabled>Click chọn nhiều từ khóa</option>
                        <?php foreach ($this->m_tags->show_list_tags_where(array('tags.status'=>1),0,0,'vn',0) as $rows) {
                            $params=array(
                                "where"=>array('tmp_id' => $item->id,'tag_id' =>$rows->id,"value"=>"item"),
                                "table"=>"tag_tmp"
                            );
                            $count=$this->global_function->count_tableWhere($params);
                            ?>
                            <option value="<?php echo $rows->id ?>" <?php if($count>0) echo 'selected'?> >
                                <?php echo $rows->name ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
            $seo=$this->m_item->show_detail_meta_seo_id_lang($item->id, $lang->name);
            $item_lang = $this->m_item->show_detail_item_id_lang($item->id, $lang->name);
            ?>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Thẻ URL</label>

                <div class="col-sm-6">
                    <input class="form-control" type="text" id="item_link_<?php echo $lang->name ?>" name="item_link_<?php echo $lang->name ?>" value="<?php echo set_value("item_link_".$lang->name,(isset($item_lang->item_link)?$item_lang->item_link:""))?>">
                    <?php echo form_error("name_seo_".$lang->name)?>
                </div>
            </div>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Thẻ tiêu đề</label>

                <div class="col-sm-6">
                    <input class="form-control" type="text"  name="name_seo_<?php echo $lang->name ?>" value="<?php echo set_value("name_seo_".$lang->name,isset($seo->name_seo)?$seo->name_seo:"")?>">
                    <?php echo form_error("name_seo_".$lang->name)?>
                </div>
            </div>
            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Thẻ từ khóa</label>

                <div class="col-sm-6 ">
                    <textarea name="meta_keywords_<?php echo $lang->name ?>" id="meta_keywords_<?php echo $lang->name ?>" class="form-control"><?php echo set_value("meta_keywords_".$lang->name,isset($seo->meta_keywords)?$seo->meta_keywords:"")?></textarea>
                    <?php echo form_error("meta_keywords_".$lang->name)?>
                </div>
            </div>
            <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                <label class="col-xs-2 control-label normal">Thẻ mô tả</label>

                <div class="col-sm-6 ">
                    <textarea name="meta_descriptions_<?php echo $lang->name ?>" id="meta_descriptions_<?php echo $lang->name ?>" class="form-control"><?php echo set_value("meta_descriptions_".$lang->name,isset($seo->meta_descriptions)?$seo->meta_descriptions:"")?></textarea>
                    <?php echo form_error("meta_descriptions_".$lang->name)?>
                </div>
            </div>
        <?php }?>
    </div>
</div>
    <input type="hidden" value="<?php echo site_url('admin/item/load_tmp') ?>" id="url_load">

<div  style="display: none">
    <input type="submit" name="ok" id="ok">
    <input type="submit"  name="ok-continues" id="ok-continues">
    <input type="reset" id="btn-reset">
</div>
</form>
</div>
<div class="clear he3"></div>
<div class="col-xs-6 list-btn" style="float: none !important;">
    <span class="i-btn i-save-continues" onclick="$('#ok-continues').trigger('click')" >Copy và tiếp tục</span>
</div>
<div class="clear he3"></div>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<script src="<?php echo base_url() ?>themes/back/assets/scripts/custom/form-fileupload.js"></script>
<script>
    jQuery(document).ready(function() {
        LoadSize();
        <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){?>
        generate_slug('input[id="name_<?php echo $lang->name ?>"]', 'input[id="item_link_<?php echo $lang->name ?>"]');
        <?php }?>
        FormFileUploadEdit.init(<?php echo $item->id?>);
    });

</script>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.jquery.js"></script>
<script src="<?php echo base_url() ?>themes/back/js/chosen-select/prism.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/js/chosen-select/chosen.css"/>
<script>
    jQuery(document).ready(function() {
        jQuery(".chosen-select").chosen();
    });

</script>



