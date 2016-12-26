<div id="round-menu-top" class="im_relative">
    <div class="container">
        <?php $this->load->view('front/block/menu_top')?>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php $this->load->view('front/block/breadcrumb',$breadcrumb)?>
        <div class="clear h2"></div>
        <div id="col-right" class="col-xs-12">
            <div class="title-cate col-xs-12 text-center"><?php echo $category->category_name?></div>
            <?php foreach($list_cate_child as $list){
                if ($list->choose_upload == 1) {
                    $src = base_url() . "uploads/Images/product/" . $list->picture;
                } else if ($list->choose_upload == 2) {
                    $src = base_url() . $list->picture;
                } else $src = '';
                ?>
                <div class="col-sm-3 col-xs-6 col-sml-12 i-item">
                    <a  class="info" href="<?php echo site_url($lang."/".$category->category_link."/".$list->category_link)?>">
                        <div class="r-img i-cate">
                    <img src="<?php echo $src;?>"  onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';">
                        </div>
                        <div class="top"></div>
                        <?php echo $list->category_name?>
                        <div class="bottom"></div>
                    </a>
                </div>
            <?php }?>
        </div>
    </div>
</div>