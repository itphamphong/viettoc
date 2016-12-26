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
            <div class="right_wrap" style="width: 100%">
                <div class="section_content">
                    <div class="body_text">
                        <div class="field-item even" property="content:encoded">
                            <div class="wd-topnew">
                                <div class="wd-topnew-content">
                                    <div class="wd-image-av wd-form-register">
                                        <div class="wd-block-register">
                                            <p class="wd-bd-top-bottom" style="text-align: center"> <span style="color: #F00; font-weight: bold; margin: auto"><?php echo $l->lang_update_sucess[$lang] ?></span>             </p>

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
