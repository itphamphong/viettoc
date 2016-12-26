<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top') ?>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php $this->load->view('front/block/breadcrumb', $breadcrumb) ?>
        <div class="clear h2"></div>
        <div id="col-right" class="col-xs-12">
                <div class="title-cate col-xs-12 text-center"><?php echo $title ?></div>
                <?php echo $detail->article_description?>
        </div>
    </div>
</div>