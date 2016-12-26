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