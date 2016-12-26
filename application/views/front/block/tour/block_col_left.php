<?php
$params = array(
    "select" => 'location_name,location.id',
    'where' => array('location.status' => 1, "location.id" => $location_id),
    'lang' => $lang,
    'table' => 'location',
    'table_detail' => 'locationdetail',
    'order' => 'location.weight',
    'join_where' => 'location.id=locationdetail.location_id',
    'first' => 'yes'
);
$location = $this->global_function->get_list_table_where($params); ?>
<?php if(isset($page) && $page=='detail'){?>
<div id="col-right" class="fleft">
    <div class="round-title"> <?php echo $this->global_function->show_config_language('lang_search_tour', $lang) . " " ?></div>
    <div class="clear hg1"></div>
    <div class="content-page">
        <form action="" method="post" id="form-search-home">
            <div id="round-search" class="col-xs-12">
                <div class="i-city s-col col_full">
                    <p class="title-select"><?php echo $this->global_function->show_config_language('lang_departure', $lang) ?></p>

                    <div id="i-select-city">
                        <?php
                        $params = array(
                            "select" => 'location_name,location.id,location_link',
                            'where' => array('location.status' => 1, "location.parent_id" => 0),
                            'lang' => $lang,
                            'table' => 'location',
                            'table_detail' => 'locationdetail',
                            'order' => 'location.weight',
                            'join_where' => 'location.id=locationdetail.location_id',
                            'modules'=>3


                        );
                        $list_location = $this->global_function->get_list_table_where_location_in($params); ?>

                        <select name="departure" id="departure_id">
                           <option value="0" data-url="0"><?php echo $this->global_function->show_config_language('lang_choose_city',$lang)?></option>

                            <?php foreach ($list_location as $location) { ?>
                                <option value="<?php echo $location->id ?>" data-url="<?php echo $location->location_link ?>"><?php echo $location->location_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="i-city s-col col_full">
                    <p class="title-select"><?php echo $this->global_function->show_config_language('lang_destination', $lang) ?></p>

                    <div id="i-select-city">
                        <?php
                        $params = array(
                            "select" => 'location_name,location.id,location_link',
                            'where' => array('location.status' => 1, "location.parent_id" => 0),
                            'lang' => $lang,
                            'table' => 'location',
                            'table_detail' => 'locationdetail',
                            'order' => 'location.weight',
                            'join_where' => 'location.id=locationdetail.location_id',
                            'modules'=>3


                        );
                        $list_location = $this->global_function->get_list_table_where_location_in($params); ?>

                        <select name="destination">
                           <option value="0"><?php echo $this->global_function->show_config_language('lang_choose_city',$lang)?></option>

                            <?php foreach ($list_location as $location) { ?>
                                <option value="<?php echo $location->id ?>" data-url="<?php echo $location->location_link ?>"><?php echo $location->location_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="clear hg1"></div>
                <div class="s-col form-group col_full text-center">
                    <div id="btn-submit-search" class="btn-submit-search-page"onclick="FormSearchTourDetail(this)" data-url="<?php echo base_url($lang."/tour")?>">
                        <?php echo $this->global_function->show_config_language('lang_search', $lang) ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="clear hg1"></div>
    <div class="box-search-left fleft col_full">
        <div class="title-box fleft col_full"> <?php echo $this->global_function->show_config_language('lang_other_tour', $lang)." ".$location->location_name ?></div>
        <div style="clear: both"></div>
        <ul class="checkbox list-other-tour">
            <?php
            foreach ($tour_other as $tour) {
                ?>
                <li class="col-xs-12">
                    <a class="o-title col_full" href="<?php echo site_url($lang . "/tour/" . $tour->tour_link) ?>">
                        <?php echo $tour->tour_name ?>
                    </a>

                    <p class="o-price col_full">
                        <?php echo $this->global_function->show_config_language('lang_value', $lang) . ": " ?>
                        <strong><?php echo $this->global_function->get_price($tour->price) ?></strong>
                    </p>
                </li>
                <div class="clear"></div>
            <?php } ?>


        </ul>
    </div>
    <div class="clear hg1"></div>
    <div class="round-title"> <?php echo $this->global_function->show_config_language('lang_place', $lang) . " " ?><?php echo $location->location_name ?></div>
    <?php echo modules::run('article/article/BlockPlace', $lang, $location_id, $location->location_name); ?>
    <div class="clear hg1"></div>
    <?php echo modules::run('support/support/Block_Support', $lang); ?>

    <div class="clear hg4"></div>
    <?php $this->load->view('front/block/block_email_letter') ?>
    <div class="clear hg4"></div>
    <?php $this->load->view('front/block/block_comment') ?>
    <div class="clear hg1"></div>
    <div class="block-why-left">
        <?php $this->load->view('front/block/block_why') ?>
    </div>
    <div class="clear hg1"></div>
    <?php echo modules::run('tags/tags/BlockAll', $lang); ?>
</div>
<?php }else{?>
    <div id="col-right" class="fleft">
        <form action="" method="post" id="form-left">
        <div class="round-title"> <?php echo $this->global_function->show_config_language('lang_search_tour', $lang) . " " ?></div>

        <div class="clear hg1"></div>
        <div class="box-search-left fleft col_full">
            <div class="title-box fleft col_full"><?php echo $this->global_function->show_config_language('lang_price_from', $lang) ?></div>
            <div style="clear: both"></div>
            <ul class="radiobox">
                <li><input onclick="FormSearch('<?php echo site_url($lang . "/tour/" . $location_link) ?>')" type="radio" id="price1" name="price" value="1"><label
                        for="price1">Dưới 500,000</label></li>
                <li><input onclick="FormSearch('<?php echo site_url($lang . "/tour/" . $location_link) ?>')" type="radio" id="price2" name="price" value="2"><label
                        for="price2">500,000 - 1,000,000</label></li>
                <li><input onclick="FormSearch('<?php echo site_url($lang . "/tour/" . $location_link) ?>')" type="radio" id="price3" name="price" value="3"><label
                        for="price3">1,000,000 - 1,500,000</label></li>
                <li><input onclick="FormSearch('<?php echo site_url($lang . "/tour/" . $location_link) ?>')" type="radio" id="price4" name="price" value="4"><label
                        for="price4">1,500,000 - 2,000,000</label>
                <li><input onclick="FormSearch('<?php echo site_url($lang . "/tour/" . $location_link) ?>')" type="radio" id="price5" name="price" value="5"><label
                        for="price5">2,000,000 - 2,500,000</label>
                <li><input onclick="FormSearch('<?php echo site_url($lang . "/tour/" . $location_link) ?>')" type="radio" id="price6" name="price" value="6"><label
                        for="price6">2,500,000 - 3,000,000</label>
                <li><input onclick="FormSearch('<?php echo site_url($lang . "/tour/" . $location_link) ?>')" type="radio" id="price7" name="price" value="7"><label
                        for="price7">Trên 3,000,000 </label>
            </ul>
        </div>
        <div class="round-title"> <?php echo $this->global_function->show_config_language('lang_place', $lang) . " " ?><?php echo $location->location_name ?></div>
        <?php echo modules::run('article/article/BlockPlace', $lang, $location_id, $location->location_name); ?>
        <div class="clear hg1"></div>
        <?php echo modules::run('support/support/Block_Support', $lang); ?>

        <div class="clear hg4"></div>
        <?php $this->load->view('front/block/block_email_letter') ?>
        <div class="clear hg4"></div>
        <?php $this->load->view('front/block/block_comment') ?>
        <div class="clear hg1"></div>
        <div class="block-why-left">
            <?php $this->load->view('front/block/block_why') ?>
        </div>
        <div class="clear hg1"></div>
        <?php echo modules::run('tags/tags/BlockAll', $lang); ?>
    </div>
 </form>
<?php }?>
