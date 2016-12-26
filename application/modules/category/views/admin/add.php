<div class="col_full fleft">
<div class="col-xs-6">
    <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
</div>
<?php $this->load->view("back/inc/list_button",array("link"=>"admin/category/index/".$type))?>
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
                <label class="col-xs-2 control-label normal">Tên</label>
                <div class="col-sm-6">
                    <input class="form-control" data-url="#item_link_<?php echo $lang->name ?>" onblur="ChangeUrl(this)"  type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>" value="<?php echo set_value("name_".$lang->name,"#")?>">
                </div>
            </div>
        <?php }?>
        <div class="clear"></div>
        <div class="form-group <?php if($type ==3) echo "hidden"?>">
            <label class="col-xs-2 control-label normal">Danh mục cha</label>
            <div class="col-sm-6">
                <select name="category[]" multiple class="chosen-select" style="width:100%;">
                    <?php foreach ($this->m_item->show_list_category_where(array("category_top" => 0, "category_type" => 1)) as $a) {?>
                        <option value="<?php echo $a->id?>"><?php echo $a->category_name?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-4">
                <label class="col-xs-6 control-label normal">Thứ tự</label>
                <div class="col-xs-4">
                    <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight",$weight)?>">
                </div>
            </div>
            <div class="col-xs-3">
                <label class="col-xs-6 control-label normal">Hiển thị</label>
                <div class="col-sm-6">
                    <select class="form-control" name="status">
                        <option value="0">Không</option>
                        <option value="1">Có</option>
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
    </div>
</div>
    <div class="clear he1"></div>
    <div class="col_full fleft info-item">
        <div class="title col_full fleft">HÌNH ẢNH</div>
        <div class="clear he1"></div>
        <div class="col-xs-12">
            <?php $this->load->view("back/inc/choose_upload") ?>
            <div class="clear h1"></div>
            <div class="col-xs-12">
                <div class="input-group col-xs-6">
                    <span class="input-group-addon">Alt</span>
                    <input type="text" class="form-control" name="alt_picture" placeholder="Nhập thông tin alt hình đại diện">
                </div>
                <div class="clear h1"></div>
            </div>
        </div>
    </div>

    <div class="clear he1"></div>
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
        jQuery(".chosen-select").chosen();
    });


</script>



