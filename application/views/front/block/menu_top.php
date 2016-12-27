<?php
$CI =& get_instance();
$CI->load->model('category/a_category');
$list_cate = $CI->a_category->show_list_category_page(array("category_top" => 0, "category_status" => 1), $lang, 0);
?>
<!--run on smartphone-->
<section id="pav-mainnav" class="hidden-lg hidden-md">
    <div class="container">
        <div class="mainnav-wrap">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-6 col-xs-6 row-offcanvas row-offcanvas-left" style="z-index:1000;">
                    <div class="ui-toggle">
                        <p class="pull-left">
                            <a href="javascript:" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        </p></div>

                    <div class="col-xs-10 col-sm-10 sidebar-offcanvas" id="sidebar" style="z-index:1000;">
                        <div class="list-group">
                            <?php foreach ($list_cate as $cate) { ?>
                                <a href="<?php echo site_url($cate->category_name) ?>" class="list-group-item"><?php echo $cate->category_name ?></a>
                            <?php } ?>
                        </div>
                    </div><!--/.sidebar-offcanvas-->

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6" style="z-index:10">
                    <div id="search" class="pull-right">
                        <form id="search-form" action="" method="get">
                            <input type="text" name="q" placeholder="Tìm kiếm">
                            <input type="submit" class="button-search" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--run on smartphone--><!--end logo & search-->
<section>
    <div class=" default_width">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <ul class="ui-menu-categories <?php echo isset($home)?$home:''?>">
                        <li class="first">DANH MỤC SẢN PHẨM<i class="fa fa-bars"></i></li>
                        <?php foreach ($list_cate as $cate) {
                            if ($cate->choose_upload == 1) {
                                $src = base_url() . "uploads/Images/product/" . $cate->picture;
                            } else if ($cate->choose_upload == 2) {
                                $src = base_url() . $list->picture;
                            }
                            $list_child = $CI->a_category->show_list_category_page(array("category_top" => $cate->id, "category_status" => 1), $lang, 0);
                            ?>
                            <li class="h">
                                <span>
                                    <img src="<?php echo $src ?>">
                                </span>
                                <a href="<?php echo $cate->category_link ?>">
                                    <?php echo $cate->category_name ?><i class="fa fa-angle-right hidden-xs"></i>
                                </a>
                                <?php if (count($list_child)) { ?>
                                    <ul>
                                        <?php foreach ($list_child as $child) {
                                            if ($child->choose_upload == 1) {
                                                $src_child = base_url() . "uploads/Images/product/" . $child->picture;
                                            } else if ($child->choose_upload == 2) {
                                                $src_child = base_url() . $child->picture;
                                            }
                                            ?>
                                            <li>
                                                <span><img src="<?php echo $src_child ?>"></span>
                                                <a href="<?php echo site_url($cate->category_link."/".$child->category_link)?>"><?php echo $child->category_name ?><i class="hidden-xs"></i>
                                                </a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="ui-policy">
                        <a target="_blank" href="#" class="si nth1">Giao toàn Quốc</a>
                        <a target="_blank" href="#" class="si nth2">Miễn phí vận chuyển</a>
                        <a target="_blank" href="#" class="si nth3">Miễn phí cà thẻ VISA, MASTER, ATM</a>
                    </div>
                    <?php
                    if (isset($home) && $home == 1) {
                        echo modules::run('banner/Banner/Top', $lang);
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</section>