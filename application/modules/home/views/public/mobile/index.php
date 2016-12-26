<div id="banner-top">
    <div id="round-menu-top">
        <div class="container">
            <?php $this->load->view('front/block/menu_top')?>
        </div>
    </div>
    <?php echo modules::run('banner/banner/Top', $lang); ?>
</div>
<div class="clearfix h1"></div>
<div class="container">
    <div class="col-sm-6">
        <?php if ($about->choose_upload == 1) { ?>
            <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $about->picture ?>" alt="<?php echo $about->alt_picture ?>"/>
        <?php } else if ($about->choose_upload == 2) { ?>
            <img src="<?php echo base_url() ?><?php echo $about->picture ?>" alt="<?php echo $about->alt_picture ?>"/>
        <?php } else { ?>
            <i class="<?php echo $about->picture ?>"></i>
        <?php } ?>
    </div>
    <div class="col-sm-6">
        <?php echo $about->article_summary ?>
        <div class="clearfix"></div>
        <a class="btn-view-about" href="<?php echo site_url($lang."/". $this->global_function->show_config_language('lang_view_more', $lang,'url'))?>">
            <?php echo $this->global_function->show_config_language('lang_view_more', $lang) ?>
        </a>
    </div>
</div>
<div class="clearfix h1"></div>
<div class="col-lg-12 about-home">
    <?php echo $info->note_home ?>
</div>
<div class="clearfix h1"></div>
<div id="round-block">
    <?php
    $x = 0;
    foreach ($list_cate as $cate) {
        if ($cate->choose_upload == 1) {
            $src = base_url() . "uploads/Images/product/" . $cate->picture;
        } else if ($cate->choose_upload == 2) {
            $src = base_url() . $cate->picture;
        } else $src = '';?>
        <div class="item">
            <div class="col-lg-12 col-block " style="background: url('<?php echo $src ?>')">
                <a class="title" href="<?php echo site_url($lang."/".$cate->category_link )?>"><?php echo $cate->category_name ?></a>
            </div>
        </div>

        <?php $x++;} ?>
</div>

<div class="clearfix h1"></div>
<?php if ($about->choose_upload == 1) { ?>
    <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $about->picture ?>" alt="<?php echo $about->alt_picture ?>"/>
<?php } else if ($about->choose_upload == 2) { ?>
    <img src="<?php echo base_url() ?><?php echo $about->picture ?>" alt="<?php echo $about->alt_picture ?>"/>
<?php } else { ?>
    <i class="<?php echo $about->picture ?>"></i>
<?php } ?>
<div class="clearfix h1"></div>
<div class="col-xs-12 about-home">
    <div class="container">
        <p class="title"><?php echo 'TIN TỨC' ?></p>
    </div>
</div>
<div class="clearfix h1"></div>
<div class="col-xs-12">
    <div class="container">
        <div id="owl-demo">
            <?php
            $x = 0;
            foreach ($blog_two as $row) {
                if ($x % 2 == 0) {
                    ?>
                    <div class="owl-pc-content">
                        <div class="owl-pc-thumbnail">
                            <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_news', $lang,'url')."/".$row->article_link) ?>">
                                <?php $this->load->view('front/block/load_picture', array('item' => $row, "folder" => "article", "class" => "attachment-wpnetbase-owl-pc-thumb size-wpnetbase-owl-pc-thumb wp-post-image", "width" => '285', "height" => "255",'thumb'=>1)) ?>
                            </a>
                        </div>
                        <div class="owl-pc-info">
                            <h2 class="owl-pc-title"><?php echo $row->article_name ?></h2>
                            <p class="owl-pc-excerpt">
                                <?php echo $this->global_function->catchuoi(strip_tags($row->article_summary), 100) ?>
                            </p>
                            <p class="owl-pc-more">
                                <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_news', $lang,'url')."/".$row->article_link) ?>"><?php echo $this->global_function->show_config_language('lang_view_more', $lang) ?></a>
                            </p>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="owl-pc-content event">
                        <div class="owl-pc-info">
                            <h2 class="owl-pc-title"><?php echo $row->article_name ?></h2>
                            <p class="owl-pc-excerpt">
                                <?php echo $this->global_function->catchuoi(strip_tags($row->article_summary), 100) ?>
                            </p>
                            <p class="owl-pc-more">
                                <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_news', $lang,'url')."/".$row->article_link) ?>"><?php echo $this->global_function->show_config_language('lang_view_more', $lang) ?></a>
                            </p>
                        </div>
                        <div class="owl-pc-thumbnail">
                            <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_news', $lang,'url')."/".$row->article_link) ?>">
                                <?php $this->load->view('front/block/load_picture', array('item' => $row, "folder" => "article", "class" => "attachment-wpnetbase-owl-pc-thumb size-wpnetbase-owl-pc-thumb wp-post-image", "width" => '285', "height" => "255",'thumb'=>1)) ?>

                            </a>
                        </div>
                    </div>
                <?php };
                $x++;
            } ?>
        </div>
    </div>
</div>


