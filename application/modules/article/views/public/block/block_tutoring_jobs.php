<div id="round-how-it-work" class="round-tutoring-job">
    <div class="col-center">
        <p class="title-home"><?php echo $this->global_function->show_config_language('lang_tutoring_jobs_on_your_terms', $lang) ?></p>
        <ul>
            <?php
            $x = 0;
            $i = 1;

                foreach ($list as $row) {
                    if ($x < 4) {
                    ?>
                    <li class="i-work">
                        <?php if ($row->choose_upload == 1) { ?>
                            <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                        <?php } else if ($row->choose_upload == 2) { ?>
                            <img src="<?php echo base_url() ?><?php echo $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                        <?php } else { ?>
                            <i class="<?php echo $row->picture ?>"></i>
                        <?php } ?>
                        <p class="title"><?php echo $i ?>. <?php echo $row->article_name ?></p>
                        <div class="sum">
                            <?php echo strip_tags($row->article_description) ?>
                        </div>

                    </li>
                    <?php $i++;
                } ?>
            <?php $x++;} ?>
        </ul>
    </div>
</div>
<div class="round-online-tutoring-jobs ">
    <div class="col-center">
        <?php
        $x = 0;
        $i = 1;

            foreach ($list as $row) {
                if ($x == 4) {
                ?>
                <p class="title-home"><?php echo $row->article_name ?> </p>
                <div class="col-1">
                    <?php echo $row->article_summary ?>
                </div>
                <div class="col-2">
                    <?php if ($row->choose_upload == 1) { ?>
                        <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                    <?php } else if ($row->choose_upload == 2) { ?>
                        <img src="<?php echo base_url() ?><?php echo $row->picture ?>" alt="<?php echo $row->alt_picture ?>"/>
                    <?php } else { ?>
                        <i class="<?php echo $row->picture ?>"></i>
                    <?php } ?>
                </div>
                <div class="col-3">
                    <?php echo $row->article_description ?>
                </div>
            <?php };
            $x++;
        } ?>
    </div>
</div>