<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top') ?>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="col-xs-12">
            <p class="cart-success text-center ">
                <?php echo $this->global_function->show_config_language('lang_buy_success', $lang) ?>
            </p>
        </div>
    </div>
</div>