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
                    <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $row=$this->m_location->show_detail_location_id($id,$lang->name);
                        ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Tên khuc vực</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>" value="<?php echo set_value("name_".$lang->name,isset($row->name) ? $row->name : '')?>">
                            </div>
                        </div>
                    <?php }?>
                    <div class="clear"></div>

                    <?php if($type==3){?>
                    <div class="form-group <?php if($type ==1) echo "hidden"?>">
                        <label class="col-xs-2 control-label normal">Danh mục cha</label>
                        <div class="col-xs-3">
                            <select class="form-control" id="country_id" onchange="LoadCity(this)" data-url="<?php echo site_url('admin/location/load_city')?>">
                                <option value="0">Chọn quốc gia</option>
                                <?php foreach ($country as $a) {?>
                                    <option value="<?php echo $a->id?>" <?php if($a->id==$parent_child->id){?> selected <?php }?>><?php echo $a->name?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-xs-3">
                            <select class="form-control" name="category" id="city_id">
                                <?php foreach ($list_parent as $p) {?>
                                    <option value="<?php echo $p->id?>" <?php if($p->id==$item->parent_id){?> selected <?php }?>><?php echo $p->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php }else{?>
                        <div class="form-group <?php if($type ==1) echo "hidden"?>">
                            <label class="col-xs-2 control-label normal">Danh mục cha</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="category">
                                    <?php foreach ($parents as $a) {
                                        ?>
                                        <option value="<?php echo $a->id?>" <?php if($a->id==$item->parent_id){?> selected <?php }?>><?php echo $a->name?></option>
                                    <?php }?>
                                </select>
                            </div>

                        </div>
                    <?php }?>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Thứ tự</label>

                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight",$item->weight)?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Hiện thị</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option value="0" <?php if($item->status==0){?>selected <?php } ?>>Không</option>
                                    <option value="1" <?php if($item->status==1){?>selected <?php } ?>>Có</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4 hide">
                            <label class="col-xs-6 control-label normal">Nổi bật</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="hot">
                                    <option value="0" <?php if($item->hot==0){?>selected <?php } ?>>Không</option>
                                    <option value="1" <?php if($item->hot==1){?>selected <?php } ?>>Có</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item hide">
                <div class="title col_full fleft">HÌNH ẢNH SẢN PHẨM</div>
                <div class="clear he1"></div>
                <div class="col-xs-12" >
                    <div class="col_full fleft bs-example-bg-classes">
                        <p class="bg-warning">- Chọn hình đại diện.</p>
                    </div>
                    <?php
                    if (file_exists('./uploads/location/'.$item->picture)) {
                        ?>
                        <img width=100 src="<?php echo base_url()?>uploads/location/<?php  echo $item->picture ?>"/>
                    <?php }?>
                    <input type="hidden" name="old" value="<?php echo $item->picture?>">
                    <div style="clear: both; height: 10px"></div>
                    <input id="uploader" type="file" name="userfile">
                    <div style="clear: both; height: 10px"></div>
                </div>
                <div style="clear: both; height: 10px"></div>
            </div>
            <div class="clear he1"></div>
            <?php //$this->load->view("back/inc/menu_lang")?>
            <div class="col_full fleft info-item hide">
                <div class="title col_full fleft">SEO</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="col_full fleft bs-example-bg-classes" >
                        <p class="bg-warning">- Các yêu tố bên dưới hỗ trợ cho SEO Website lên các bộ máy tìm kiếm như Google, Bing, Yahoo, Ask,...</p>
                    </div>
                    <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $seo=$this->global_function->show_detail_meta_seo_id_lang($id, $lang->name,"term");
                        ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thẻ URL</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="item_link_<?php echo $lang->name ?>" name="item_link_<?php echo $lang->name ?>" value="<?php echo set_value("item_link_".$lang->name,isset($item->location_link)?$item->location_link:"")?>">
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
            <?php $this->load->view("back/inc/list_hide_button")?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/category/index/".$type))?>
    <div class="clear he3"></div>
</div>
<div class="clear"></div>
<script>
    jQuery(document).ready(function() {
        <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){?>
        generate_slug('input[id="name_<?php echo $lang->name ?>"]', 'input[id="item_link_<?php echo $lang->name ?>"]');
        <?php }?>
    });
</script>