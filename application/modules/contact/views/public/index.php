<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top') ?>
    </div>
</div>
<div id="content">
    <div class="container" id="contact-form">
        <?php $this->load->view('front/block/breadcrumb', $breadcrumb) ?>
        <div class="clear h2"></div>
        <div class="col-sm-6 col-xs-12" style="line-height: 20px">
            <div class="page-block-title">
                <h2><?php echo $this->global_function->show_config_language('lang_contact_us', $lang) ?></h2>
            </div>
            <?php echo $info->about_company ?>
        </div>
        <div class="col-sm-6 col-xs-12 columns">
            <div class="page-block-title">
            </div>
            <div id="error-content">
                <?php
                echo form_error("c-full_name");
                echo form_error("c-title");
                echo form_error("c-email");
                echo form_error("c-content");
                echo form_error("c-captcha");
                ?>
            </div>
            <?php
            $this->load->view('front/inc/messager', array('type_messager' => $this->input->get('messager')));
            ?>
            <form action="" method="POST" name="page_feedback" id="page_feedback">
                <div class="commentform-inner">
                    <input id="sender_name" name="c-full_name" type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_full_name', $lang) ?>"
                           value="<?php echo set_value('c-full_name') ?>">
                    <input id="sender_email" name="c-email" type="email" placeholder="Email" value="<?php echo set_value('c-email') ?>">
                    <input class="pull-right" id="letter_subject" name="c-title" type="text"
                           placeholder="<?php echo $this->global_function->show_config_language('lang_title', $lang) ?>" value="<?php echo set_value('c-title') ?>">
                </div>
                <textarea id="letter_text" name="c-content" placeholder="<?php echo $this->global_function->show_config_language('lang_notice', $lang) ?>"><?php echo set_value('c-content') ?></textarea>
                <div class="row">
                    <img src="<?php echo site_url('load-captcha') ?>" alt="" id="img-captcha"/>
                    <input type="text" name="c-captcha" class="text" id="captcha">
                </div>
                <div class="five columns" style="text-align: right">
                    <button class="i-btn btn-cart button pull-right" name="ok" type="submit">Gửi thông tin</button>
                </div>
            </div>
        </form>
    </div>
</div>