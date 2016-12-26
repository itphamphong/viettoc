<style>
    .col-lang{ display: none}
</style>
<div class="tab-language fleft col_full">
<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$CI = &get_instance();
$lang = $CI->global_function->show_list_lang();
foreach ($lang as $l) {
    ?>


    <span class="i-tab i-lang-<?php echo $l->name ?> <?php if($l->default==1) {?>active <?php } ?>" data="<?php echo $l->name?>" onclick="Lang(this)"><?php echo $l->title?></span>
    <?php } ?>
</div>
<script type="application/javascript">
    $(document).ready(function(){
        DefaultLang();
    });
    <?php if(isset($item) && $item=='menu'){?>
    function Lang(e){
        var menu=$(".menu_type:checked").val();
        $(".i-tab").removeClass("active");
        $(".col-lang").hide();
        var data=$(e).attr("data");
        $(".i-lang-"+data).addClass("active");
        $(".col-"+data).show();
        if(menu==1){
        $(".blank_link.col-lang,.uri_link.col-lang").hide();
        }else if(menu==2){
            $(".blank_link.col-lang,.modules.col-lang").hide();
        }else{
            $(".modules.col-lang,.uri_link.col-lang").hide();
        }


    }
    <?php }else{?>
    function Lang(e){
        $(".i-tab").removeClass("active");
        $(".col-lang").hide();
        var data=$(e).attr("data");
        $(".i-lang-"+data).addClass("active");
        $(".col-"+data).show();

    }
    <?php }?>

</script>