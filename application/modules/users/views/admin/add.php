<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/users/index/")) ?>
    <div class="clear he1"></div>
    <div class="col_full fleft bs-example-bg-classes">
        <p class="bg-warning">
                <?php echo form_error("full_name") ?>
                <?php echo form_error("user_name") ?>
                <?php echo form_error("password") ?>
        </p>
    </div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">MÔ TẢ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal">Tài khoản đăng nhập</label>
                            <div class="col-xs-8">
                                <input class="form-control" type="text" name="user_name" value="">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal">Mật khẩu</label>
                            <div class="col-xs-8">
                                <input class="form-control" type="text" name="password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal"><?php echo $this->global_function->show_config_language('lang_full_name', $rlang) ?></label>
                            <div class="col-xs-8">
                                <input class="form-control" type="text" name="full_name" value=""
                                       placeholder="<?php echo $this->global_function->show_config_language('lang_full_name', $rlang) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal"><?php echo $this->global_function->show_config_language('lang_phone', $rlang) ?></label>
                            <div class="col-xs-8">
                                <input class="form-control" type="text" name="phone" value=""
                                       placeholder="<?php echo $this->global_function->show_config_language('lang_phone', $rlang) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal"><?php echo 'Email' ?></label>
                            <div class="col-xs-8">
                                <input class="form-control" type="text" name="email" value=""
                                       placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal"><?php echo $this->global_function->show_config_language('lang_age', $rlang) ?></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="age" value=""
                                       placeholder="<?php echo $this->global_function->show_config_language('lang_age', $rlang) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal"><?php echo $this->global_function->show_config_language('lang_address', $rlang) ?></label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="address" value=""
                                       placeholder="<?php echo $this->global_function->show_config_language('lang_address', $rlang) ?>">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal">Kích hoạt</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="status">
                                    <option value="0">Không</option>
                                    <option value="1" selected>Có</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal">Quốc gia</label>
                            <div class="col-sm-8">
                                <select class="form-control input-text select-input" id="country" name="country_id" onchange="LoadCity(this)" data-child='0'
                                        data-url="<?php echo site_url($rlang . "/load-location") ?>">
                                    <option value="0">---<?php echo $this->global_function->show_config_language('lang_country', $rlang) ?>---</option>
                                    <?php foreach ($this->m_location->show_list_location_where(array("parent_id" => 0, "location.status" => 1), 1, 1, $rlang, 0) as $c1) {
                                        ?>
                                        <option   value="<?php echo $c1->id ?>"><?php echo $c1->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal">Tỉnh/Tp</label>
                            <div class="col-sm-8">
                                <select class="form-control input-text select-input"  id="city_id" name="city_id" onchange="LoadCity(this)" data-child='1'
                                        data-url="<?php echo site_url($rlang . "/load-location") ?>">
                                    <option value="0">---<?php echo $this->global_function->show_config_language('lang_city', $rlang) ?>---</option>
                                    <?php foreach ($this->m_location->show_list_location_where(array("parent_id" => $user->country_id, "location.status" => 1), 1, 1, $rlang, 0) as $c2) {
                                        ?>
                                        <option value="<?php echo $c2->id ?>"><?php echo $c2->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <label class="col-xs-4 control-label normal">Quận/huyện</label>
                            <div class="col-sm-8">
                                <select class="form-control input-text select-input" data-child="2"   name="agent_id" id="states">
                                    <option value="0">---<?php echo $this->global_function->show_config_language('lang_states', $rlang) ?>---</option>
                                    <?php foreach ($this->m_location->show_list_location_where(array("parent_id" => $user->city_id, "location.status" => 1), 1, 1, $rlang, 0) as $c3) {
                                        ?>
                                        <option value="<?php echo $c3->id ?>"><?php echo $c3->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                            ?>

                            <div class="form-group col-lang col-<?php echo $lang->name ?>">
                                <label class="col-xs-2 control-label normal">
                                    <label class="col-xs-8 control-label normal">Giới thiệu</label>
                                </label>
                                <div class="col-sm-10">
                                    <?php $this->load->view("back/inc/editor", array("name" => "info-" . $lang->name)) ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="clear he1"></div>
            <div class="col_full fleft info-item ">
                <div class="title col_full fleft">Avatar</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <div class="inline_avatar user-avatar">

                    </div>
                    <div style="clear: both; height: 10px"></div>
                    <input type="file" name="img" id="user-avatar">
                    <input type="hidden" name="old_img" value="">
                </div>
                <div style="clear: both; height: 10px"></div>
            </div>
            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/list_hide_button") ?>
        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/users/index")) ?>
    <div class="clear he3"></div>
</div>



