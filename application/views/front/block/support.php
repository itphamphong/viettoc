<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 8/18/2016
 * Time: 10:46 AM
 */
$CI=&get_instance();
$CI->load->model('support/m_support');
$list_support=$CI->m_support->show_list_support_where(array('support.status'=>1),0,0,$lang,0);?>
<?php foreach($list_support as $sp){?>
    <div class="col-xs-6 i-support col-sml-pad-0">
        <a href="Skype:<?php echo $sp->support_nick?>?chat" class="i-skype">
        <img src="<?php echo base_url() ?>themes/front/images/i-skype.png">
                <span class=""><?php echo $sp->support_name?> <br>
                    <?php echo $sp->support_phone?></span>
        </a>
    </div>
<?php }?>
