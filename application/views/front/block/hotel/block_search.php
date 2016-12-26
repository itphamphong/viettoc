<?php if(isset($page) && $page=='list'){?>
    <div id="round-search" class="col-xs-12">
        <div class="i-city s-col col_full">
            <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_city',$lang)?></p>
            <div id="i-select-city">
                <?php
                $params=array(
                    "select"=>'location_name,location.id',
                    'where'=>array('location.status'=>1,"location.parent_id"=>0,'type'=>1),
                    'lang'=>$lang,
                    'table'=>'location',
                    'table_detail'=>'locationdetail',
                    'order'=>'location_name',
                    'join_where'=>'location.id=locationdetail.location_id',
                    'modules'=>2


                );
                $list_location=$this->global_function->get_list_table_where_location_in($params);?>

                <select name="city_id">
                    <option value="0"><?php echo $this->global_function->show_config_language('lang_choose_city',$lang)?></option>
                    <?php foreach($list_location as $location){?>
                        <option value="<?php echo $location->id?>"><?php echo $location->location_name?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="i-city s-col  col_full">
            <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_name_hotel',$lang)?></p>
            <input id="key-name" type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_search_name_hotel',$lang)?>..." class="col_full" name="hotel_name">
        </div>
        <div class="s-col col_full">
            <p class="title-select"><?php echo $this->global_function->show_config_language('lang_check_out_date',$lang)?></p>

            <div class="r-date col_full">
                <i class="fa fa-calendar-plus-o"></i>
                <input class="date col-xs-10" type="text" id="date-one" placeholder="<?php echo $this->global_function->show_config_language('lang_choose_date',$lang)?>" name="date-one">
            </div>
        </div>
        <div class="s-col form-group col_full">
            <p class="title-select"><?php echo $this->global_function->show_config_language('lang_check_out_date',$lang)?></p>
            <div class="r-date col_full">

                <i class="fa fa-calendar-minus-o "></i><input class="date col-xs-10" id="date-two" type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_choose_date',$lang)?>" name="date-two">
            </div>
        </div>
        <div class="s-col form-group col_full text-center">
            <div id="btn-submit-search" class="btn-submit-search-page" onclick="FormSearch('<?php echo site_url($lang."/search/".$location_link)?>')">
                <?php echo $this->global_function->show_config_language('lang_search',$lang)?>
            </div>
        </div>
    </div>
<?php }else if(isset($page) && $page=='detail'){?>
    <form action="" method="post" id="form-search-home">
        <div id="round-search" class="col-xs-12">
            <div class="i-city s-col col_full">
                <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_city', $lang) ?></p>

                <div id="i-select-city">
                    <?php
                    $params = array(
                        "select" => 'location_name,location.id,location_link',
                        'where' => array('location.status' => 1, "location.parent_id" => 0,'type'=>1),
                        'lang' => $lang,
                        'table' => 'location',
                        'table_detail' => 'locationdetail',
                        'order' => 'location_name',
                        'join_where' => 'location.id=locationdetail.location_id',
                        'modules'=>2


                    );
                    $list_location = $this->global_function->get_list_table_where_location_in($params); ?>

                    <select name="city_id">
                        <?php foreach ($list_location as $location) { ?>
                            <option value="<?php echo $location->id ?>" data-url="<?php echo $location->location_link ?>"><?php echo $location->location_name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="i-city s-col  col_full">
                <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_name_hotel', $lang) ?></p>
                <input id="key-name" type="text" placeholder="<?php echo $this->global_function->show_config_language('lang_search_name_hotel', $lang) ?>..." class="col_full"
                       name="hotel_name">
            </div>
            <div class="s-col col_full">
                <p class="title-select"><?php echo $this->global_function->show_config_language('lang_check_out_date', $lang) ?></p>

                <div class="r-date col_full">
                    <i class="fa fa-calendar-plus-o"></i>
                    <input class="date col-xs-10" type="text" id="date-one" placeholder="<?php echo $this->global_function->show_config_language('lang_choose_date', $lang) ?>"
                           name="date-one">
                </div>
            </div>
            <div class="s-col form-group col_full">
                <p class="title-select"><?php echo $this->global_function->show_config_language('lang_check_out_date', $lang) ?></p>

                <div class="r-date col_full">

                    <i class="fa fa-calendar-minus-o "></i><input class="date col-xs-10" id="date-two" type="text"
                                                                  placeholder="<?php echo $this->global_function->show_config_language('lang_choose_date', $lang) ?>" name="date-two">
                </div>
            </div>
            <div class="s-col form-group col_full text-center">
                <div id="btn-submit-search" class="btn-submit-search-page"
                     data-url="<?php echo base_url($lang . "/" . $this->global_function->show_config_language('lang_hotel', $lang, 'url') . "/" . $this->global_function->show_config_language('lang_hotel_at', $lang, 'url') . "-") ?>"
                     onclick="FormSearchHome(this)">
                    <?php echo $this->global_function->show_config_language('lang_search', $lang) ?>
                </div>
            </div>
        </div>
    </form>
<?php }else{?>
<div class="col-xs-12">
    <div class="col-center">
        <div class="col_full relative">
            <form action="" method="post" id="form-search-home">
            <div id="round-search" class="round-search-home">
                <div class="i-city s-col col-xs-12 col-md-3 lpad0 lmleft10">
                    <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_city', $lang) ?></p>

                    <div id="i-select-city">
                        <?php
                        $params = array(
                            "select" => 'location_name,location.id,location_link',
                            'where' => array('location.status' => 1, "location.parent_id" => 0,'type'=>1),
                            'lang' => $lang,
                            'table' => 'location',
                            'table_detail' => 'locationdetail',
                            'order' => 'location_name',
                            'join_where' => 'location.id=locationdetail.location_id',
                            'modules'=>2


                        );
                        $list_location = $this->global_function->get_list_table_where_location_in($params); ?>

                        <select name="city_id">
                          <option value="0" data-url="0" data-name="<?php echo $this->global_function->show_config_language('lang_chose_city_please',$lang)?>"><?php echo $this->global_function->show_config_language('lang_choose_city',$lang)?></option>
                            <?php foreach ($list_location as $location) { ?>
                                <option  value="<?php echo $location->id ?>" data-url="<?php echo $location->location_link ?>"><?php echo $location->location_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="i-city s-col col-xs-12 col-md-3 lpad0 lmleft10 relative">
                    <p class="title-select"><?php echo $this->global_function->show_config_language('lang_search_name_hotel', $lang) ?></p>
                    <input  name="hotel_name" id="key-name" type="text"  data-autocomplete-method="POST"  data-autocomplete-param-name="hotel_name"
    data-autocomplete-no-result="Regex no matched" data-autocomplete-type="HTML" data-autocomplete="<?php echo site_url($lang."/load-ajax-name")?>" placeholder="<?php echo $this->global_function->show_config_language('lang_search_name_hotel', $lang) ?>..." class="col_full">

                </div>
                <div class="s-col col-xs-12 lpad0  col-md-2  lmleft10">
                    <p class="title-select"><?php echo $this->global_function->show_config_language('lang_check_out_date', $lang) ?></p>

                    <div class="r-date col_full">
                        <i class="fa fa-calendar-plus-o"></i>
                        <input class="date" type="text" id="date-one" placeholder="<?php echo $this->global_function->show_config_language('lang_choose_date', $lang) ?>" name="date-one">
                    </div>
                </div>
                <div class="s-col col-xs-12 lpad0 col-md-2 lmleft10">
                    <p class="title-select"><?php echo $this->global_function->show_config_language('lang_check_out_date', $lang) ?></p>

                    <div class="r-date col_full">

                        <i class="fa fa-calendar-minus-o"></i><input class="date" id="date-two" type="text"
                                                                     placeholder="<?php echo $this->global_function->show_config_language('lang_choose_date', $lang) ?>" name="date-two">
                    </div>
                </div>
                <div class="s-col col-xs-12 lpad0 col-md-1 text-center">
                    <div id="btn-submit-search" data-url="<?php echo base_url($lang."/".$this->global_function->show_config_language('lang_hotel',$lang,'url')."/".$this->global_function->show_config_language('lang_hotel_at',$lang,'url')."-")?>" onclick="FormSearchHome(this)"><?php echo $this->global_function->show_config_language('lang_search', $lang) ?></div>
                </div>
            </div>
                </form>
        </div>
    </div>
</div>
</div>
<?php }?>