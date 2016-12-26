<!-- END PAGE LEVEL STYLES -->
<div class="col_full fleft">
    <?php
    $this->load->view('back/inc/messager', array('type_messager'=>$this->input->get('messager') ) );
    ?>
    <form name="them" method="post" id="them" action="" enctype="multipart/form-data">
        <div class="col-xs-6 list-btn fright">
            <a class="i-btn i-add" href="<?php echo site_url("admin/banner/add/".$type) ?>">Thêm mới</a>
            <p style="display:none">
                <input class="a_button_act a_update" name="update" style="cursor: pointer" type="submit" value="Cập nhật"/>
            </p>
            <p style="display:none">
                <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit" value="Delete"/>
            </p>
            <span class="i-btn i-save-continues" onclick="$('.a_update').trigger('click')">Cập nhật</span>
            <a class="i-btn i-delete" onclick="Delete()">Xoá</a>
        </div>
        <div class="clear he1"></div>
        <table class="table table-bordered">
            <thead>
            <tr class="tr-product">
                <th><input name="" type="checkbox" value="" id="checkboxall"/></th>
                <th>Ảnh</th>
                <th> Tình trạng</th>
<!--                <th> Nổi Bật</th>-->
                <th> Thứ tự</th>
                <th>Nhóm</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($item as $a) {
                ?>
                <tr class="tr-product">
                    <td><input type="checkbox" value="check_article[<?php echo $a->id ?>]" name="checkall[<?php echo $a->id ?>]" class="checkall"/></td>
                    <td>
                        <?php
                        if (file_exists('./uploads/Images/quang-cao/'.$a->name)) {
                            ?>
                            <img width=100 src="<?php echo base_url()?>uploads/Images/quang-cao/<?php  echo $a->name ?>"/>
                        <?php }?>
                    </td>
                    <td>
                        <?php if ($a->status == 1) { ?>
                            <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $a->id ?>" data="0" onclick="Active(this)"
                                 data-url="<?php echo base_url("admin/banner/active") ?>">
                                <?php echo ACTIVE ?>
                            </div>
                        <?php } else { ?>
                            <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $a->id ?>" data="1" onclick="Active(this)"
                                 data-url="<?php echo base_url("admin/banner/active") ?>">
                                <?php echo NO_ACTIVE ?>
                            </div>
                        <?php } ?>
                    </td>
<!--                    <td>  --><?php //if ($a->hot == 1) { ?>
                        <!--                            <div class="checkbox-inline btn default btn-status status" data-id="--><?php //echo $a->id ?><!--" data="0" onclick="Active(this)"-->
                        <!--                                 data-url="--><?php //echo base_url("admin/banner/hot") ?><!--">-->
                        <!--                                --><?php //echo ACTIVE ?>
                        <!--                            </div>-->
                        <!--                        --><?php //} else { ?>
                        <!--                            <div class="checkbox-inline btn default btn-status no-status" data-id="--><?php //echo $a->id ?><!--" data="1" onclick="Active(this)"-->
                        <!--                                 data-url="--><?php //echo base_url("admin/banner/hot") ?><!--">-->
                        <!--                                --><?php //echo NO_ACTIVE ?>
                        <!--                            </div>-->
<!--                        --><?php //} ?>
                    </td>
                    <td>
                        <span title="Sửa" class="change_weight" onclick="ChangeW(this)"><?php echo $a->weight ?></span>
                        <div class="col-center">
                            <input type="text" name="weight[]" class="weight form-control" value="<?php echo $a->weight ?>">
                        </div>
                    </td>
                    <td><?php echo $a->album_name ?></td>
                    <td>
                        <a href="<?php echo site_url("admin/banner/edit/".$type."/". $a->id) ?>" class="btn  btn-sm i-btn">
                            <i class="fa fa-edit"></i> Sửa
                        </a>
                        <a data="<?php echo site_url("admin/banner/delete/".$type."/" . $a->id) ?>" onclick="DeleteAjax(this)" class="btn  btn-sm i-btn">
                            <i class="fa  fa-times"></i> Xoá
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
</div>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/back/assets/plugins/select2/select2-metronic.css"/>
<link href="<?php echo base_url() ?>themes/back/assets/css/plugins.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url() ?>themes/back/assets/plugins/data-tables/DT_bootstrap.css"/>
<script type="text/javascript" src="<?php echo base_url() ?>themes/back/assets/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/back/assets/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>themes/back/assets/plugins/data-tables/DT_bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url() ?>themes/back/assets/scripts/core/app.js"></script>
<script src="<?php echo base_url() ?>themes/back/assets/scripts/custom/table-advanced.js"></script>
<script>
    jQuery(document).ready(function() {
        TableAdvanced.init();
    });
</script>