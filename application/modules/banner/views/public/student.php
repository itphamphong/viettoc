<div id="banner-top" class="banner-page">
    <div class="fluid_container">
        <div class="camera_wrap camera_emboss pattern_1" id="camera_wrap_4">
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
    <div class="info-banner for-student">
        <div class="col-center">
            <form action="<?php echo site_url($lang.'/get-tutoring-info-now')?>" method="post" id="form-get-tutoring-info">
            <div id="form-search-top" class="get-tutoring-info-now">
                <div class="tab-title"><?php echo $this->global_function->show_config_language('lang_get_tutoring_info_now', $lang) ?></div>
                <div class="input-text"><i class="fa fa-edit "></i><input type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_subject', $lang) ?>" name="subject"></div>
                <div class="input-text"><i class="fa  fa-user"></i><input type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_full_name', $lang) ?>" name="full_name"></div>
                <div class="input-text"><i class="fa fa-envelope"></i><input type="text" placeholder="Email"></div>
                <div class="input-text"><i class="fa fa-phone"></i><input type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_phone', $lang) ?>" name="phone"></div>
                <div class="input-text"><i class="fa fa-map-marker"></i><input type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_zip_code', $lang) ?>" name="zip-code"></div>
                <div class="input-text area-text"><i class="fa fa-adn "></i><textarea ></textarea></div>
                <div class="i-btn btn-get-answer" onclick="$('#form-get-tutoring-info').submit()">
                    <?php echo $this->global_function->show_config_language('lang_request_tutor_info', $lang) ?>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
