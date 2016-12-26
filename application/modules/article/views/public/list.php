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
                foreach ($list as $row) { ?>
                    <div class="col-sm-3 col-xs-6 col-sml-12 i-item ">
                        <div class="i-blog">
                            <?php if ($row->choose_upload == 1) { ?>
                                <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                            <?php } else if ($row->choose_upload == 2) { ?>
                                <img src="<?php echo base_url() ?><?php echo $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                            <?php } else { ?>
                                <i class="<?php echo $row->picture ?>"></i>
                            <?php } ?>
                            <a class="title-blog" href="<?php echo site_url($lang . "/" . $url . "/" . $row->article_link) ?>">
                                <?php echo $row->article_name ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>