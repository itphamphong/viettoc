<?php
$active = isset($menu_active) ? $menu_active : 'home'; ?>
<div id="header">
    <div class="col-center">
        <a href="<?php echo site_url() ?>"><img src="<?php echo $logo['picture'] ?>" alt="<?php echo $logo['alt'] ?>" height="100"></a>
        <div id="language-tab" onclick="MegaMenu(this)" data="0">
            Việt Nam <i class="fa fa-angle-down"></i>
        </div>
        <ul class="i-menu">
            <?php if (isset($this->session->userdata("user")->id)) { ?>
                <li>
                    <a href="<?php echo site_url($lang . "/my-info") ?>"><?php echo $this->session->userdata("user")->full_name ?></a>
                    | <a href="<?php echo site_url($lang . "/logout") ?>"><i class="fa fa-sign-out"></i></a>
                </li>
            <?php }else{ ?>
            <li>
                <a id="various2" href="#inline2">
                    <?php echo $this->global_function->show_config_language('lang_login', $lang) ?>
                </a>
            </li>
            <?php }?>
            <li>
                <?php if (!isset($this->session->userdata("user")->id)) { ?>
                    <a id="various2" href="#inline2">
                        <?php echo $this->global_function->show_config_language('lang_became_a_tutor', $lang) ?>
                    </a>
                <?php } else { ?>
                    <a href="<?php echo site_url($lang . "/for-tutor-signin-location") ?>">
                        <?php echo $this->global_function->show_config_language('lang_became_a_tutor', $lang) ?>
                    </a>
                <?php } ?>
            </li>

            <li class="last">
                <a href="<?php echo site_url($lang . "/find-tutor") ?>">
                    <?php echo $this->global_function->show_config_language('lang_request_a_tutor', $lang) ?>
                </a>
            </li>

        </ul>
        <ul id="menu-top">
            <li>
                <a class="<?php if ($active == 'home') echo 'active' ?>"
                   href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_home', $lang, 'url')) ?>">
                    <?php echo $this->global_function->show_config_language('lang_home', $lang) ?>
                </a>
            </li>
            <li>
                <a class="<?php if ($active == 'for-student') echo 'active' ?>"
                   href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_for_student', $lang, 'url')) ?>">
                    <?php echo $this->global_function->show_config_language('lang_for_student', $lang) ?>
                </a>
            </li>
            <li>
                <a class="<?php if ($active == 'for-tutor') echo 'active' ?>"
                   href="<?php echo site_url($lang . "/" . $this->global_function->show_config_language('lang_for_tutor', $lang, 'url')) ?>"><?php echo $this->global_function->show_config_language('lang_for_tutor', $lang) ?></a>
            </li>
            <li><a class="flag active" href="#">EN</a><a  href="#" class="flag">VI</a></li>
        </ul>

    </div>
</div>
<div id="mega_menu">
    <div class="col-center">
        <div class="menusevenRow">
            <div class="row menuCon menusevencol">
                <div class="col-sm-12 col-md-2 menuCol"> <a href="#">
                        <h3 class="menuTitle sg">Singapore</h3>
                        <ul class="secondLevel">
                            <li>Singapore</li>
                        </ul>
                    </a> </div>
                <div class="col-sm-12 col-md-2 menuCol"> <a href="#">
                        <h3 class="menuTitle my">Malaysia</h3>
                        <ul class="secondLevel">
                            <li>Kuala Lumpur
                            </li><li>Putrajaya</li>
                            <li>Selangor</li>
                            <li>Negeri Sembilan</li>
                            <li>Johor</li>
                            <li>Malacca</li>
                            <li>Kuching</li>
                            <li>Penang</li>
                            <li>Kota Kinabalu </li>
                        </ul>
                    </a> </div>
                <div class="col-sm-12 col-md-2 menuCol"> <a href="#">
                        <h3 class="menuTitle th">Thailand</h3>
                        <ul class="secondLevel">
                            <li>Bangkok</li>
                            <li>Pattaya</li>
                            <li>Chiang Rai</li>
                            <li>Chiang Mai</li>
                            <li>Phuket</li>
                        </ul>
                    </a> </div>
                <div class="col-sm-12 col-md-2 menuCol"> <a href="<?php echo site_url()?>">
                        <h3 class="menuTitle vn">Việt Nam</h3>
                        <ul class="secondLevel">
                            <li>Tp.Hồ Chí Minh</li>
                            <li>Hà Nội</li>
                            <li>Đà Nẵng</li>
                        </ul>
                    </a> </div>


                <div class="col-sm-12 col-md-2 menuCol">
                    <a href="#">
                        <h3 class="menuTitle us">United States</h3>
                        <ul class="secondLevel">
                            <li>United States</li>
                        </ul>
                    </a>
                </div>

            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div id="inline2" style="display: none">

    <div class="loginbox-v4 js-signin-box">
        <h2 class="box-heading">
            <?php echo $this->global_function->show_config_language('lang_required_login', $lang) ?>
        </h2>
        <div class="fxw box-wrapper ud-usertracker" data-namespace="login-popup">
            <div class="box-left box-col fx">
                <h4>Login with social accounts</h4>
                <div class="ud-facebook-signup">
                    <a href="javascript:void(0)" class="social-btn facebook-btn js-facebook-btn shadowed-btn fxac">
                        <i class="icon-facebook social-icon fa fa-facebook"></i>
        <span class="btn-text">
                Login with Facebook
        </span>
                        <span class="ajax-loader-tiny hidden"></span>
                    </a>
                </div>
                <div class="ud-google-plus-signup-social">
                    <a href="javascript:void(0)" class="social-btn google-btn shadowed-btn fxac">
                        <i class="icon-google-plus social-icon fa fa-google-plus"></i>
        <span class="btn-text">
                Login with Google+
        </span>
                        <span class="ajax-loader-tiny hidden"></span>
                    </a>
                </div>

            </div>
            <div class="box-separator"></div>
            <div class="box-right box-col fx">
                <div class="usertracker-command" data-usertracker-type="seen-login-popup" data-namespace="login-popup">
                </div>
                <h4>Login with your email</h4>
                <form name="login-form" id="login-form" class="ud-signin-form dj" method="post">
                    <input type="hidden">
                    <div class="manage-fields-wrapper">
                        <input type="hidden" name="locale" value="en_US">
                        <div class="non-labeled " id="form-item-email">
                            <input class="ud-mailcheck emailinput form-control" id="user_name"
                                   maxlength="64" minlength="6" name="user_name" placeholder="<?php echo $this->global_function->show_config_language('lang_user_name', $lang) ?>"
                                   type="text">
                        </div>
                        <div class="non-labeled " id="form-item-password">

                            <input class="textinput textInput form-control" id="password"
                                   maxlength="64" minlength="3" name="password" placeholder="<?php echo $this->global_function->show_config_language('lang_password', $lang) ?>"
                                   required="True" type="password">
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="submit-row">
                            <input type="button" name="submit" value="<?php echo $this->global_function->show_config_language('lang_login', $lang) ?>"
                                   class="i-btn btn btn-primary btn btn-success" id="submit-id-submit"
                                   data-purpose="do-login" onclick="LoginAjax(this)" data-link="<?php echo site_url($lang . "/login-ajax") ?>"
                                   data-su="<?php echo site_url($lang . "/for-tutor-signin-location") ?>"> <span>or </span><a
                                href="#"
                                class="cancel-link">Forgot Password</a></div>
                    </div>
                </form>

            </div>
        </div>
        <div class="box-footer">
            <?php echo $this->global_function->show_config_language('lang_required_register', $lang) ?>
            <a class="sign-link" href="<?php echo site_url($lang . "/singup") ?>">
                Tại đây !
            </a>
        </div>
    </div>
</div>