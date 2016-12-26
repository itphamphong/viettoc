<link href="<?php echo base_url() ?>themes/back/assets/css/style.css" rel="stylesheet" type="text/css"/>
<!-- begin order -->
<div class="row" style="color: #fff; w">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->global_function->count_table(array("id !=" => 0), "od_order") ?>
                </div>
                <div class="desc">
                    Đơn hàng
                </div>
            </div>
            <a class="more" href="<?php echo site_url('admin/order') ?>">
                Xêm thêm <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-signal"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->global_function->get_price($total_order) ?>
                </div>
                <div class="desc">
                    Tổng tiền giao dịch
                </div>
            </div>
            <a class="more" href="<?php echo site_url('admin/order') ?>">
                Xêm thêm <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->global_function->count_table(array("id !=" => 0), "contact") ?>
                </div>
                <div class="desc">
                    Bình luận
                </div>
            </div>
            <a class="more" href="<?php echo site_url('admin/contact') ?>">
                Xem thêm <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat yellow">
            <div class="visual">
                <i class="fa  fa-envelope-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <?php echo $this->global_function->count_table(array("id !=" => 0), "email_letter") ?>
                </div>
                <div class="desc">
                    Liên hệ
                </div>
            </div>
            <a class="more" href="<?php echo site_url() ?>">
                Xem thêm <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<!-- đon hang moi nhat-->
<table class="table table-bordered">
    <tr class="tr-product">
        <th>#</th>
        <th>Mã đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>Điện thoại</th>
        <th>Thời gian đặt hàng</th>
        <th>Tổng tiền</th>
        <th>Xem chi tiết</th>
    </tr>
    <tbody id="show_list_ajax">
    <?php
    $x = 1;
    foreach ($list_order as $i) {
        $status = $this->general->get_tableWhere(array("id" => $i->status), "order_status");
        $tong = $this->m_order->sum_total($i->id);
        ?>
        <tr class="tr-product">
            <td><?php echo $x ?></td>
            <td class="text-left"><?php echo $i->code_booking ?></td>
            <td class="text-left"><?php echo isset($i->full_name) ? $i->full_name : "" ?></td>
            <td class="text-left"><?php echo isset($i->phone) ? $i->phone : "" ?></td>
            <td><?php echo date("d-m-Y", strtotime($i->date_create)) ?></td>
            <td><?php if ($tong == 0) echo "Liên hệ"; else echo number_format($tong, 0, ",", ".") . " vnđ" ?> </td>
            <td><a href="<?php echo base_url() ?>admin/order/view/<?php echo $i->id ?>"><i class="fa fa-eye"></i></a></td>

        </tr>
        <?php $x++;
    } ?>
    </tbody>
</table>
<div class="clear he1"></div>
<div class="row">
    <div class="col-md-6">
        <!-- Begin: life time stats -->
        <div class="portlet box yellow">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-thumb-tack"></i>Top 10
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#overview_1" data-toggle="tab">
                            Bán chạy nhất
                        </a>
                    </li>
                    <li>
                        <a href="#overview_2" data-toggle="tab">
                            Xem nhiều nhất
                        </a>
                    </li>
                    <li>
                        <a href="#overview_3" data-toggle="tab">
                            Thành viên mới
                        </a>
                    </li>
                </ul>
                <div class="tab-content" style="height: 319px">
                    <div class="tab-pane active" id="overview_1">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        Tên sản phẩm
                                    </th>
                                    <th>
                                        Giá
                                    </th>
                                    <th>
                                        Đã bán
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($top_buy as $top) {
                                    $item_lang = $this->m_item->show_detail_item_id_lang($top->id_item, 'vn');
                                    if (isset($item_lang->item_name)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo site_url('admin/item/edit/' . $top->id_item) ?>">
                                                    <?php echo $item_lang->item_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $this->global_function->get_price($top->total_money) ?>
                                            </td>
                                            <td>
                                                <?php echo $top->q ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('admin/item/edit/' . $top->id_item) ?>" class="btn default btn-xs green-stripe">
                                                    Xem
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="overview_2">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        Tên sản phẩm
                                    </th>
                                    <th>
                                        Giá
                                    </th>
                                    <th>
                                        Số lượt xem
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list_most_view as $row) {
                                    if (isset($row->id)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo site_url('admin/item/edit/' . $row->id) ?>">
                                                    <?php echo $row->item_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo $this->global_function->get_price($row->price) ?>
                                            </td>
                                            <td>
                                                <?php echo $row->item_view ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('admin/item/edit/' . $top->id_item) ?>" class="btn default btn-xs green-stripe">
                                                    Xem
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="overview_3">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>
                                        Tên thành viên
                                    </th>
                                    <th>
                                        Ngày đăng ký
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list_user as $row) {
                                    if (isset($row->id)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo site_url('admin/users/edit/' . $row->id) ?>">
                                                    <?php echo $row->full_name ?>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo date('d-m-Y', strtotime($row->created_date)) ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo site_url('admin/item/edit/' . $top->id_item) ?>" class="btn default btn-xs green-stripe">
                                                    Xem
                                                </a>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
    <div class="col-md-6">
        <!-- Begin: life time stats -->
        <div class="portlet box blue tabbable">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart-o"></i>Doanh thu
                </div>
            </div>
            <div class="portlet-body">
                <div class="portlet-tabs">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2">
                            <div id="statistics_2" class="chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="well no-margin no-border char-revenue">
                    <div class="row">
                        <div class="col-xs-6 text-stat"><span class="label label-success col-xs-4">Tổng:</span>
                            <span class="price-bar"><?php echo $this->global_function->get_price($this->m_order->sum_total()) ?></span>
                        </div>
                        <div class=" col-xs-6 text-stat">
										<span class="label label-info col-xs-4">
											 VAT 10%:
										</span>
                            <span class="price-bar"><?php echo $this->global_function->get_price($this->m_order->sum_total()*0.1) ?></span>
                        </div>
                        <div class="col-xs-6 text-stat">
										<span class="label label-danger col-xs-4">
											 Phí:
										</span>
                            <span class="price-bar"><?php echo $this->global_function->get_price($this->m_order->sum_ship(),0) ?></span>
                        </div>
                        <div class="col-xs-6 text-stat">
										<span class="label label-warning col-xs-4">
											 Đơn hàng:
										</span>
                            <span class="price-bar"><?php echo $this->m_order->count_list_order() ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
    <div class="col-md-6">
        <!-- Begin: life time stats -->
        <div class="portlet box green tabbable">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bar-chart-o"></i>Users Online
                </div>
            </div>
            <div class="portlet-body">
                <div class="portlet-tabs">
                    <div class="tab-content">
                        <div class="tab-pane active" id="portlet_tab2">
                            <div id="statistics_1" class="chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="well no-margin no-border">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-success">
											 Tổng lượt truy cập:
										</span>
                            <h3>
                                <?php

                                echo $this->global_function->get_tableWhere(array('total !='=>0),'count_user_online')->total;
                                ?>
                            </h3>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
										<span class="label label-info">
											 Đang online:
										</span>
                            <h3>
                                <?php
                                echo $this->global_function->count_table_group_by(array('time >='=>time()-600,'time <'=>time()),'user_online');
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet paddingless">
            <div class="portlet-title line">
                <div class="caption">
                    <i class="fa fa-bell-o"></i>Thông báo
                </div>
                <div class="tools">
                    <a href="" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="" class="reload">
                    </a>
                    <a href="" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <!--BEGIN TABS-->
                <div class="tabbable tabbable-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab">
                                Lava
                            </a>
                        </li>
                        <li>
                            <a href="#tab_1_2" data-toggle="tab">
                                Liên hệ
                            </a>
                        </li>
                        <li>
                            <a href="#tab_1_3" data-toggle="tab">
                                Thành viên
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">
                            <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                   <?php echo HTML?>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_1_2">
                            <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                <ul class="feeds">
                                    <?php foreach($list_contact as $contact){?>
                                    <li>
                                        <a href="<?php echo site_url('admin/contact/view/'.$contact->id)?>" target="_blank">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            <?php echo $contact->name?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    <?php echo date("d-m",strtotime($contact->date_reseive))?>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab_1_3">
                            <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                <div class="row">
                                    <?php foreach($list_user as $row){
                                        $user=$this->global_function->get_tableWhere( array("user_id" => $row->users_id),"tbl_user");
                                        ?>
                                    <div class="col-md-6 user-info">
                                        <img alt="" src="<?php echo base_url() ?>themes/back/assets/img/avatar.png" class="img-responsive"/>
                                        <div class="details">
                                            <div>
                                                <a >
                                                    <?php echo $user->user_loginname ?>
                                                </a>
                                            </div>
                                            <div>
                                                <?php echo date('H:s d-m',$row->last_login)?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        initChart1();
        initChart2();
    });
    var initChart2 = function(data) {
        var data = [
            <?php
            foreach($list_order_day as $list) {
            $tong = $this->m_order->sum_total($list->id);
            ?>
            ['<?php echo date("d-m-Y", strtotime($list->date_create)) ?>', <?php echo $tong?>],
            <?php }?>
        ];
        var plot_statistics = $.plot(
            $("#statistics_2"),
            [
                {
                    data:data,
                    lines: {
                        fill: 0.6,
                        lineWidth: 0,
                    },
                    color: ['#BAD9F5']
                },
                {
                    data: data,
                    points: {
                        show: true,
                        fill: true,
                        radius: 5,
                        fillColor: "#BAD9F5",
                        lineWidth: 3
                    },
                    color: '#fff',
                    shadowSize: 0
                },
            ],
            {

                xaxis: {
                    tickLength: 0,
                    tickDecimals: 0,
                    mode: "categories",
                    min: 2,
                    font: {
                        lineHeight: 14,
                        style: "normal",
                        variant: "small-caps",
                        color: "#6F7B8A"
                    }
                },
                yaxis: {
                    ticks: 3,
                    tickDecimals: 0,
                    tickColor: "#f0f0f0",
                    font: {
                        lineHeight: 14,
                        style: "normal",
                        variant: "small-caps",
                        color: "#6F7B8A"
                    },
                    tickFormatter: function(val, yaxis) { return numberWithCommas(val);}
                },
                grid: {
                    backgroundColor: {
                        colors: ["#fff", "#fff"]
                    },
                    borderWidth: 1,
                    borderColor: "#f0f0f0",
                    margin: 0,
                    minBorderMargin: 0,
                    labelMargin: 20,
                    hoverable: true,
                    clickable: true,
                    mouseActiveRadius: 6
                },
                legend: {
                    show: false
                }
            }
        );
        var previousPoint = null;
        $("#statistics_2").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;

                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);

                    showTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1]);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });

    }
    var initChart1 = function () {
        var data = [
            <?php
            for($i=10;$i>=0;$i--){
            $total=$this->global_function->count_table(array('date_time'=>date('Y-m-d',strtotime(-$i." day",time()))),'user_online');
            ?>
            ['<?php echo date("d-m", strtotime(-$i." day", time())) ?>', <?php echo $total?>],
            <?php }?>
        ];

        var plot_statistics = $.plot(
            $("#statistics_1"),
            [
                {
                    data:data,
                    lines: {
                        fill: 0.6,
                        lineWidth: 0,
                    },
                    color: ['#f89f9f']
                },
                {
                    data: data,
                    points: {
                        show: true,
                        fill: true,
                        radius: 5,
                        fillColor: "#f89f9f",
                        lineWidth: 3
                    },
                    color: '#fff',
                    shadowSize: 0
                },
            ],
            {

                xaxis: {
                    tickLength: 0,
                    tickDecimals: 0,
                    mode: "categories",
                    min: 2,
                    font: {
                        lineHeight: 15,
                        style: "normal",
                        variant: "small-caps",
                        color: "#6F7B8A"
                    }
                },
                yaxis: {
                    ticks: 3,
                    tickDecimals: 0,
                    tickColor: "#f0f0f0",
                    font: {
                        lineHeight: 15,
                        style: "normal",
                        variant: "small-caps",
                        color: "#6F7B8A"
                    }
                },
                grid: {
                    backgroundColor: {
                        colors: ["#fff", "#fff"]
                    },
                    borderWidth: 1,
                    borderColor: "#f0f0f0",
                    margin: 0,
                    minBorderMargin: 0,
                    labelMargin: 20,
                    hoverable: true,
                    clickable: true,
                    mouseActiveRadius: 6
                },
                legend: {
                    show: false
                }
            }
        );
        var previousPoint = null;
        $("#statistics_1").bind("plothover", function (event, pos, item) {
            $("#x").text(pos.x.toFixed(2));
            $("#y").text(pos.y.toFixed(2));
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $("#tooltip").remove();
                    var x = item.datapoint[0].toFixed(2),
                        y = item.datapoint[1].toFixed(2);
                    showTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1]);
                }
            } else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });

    }
</script>