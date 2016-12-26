<div class="clear "></div>
<div class="round-article-work">
    <div class="col-center">
        <?php
        $i = 1;
        foreach ($list as $row) {
            if ($i <= 3) {
                ?>
                <div class="article-work">
                    <div class="col-center">
                        <?php if ($row->choose_upload == 1) { ?>
                            <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                        <?php } else if ($row->choose_upload == 2) { ?>
                            <img src="<?php echo base_url() ?><?php echo $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                        <?php } else { ?>
                            <i class="<?php echo $row->picture ?>"></i>
                        <?php } ?>

                    </div>
                    <div class="article-info">
                        <strong><?php echo $i . "." . $row->article_name ?></strong>
                        <p class="sum i-sum-one">
                            <?php echo strip_tags($row->article_description) ?>
                        </p>
                    </div>
                </div>
                <?php
            };
            $i++;
        } ?>
    </div>
    <?php
    $j = 1;
    foreach ($list as $row) {
        if ($j > 3) {
            ?>
            <div class="article-work <?php if ($j > 3 && $j % 2 == 0) echo 'full_left'; else if ($j > 3 && $j % 2 == 1) echo 'full_right' ?>">
                <div class="col-center">
                    <?php if ($row->choose_upload == 1) { ?>
                        <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                    <?php } else if ($row->choose_upload == 2) { ?>
                        <img src="<?php echo base_url() ?><?php echo $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                    <?php } else { ?>
                        <i class="<?php echo $row->picture ?>"></i>
                    <?php } ?>
                    <div class="article-info">
                        <strong><?php echo $row->article_name ?></strong>
                        <p class="sum">
                            <?php echo strip_tags($row->article_description) ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
        };
        $j++;
    } ?>
</div>