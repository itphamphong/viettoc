<?php
$CI =& get_instance();
$CI->load->model('category/a_category');
$list_cate = $CI->a_category->show_list_category_page(array("category_top" => 0, "category_status" => 1), $lang, 0);
?>
<section>
    <div class=" default_width">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <ul class="ui-menu-categories page-menu">
                        <li class="first">DANH MỤC SẢN PHẨM<i class="fa fa-bars"></i></li>
                        <?php foreach ($list_cate as $cate) {
                            if ($cate->choose_upload == 1) {
                                $src = base_url() . "uploads/Images/product/" . $cate->picture;
                            } else if ($cate->choose_upload == 2) {
                                $src = base_url() . $list->picture;
                            }
                            $list_child = $CI->a_category->show_list_category_page(array("category_top" => $cate->id, "category_status" => 1), $lang, 0);
                            ?>
                            <li class="h">
                                <span>
                                    <img src="<?php echo $src ?>">
                                </span>
                                <a href="<?php echo $cate->category_link ?>">
                                    <?php echo $cate->category_name ?><i class="fa fa-angle-right hidden-xs"></i>
                                </a>
                                <?php if (count($list_child)) { ?>
                                    <ul>
                                        <?php foreach ($list_child as $child) {
                                            if ($child->choose_upload == 1) {
                                                $src_child = base_url() . "uploads/Images/product/" . $child->picture;
                                            } else if ($child->choose_upload == 2) {
                                                $src_child = base_url() . $child->picture;
                                            }
                                            ?>
                                            <li>
                                                <span><img src="<?php echo $src_child ?>"></span>
                                                <a href=""><?php echo $child->category_name ?><i class="hidden-xs"></i>
                                                </a>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 hidden-sm hidden-xs">
                    <div class="ui-policy">
                        <a target="_blank" href="#" class="si nth1">Giao toàn Quốc</a>
                        <a target="_blank" href="#" class="si nth2">Miễn phí vận chuyển</a>
                        <a target="_blank" href="#" class="si nth3">Miễn phí cà thẻ VISA, MASTER, ATM</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="content">
    <div class="container">
        <div class="clear h2"></div>
        <div id="col-right" class="col-xs-12 item-detail">

            <div class="col-sm-6 col-xs-12">
                <div class="title"> <?php echo $title?></div>
            <table id="table-cart" class="table">
                <thead>
                <tr>
                    <th>  <?php echo $this->global_function->show_config_language('lang_product', $lang) ?></th>
                    <th>  <?php echo $this->global_function->show_config_language('lang_quantity', $lang) ?></th>
                </tr>
                </thead>
                <tbody id="show-cart-ajax">
                <?php
                $tongtien = 0;
                $soluong = 0;
                $point=0;
                $x = 0;

                foreach ($this->cart->contents() as $row) {
                    $id = $row['id'];
                    $item=$this->a_item->show_detail_item_cart($id,$lang);
                    if(isset($item->id)){
                    $time=TIME;
                    if($item->price!=0){
                        $price=$item->price;
                    }else{
                        $price=$item->value;
                    }
                    $tongtien=$tongtien+($price*$row['qty']);

                    ?>
                    <tr class="even">
                        <td>
                            <?php echo $item->item_name?>
                        </td>
                        <td>
                            <div class="round-cart rquantity" data="cart">
                                <input type="text" value="<?php echo $row['qty']?>" class="quantity"  data-id="<?php echo $row['rowid']?>" data-url="<?php echo site_url('update-cart')?>" data-ajax="<?php echo site_url($lang.'/load-ajax-cart')?>">
                                <i class="fa fa-caret-square-o-up button" data="1" onclick="ButtonQuantity(this)"></i>
                                <i class="fa fa-caret-square-o-down button" data="0" onclick="ButtonQuantity(this)"></i>
                            </div>
                        </td>
                        <td><span style="cursor: pointer"  onclick="DeleteCart(this)" data-id='<?php echo $row['rowid']?>' data-ajax="<?php echo site_url($lang.'/load-ajax-cart')?>" data-url="<?php echo site_url('update-cart')?>")><i class="fa fa-times"></i></span></td>
                    </tr>
                <?php }}?>
                <?php if($this->cart->total_items() >0){?>
                    <tr>
                        <td >

                        </td>
                        <td >


                        </td>
                    </tr>
                <?php }else{?>
                    <tr>
                        <td>
                            <p class="red">
                                <?php echo $this->global_function->show_config_language('lang_empty_cart', $lang) ?>
                            </p>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
                </div>
            <div class="col-sm-6 col-xs-12" id="contact-form">
                <?php
                echo form_error("c-full_name");
                echo form_error("c-phone");
                echo form_error("c-email");
                echo form_error("c-content");
                echo form_error("c-captcha");
                ?>
                <form action="" method="post">
                <div class="title">   <?php echo $this->global_function->show_config_language('lang_info_buyer', $lang) ?></div>
                <div class="commentform-inner">
                    <input id="sender_name" name="c-full_name" type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_full_name', $lang) ?>" value="<?php echo set_value('c-full_name') ?>">
                    <input id="sender_email" name="c-email" type="email" placeholder="Email" value="<?php echo set_value('c-email') ?>">
                    <input class="pull-right" id="letter_subject" name="c-phone" type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_phone', $lang) ?>" value="<?php echo set_value('c-title') ?>">
                </div>
                <textarea id="letter_text" name="c-content" placeholder="<?php echo $this->global_function->show_config_language('lang_notice', $lang) ?>"><?php echo set_value('c-content') ?></textarea>
                    <div class="row">
                        <img src="<?php echo site_url('load-captcha') ?>" alt="" id="img-captcha"/>
                        <input type="text" name="c-captcha" class="text" id="captcha">
                    </div>
                    <input type="submit" value="ok" name="ok" id="btn-submit-cart" style="display: none">
                </form>
            </div>
            <div class="clear"></div>
            <div class="col-xs-6">
                <div class="five columns" style="text-align: right; margin-top: 10px">
                    <a class="i-btn btn-view pull-left" href="<?php echo site_url(site_url())?>">
                        <i class="fa fa-sign-in"></i> <?php echo $this->global_function->show_config_language('lang_continue_buy', $lang) ?>
                    </a>
                </div>
            </div>
            <div class="col-xs-6">
                <?php if($this->cart->total_items() >0){?>
                <div class="five columns" style="text-align: right; margin-top: 10px">
                    <div class="i-btn btn-cart pull-right" href="<?php echo site_url($lang."/checkout")?>" onclick="$('#btn-submit-cart').trigger('click')">
                        <i class="fa fa-sign-in"></i> <?php echo $this->global_function->show_config_language('lang_checkout', $lang) ?>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<div style="clear: both; height: 10px"></div>
