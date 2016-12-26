<link type="text/css" href="<?php echo base_url()?>themes/front/nhatminh/css/default.css" rel="stylesheet"/>
<script type='text/javascript' src='<?php echo base_url()?>themes/front/nhatminh/js/jquery-1.8.2.min.js'></script>
<script src="<?php echo base_url()?>themes/front/nhatminh/js/datetimepicker-master/jquery.datetimepicker.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/front/nhatminh/js/datetimepicker-master/jquery.datetimepicker.css"/>
<div id="info-user" style="width: 400px; margin: auto; float: none">
    <div id="right-col-user"  style="width: 100%; border: none">
        <div class="title-cart"><?php echo $l->lang_recipient[$lang] ?></div>
        <div class="form-log " style="width: 90%">
            <?php $this->load->view('front/inc/messager', array('type_messager'=>$this->input->get('messager') ) );?>

            <form action="" method="post">
                <p class="note-copy" ><input value="1" name="copy" type="checkbox" id="copy" onclick="return CopyInfoRec(this)" <?php if($this->input->post("copy")==1) echo "checked"?>>
                    <?php echo $l->lang_copy_info[$lang]?>
                </p>
                <div class="col-one">
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
                <label style="display: none"><?php echo $l->lang_birthday[$lang] ?> <span class="red">*</span></label>
                <input style="display: none" type="text" name="birthday" class="input" id="birthday" value="<?php echo isset($user->birthday)?$user->birthday:""?>">
                <?php echo form_error("birthday") ?>
                <label><?php echo $l->lang_sex[$lang] ?> <span class="red">*</span></label>
                <select class="select input" name="sex">
                    <option value="1" <?php if(isset($user->sex)&& $user->sex==1){?>  selected="selected" <?php }?>><?php echo $l->lang_women[$lang] ?></option>
                    <option value="2" <?php if(isset($user->sex)&&$user->sex==2){?>  selected="selected" <?php }?>><?php echo $l->lang_men[$lang] ?></option>
                </select>
                <label><?php echo $l->lang_address[$lang] ?> *</label>
                <input type="text" class="input" name="address_one" id="address_one" value="<?php echo isset($user->address) ? $user->address : '' ?>"/>
                <?php echo form_error("address_one") ?>
                <label><?php echo $l->lang_city[$lang] ?> *</label>
                <select class="input" onchange="LoadAgentCartForm(this)" data-load="agent-one" name="city_one" id="city_one">
                    <option value="0" selected><?php echo $l->lang_chose_city[$lang] ?></option>
                    <?php foreach ($city as $c) { ?>
                        <option value="<?php echo $c->id ?>" <?php if (isset($user->city_id) && $user->city_id== $c->id) { ?> selected <?php } ?>><?php echo $c->name ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error("city_one") ?>
                <label><?php echo $l->lang_agent[$lang] ?> *</label>
                <select class="input" id="agent-one" name="agent_one">
                    <option value="0" selected><?php echo $l->lang_chose_agent[$lang] ?></option>
                    <?php foreach ($agent as $a) { ?>
                        <option value="<?php echo $a->id ?>" <?php if (isset($user->agent_id) &&$user->agent_id == $a->id) { ?> selected <?php } ?>><?php echo $a->name ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error("agent_one") ?>
                <div class="round-btn"><input type="submit" class="btn" value="<?php echo $l->lang_update[$lang] ?>" name="ok"></div>
                <input type="hidden" value="<?php echo isset($user->id)?$user->id:0?>" name="user_id">
                <input type="hidden" value="<?php echo $this->session->userdata("user")->id?>" name="buyer_id">
                <input type="hidden" value="<?php echo isset($user->store_id)?$user->store_id:0?>" id="store_hidden">

            </form>
        </div><!-- form-log-->
    </div><!-- right-col-user-->
</div><!-- info-user-->
<input type="hidden" value="<?php echo isset($lang)?$lang:"vn" ?>" id="lang_id">
<script type="application/javascript">
    $(document).ready(function(){

        $('#birthday').datetimepicker({
            format:'Y/m/d',
            lang:'vi',
            timepicker:false
        });
        var agent_one=$( "#agent-one option:selected" ).val();
        var lang=$("#lang_id").val();
    });
    function LoadAgentCartForm(e){
        var id=$(e).val();
        var data_load=$(e).attr("data-load");
        var lang=$("#lang_id").val();
        if(lang=='') lang="vn";
        $.post("<?php echo site_url($lang."/load-agent-cart")?>",{id:id,lang:lang},function(data){
            $("#"+data_load).html(data);
            $("#"+data_load).attr("disabled",false);
        });
        return false;
    }
    function CopyInfoRec(e){
        if(e.checked ==true){
            var lang=$("#lang_id").val();
            if(lang=='') lang="vn";
            $("#full_name_one").val("<?php echo $userinfo->full_name?>");
            $("#cell_phone_one").val("<?php echo $userinfo->cell_phone?>");
            $("#land_line_one").val("<?php echo $userinfo->landline?>");
            $("#birthday").val("<?php echo $userinfo->birthday?>");
            $("#email_one").val("<?php echo $userinfo->email?>");
            $("#address_one").val("<?php echo $userinfo->address?>");
            var city_one="<?php echo $userinfo->city_id?>";
            var agent_one="<?php echo $userinfo->agent_id?>";
            $("#city_one option[value=" + city_one + "]").prop("selected",true);
            $.post("<?php echo site_url($lang."/load-agent-cart")?>",{id:city_one,lang:lang},function(data){
                $("#agent-one").html(data);
                $("#agent-one").attr("disabled",false)
                $("#agent-one option[value=" + agent_one + "]").prop("selected",true);
                $.post("<?php echo site_url($lang."/load-store-cart")?>",{id:agent_one,lang:lang},function(data){
                    $("#store").html(data);
                    $("#store").attr("disabled",false);
                });
            });
        }else{
            $(".col-one input").val("");
            $(".col-one select").val(0);
            $(".col-one .select").attr("disabled",true);
        }
    }
</script>
