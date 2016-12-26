<?php
$x = 1;
foreach ($banner as $b) {
    ?>
    <div class="col-ready <?php if ($x == 2) echo 'right' ?>">
        <p class="title"><?php echo $b->images_name ?></p>
        <a href="<?php echo $b->images_link ?>" target="_blank"><img src="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>"
                                                                     alt="<?php echo $b->images_name ?>"></a>
    </div>
    <?php $x++;
} ?>