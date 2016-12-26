<div class="col_full fleft" >
    <div class="item-col fright">
        <div class="title fleft col_full"><a href="<?php echo site_url('admin')?>" style="color: #fff">Trang chủ</a></div>
        <ul class="menu-left fleft col_full">
            <li class="i-order parent <?php if($mod=='order') echo 'active'?>"><a href="<?php echo site_url("admin/order")?>">Đơn hàng</a></li>
            <li class="i-product parent "><a href="#">Sản phẩm</a>
                <ul class="sub" <?php if($mod=='item_list' || $mod=='item_add' || $mod=='item_edit' ||$mod=='category_1' || $mod=='category_2'){?> style="display: block" <?php }?>>
                    <li <?php if($mod=='item_add'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/item/add")?>" class="i-add">Đăng sản phẩm</a></li>
                    <li <?php if($mod=='item_list'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/item")?>" class="m-product">Quản lý sản phẩm</a></li>
                    <li <?php if($mod=='category_1'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/category/index/1")?>" class="m-ca-product">Quản lý danh mục</a></li>
                    <li <?php if($mod=='category_2'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/category/index/2")?>" class="m-ca-product">Quản lý NSX</a></li>
                </ul>
            </li>
            <li class="i-product parent <?php if($mod=='project_list'|| $mod=='project_add') echo 'active'?>"><a href="<?php echo site_url("admin/project/index/1")?>">Công trình tiêu biểu</a>
              
            </li>
            <li class="i-news parent"><a href="#">Tin tức</a>
                <ul class="sub" <?php if($mod=='article_1' || $mod=='term_1'){?> style="display: block" <?php }?>>
                    <li <?php if($mod=='article_1'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/article/index/1")?>" class="i-news">Quản lý tin</a></li>
                </ul>
            </li>
            <li class="i-pic parent"><a href="#">Hình ảnh</a>
                <ul class="sub" <?php if($mod=='banner'){?> style="display: block" <?php }?>>
                    <li <?php if($mod=='banner'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/banner")?>" class="i-pic">Quản lý banner</a></li>
                </ul>
            </li>

            <li class="i-search parent"><a href="#">Tối ưu hóa tìm kiếm</a>
                <ul class="sub" <?php if($mod=='tags_1'){?> style="display: block" <?php }?>>
                    <li <?php if($mod=='tags_1'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/tags")?>" class="i-search">Quản lý từ khóa</a></li>
                </ul>
            </li>
            <li class="i-contact parent"><a href="#">Liên hệ</a>
                <ul class="sub" <?php if($mod=='email_list' || $mod=='contact'){?> style="display: block" <?php }?>>
                    <li <?php if($mod=='email_list'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/contact/email")?>" class="i-contact">Quản lý email</a></li>
                    <li <?php if($mod=='contact'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/contact")?>" class="i-contact">Quản lý liên hệ</a></li>
                </ul>
            </li>
            <li class="i-user parent"><a href="#">Thành viên</a>
                <ul class="sub" <?php if($mod=='users' || $mod=='moderator'){?> style="display: block" <?php }?>>
                    <li <?php if($mod=='users'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/users")?>" class="i-contact">Danh sách thành viên</a></li>
                    <li <?php if($mod=='moderator'){?> class="active" <?php }?>><a href="<?php echo site_url("admin/moderator")?>" class="i-contact">Danh sách quản trị</a></li>
                </ul>
            </li>
            <li class="i-static parent <?php if($mod=='company'){?>active<?php }?>"><a href="<?php echo site_url("admin/company")?>">Cấu hình</a></li>

        </ul>
    </div>
</div>
