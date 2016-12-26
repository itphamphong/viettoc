<div class="breadcrumbs">
    <a href="<?php if($lang!='vn') echo site_url($lang."/".$l->lang_url_home[$lang])?>" class="first"><?php echo $l->lang_home[$lang]?></a>
    <?php echo $l->lang_active_account[$lang]?>
</div>
<div id="cart">
    <p class="red" style="text-align: center"><?php echo isset($message)?$message:""?></p>
    <p style="text-align: center" class="number">5</p>
</div>
<script language="javascript">
    var x=5;
   setInterval(ref,1000); //every 5 minutes
   function ref() {
       if(x>0){
           x--;
           $(".number").html(x);
       }else{
           window.location.href="<?php echo $site?>";
       }
   }
</script>