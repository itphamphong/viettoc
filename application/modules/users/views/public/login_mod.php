<div class="breadcrumbs">
    <a href="<?php if($lang!='vn') echo site_url($lang."/".$l->lang_url_home[$lang])?>" class="first"><?php echo $l->lang_home[$lang]?></a>
        <a href="<?php echo site_url($lang."/dang-nhap-cua-hang")?>" class="last"> <?php echo "Đăng nhập cửa hàng"?></a>

</div>
<div class="menu-left menu-article">
    <?php $this->load->view("front/block/col-banner")?>
</div><!-- menu left-->
<div class="right-content">
    <h1 class="title"><?php echo "Đăng nhập của hàng"?></h1>
    <div class="c10"></div>
    <form action="" method="post">
        <div class="form-log" style="margin: auto; float: none">
            <p class="error red bold"></p>
            <label>Email</label>
            <input type="text" name="email" class="input" id="email">
            <?php echo form_error("email")?>
            <label><?php echo $l->lang_password[$lang]?></label>
            <input type="password" name="password" class="input" id="pass">
            <?php echo form_error("password")?>
            <a href="<?php echo site_url($lang."/".$l->lang_url_forgot_pass[$lang])?>" class="forgot-pass ajax "><?php echo $l->lang_forgot_pass[$lang]?></a>
            <div class="round-btn">
                <input type="button" class="btn" value="<?php echo $l->lang_login[$lang]?>" onclick="LoginMod()">
            </div>
        </div>
    </form>

</div>