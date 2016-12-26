<div id="banner-top" class="banner-tutor">
    <div class="fluid_container">
        <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_2">
            <?php
            $x = 1;
            foreach ($banner as $b) {
                if (count($banner) == 1) {
                    ?>
                    <div data-thumb="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>"
                         data-src="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>">
                    </div>
                    <div data-thumb="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>"
                         data-src="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>">
                    </div>
                <?php } else {
                    ?>
                    <div data-thumb="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>"
                         data-src="<?php echo base_url() ?>uploads/Images/quang-cao/<?php echo $b->name ?>">
                    </div>
                <?php }
            } ?>
        </div>

    </div><!-- .fluid_container -->
    <div class="info-banner">
        <div class="col-center">
            <p class="text-note one"><?php echo $this->global_function->show_config_language('lang_online_tutoring_jobs', $lang) ?><p>
            <p class="text-note"><?php echo $this->global_function->show_config_language('lang_start_tutoring_online_with_find_tutors', $lang) ?><p>
            <p class="text-note"><strong><?php echo $this->global_function->show_config_language('lang_top_tutors_can_earn', $lang) ?></strong><p>
            <div class="i-btn btn-become"><?php echo $this->global_function->show_config_language('lang_became_a_tutor', $lang) ?></div>
            <div class="clear"></div>
            <p class="text-small"><?php echo $this->global_function->show_config_language('lang_banner_student_text_three', $lang) ?></p>
        </div>
    </div>
</div>