<section class="gt-group">
    <div class="default_width">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-h"><i class="ui-head ui-icon1"></i><span>Sản phẩm mới</span></div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-gt-block">
                    <?php foreach($list_product as $row){
                        $cate=$this->a_item->show_detail_item_cate(array('item_id'=>$row->id,"category_top !="=>0),$lang);
                        $parent=$this->a_category->show_detail_category_where(array('category_id'=>$cate->category_top),$lang);
                        if(isset($parent->category_link) && isset($cate->category_link)){
                        $link=$parent->category_link."/".$cate->category_link."/".$row->item_link;
                        }else{
                            $link="#";
                        }
                        ?>
                    <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6">
                        <div class="ui-block">
                            <div class="ui-img-block">
                                <a href="<?php echo site_url($row->item_link) ?>">
                                    <?php $this->load->view('front/block/load_picture', array('item' => $row, "folder" => "product")) ?>
                                </a>
                            </div>
                            <div class="ui-hyperlink">
                                <a href="<?php echo site_url($link)?>">
                                    <?php echo $row->item_name?>
                                </a>
                            </div>
                            <div class="ui-price"><?php echo $this->global_function->get_price($row->price) ?></div>
                            <div class="ui-quick">
                                <div class="quickview">
                                    <a href="#" class="fa fa-eye"><span>Quick view</span></a>
                                </div>
                                <div class="wishlist">
                                    <a data-id="249" data-name="Apple Watch Sport 42mm Series 2 - Gold - Caramel Nylon Band" data-summary="1" data-price="135000000" data-quantity="1" data-image="1257927614.nv.jpg" class="fa fa-heart my-wishlist-btn"><span>Wish List</span></a>
                                </div>
                                <div class="shoping">
                                    <a data-id="249" data-name="Apple Watch Sport 42mm Series 2 - Gold - Caramel Nylon Band" data-summary="1" data-price="135000000" data-quantity="1" data-image="1257927614.nv.jpg" class="fa fa-shopping-cart my-cart-btn"><span>Add cart</span></a>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-lg-12-->
                    <?php }?>
                </div><!--end col-lg-12-->
            </div>
        </div>
    </div>
</section>