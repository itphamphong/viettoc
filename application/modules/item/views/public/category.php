<?php $this->load->view('front/block/menu_top',array('home'=>'page-menu'))?>
<?php foreach ($list_child as $cate) {

    $params = array(
        'lang' => $lang,
        'status' => 2,
        'category_id' => $cate->id
    );
    $list_item = $this->a_item->show_list_item_params($params);
    ?>
    <!--end advertise--><!--new product-->
    <section class="gt-group">
        <div class="default_width">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-h">
                        <?php
                        if ($cate->choose_upload == 1) {
                            $src = base_url() . "uploads/Images/product/" . $cate->picture;
                        } else if ($cate->choose_upload == 2) {
                            $src = base_url() . $list->picture;
                        }
                        ?>
                        <i class="ui-head ui-icon1 nobg"> <img src="<?php echo $src ?>" width="26"></i>
                        <span><?php echo $cate->category_name ?></span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-gt-block">
                        <?php foreach ($list_item as $item) {
                            $cate=$this->a_item->show_detail_item_cate(array('item_id'=>$item->id,"category_top !="=>0),$lang);
                            $parent=$this->a_category->show_detail_category_where(array('category_id'=>$cate->category_top),$lang);
                            if(isset($parent->category_link) && isset($cate->category_link)){
                                $link=$parent->category_link."/".$cate->category_link."/".$item->item_link;
                            }else{
                                $link="#";
                            }
                            ?>
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                                <div class="ui-block">
                                    <div class="ui-img-block">
                                        <?php $this->load->view('front/block/load_picture', array("item" => $item, 'folder' => 'product')); ?>
                                    </div>
                                    <div class="ui-hyperlink">
                                        <a href="<?php echo $link?>">
                                            <?php echo $item->item_name ?>
                                        </a>
                                    </div>
                                    <div class="ui-price"><?php echo $this->global_function->get_price($item->price) ?></div>
                                    <div class="ui-quick">
                                        <div class="quickview">
                                            <a href="#" class="fa fa-eye"><span>Quick view</span></a>
                                        </div>
                                        <div class="wishlist">
                                            <a href="#" class="fa fa-heart"><span>Wish List</span></a>
                                        </div>
                                        <div class="shoping">
                                            <a class="fa fa-shopping-cart my-cart-btn" ><span>Add cart</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-lg-12-->
                        <?php } ?>
                    </div><!--end col-lg-12-->
                </div>
            </div>
        </div>
    </section>
    <!--end new product--><!--advertise-->
<?php } ?>