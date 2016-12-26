<ul id="breadcrumb" class="col-xs-12">
    <li>
        <a href="<?php echo site_url($lang."/".$this->global_function->show_config_language('lang_home', $lang,'url')) ?>">
            <?php echo $this->global_function->show_config_language('lang_home', $lang) ?>
        </a> <i class="fa fa-angle-right "></i>
        <?php echo $breadcrumb;?>
    </li>
</ul>