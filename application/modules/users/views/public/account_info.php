<div class="col-center" id="tutor-singin">
    <div class="clear hg1"></div>
    <ul id="nav-breadcrumb">
        <li><a href="<?php echo site_url() ?>">  <?php echo $this->global_function->show_config_language('lang_home', $lang) ?></a><i class="fa fa-angle-right "></i></li>
        <li>
            <a class="last">
                <?php echo $this->global_function->show_config_language('lang_account_manager', $lang) ?>
            </a>
        </li>

    </ul>
    <div class="clear hg1"></div>
    <form action="" method="post" id="f-myinfo" enctype="multipart/form-data">
        <div id="form-signin-location">
            <div class="users-col-left">
                <?php $this->load->view('users/public/block_col_left', array('user' => $user, 'left_active' => 'my-info')) ?>
            </div>
            <div class="users-col-right">
                <?php if (!empty($msg)) { ?>
                    <div class="bg-success"><?php echo $msg ?></div>
                <?php } ?>
                <p class="title">
                    <?php echo $this->global_function->show_config_language('lang_change_your_infomation', $lang) ?>
                </p>
                <div class="clear hg1"></div>
                <div class="round-input">
                    <span><i class="fa fa-user"></i></span>
                    <input type="text" name="full_name" value="<?php echo $user->full_name ?>"
                           placeholder="<?php echo $this->global_function->show_config_language('lang_full_name', $lang) ?>">
                </div>
                <div class="round-input fright">
                    <span><i class="fa  fa-phone"></i></span>
                    <input type="text" name="phone" value="<?php echo $user->cell_phone ?>"
                           placeholder="<?php echo $this->global_function->show_config_language('lang_phone', $lang) ?>">
                </div>
                <p><?php echo form_error('full_name') ?><?php echo form_error('phone') ?></p>
                <div class="round-input">
                    <span><i class="fa  fa-envelope-o"></i></span>
                    <input type="text" name="email" value="<?php echo $user->email ?>" placeholder="Email">
                </div>
                <p><?php echo form_error('email') ?></p>
                <div class="round-input fright">
                    <span><i class="fa fa-calendar-minus-o"></i></span>
                    <input type="text" name="age" value="<?php echo $user->age ?>" placeholder="<?php echo $this->global_function->show_config_language('lang_age', $lang) ?>">
                </div>
                <div class="round-input col_full">
                    <span><i class="fa  fa-map-marker"></i></span>
                    <input type="text" name="address" value="<?php echo $user->address ?>"
                           placeholder="<?php echo $this->global_function->show_config_language('lang_address', $lang) ?>">
                </div>
                <div class="clear hg1"></div>
                <div class="round-input input-sec">
                    <span><i class="fa  fa-map-marker"></i></span>
                    <select class="input-text select-input" id="country" name="country_id" onchange="LoadCity(this)" data-child='0'
                            data-url="<?php echo site_url($lang . "/load-location") ?>">
                        <option value="0">---<?php echo $this->global_function->show_config_language('lang_country', $lang) ?>---</option>
                        <?php foreach ($this->m_location->show_list_location_where(array("parent_id" => 0, "location.status" => 1), 1, 1, $lang, 0) as $c1) {
                            ?>
                            <option <?php if($user->country_id==$c1->id) echo 'selected'?>  value="<?php echo $c1->id ?>"><?php echo $c1->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="round-input input-sec">
                    <span><i class="fa  fa-map-marker"></i></span>
                    <select class="input-text select-input"  id="city_id" name="city_id" onchange="LoadCity(this)" data-child='1'
                            data-url="<?php echo site_url($lang . "/load-location") ?>">
                        <option value="0">---<?php echo $this->global_function->show_config_language('lang_city', $lang) ?>---</option>
                        <?php foreach ($this->m_location->show_list_location_where(array("parent_id" => $user->country_id, "location.status" => 1), 1, 1, $lang, 0) as $c2) {
                            ?>
                            <option <?php if($user->city_id==$c2->id) echo 'selected'?> value="<?php echo $c2->id ?>"><?php echo $c2->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="round-input input-sec">
                    <span><i class="fa  fa-map-marker"></i></span>
                    <select class="input-text select-input" data-child="2"  name="agent_id" id="states">
                        <option value="0">---<?php echo $this->global_function->show_config_language('lang_states', $lang) ?>---</option>
                        <?php foreach ($this->m_location->show_list_location_where(array("parent_id" => $user->city_id, "location.status" => 1), 1, 1, $lang, 0) as $c3) {
                            ?>
                            <option <?php if($user->agent_id==$c3->id) echo 'selected'?> value="<?php echo $c3->id ?>"><?php echo $c3->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="clear hg1"></div>
                <div class="round-input three">
                    <span><i class="fa fa-facebook"></i></span>
                    <input type="text" name="facebook" value="<?php echo $user->facebook ?>" placeholder="Facebook">
                </div>
                <div class="round-input three">
                    <span><i class="fa fa-google-plus"></i></span>
                    <input type="text" name="google" value="<?php echo $user->google ?>" placeholder="Google +">
                </div>
                <div class="round-input three">
                    <span><i class="fa fa-globe"></i></span>
                    <input type="text" name="website" value="<?php echo $user->website ?>" placeholder="Website">
                </div>
                <div class="clear hg1"></div>
                <div class="round-major">
                    <?php  foreach ($this->global_function->list_tableWhere(array("users_id" => $user->id), "users_graduated") as $graduated) {?>
                        <div class="i-major">
                            <div class="round-input">
                                <span><i class="fa fa-building"></i></span>
                                <input type="text" name="company[]" value="<?php echo $graduated->company?>"
                                       placeholder="<?php echo $this->global_function->show_config_language('lang_company', $lang) ?>">
                            </div>
                            <i class="fa fa-minus-square i-delete-more" onclick="DeleteAjax(this)" data="<?php echo site_url($lang . "/delete/major/".$graduated->id) ?>" data-show="round-major"></i>
                            <div class="round-input fright">
                                <span><i class="fa  fa-briefcase"></i></span>
                                <input type="text" name="major[]" value="<?php echo $graduated->major?>"
                                       placeholder="<?php echo $this->global_function->show_config_language('lang_major', $lang) ?>">
                            </div>
                        </div>
                        <div class="clear hg1"></div>
                    <?php }?>
                    <div class="i-major">
                        <div class="round-input">
                            <span><i class="fa fa-building"></i></span>
                            <input type="text" name="company[]" value=""
                                   placeholder="<?php echo $this->global_function->show_config_language('lang_company', $lang) ?>">
                        </div>
                        <i class="fa fa-plus-square i-add-more" onclick="AddMore(this)" data-url="<?php echo site_url($lang . "/add/major") ?>" data-show="round-major"></i>
                        <div class="round-input fright">
                            <span><i class="fa  fa-briefcase"></i></span>
                            <input type="text" name="major[]" value=""
                                   placeholder="<?php echo $this->global_function->show_config_language('lang_major', $lang) ?>">
                        </div>
                    </div>
                </div>
                  <div class="clear hg1"></div>
                <div class="round-degree">
                    <?php  foreach ($this->global_function->list_tableWhere(array("users_id" => $user->id), "users_degree") as $degree) {?>
                        <div class="i-degree">
                            <div class="round-input col_full">
                                <span><i class="fa  fa-graduation-cap"></i></span>
                                <input type="text" name="degree[]" value="<?php echo $degree->degree ?>"
                                       placeholder="<?php echo $this->global_function->show_config_language('lang_undergraduate_degree', $lang) ?>">
                            </div>
                            <i class="fa fa-minus-square i-delete-more" onclick="DeleteAjax(this)" data="<?php echo site_url($lang . "/delete/degree/".$degree->id) ?>" data-show="round-degree"></i>
                        </div>
                    <?php }?>
                    <div class="i-degree">
                        <div class="round-input col_full">
                            <span><i class="fa  fa-graduation-cap"></i></span>
                            <input type="text" name="degree[]" value="" placeholder="<?php echo $this->global_function->show_config_language('lang_undergraduate_degree', $lang) ?>">
                        </div>
                        <i class="fa fa-plus-square i-add-more" onclick="AddMore(this)" data-url="<?php echo site_url($lang . "/add/degree") ?>" data-show="round-degree"></i>
                    </div>
                </div>
                <div class="clear hg1"></div>
                <?php $this->load->view("front/block/menu_lang") ?>
                <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                    $row = $this->global_function->get_tableWhere(array("users_id" => $user->id, "country_id" => $rlang->id), 'usersdetail');
                    ?>
                    <div class="round-input col_full textarea col-lang col-<?php echo $rlang->name ?>">
                        <span class="span-i"><i class="fa  fa-info"></i></span>
                        <div class="info-textarea">
                        <textarea type="text" id="info-<?php echo $rlang->name ?>" name="info-<?php echo $rlang->name ?>"
                                  placeholder="<?php echo $this->global_function->show_config_language('lang_address', $lang) ?>" cols="50"
                                  style="width: 100%; height:345px"><?php echo isset($row->info) ? $row->info : "" ?></textarea>
                        </div>
                    </div>
                <?php } ?>
                <div class="clear hg1"></div>
                <div class="i-btn btn-save-change" onclick="$('#btn-submit-f-myinfo').trigger('click')"><i
                        class="fa fa-save"></i><?php echo $this->global_function->show_config_language('lang_save_changes', $lang) ?></div>
                <input type="submit" id="btn-submit-f-myinfo" name="ok" style="display: none">

            </div>
        </div>
    </form>
</div>
<script>
    bkLib.onDomLoaded(function () {
        //nicEditors.allTextAreas() ;
        new nicEditor({maxHeight: 345}).panelInstance('info-vn');
        new nicEditor({maxHeight: 345}).panelInstance('info-en');

    });
    $(document).ready(function () {
        DefaultLang();
    });
</script>