<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/config_language/"))?>
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
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ DANH MỤC</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $row = $this->m_config_language->show_detail_config_language_id($id,$lang->name);
                        ?>
                        <div class="form-group ">
                            <label class="col-xs-2 control-label normal">Tên <?php echo $lang->name ?></label>

                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="value_<?php echo $lang->name ?>" name="value_<?php echo $lang->name ?>" value="<?php echo set_value("value_".$lang->name,isset($row->value)?$row->value:'')?>">
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-xs-2 control-label normal">Url</label>

                            <div class="col-sm-6">
                                <input   class="form-control" type="text" id="url_<?php echo $lang->name ?>" name="url_<?php echo $lang->name ?>" value="<?php echo set_value("url_".$lang->name,isset($row->url)?$row->url:'#')?>">
                            </div>
                        </div>
                    <?php }?>
                    <div class="clear"></div>
                    <div class="form-group hide">
                        <label class="col-xs-2 control-label normal">Biến</label>

                        <div class="col-sm-6">
                            <input class="form-control" type="text" id="name" name="name" value="<?php echo set_value("name",isset($item->name)?$item->name:'')?>">
                        </div>
                    </div>

                </div>
            </div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/list_hide_button")?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button",array("link"=>"admin/config_language"))?>
    <div class="clear he3"></div>
</div>
<div class="clear"></div>



