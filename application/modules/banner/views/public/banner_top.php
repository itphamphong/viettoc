<div class="ui-slide"> <!-- banner -->
    <div id="owl-demo" class="owl-carousel owl-theme">
        <?php
        $x = 1;
        foreach ($banner as $b) {
        ?>
        <div class="item">
            <img src="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>">
        </div>
        <?php }?>
    </div>
</div>