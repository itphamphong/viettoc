<div class="left_wrap">
  <ul class="list_link">
    <li><a <?php if (isset($mod) && $mod == 'dashboard') { ?> class='active'<?php } ?>  href="<?php echo site_url($lang . "/dashboard") ?>"><?php echo $l->lang_info[$lang] ?></a></li>
     <li><a <?php if (isset($mod) && $mod == 'Reset Pass') { ?> class='active'<?php } ?> href="<?php echo site_url($lang . "/reset-pass/".$this->session->userdata('user')->user_code) ?>"><?php echo $l->lang_change_pass[$lang] ?></a></li>
    <?php if ($this->a_general->get_row("users", array("id" => $this->session->userdata('user')->id))->type_account == 1) { ?>
   <!-- <li><a <?php if (isset($mod) && $mod == 'dang-tin') { ?> class='active'<?php } ?> href="<?php echo site_url($lang . "/dang-tin") ?>"><?php echo "Đăng tin" ?></a></li>-->
    <li><a <?php if (isset($mod) && $mod == 'quan-ly-tin') { ?> class='active'<?php } ?> href="<?php echo site_url($lang . "/quan-ly-tin") ?>"><?php echo "Quản lý tin" ?></a></li>
    <?php } ?>
    <li><a <?php if (isset($mod) && $mod == 'tin-yeu-thich') { ?> class='active'<?php } ?> href="<?php echo site_url($lang . "/quan-ly-tin-yeu-thich") ?>">Danh sách tin tức yêu thích</a></li>
    <li><a <?php if (isset($mod) && $mod == 'dich-vu-yeu-thich') { ?> class='active'<?php } ?> href="<?php echo site_url($lang . "/quan-ly-dich-vu-yeu-thich") ?>">Danh sách dịch vụ yêu thích</a></li>
  </ul>
</div>