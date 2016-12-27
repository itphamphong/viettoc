// load hotel of location
$(document).ready(function () {
    $('.page-menu').click(function(){
       $(".page-menu li.h").toggle();
    });
    $(window).scroll(function(){
        if($(window).scrollTop()>300){
            $("#scroll_top").fadeIn();
        }else{
            $("#scroll_top").fadeOut();
        }
    });
});
function Sroll(){
    $('html, body').animate({
        scrollTop:0
    }, 2000);
}
function HoverImg(){
    $('.i-tutor').hover(function(){
        $(this).find('.hover-img').show();

    },function(){
        $('.hover-img').hide();
    });
}
function Show_browse_lession(){
    $(".content-topic-search").hide();
    $('#show_browse_lession').show(100);
    var h=$('.tab-topic-search').height();
    $('.tab-topic-search-right ul').height(h);

    $('.tab-topic-search li').hover(function(){
        var id=$(this).attr('data-id');
        $("#content-topic-"+id).show();
    },function(){
        $(".content-topic-search").hover(function(){
            $(this).show();
        });
        $(".content-topic-search").hide();
    });
    $("body").append('<div class="hidden-close" onclick="CloseTopic()"></div>');
}
// Add Availabillity  Tutor signin - Schedule
function AddAvil(e) {
    var link = $(e).attr('data-url');
    $.ajax({
        url: link,
        type: "POST",
        success: function (data) {
            if (data) {
                $('#show-add-availabillity').append(data);
            }
        }
    }); //end ajax
}
function AddGraduated(e) {
    var link = $(e).attr('data-url');
    $.ajax({
        url: link,
        type: "POST",
        success: function (data) {
            if (data) {
                $('#load-graduated-item').append(data);
            }
        }
    }); //end ajax
}
function LoadChildSub(e) {
    var link = $(e).attr('data-url');
    var id = $(e).attr('data-id');
    $(".list-cate li").removeClass('active');
    $.ajax({
        url: link,
        type: "POST",
        data:{id:id},
        success: function (data) {
            if (data) {
                $('.child-cate').html(data);
                $(this).addClass('active');
            }
        }
    }); //end ajax
}
function ChooseDay(e){
    var id=$(e).attr('data-id');
    $('.choose-day').hide();
    $('.tab-day li').removeClass('active');
    $(e).addClass('active');
    $("#day-"+id).show();
}
function LoadCity(e){
    var id=$(e).val();
    var link=$(e).attr('data-url');
    var child=$(e).attr('data-child');
    $.ajax({
        url: link,
        type: "POST",
        data:{id:id,child:child},
        success: function (data) {
            if (data) {
                if(child==0) {
                    $('#city_id').removeAttr('disabled');
                    $('#city_id').html(data);
                }else if(child ==1){
                    $('#states').removeAttr('disabled');
                    $('#states').html(data);

                }
            }
        }
    }); //end ajax
}
function ChosseTopic(e){
    var id=$(e).attr('data-id');
    var text=$(e).text();
    $('.col-select-topic').hide();
    $("#select-topic").val(text);
    $('#hidden-select-topic').val(id);
}
function ShowTopic(){
    $('.col-select-topic').fadeIn(200);
    $('.col-select-topic').attr('data-show',1);
    $("body").append('<div class="hidden-close" onclick="CloseTopic()"></div>');
    /*$("div").not('#select-topic, .col-select-topic *').on('click',function(e) {
        $('.col-select-topic').hide();
        $('.col-select-topic').attr('data-show',0);

    });*/


}
function ShowlessionCity(){
    $('#show-lession-city').show(200);
    $("body").append('<div class="hidden-close" onclick="CloseTopic()"></div>');
}
function CloseTopic(){
    $('.col-select-topic').hide(200);
    $('#show-lession-city').hide(200);
    $('#show_browse_lession').hide(200);
    $('.hidden-close').remove();
    $('#mega_menu').hide();
    $("#language-tab").attr('data',0);
}
function ChosseArea(e){
    var id=$(e).val();
    var text=$( "#states option:selected" ).text();
    var child=$(e).attr('data-child');
    $("#show-lession-city").hide();
    $("#select-area").val(text.trim());
    $("#hidden-select-area").val(id);
    $('#hidden-child').val(child);
}
function ChosseBrowse(e){
    var text=$(e).text();
    var id=$(e).attr('data-id');
    $('#show_browse_lession').hide();
    $('#hidden-search-subject').val(id);
    $("#search-subject").val(text.trim());
}
function SortTab(e){
    var id=$(e).val();
    var link=$(e).attr('data-link');
    $.ajax({
        url: link,
        type: "POST",
        data:{id:id},
        success: function (data) {
            if (data) {
               $('#load-round-tutor').html(data);
            }
        }
    }); //end ajax
}
function SearchSubject(e){
    var select_topic=$("#hidden-search-subject").val();
    var link=$(e).attr('data-link');
    $.ajax({
        url: link,
        type: "POST",
        data:{id:'0',select_topic:select_topic},
        success: function (data) {
        $('#load-round-tutor').html(data);
        }
    }); //end ajax
}
function LoginAjax(e){
    var link=$(e).attr('data-link');
    var sucess=$(e).attr('data-su');
    var user_name=$("#user_name").val();
     var password=$("#password").val();
    $.ajax({
        url: link,
        type: "POST",
        data:{password:password,user_name:user_name},
        success: function (data) {
            if (data.msg==0) {
                alert(data.message);
            }else{
                window.location.href=sucess;
            }
        }
    }); //end ajax
}
function FormRate(e){
    var rate=$('#rate').val();
    var user_id=$('#user_id').val();
    var item_id=$('#item_id').val();
    var note=$('#note').val();
    var link=$(e).attr('data-link');
    $.ajax({
        url: link,
        type: "POST",
        data:{productID:item_id,value:rate,user_id:user_id,note:note},
        success: function (data) {
                alert(data);
            }

    }); //end ajax
}
function MegaMenu(e){
    var data=$(e).attr('data');
    if(data==0) {
        $(e).addClass('active');
        $("#mega_menu").fadeIn(200);
        $(e).attr('data',1);
        $("body").append('<div class="hidden-close" onclick="CloseTopic()"></div>');
    }else{
        $(e).removeClass('active');
        $("#mega_menu").hide();
        $(e).attr('data',0);
    }
}
function Lang(e) {
    $(".i-tab").removeClass("active");
    $(".col-lang").hide();
    var data = $(e).attr("data");
    $(".i-lang-" + data).addClass("active");
    $(".col-" + data).show();

}

function DefaultLang() {

    $(".i-tab.active").each(function () {
        var data = $(this).attr("data");
        $(".col-" + data).show();
    });
}
function checkup(e) {
    var files = $('#' + e)[0].files;
    kt = k1 = k2 = k3 = k4 = 0;
    val = files[0].name.substr(-3).toLowerCase();
    val1 = files[0].name.substr(-4).toLowerCase();
    if (val != 'jpg')
        k1 = 1;
    if (val != 'png')
        k2 = 1;
    if (val != 'gif')
        k3 = 1;
    if (val1 != 'jpeg')
        k4 = 1;
    if (k1 + k2 + k3 + k4 == 4) {
        alert('Only support file JPG | GIF | PNG');
        return false;
    }
    $("." + e).html('');
    var reader = new FileReader();
    reader.onload = function (evt) {
        var img = '<img   src="' + evt.target.result + '"/>';
        $("." + e).append(img);
    }
    reader.readAsDataURL(files[0]);
}
function FormReg(e){
    var link=$(e).attr('data-url');
    var sucess=$(e).attr('data-su');
    var user_name=$("#id_username").val();
    var password=$("#id_password").val();
    var full_name=$("#id_fullname").val();
    var captcha=$("#captcha").val();
    var captcha_hide=$("#captcha-hide").val();
    var check=$('.buyer_id:checked').val();
    $.ajax({
        url: link,
        type: "POST",
        dataType: "json",
        data:{password:password,user_name:user_name,full_name:full_name,captcha:captcha,captcha_hide:captcha_hide,buyer_id:check},
        success: function (data) {
            if(data.v1==1) {
                alert(data.message_1);
            }else if(data.v2==1){
                alert(data.message_2)
            }else if(data.v3==1){
                alert(data.message_3)
            }else if(data.v4==1){
                alert(data.message_4)
            }else{
                alert(data.message_success);
                window.location.href=sucess;
            }
            //if (data.message_success==0) {
            //    alert(data.message);
            //}else{
            //    window.location.href=sucess;
            //}
        }
    }); //end ajax
}
function TabContent(e){
    var id=$(e).attr('data-id');
    $('.tab-detail-tutor li').removeClass('active');
    $(".content-detail").hide();
    $(e).addClass('active');
    $("#tab-"+id).show();
}
function CheckNotification(e){
    var id=$(e).attr('data-id');
    var url=$(e).attr('data-url');
    $.post(url,{id:id},function(){
        window.location.reload();
    })


}
function DeleteAjax(div) {
    var r = confirm("Bạn có muốn xóa mục này");
    if (r == false) {
        return false;
    } else {
        var url = $(div).attr("data");
        window.location.href = url;
    }
}
function ResetCapt(e){
    $.post(e,function(data){
       $("#load-captcha").html(data);
    });
}
function AddMore(e){
    var url=$(e).attr('data-url');
    var id=$(e).attr('data-show');
    $.post(url,function(data){
        $('.'+id).prepend(data);
    });


}
function DeleteMore(e){
    $(e).parent().remove();
}
function Slide_detail_product(){
    var sync1 = $(".slide-img .feature-img");
    var sync2 = $(".slide-img .slide-item");

    sync1.owlCarousel({
        singleItem : true,
        slideSpeed : 1000,
        navigation: false,
        pagination:false,
        singleItem : true,
        transitionStyle : "fade",
        afterAction : syncPosition,
        responsiveRefreshRate : 200,
    });

    sync2.owlCarousel({
        items : 3,
        itemsDesktop      : [1199,3],
        itemsDesktopSmall     : [979,3],
        itemsTablet       : [768,3],
        itemsMobile       : [479,3],
        pagination:false,
        navigation:true,
        navigationText:["<i class='fa fa-angle-left '></i>","<i class='fa fa-angle-right '></i>"],
        responsiveRefreshRate : 100,
        afterInit : function(el){
            el.find(".owl-item").eq(0).addClass("synced");
        }
    });

    function syncPosition(el){
        var current = this.currentItem;
        sync1
            .find(".owl-item")
            .removeClass("synced")
            .eq(current)
            .addClass("synced")
        if(sync2.data("owlCarousel") !== undefined){
            center(current)
        }
    }

    sync2.on("click", ".owl-item", function(e){
        e.preventDefault();
        var number = $(this).data("owlItem");
        sync1.trigger("owl.goTo",number);
    });

    function center(number){
        var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
        var num = number;
        var found = false;
        for(var i in sync2visible){
            if(num === sync2visible[i]){
                var found = true;
            }
        }

        if(found===false){
            if(num>sync2visible[sync2visible.length-1]){
                sync2.trigger("owl.goTo", num - sync2visible.length+2)
            }else{
                if(num - 1 === -1){
                    num = 0;
                }
                sync2.trigger("owl.goTo", num);
            }
        } else if(num === sync2visible[sync2visible.length-1]){
            sync2.trigger("owl.goTo", sync2visible[1])
        } else if(num === sync2visible[0]){
            sync2.trigger("owl.goTo", num-1)
        }

    }
}
function AddCartAjax(e){
    var id=$(e).attr('data-id');
    var  url=$(e).attr('data-url');

    $.ajax({
        url: url,
        type: "POST",
        data:{id:id,number:1},
        success: function (data) {
            if (data) {
                $("#notification,body").addClass('active');
                setTimeout(function(){
                    $("#notification,body").removeClass('active');
                    $("#num-cart").html("( "+data +" )");
                }, 1500);


            }
        }
    }); //end ajax
}
/**************************** cart *********************************/
function ButtonQuantity(e){

        var $button = $(e);
        var oldValue = $button.parent().find("input").val();
        var type=$button.parent().attr('data');
        if ($button.attr('data') == 1) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 1) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal =1;
            }
        }

        $button.parent().find("input").val(newVal);
        if(type==='cart'){
            AddNumber(e);
        }
}
function AddCartDetail(e){
    var id=$(e).attr('data-id');
    var  url=$(e).attr('data-url');
    var  url_cart=$(e).attr('data-cart');
    var number=$("#quantity option:selected").val();
    $.ajax({
        url: url,
        type: "POST",
        data:{id:id,number:number},
        success: function (data) {
            if (data) {
                window.location.href=url_cart;
            }
        }
    }); //end ajax
}
function AddNumber(e){
    var number=$(e).parent().find(".quantity").val();
    var id=$(e).parent().find(".quantity").attr("data-id");
    var url=$(e).parent().find(".quantity").attr('data-url');
    var url_ajax=$(e).parent().find(".quantity").attr('data-ajax');
    $.ajax({
        url: url,
        type: "POST",
        data:{id:id,qty:number},
        success: function (data) {
            if (data){
                $("#show-cart-ajax").load(url_ajax);

            }

        }
    }); //end ajax
}
//
function DeleteCart(e){
    var id=$(e).attr("data-id");
    var url=$(e).attr('data-url');
    var url_ajax=$(e).attr('data-ajax');
    $.ajax({
        url: url,
        type: "POST",
        data:{id:id,qty:0},
        success: function (data) {
            if (data){
                $("#show-cart-ajax").load(url_ajax);

            }

        }
    }); //end ajax
}