<?php if (!$this->agent->is_mobile()) {?>
<div id="copyright">
    <div class="col-center">
        <div class="text-copy"> <?php echo $info->copyright?></div>
        <div class="i-lava">
            <img src="<?php echo base_url()?>themes/front/images/logo-lava.png" alt=""/>
                <span><a  href="http://lavaweb.vn/thiet-ke-website.html" target="_blank">Thiết Kế Website</a><br>
                bởi lavaweb.vn-096 888 7700</span>

        </div>
    </div>
</div>
<?php }else{?>
<div id="copyright" class="copyright-mobile">
    <div class="text-copy col-xs-12 text-center"> <?php echo $info->copyright ?></div>
    <div class="i-lava col-xs-12 text-center">
        <div class="center-block">
                <div class="col-xs-8 text-right">
                <span class="pull-right"><a href="http://lavaweb.vn/thiet-ke-website.html" target="_blank">Thiết Kế Website</a><br>bởi lavaweb.vn-096 888 7700</span>
                </div>
            <div class="col-xs-4 text-left pad0">

            <img src="<?php echo base_url() ?>themes/front/images/logo-lava.png" alt=""/>
                </div>
        </div>

    </div>
</div>
<?php }?>