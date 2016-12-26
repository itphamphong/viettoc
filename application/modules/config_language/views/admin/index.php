<div class="col_full fleft">
    <form name="them" method="post" id="them" action="" enctype="multipart/form-data">
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered" id="sample_2">
                <thead>
                <tr class="tr-product">
                    <th ></th>
                    <th class="no_sort">Tên hiển thị</th>
                    <th class="no_sort">STT</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($list as $i) {
                    ?>
                    <tr class="tr-product">
                        <td class="text-left"><?php echo wordwrap($i->name, 50, "<br />\n") ?></td>
                        <td class="text-left"><?php echo wordwrap($i->value, 50, "<br />\n") ?></td>
                        <td class=" ">
                            <a href="<?php echo base_url() ?>admin/config_language/edit/<?php echo $i->id ?>" class="btn default btn-sm green ">
                                <i class="fa  icon-black"></i> Sửa
                            </a>
                            <?php if ($this->m_session->userdata('admin_login')->type == 2) { ?>
                                <?php if ($i->status == 1) { ?>
                                    <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id ?>" data="0" onclick="Active(this)"
                                         data-url="<?php echo base_url("admin/config_language/active") ?>">
                                        Đã kích hoạt
                                    </div>
                                <?php } else { ?>
                                    <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id ?>" data="1" onclick="Active(this)"
                                         data-url="<?php echo base_url("admin/config_language/active") ?>">
                                        Chưa kích hoạt
                                    </div>
                                <?php } ?>
<!--                                <div class="checkbox-inline btn default btn-status status" data-id="--><?php //echo $i->id ?><!--" data="1" onclick="Active(this)"-->
<!--                                     data-url="--><?php //echo base_url("admin/config_language/type") ?><!--">-->
<!--                                   1-->
<!--                                </div>-->
<!--                                <div class="checkbox-inline btn default btn-status status" data-id="--><?php //echo $i->id ?><!--" data="2" onclick="Active(this)"-->
<!--                                     data-url="--><?php //echo base_url("admin/config_language/type") ?><!--">-->
<!--                                  2-->
<!--                                </div>-->
                                <a href="<?php echo base_url() ?>admin/config_language/delete/<?php echo $i->id ?>" class="btn default btn-sm green ">
                                    <i class="fa  icon-black"></i> Xóa
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
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
    jQuery(document).ready(function () {
        TableAdvanced.init();
    });
</script>
<style>
    #sample_2_wrapper .col-sm-12{ width: 100% !important}
    #sample_2_filter{ width: 50% !important; float: left !important;}
    .dataTables_filter label{ width: 100%; float: left}
    .dataTables_filter label input{ width: 100%}
</style>