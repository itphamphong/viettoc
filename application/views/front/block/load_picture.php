
<?php
if(isset($width) && isset($height) && isset($thumb) && $thumb==1) {
    $src = base_url() . 'timthumb.php?src=' . base_url() . 'uploads/Images/' . $folder . '/' . $item->picture . '&amp;h=' . $width . '&amp;w=' . $height . '&amp;zc=1';
}else{
    $src=base_url() . "uploads/Images/" . $folder . "/" . $item->picture;
}
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/19/2016
 * Time: 11:07 AM
 */
if ($item->choose_upload == 1 || $item->choose_upload == 4) { ?>
    <img alt="<?php echo $item->alt_picture ?>" class="<?php echo isset($class) ? $class : '' ?>"
         src='<?php echo $src?>' <?php if (isset($width) && $width != 0) { ?> width="<?php echo $width ?>" <?php } ?> <?php if (isset($height) && $height != 0) { ?> height="<?php echo $height ?>" <?php } ?> >

<?php } else if ($item->choose_upload == 2) { ?>
    <img alt="<?php echo $item->alt_picture ?>" class="<?php echo isset($class) ? $class : '' ?>"
         src='<?php echo base_url() . $item->picture; ?>' <?php if (isset($width) && $width != 0) { ?> width="<?php echo $width ?>" <?php } ?> <?php if (isset($height) && $height != 0) { ?> height="<?php echo $height ?>" <?php } ?> >
<?php } else { ?>
    <i class="<?php echo $item->picture ?> <?php echo isset($class) ? $class : '' ?>"></i>
<?php } ?>
