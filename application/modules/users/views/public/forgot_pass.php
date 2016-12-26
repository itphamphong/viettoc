<form action="" method="post">
    <div class="form-log">
        <div class="title-popup"><?php echo $l->lang_forgot_pass[$lang]?></div>
        <p class="error red bold"></p>
        <label>Email</label>
        <input type="text" name="email" class="input" id="email">
        <?php echo form_error("email")?>
        <div class="round-btn">
            <input type="button" class="btn" value="<?php echo $l->lang_send[$lang]?>" onclick="Forgot()">
        </div>
    </div>
</form>