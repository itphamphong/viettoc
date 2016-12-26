<!DOCTYPE html>
<!-- saved from url=(0025)# -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/tfg_style.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/styles.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/js/fancyapps/source/jquery.fancybox.css" type="text/css"
          media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/bootstrap.min.css" type="text/css"
          media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/bootstrap-theme.min.css" type="text/css"
          media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/normalize.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/animate.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/animate.min.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/font-awesome.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/font-awesome.min.css" type="text/css"
          media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/bxslider/jquery.bxslider.css" type="text/css"
          media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/letter/jquery-letterfx.css" type="text/css"
          media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/letter/jquery-letterfx.min.css"
          type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo base_url() ?>themes/front/css/mobile.css" type="text/css" media="all">
    <script src="<?php echo base_url() ?>themes/front/js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>themes/front/js/jquery-ui.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/bxslider/jquery.bxslider.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/bxslider/jquery.fitvids.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/fancyapps/source/jquery.fancybox.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/letter/jquery.fittext.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/letter/jquery.lettering.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/letter/highlight.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>themes/front/js/letter/jquery.textillate.js"></script>

<body>
<div id="text-body-hide" class="text-body-hide">Bạn vui lòng dùng màn hình ngang !</div>
<div  id="mobile">
<?php //$this->load->view('front/block/slide_bar');?>
<?php $this->load->view('front/block/header_mobile');?>
<?php echo $content?>
</div>
</body>
<script>
    $( window ).resize(function() {
        var win = $(this); //this = window
        if (win.height() > win.width()){
            $("body").addClass('closebody');
        }else{
            $("body").removeClass('closebody');
        }
    });
    /*$( window ).orientationchange();
    $(window).on("orientationchange",function(){
        if(window.orientation == 0) // Portrait
        {
            $("body").addClass('closebody');
        }
        else // Landscape
        {
            $("body").removeClass('closebody');
        }
    });
    //    jQuery(document).ready(function () {
    //        var height = window.innerHeight;
    //        $('.height-screen').css({'height': height + 'px'});
    //    });
    */

    function showpop(id) {
        $('#' + id).fadeIn(300);
    }
    function showpop(id) {
        $('#' + id).fadeIn(300);
    }
    $(".close-image").on('click', function () {
        $('.popup').fadeOut(500);
    });
    $(document).ready(function(){
        var win = $(window); //this = window
        if (win.height() > win.width()){
            $("body").addClass('closebody');
        }else{
            $("body").removeClass('closebody');
        }
        /*$(".hide-title").on("hover",function(e){
            if (e.type == "mouseenter") {
                var data=$(this).attr('data-value');
                $("#"+data).show(500);
            }
            else { // mouseleave
                $(".hover-answer").hide();
            }
        });
        */

        var myVideo = document.getElementById("myVideo1");
        var myVideo2 = document.getElementById("myVideo2");
        var x=0;
        var slider= $('.bxslider').bxSlider({
            pager:false,
            controls:true,
            video:true,
            infiniteLoop: false,
            hideControlOnEnd:true,
            onSliderLoad: function(){
               Change(slider,myVideo,myVideo2,x);
            }
        });
        $('.bx-next').on("click",function(){
            Change(slider,myVideo,myVideo2,1);
        });
        $('.bx-prev').on("click",function(){
            Change(slider,myVideo,myVideo2,0);
        });
    });
    function Change(slider,myVideo,myVideo2,x){
        if(x==0) {
            myVideo.currentTime = '0';
            myVideo.play();
            myVideo.addEventListener('ended', function () {
               $('.bx-next').trigger('click');
                Change(slider,myVideo,myVideo2,1)
            },false);
        }else{
            myVideo2.currentTime = '0';
            myVideo2.play();
            myVideo2.addEventListener('ended', function () {
                $('.bx-prev').trigger('click');
                Change(slider,myVideo,myVideo2,0);
            },false);
        }
    }
    function ShowMenu(e){
        var data=$("#icon-menu").attr('data');
        if(data==0) {
            $(".menu").addClass('h_auto');
            $("#menu-mobile").show(500);
            $("#icon-menu").attr('data',1);
        }else{
            $(".menu").removeClass('h_auto');
            $("#menu-mobile").hide();
            $("#icon-menu").attr('data',0);
        }
    }
</script>
</html>