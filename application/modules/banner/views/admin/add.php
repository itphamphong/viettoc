<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/banner/index")) ?>
    <div class="clear he1"></div>
    <div class="col_full fleft ">
            <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                if(!empty(form_error("name_" . $lang->name))){
                ?>
                    <p class="note note-danger"> <?php echo form_error("name_" . $lang->name) ?></p>
            <?php }} ?>

    </div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) { ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Tên</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_" . $lang->name) ?>">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-xs-2 control-label normal">Link</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="item_link_<?php echo $lang->name ?>" name="item_link_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("item_link_" . $lang->name) ?>">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-xs-2 control-label normal">Thông tin chi tiết</label>

                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_description_".$lang->name)) ?>

                            </div>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Danh mục</label>
                            <?php if($type!=0){
                                $array=array("status"=>1,'album.id'=>$type);
                            }else{
                                $array=array("status"=>1);
                            }

                            ?>
                            <div class="col-xs-6">
                                <select class="form-control" name="term_id">
                                    <?php foreach($this->global_function->list_tableWhere($array,"album") as $term){?>
                                        <option value="<?php  echo $term->id?>"><?php echo $term->name?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Thứ tự</label>

                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight", 1) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Hiện thị</label>

                            <div class="col-sm-6">
                                <select class="form-control" name="status">
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
                    <div class="col_full fleft bs-example-bg-classes">
                        <p class="bg-warning">- Chọn hình đại diện.</p>
                    </div>
                    <input id="uploader" type="file" name="userfile">
                </div>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">NHÓM SẢN PHẨM</div>
                <div class="clear he1"></div>
                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 2)) as $row) {

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
            <?php $this->load->view("back/inc/list_hide_button") ?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/banner")) ?>
    <div class="clear he3"></div>
</div>