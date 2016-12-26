<div id="info-user">
    <?PHP $this->load->view("notice/public/block_col_left")?>
    <div id="right-col-user" >
        <div class="title-cart"><?php echo $l->lang_change_store[$lang] ?></div>
        <?php
        $this->load->view('front/inc/messager', array('type_messager' => $this->input->get('messager')));
        ?>
        <form action="" method="post">
            <div class="form-log" style="width: 95%">
                <label class="bold"><?php echo $l->lang_store[$lang]?></label>
                <select class="input" name="store_id" id="store_id">
                    <?php foreach($list as $store){?>
                        <option  value="<?php echo $store->id?>"><?php echo $store->store_name?></option>
                    <?php }?>
                </select>
                <textarea placeholder="<?php echo $l->lang_note[$lang]?>" class="note-change-store" id="note-change-store" name="note-change-store"></textarea>
                <?php echo form_error("note-change-store")?>
                <div class="round-btn">
                    <input type="submit" class="btn right" value="<?php echo $l->lang_send[$lang]?>"  name="ok">
                </div>
            </div>
        </form>
    </div><!-- right-col-user-->
</div><!-- info-user-->
