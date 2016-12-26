<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top') ?>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php $this->load->view('front/block/breadcrumb', $breadcrumb) ?>
        <div class="clear h2"></div>
        <div id="col-left" class="col-xs-3">
            <div class="title">
                <?php echo $this->global_function->show_config_language('lang_news', $lang);?>
            </div>
            <div class="box">
                <ul>
                    <?php foreach($list as $row){?>
                        <li class="<?php if($row->id==$detail->id) echo 'active'?>">
                            <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_news', $lang,'url')."/".$row->article_link) ?>">

                            <i class="fa fa-gg"></i><?php echo $row->article_name?>
                            </a>
                        </li>
                    <?php }?>
                </ul>
            </div>
            <div class="clear "></div>
        </div>
        <div id="col-right" class="col-sm-9 col-xs-12 item-detail">
            <div class="title"> <?php echo $title ?></div>
            <div class="article-description">
            <?php echo $detail->article_description?>
            </div>
        </div>
    </div>
</div>

