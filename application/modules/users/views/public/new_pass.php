<?php $this->load->view("front/block/block_banner_dangtin") ?>
<div id="loading" style="position:relative; display:none; margin:auto; background:#FFF; width:1000px;"><div style="position:absolute; top:-215px; left:452px; z-index:10"><img src="themes/images/layout/loading.gif" width="100px" /></div></div>
<div id="main-page" class="trans_top">
    <div id="breadcrumbs">
        <ul class="list_bread">
            <li class="bread first"><a href="<?php echo site_url() ?>">Trang chủ</a></li>
            <li class="bread last" style="color: #fff; text-transform: uppercase"><?php echo $l->lang_dangnhap[$lang] ?></li>
        </ul>
    </div>
    <div id="page-content" >
        <div id="wrap_detail_page">
           <?php $this->load->view("menu-left") ?>
            <div class="right_wrap">
                <div class="section_content">
                    <div class="body_text">
                        <div class="field-item even" property="content:encoded">
                            <div class="wd-topnew">
                                <div class="wd-topnew-content">
                                    <div class="wd-image-av wd-form-register">
                                        <?php if(isset($message) && $message!='') echo $message?>
                                        <div class="wd-block-register">
                                            <p class="wd-bd-top-bottom"><?php echo $l->lang_newpass[$lang] ?></p>
                                            <fieldset>
                                                <form class="form-vertical" id="userLoginForm" action="" method="post">							<div class="wd-input">
                                                        <input placeholder="" autofocus="autofocus" name="newpass" id="GNLoginForm_email" type="password" />
                                                    </div>
                                                   <?php echo form_error("newpass")?>
                                                    <div class="wd-submit">
                                                        <input type="submit" value="<?php echo $l->lang_send[$lang] ?>" name="ok">

                                                    </div>
                                                      <input value="<?php echo $this->session->userdata("email_forgot") ?>" type="hidden" name="email_forgot">
                                                </form>						
                                            </fieldset>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        PageHeight();
        Columnfooter();
    })
</script>

