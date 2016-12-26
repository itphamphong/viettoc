<div id="banner-top">
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
    <div class="info-banner">
        <div class="col-center">
            <div class="col-select-topic">
                    <ul class="tab-topic">
                        <?php foreach ($browse_lession as $brows) {
                            ?>
                            <li data-id="<?php echo $brows->id ?>"><?php echo $brows->browse_lession_name ?></li>
                        <?php } ?>
                    </ul>

                <div id="content-1" class="content mCustomScrollbar">
                    <?php
                    $x = 0;
                    foreach ($browse_lession as $brows) {
                        $child = $this->m_browse_lession->show_list_browse_lession_where(array("browse_lession.browse_lession_type" => 1, "browse_lession.browse_lession_top" => $brows->id));
                        ?>
                        <ul class="content-topic" id="content-topic-<?php echo $brows->id ?>" <?php if ($x == 0) echo 'style="display: block"' ?> >
                            <?php
                            foreach ($child as $c) {
                                ?>
                                <li data-id="<?php echo $c->id ?>" onclick="ChosseTopic(this)"><i class="fa fa-angle-double-right"></i><?php echo $c->browse_lession_name ?></li>
                            <?php } ?>

                        </ul>
                        <?php $x++;
                    } ?>
                </div>
                <div id="close-col-select-topic" onclick="$('.col-select-topic').hide()"><i class="fa fa-close"></i></div>
            </div>
            <p class="text-note one">What would you like to learn today?
            <p>
            <p class="text-note two"> Search for thousands of teachers for local and online lessons</p>

            <div id="form-search-top">
                <div class="tab-title"></div>
                <div class="input-text"><i class="fa fa-edit "></i><input type="text" id="select-topic" class="input-text-form"  placeholder="Select Topic" onclick="ShowTopic()"></div>
                <div class="input-text"><i class="fa  fa-map-marker "></i>
                    <input type="text" id="select-area" class="input-text-form" placeholder="Select Area" onclick="$('#show-lession-city').show()">
                    <div id="show-lession-city">
                        <div id="content-2" class="content mCustomScrollbar">
                        <?php foreach ($this->m_location->show_list_location_where(array("parent_id" =>0, "location.status" => 1), 1, 1, $lang, 0) as $c1) {
                            ?>
                            <div class="i-location" onclick="ChosseArea(this)" data-value="<?php echo $c1->id?>" data-child="0"><?php echo $c1->name?></div>
                        <?php foreach ($this->m_location->show_list_location_where(array("parent_id" =>$c1->id, "location.status" => 1), 1, 1, $lang, 0) as $c2) {
                            ?>
                                <div class="i-location" onclick="ChosseArea(this)"  data-child="1" data-value="<?php echo $c2->id?>"><i class="fa fa-angle-right"></i><?php echo $c2->name?></div>
                                <?php foreach ($this->m_location->show_list_location_where(array("parent_id" =>$c2->id, "location.status" => 1), 1, 1, $lang, 0) as $c3) {
                                    ?>
                                    <div class="i-location" onclick="ChosseArea(this)" data-child="2" data-value="<?php echo $c3->id?>"><i class="fa fa-angle-double-right"></i><?php echo $c3->name?></div>
                                <?php }?>
                            <?php }?>
                        <?php }?>
                            </div>
                    </div>
                </div>
                <form action="<?php echo site_url($lang."/get-answer")?>" method="post" id="fget-answer">
                <div class="i-btn btn-get-answer" onclick="$('#fget-answer').submit()">GET ANSWER</div>
                <input type="hidden" name="select-topic" id="hidden-select-topic" value="0">
                <input type="hidden" name="select-area" id="hidden-select-area" value="0">
                <input type="hidden" name="child" id="hidden-child" value="0">
                </form>
            </div>
            <div id="round-i-block">
                <div class="i-block">
                    <p><i class="fa  fa-asterisk"></i><strong>Become a Tutor</strong>
                    <p>
                    <p>Get one day trial access to entire 1 million Q&A For 9.99$</p>
                </div>
                <div class="i-block">
                    <p><i class="fa  fa-align-justify "></i><strong>Become a Tutor</strong>
                    <p>
                    <p>Get one day trial access to entire 1 million Q&A For 9.99$</p>
                </div>
            </div>
            <div class="clear hg1"></div>
            <div class="i-icon-store">
                <a href="#"><img src="<?php echo base_url() ?>themes/front/images/app.png"></a>
                <a href="#"><img src="<?php echo base_url() ?>themes/front/images/google.png"></a>
            </div>
        </div>
    </div>
</div>
