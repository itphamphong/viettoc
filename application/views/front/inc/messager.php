<div class="messages" id="message-fadeout">
    <?php
    switch (mb_strtolower($type_messager)) {
        /*
         * THAO TAC THANH CONG
         */
        case 'send-success': echo '<div class="status success"><p><span>Info sent successfull!</span></p></div>'; break;
        case 'thanh-cong': echo "<div class=\"status success\"><p><span>Thông tin đã được gửi thành công!  </span></p></div>"; break;
        case 'update-success': echo "<div class=\"status success\"><p><span>Info updated successfull!  </span></p></div>"; break;
        case 'cap-nhat-thanh-cong': echo "<div class=\"status success\"><p><span>Thông tin đã được cập nhật thành công!  </span></p></div>"; break;
    }
    ?>
</div>

<script language="javascript">
    setTimeout(function() {
        $("div#message-fadeout").fadeOut();
    }, 5000);
</script>
<style>
    .success {
        background: #689A1D;
        border: 1px solid #65971e; color: #fff; font-size: 13px
    }
    .success p{  margin:5px}
</style>


