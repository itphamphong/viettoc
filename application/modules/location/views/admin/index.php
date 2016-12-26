<div class="col_full fleft">
    <form name="them" method="post" id="form-location" action="" enctype="multipart/form-data">
        <div class="col_full fleft bg-search">
            <div class="col-xs-8">
                <div class="col-xs-4">
                    <input class="form-control" name="key" id="key" placeholder="Tên khu vực">
                </div>
                <div class="col-xs-6 pl0">
                    <?php if($type==3){?>
                        <div class="col-xs-6">
                            <select class="form-control" id="country_id" onchange="LoadCity(this)" data-url="<?php echo site_url('admin/location/load_city')?>">
                                <option value="0">Chọn quốc gia</option>
                                <?php foreach ($country as $a) {?>
                                    <option value="<?php echo $a->id?>"><?php echo $a->name?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <select class="form-control" name="category" id="city_id">
                                <option value="0">--Chọn--</option>
                            </select>
                        </div>
                    <?php }else if($type==2){?>
                        <div class="col-xs-12">
                            <select class="form-control" name="category" id="country_id" onchange="LoadCity(this)" data-url="<?php echo site_url('admin/location/load_city')?>">
                                <option value="0">Chọn quốc gia</option>
                                <?php foreach ($country as $a) {?>
                                    <option value="<?php echo $a->id?>"><?php echo $a->name?></option>
                                <?php }?>
                            </select>
                        </div>
                    <?php }?>
                </div>
                <div class="col-xs-2 pl0"><input data-url="<?php echo site_url('admin/location/load_location_ajax/'.$type)?>" type="button" class="btn fleft" value="Tìm kiếm"  id="btn_search" onclick="LoadSearch(this)"/></div>
            </div>
            <div class="col-xs-4 list-btn fright">
                <a href="<?php echo base_url() ?>admin/location/add/<?php echo $type ?>" class="btn default btn-sm green">
                    <i class="fa fa-plus icon-black"></i> Thêm mới
                </a>
                <p style="display:none">
                    <input class="a_button_act a_update" name="update" style="cursor: pointer" type="submit" value="Cập nhật"/>
                </p>
                <p style="display:none">
                    <input class="a_button_act a_delete" name="delete" style="cursor: pointer" type="submit" value="Delete"/>
                </p>
                <span class="i-btn i-save-continues" onclick="$('.a_update').trigger('click')">Cập nhật</span>
                <a class="i-btn i-delete" onclick="Delete()">Xoá</a>

            </div>
        </div>
        <div class="clear he1"></div>
        <div class="col-lx-12 pr0">
            <table class="table table-bordered" id="sample_2">
                <thead>
                <tr class="tr-product">
                    <th class="no_sort"><input name="" type="checkbox" value="" id="checkboxall"/></th>
                    <th>Tên</th>
                    <th>STT</th>
                    <th>Trạng thái</th>
                    <th class="no_sort">Hành động</th>
                </tr>
                </thead>
                <tbody id="load-ajax-location">
                <?php foreach ($list as $i) {

                    ?>
                    <tr class="tr-product">
                        <td><input type="checkbox" value="check_article[<?php echo $i->id ?>]" name="checkall[<?php echo $i->id ?>]" class="checkall"/></td>


                        <td class="text-left"><?php echo $i->name ?></td>
                        <td data-order="<?php echo $i->weight ?>">
                            <span title="Sửa" class="change_weight" onclick="ChangeW(this)"><?php echo $i->weight ?></span>
                            <div class="col-center">
                                <input type="text" name="weight[]" class="weight form-control" value="<?php echo $i->weight ?>">
                            </div>
                        </td>

                        <td data-order="<?php echo $i->status ?>">
                            <?php if ($i->status == 1) { ?>
                                <div class="checkbox-inline btn default btn-status status" data-id="<?php echo $i->id ?>" data="0" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/location/active") ?>">
                                    Đã kích hoạt
                                </div>
                            <?php } else { ?>
                                <div class="checkbox-inline btn default btn-status no-status" data-id="<?php echo $i->id ?>" data="1" onclick="Active(this)"
                                     data-url="<?php echo base_url("admin/location/active") ?>">
                                    Chưa kích hoạt
                                </div>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url() ?>admin/location/edit/<?php echo $type . "/" . $i->id ?>" class="btn default btn-sm green ">
                                <i class="fa fa-pencil icon-black"></i> Sửa
                            </a>
                            <a href="<?php echo base_url() ?>admin/location/delete/<?php echo $type . "/" . $i->id ?>" class="btn default btn-sm red">
                                <i class="fa fa-times icon-black "></i> Xoá
                            </a>
                        </td>

                    </tr>
                <?php } ?>

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5"> <?php echo $link ?></td>
                </tr>
                </tfoot>

            </table>
        </div>
    </form>
</div>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

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
