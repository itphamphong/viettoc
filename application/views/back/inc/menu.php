<div class="col_full fleft">
    <div class="item-col fright">
        <ul class="menu-left fleft col_full">
            <li class="i-pic "><a href="<?php echo site_url('admin')?>"><i class="fa fa-home"></i>Trang chủ</a></li>
            <li class="i-pic pactive"><a>Media</a></li>
            <li class="i-pic parent"><a><i class="fa fa-picture-o"></i>Banner</a>
                <ul class="sub" <?php if ($mod == 'banner_0' ||$mod=='banner_add_0' || $mod=='album_1') { ?> style="display: block" <?php } ?>>
                    <li <?php if ($mod == 'banner_add_0') { ?> class="active" <?php } ?>>
                        <a href="<?php echo site_url("admin/banner/add") ?>" class="i-add"><i class="fa fa-plus"></i>Thêm mới</a>
                        <div class="arrow-left <?php if ($mod == 'banner_add') echo 'show';else echo 'hidden'  ?>"></div>
                    </li>

                    <li class=" <?php if ($mod == 'banner_0') { ?>active<?php } ?>">
                        <a href="<?php echo site_url("admin/banner") ?>" class="i-pic"><i class="fa fa-file-picture-o"></i>Quản lý banner</a>
                        <div class="arrow-left <?php if ($mod == 'banner') echo 'show';else echo 'hidden'  ?>"></div>
                    </li>
                </ul>
            </li>
            <li class="i-pic pactive"><a>Sản phẩm</a></li>
            <li class="i-about parent"><a><i class="fa  fa-industry"></i>Nhóm sản phẩm</a>
                <ul class="sub" <?php if ($mod == 'add_category_2' || $mod == 'category_2') { ?> style="display: block" <?php } ?>>
                    <li <?php if ($mod == 'add_category_2') { ?> class="active" <?php } ?>>
                        <a href="<?php echo site_url("admin/category/add/2") ?>" class="i-add">
                            <i class="fa fa-plus"></i>Thêm mới
                        </a>
                    </li>
                    <li <?php if ($mod == 'category_2') { ?> class="active" <?php } ?>>
                        <a href="<?php echo site_url("admin/category/index/2") ?>" class="nobefor">
                            <i class="fa  fa-th"></i>Quản lý nhóm
                        </a>
                    </li>
                </ul>
            </li>
            <li class="i-about parent"><a><i class="fa   fa-cube"></i>Sản phẩm</a>
                <ul class="sub" <?php if ($mod == 'item_list' || $mod == 'item_add') { ?> style="display: block" <?php } ?>>
                    <li <?php if ($mod == 'item_add') { ?> class="active" <?php } ?>>
                        <a href="<?php echo site_url("admin/item/add") ?>" class="i-add">
                            <i class="fa fa-plus"></i>Thêm mới
                        </a>
                    </li>
                    <li <?php if ($mod == 'item_list') { ?> class="active" <?php } ?>>
                        <a href="<?php echo site_url("admin/item") ?>" class="nobefor">
                            <i class="fa  fa-cube"></i>Quản lý sản phẩm
                        </a>
                    </li>
                </ul>
            </li>
            <li class="i-pic pactive"><a>Thống kê</a></li>
            <li class="i-search parent"><a><i class="fa fa-edit"></i>Hóa đơn</a>
                <ul class="sub" <?php if ($mod == 'order' || $mod=='booking_flight') { ?> style="display: block" <?php } ?>>
                    <li <?php if ($mod == 'order') { ?> class="active" <?php } ?>><a href="<?php echo site_url("admin/order") ?>" class="i-search"><i class="fa  fa-list-ul"></i>DS Mua hàng</a></li>

                </ul>

            </li>
    </div>
</div>