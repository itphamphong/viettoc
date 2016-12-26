<div class="col-xs-12">
    <div class="col-center">
        <div class="col_full relative">
            <form action="<?php if(isset($location->id)) echo site_url($lang."/tour/".$location->location_link)?>" method="post" id="form-search-tour-home">
                <div id="round-search" class="round-search-home tour-round-search">
                    <div class="i-city s-col col-xs-12 col-md-6 lpad0 lmleft10">
                        <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_city', $lang) ?></p>

                        <ul id="i-select-city-tour">
                            <?php
                            $params = array(
                                "select" => 'location_name,location.id,location_link',
                                'where' => array('location.status' => 1, "location.hot_tour" => 1),
                                'lang' => $lang,
                                'table' => 'location',
                                'table_detail' => 'locationdetail',
                                'order' => 'location.weight',
                                'join_where' => 'location.id=locationdetail.location_id',
                                'limit'=>4,
                                'offset'=>0,
                                'modules'=>3


                            );
                            $list_location = $this->global_function->get_list_table_where_location_in($params); ?>
                            <?php
                            $x=0;
                            foreach ($list_location as $lo) { ?>
                            <li class="<?php if($x==0) echo 'active'?>">
                                <input  class="hide" type="radio" name="location_tour_id" id="<?php echo "location_tour-".$lo->id?>" <?php if(isset($location->id) && $location->id==$lo->id) echo 'checked'?> >
                                <label for="<?php echo "location_tour-".$lo->id?>" onclick="ChangeFormTour('<?php echo site_url($lang."/tour/".$lo->location_link)?>')"><?php echo $lo->location_name ?></label>

                            </li>
                            <?php $x++;}?>
                        </ul>
                    </div>
                    <div class="i-city s-col col-xs-12 col-md-4 lpad0 lmleft10 relative">
                        <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_name', $lang) ?></p>
                        <input name="tour_name" id="key-name" data-autocomplete-method="POST"  data-autocomplete-param-name="hotel_name"
                               data-autocomplete-no-result="Regex no matched" data-autocomplete-type="HTML" data-autocomplete="<?php echo site_url($lang."/load-tour-ajax-name")?>" type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_search_name', $lang) ?>..." class="col_full">
                    </div>
                    <div class="s-col col-xs-12 lpad0 col-md-1 text-center">
                        <div  class="btn-tour-home" id="btn-submit-search" onclick="$('#form-search-tour-home').submit()"><?php echo $this->global_function->show_config_language('lang_search', $lang) ?></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>