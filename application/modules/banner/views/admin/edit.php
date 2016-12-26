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
    <?php
    $this->load->view('back/inc/messager', array('type_messager' => $this->input->get('messager')));
    ?>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $row = $this->m_banner->check_tmp_detail($banner->id, $lang->id);
                        ?>
                        <div class="form-group col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Tên</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="name_<?php echo $lang->name ?>" name="name_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("name_" . $lang->name, isset($row->images_name) ? $row->images_name : "") ?>">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-xs-2 control-label normal">Link</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="item_link_<?php echo $lang->name ?>" name="item_link_<?php echo $lang->name ?>"
                                       value="<?php echo set_value("item_link_" . $lang->name, isset($row->images_link) ? $row->images_link : "") ?>">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-xs-2 control-label normal">Thông tin chi tiết</label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor", array("name" => "item_description_" . $lang->name, "value" => (isset($row->images_summary) ? $row->images_summary : ""))) ?>

                            </div>
                        </div>
                    <?php } ?>
                    <div class="clear"></div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <?php if ($type != 0) {
                                $array = array("status" => 1, 'album.id' => $type);
                            } else {
                                $array = array("status" => 1);
                            }
                            ?>
                            <label class="col-xs-6 control-label normal">Danh mục</label>
                            <div class="col-xs-6">
                                <select class="form-control" name="term_id">
                                    <?php foreach ($this->global_function->list_tableWhere($array, "album") as $term) { ?>
                                        <option
                                            value="<?php echo $term->id ?>" <?php if ($this->global_function->get_tmp_album($term->id, $banner->id) > 0) { ?>  selected <?php } ?>><?php echo $term->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Thứ tự</label>s
                            <div class="col-xs-4">
                                <input class="form-control" type="text" name="weight" value="<?php echo set_value("weight", 1) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-6 control-label normal">Hiện thị</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="status">
                                    <option value="1" <?php if ($banner->status == 1) { ?>  selected="selected"<?php } ?>>Kích hoạt</option>
                                    <option value="0" <?php if ($banner->status == 0) { ?>  selected="selected"<?php } ?>>Chưa kích hoạt</option>
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
                    <?php
                    if (file_exists('./uploads/Images/quang-cao/' . $banner->name)) {?>
                        <img width=100 src="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $banner->name ?>"/>
                        <input type="checkbox" name="check_delete" value="1">Xóa hình này
                    <?php } ?>

                    <div class="clear h1"></div>
                    <div class="col-xs-12" style="padding: 0px">
                        <div class="input-group col-xs-6">
                            <span class="input-group-addon">Alt</span>
                            <input type="text" class="form-control" name="alt" placeholder="Nhập thông tin alt hình đại diện" value="<?php echo $banner->alt?>">
                        </div>

                    </div>
                    <div class="clear he1"></div>
                    <span class="btn default btn-file">
														<span class="fileinput-new">
															 <i class="fa fa-picture-o"></i> Chọn ảnh khác
														</span>
														<input type="file" name="userfile">
													</span>
                    <input type="hidden" name="old" value="<?php echo $banner->name ?>">
                    <div class="clear he1"></div>
                </div>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">NHÓM SẢN PHẨM</div>
                <div class="clear he1"></div>
                <?php foreach ($this->m_item->show_list_category_where(array("category.category_type" => 2)) as $row) {
                    $params_status = array(
                        "where" => array('tmp_id' => $banner->id, 'tmp_id' => $row->id),
                        "table" => "tmp_banner"
                    );
                    $count_status = $this->global_function->count_tableWhere($params_status);
                    ?>
                    <div class="text-left col-xs-4" style="list-style: none">
                        <div class="checkbox col-xs-12">
                            <label class="normal col-xs-12">
                                <input <?php if($count_status>0) echo 'checked'?>  type="checkbox" value="<?php echo $row->id ?>" name="category[]" data-id="<?php echo $row->id ?>"
                                       data-url="<?php echo site_url('admin/item/load_tmp') ?>"><strong><?php echo $row->category_name ?></strong>
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php $this->load->view("back/inc/list_hide_button") ?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/banner")) ?>
    <div class="clear he3"></div>
</div>