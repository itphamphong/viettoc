<link type="text/css" href="<?php echo base_url() ?>themes/css/default/default.css" rel="stylesheet"/>
<script type='text/javascript' src='<?php echo base_url() ?>themes/js/default/jquery-1.8.2.min.js'></script>
<script src="<?php echo base_url() ?>themes/js/custom/datetimepicker-master/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>themes/js/custom/datetimepicker-master/jquery.datetimepicker.css"/>
<div id="info-user" style="width: 400px">
    <div id="right-col-user" style="width: 400px">
        <div class="title-cart"><?php echo $l->lang_account_info[$lang] ?></div>
        <div class="form-log">
            <?php $this->load->view('front/inc/messager', array('type_messager'=>$this->input->get('messager') ) );?>
            <form action="" method="post">
                <label><?php echo $l->lang_full_name[$lang] ?> *</label>
                <input type="text" class="input" name="full_name_one" id="full_name_one" value="<?php echo isset($user->full_name) ? $user->full_name : '' ?>"/>
                <?php echo form_error("full_name_one") ?>
                <label><?php echo $l->lang_cellphone[$lang] ?> *</label>
                <input type="text" class="input" name="cell_phone_one" id="cell_phone_one" value="<?php echo isset($user->cell_phone) ? $user->cell_phone : '' ?>"/>
                <?php echo form_error("cell_phone_one") ?>
                <label><?php echo $l->lang_landline[$lang] ?></label>
                <input type="text" class="input" name="land_line_one" id="land_line_one" value="<?php echo isset($user->landline) ? $user->landline : '' ?>"/>
                <label><?php echo "Email *" ?></label>
                <input type="text" class="input" name="email_one" id="email_one" value="<?php echo isset($user->email) ? $user->email : '' ?>"/>
                <?php echo form_error("email_one") ?>
                <label><?php echo $l->lang_address[$lang] ?> *</label>
                <input type="text" class="input" name="address_one" id="address_one" value="<?php echo isset($user->address) ? $user->address : '' ?>"/>
                <label><?php echo $l->lang_city[$lang] ?> *</label>
                <select class="input" onchange="LoadAgent_Cart(this)" data-load="agent-one" name="city_one" id="city_one">
                    <option value="0" selected><?php echo $l->lang_chose_city[$lang] ?></option>
                    <?php foreach ($city as $c) { ?>
                        <option value="<?php echo $c->id ?>" <?php if ($user->city_id == $c->id) { ?> selected <?php } ?>><?php echo $c->name ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error("city_one") ?>
                <label><?php echo $l->lang_agent[$lang] ?> *</label>
                <select class="input" id="agent-one" name="agent_one">
                    <option value="0" selected><?php echo $l->lang_chose_agent[$lang] ?></option>
                    <?php foreach ($agent as $a) { ?>
                        <option value="<?php echo $a->id ?>" <?php if ($user->agent_id == $a->id) { ?> selected <?php } ?>><?php echo $a->name ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error("agent_one") ?>
                <div class="round-btn"><input type="submit" class="btn" value="<?php echo $l->lang_update[$lang] ?>" name="ok"></div>
                <input type="hidden" value="<?php echo $user->id?>" name="user_id">
                <input type="hidden" value="0" name="buyer_id">
            </form>
        </div><!-- form-log-->
    </div><!-- right-col-user-->
</div><!-- info-user-->
<input type="hidden" value="<?php echo isset($lang)?$lang:"vn" ?>" id="lang_id">
<script type="application/javascript">
    $jq(document).ready(function(){
        $jq('#birthday').datetimepicker({
            format:'Y/m/d',
            lang:'vi',
            timepicker:false
        });
    })
    function LoadAgentCartForm(e){
        var id=$(e).val();
        var data_load=$(e).attr("data-load");
        var lang=$("#lang_id").val();
        if(lang=='') lang="vn";
        $jq.post("<?php echo site_url($lang."/load-agent-cart")?>",{id:id,lang:lang},function(data){
            $jq("#"+data_load).html(data);
            $jq("#"+data_load).attr("disabled",false);
        });
        return false;
    }
</script>