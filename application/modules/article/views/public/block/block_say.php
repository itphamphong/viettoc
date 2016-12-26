<div id="round-say-about">
    <div class="col-center">
        <p class="title-home">
            <?php echo $this->global_function->show_config_language('lang_what_students_say', $lang) ?>
        </p>
        <ul class="i-say">
            <?php
            $i = 1;
            foreach ($list as $row) { ?>
                <li class="say-<?php echo $i ?>">
                    <p class="i-note">
                        <?php echo strip_tags($row->article_description) ?>
                        <i class="i-arrow"><img src="<?php echo base_url() ?>themes/front/images/i-arow-<?php echo $i ?>.png"></i>
                    </p>
                    <div class="info-user">
                        <span class="avatar">
                            <?php if ($row->choose_upload == 1) { ?>
                                <img src="<?php echo base_url() ?>uploads/Images/<?php echo "/article/" . $row->picture ?>"
                                     onerror="this.src='<?php echo base_url() ?>themes/back/images/text.png';" alt=""/>
                            <?php } else if ($row->choose_upload == 2) { ?>
                                <img src="<?php echo base_url() ?><?php echo $row->picture ?>" onerror="this.src='<?php echo base_url() ?>themes/back/images/text.png';" alt=""/>
                            <?php } else { ?>
                                <i class="<?php echo $row->picture ?>"></i>
                            <?php } ?>
                        </span>
                        <span class="i-info">
                           <strong><?php echo $row->article_name ?></strong><br>
                            <?php echo $row->article_summary ?>
                        </span>
                    </div>
                </li>
                <?php $i++;
            } ?>
        </ul>
    </div>
</div>