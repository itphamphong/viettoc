<?php
$x = 1;
foreach ($banner as $b) {
    ?>
    <a href="<?php echo $b->images_link?>" target="_blank"><img src="<?php echo base_url() ?>uploads/quang-cao/<?php echo $b->name ?>" class="row-banner" alt="<?php echo $b->images_name?>"></a>
    <?php $x++;
} ?>