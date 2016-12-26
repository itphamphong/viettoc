<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/19/2016
 * Time: 11:07 AM
 */
if ($item->choose_upload == 1) { ?>
<img  class="<?php echo isset($class)?$class:''?>" src='<?php echo base_url() . "uploads/Images/product/" . $item->picture;?>' <?php if(isset($width) && $width !=0 ) {?> width="<?php echo $width?>" <?php }?> <?php if(isset($height) && $height !=0 ) {?> height="<?php echo $height?>" <?php }?>>

<?php } else if ($item->choose_upload == 2) { ?>
    <img  class="<?php echo isset($class)?$class:''?>" src='<?php echo base_url() . $item->picture;?>' <?php if(isset($width) && $width !=0 ) {?> width="<?php echo $width?>" <?php }?> <?php if(isset($height) && $height !=0 ) {?> height="<?php echo $height?>" <?php }?>>
<?php } else {?>
<i class="<?php echo $item->picture?> <?php echo isset($class)?$class:''?>"></i>
<?php }?>
