<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top') ?>
    </div>
</div>
<div class="col-xs-12">
    <div class="container">
        <?php $this->load->view('front/block/breadcrumb', $breadcrumb) ?>
        <div class="clearfix h1"></div>
        <div id="owl-demo">
            <?php
            $x = 0;
            foreach ($list as $row) {
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
                                <a href="<?php echo site_url($row->article_link) ?>"><?php echo $this->global_function->show_config_language('lang_view_more', $lang) ?></a>
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