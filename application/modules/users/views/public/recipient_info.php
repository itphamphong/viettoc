<div id="info-user">
   <?PHP $this->load->view("public/block_col_left")?>
    <div id="right-col-user" >
        <div class="title-cart"><?php echo $l->lang_account_info[$lang] ?></div>
        <?php
        $this->load->view('front/inc/messager', array('type_messager' => $this->input->get('messager')));
        ?>
        <div class="form-log">
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
                <select class="input" onchange="LoadAgent_Cart(this)" data-load="agent-one" name="city_one" id="city_one">
                    <option value="0" selected><?php echo $l->lang_chose_city[$lang] ?></option>
                    <?php foreach ($city as $c) { ?>
                        <option value="<?php echo $c->id ?>" <?php if (isset($user->city_id) && $user->city_id== $c->id) { ?> selected <?php } ?>><?php echo $c->name ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error("city_one") ?>
                <label><?php echo $l->lang_agent[$lang] ?> *</label>
                <select class="input" id="agent-one" name="agent_one" >
                    <option value="0" selected><?php echo $l->lang_chose_agent[$lang] ?></option>
                    <?php foreach ($agent as $a) { ?>
                        <option value="<?php echo $a->id ?>" <?php if ($user->agent_id == $a->id) { ?> selected <?php } ?>><?php echo $a->name ?></option>
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
<script type="application/javascript">
    $jq(document).ready(function(){
        $jq('#birthday').datetimepicker({
            format:'Y/m/d',
            lang:'vi',
            timepicker:false
        });
        var agent_one=$( "#agent-one option:selected" ).val();
        var lang=$("#lang_id").val();
        if(agent_one==0){
            $jq("#store").attr("disabled",true);
        }

    })

</script>