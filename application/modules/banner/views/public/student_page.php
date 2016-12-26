<div id="banner-top" class="banner-tutor">
    <div class="fluid_container">
        <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_3">
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
            <p class="text-note one">
                <?php echo $this->global_function->show_config_language('lang_banner_student_text_one', $lang) ?>
            <p>
            <p class="text-note"> <?php echo $this->global_function->show_config_language('lang_banner_student_text_two', $lang) ?><p>
            <a class="i-btn btn-become" href="<?php echo site_url($lang."/find-tutor")?>"><?php echo $this->global_function->show_config_language('lang_find_a_tutor', $lang) ?></a>
            <div class="clear"></div>
            <p class="text-small"><?php echo $this->global_function->show_config_language('lang_banner_student_text_three', $lang) ?></p>
        </div>
    </div>
    <div class="bottom-banner">
        <div class="col-center">
            <?php echo $this->global_function->show_config_language('lang_how_it_work_for_student_partner', $lang) ?>
        </div>

    </div>
</div>