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
            <div class="row">
                <div class="title-cate col-xs-12 text-center"><?php echo $title ?></div>
                <?php
                $i = 1;
                foreach ($list as $row) {
                    $thumb = $this->m_project->show_thumb($row->id);
                    $list_images = $this->a_item->list_thumb($row->id);
                    ?>
                    <div class="col-sm-3 col-xs-6 col-sml-12 i-project ">
                        <div class="i-blog">
                            <a rel="group1" class=" group" href="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($thumb->name) ? $thumb->name : "" ?>">
                                <img src="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($thumb->name) ? $thumb->name : "" ?>"
                                     alt=" <?php echo $row->item_name ?>">
                                <?php echo $row->item_name ?>
                            </a>
                            <?php foreach ($list_images as $list) { ?>
                                <a rel="group1" class="title-hide group" href="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>">
                                    <img src="<?php echo base_url() ?>uploads/Images/product/<?php echo isset($list->name) ? $list->name : "" ?>">
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
                <div style="clear: both; height: 10px"></div>
            </div>
        </div>
        <div style="clear: both; height: 10px"></div>
    </div>
    <div style="clear: both; height: 10px"></div>
</div>
<div style="clear: both; height: 10px"></div>
<script>
    $(document).ready(function () {
        $("a.group").fancybox({
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 600,
            'speedOut': 200,
            'overlayShow': false
        });
    })
</script>