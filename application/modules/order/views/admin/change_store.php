<div class="contentcontainer">
    <div class="headings altheading">
        <h2>Chuyển cửa hàng</h2>
    </div>
    <div class="contentbox">
        <div id="info-user">
            <div id="right-col-user">
                <?php
                $this->load->view('front/inc/messager', array('type_messager' => $this->input->get('messager')));
                ?>
                <form action="" method="post">
                    <div class="form-log" style="width: 95%">
                        <label class="bold"><?php echo $l->lang_store[$lang] ?></label>
                        <select name="store_id" id="store_id" class="inputbox " >
                            <?php foreach ($list as $store) { ?>
                                <option value="<?php echo $store->id ?>"><?php echo $store->store_name ?></option>
                            <?php } ?>
                        </select>
                        <div style="clear: both; height: 10px"></div>
                        <textarea  style="height: 100px" placeholder="<?php echo $l->lang_note[$lang] ?>" class="inputbox " id="note-change-store" name="note-change-store"></textarea>
                        <?php echo form_error("note-change-store") ?>
                        <div class="round-btn">
                            <input type="submit" class="btn right" value="<?php echo $l->lang_send[$lang] ?>" name="ok">
                        </div>
                    </div>
                </form>
            </div>
            <!-- right-col-user-->
        </div>
        <!-- info-user-->
    </div>
</div>
