<div id="round-take-lession">
    <div class="col-center">
        <p class="title-home">
            <?php echo $this->global_function->show_config_language('lang_why_take_lessons', $lang) ?>
        </p>
        <ul class="i-take">
            <?php
            $i=1;
            foreach ($list as $row) { ?>
            <li>
                <?php if ($row->choose_upload == 1) { ?>
                    <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>" alt="<?php echo $row->alt_picture?>"/>
                <?php } else if ($row->choose_upload == 2) { ?>
                    <img src="<?php echo base_url() ?><?php echo $row->picture ?>" alt="<?php echo $row->alt_picture?>"/>
                <?php } else { ?>
                    <i class="<?php echo $row->picture ?>" ></i>
                <?php } ?>
                <div class="clear hg1"></div>
                <strong><?php echo $row->article_name?></strong>
                <p class="sum">
                    <?php echo strip_tags($row->article_description) ?>
                </p>
            </li>
          <?php }?>
        </ul>
    </div>
</div>