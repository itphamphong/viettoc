$(document).ready(function () {
    $(window).scroll(function(){
        if($(window).scrollTop()>600){
            $("#scroll_top").fadeIn();
        }else{
            $("#scroll_top").fadeOut();
        }
    });
    $(".parent a").click(function () {
        $(this).parent().find(".sub").slideToggle();
    });
    $("#checkboxall").click(function () {
        var checked_status = this.checked;
        $("input[class='checkall']").each(function () {
            this.checked = checked_status;
            if(checked_status==true) {
                $(".tr-product .checker span").addClass("checked");
                $(".tr-product .checkall").attr("checked",true);
            }else{
                $(".tr-product .checker span").removeClass("checked");
                $(".tr-product .checkall").removeAttr("checked");
            }
        });
    });
    Autoheight();

});
// Language
function DefaultLang(){
    $(".i-tab.active").each(function(){
        var data=$(this).attr("data");
        $(".col-"+data).show();
    });
}
function Autoheight(){
    var h1=$("#col-left").height();
    var h2=$("#col-right").height();
    if(h1>h2){
        //$("#col-right").height(h1);
    }else{
        //$("#col-left").height(h2);
    }
}
function Alert(e) {
    var r = confirm("Bạn có muốn xóa mục này");
    if (r == false) {
        return false;
    } else
        window.location = (e);

}

function Delete() {
    var r = confirm("Bạn có muốn xóa mục này");
    if (r == false) {
        return false;
    } else {
        $(".a_delete").trigger('click');
    }

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
function Active(e){
var url=$(e).attr("data-url");
    var id=$(e).attr("data-id");
    var active=$(e).attr("data");
    $.post(url,{id:id,active:active},function(){
        window.location.reload();
    })
}
function ActiveNoLoad(e){
    var url=$(e).attr("data-url");
    var id=$(e).attr("data-id");
    var active=$(e).attr("data");
    $.post(url,{id:id,active:active},function(){
        if(active==0){
            $(e).parent().find(".status").hide();
            $(e).parent().find('.no-status').show();
        }else{
            $(e).parent().find(".status").show();
            $(e).parent().find('.no-status').hide();
        }
    })
}
function ActiveModules(e){
    var value="";
    var check=$(e).parent().parent().parent().find(".checkbox input");
    for(var i=0;i < check.length;i++){
        if(check[i].checked){
            value+=check[i].value+",";
        }

    }
    var url=$(e).attr("data-url");
    var id=$(e).attr("data-id");
    var active=$(e).val();
    $.post(url,{id:id,active:value},function(){

    })
}
function ReModules(e){
    var url=$(e).attr("data-url");
    var id=$(e).attr("data-id");
    var active=$(e).attr('data');
    $.post(url,{id:id,active:active},function(){
        $(e).parent().parent().remove();
    })
}
// cap nhat so luong
function ChangeW(e){
    $(e).hide();
    $(e).parent().find(".weight").show();
    $(".tr-product .checker span").addClass("checked");
    $(".tr-product .checkall").attr("checked",true);
}
function ChangeP(e){
    $(e).hide();
    $(e).parent().find(".price").show();
    $("td .checkall").attr("checked",true);
}
function PAll(){
    $(".check_permission").attr("checked",true);
}
function DAll(){
    $(".check_permission").attr("checked",false);
}
function ChoseLink(e){
    if(e==1){
        $(".chose_file").show();
        $(".link_file").hide()
    } else{
        $(".link_file").show();
        $(".chose_file").hide();
    }
}
function Menu() {
    var e=$(".menu_type:checked").val();
    var data=$(".i-tab.active").attr("data");
    $(".link").hide();
    if (e == 1) {
        $(".modules").show();
    }else if(e==2){
        $(".uri_link.col-"+data).show();
    }else{
        $(".blank_link.col-"+data).show();
    }
}
function Sroll(){
    $('html, body').animate({
        scrollTop:0
    }, 2000);
}
function FormKm(url){
    $('#show_list_places').append('<tr id="ploading"><td colspan="4"><div id="loading"></div></td>');
    $.ajax({
        url: url,
        type: 'POST',
        data:$("#formkm").serialize(),
        success: function(data){
            $('#show_list_places').html(data);
            $("#ploading").remove();
        }
    });
}

/*function DeleteAjax(e){
    $('#show_list_places').append('<tr id="ploading"><td colspan="4"><div id="loading"></div></td>');
    $.ajax({
        url: $(e).attr('data-href'),
        type: 'GET',
        cache: false,
        success: function(data){
           $(e).parent().parent().remove();
            $("#ploading").remove();

        }
    });
}*/
function EditAjax(e){
    $(e).parent().parent().find('td p').hide();
    $(e).parent().parent().find('td .form-control').show();
    $(e).hide();
    $(e).parent().find('.btn_update').show();
}
// update  gia phong ngay le
function UpdateAjax(e){

    var price_room=$(e).parent().parent().parent().find('.price_room').val();
    var price_bed=$(e).parent().parent().parent().find('.price_bed').val();
    var start_date=$(e).parent().parent().parent().find('.start_date').val();
    var id= $(e).attr('data-id');
    $(e).parent().parent().parent().html('<td colspan="6" id="ploading"><div id="loading"></div></td>');
    $.ajax({
        url: $(e).attr('data-url'),
        type: 'POST',
        data: {id:id,price_room: price_room,price_bed:price_bed,start_date:start_date},
        success: function(data){
            $("#ploading").parent().html(data);
            $("#ploading").remove();
        }
    });
}
function CancelAjax(e){
    $(e).parent().parent().parent().find('td p').show();
    $(e).parent().parent().parent().find('td .dhide').hide();
    $(e).parent().parent().find('.btn_edit').show();
}
// add gia phong ngay le
function FormRoomHoliday(url){
    var date=$('#formkm input[name="start_date"]').val();
    var price_room=$('#formkm input[name="price_room"]').val();
    var price_bed=$('#formkm input[name="price_bed"]').val();
    if(date==''){
        alert('Vui lòng nhập ngày !');
    }else if( $.isNumeric(price_room) == false){
        alert("Giá phòng phải là dạng số !");
    }else if( $.isNumeric(price_bed) == false){
        alert("Giá giường phụ phải là dạng số !");
    }else {
        $('#show_list_places').append('<tr id="ploading"><td colspan="4"><div id="loading"></div></td>');
        $.ajax({
            url: url,
            type: 'POST',
            data: $("#formkm").serialize(),
            success: function (data) {
                $('#show_list_places').html(data);
                $("#ploading").remove();
            }
        });
    }
}
// add loai phong khuyen mai
function FormRoomSale(url){
    var price=$('#form_room_sale input[name="price"]').val();
    var number=$('#form_room_sale input[name="number"]').val();
    var name=$('#form_room_sale .name').val();
    if(name==''){
        alert('Vui lòng nhập ngày !');
    }else if( $.isNumeric(price) == false){
        alert("Giá phòng phải là dạng số !");
    }else if( $.isNumeric(number) == false){
        alert("Số người không đúng định dạng");
    }else {
        $('#show_room_sale_edit').append('<tr id="ploading"><td colspan="4"><div id="loading"></div></td>');
        $.ajax({
            url: url,
            type: 'POST',
            data: $("#form_room_sale").serialize(),
            success: function (data) {
                $('#show_room_sale_edit').html(data);
                $("#ploading").remove();
            }
        });
    }
}
function UpdateAjaxForm(e){
    var id= $(e).attr('data-id');
    var data=$("#form_room_sale_edit .tr-"+id).find('input').serialize();
    $(e).parent().parent().parent().html('<td colspan="6" id="ploading"><div id="loading"></div></td>');
    $.ajax({
        url: $(e).attr('data-url'),
        type: 'POST',
        data:data,
        success: function(data){
            $("#ploading").parent().html(data);
            $("#ploading").remove();
        }
    });
}
 function ShowDate(e){
     $(".day_of_week").hide();
     $("#"+e).fadeIn(500);
     jQuery('#with-altField').multiDatesPicker({
         altField: '#altField'
     });
 }
// Chon diem den trong nuoc || ngoai nuoc
function ChangeDestination(e){
    var id=$(e).val();
    if(id!=0){
        $(".destination_id").not(e).val(0);
        $(".destination_id").not(e).removeAttr('name');
        $(e).attr("name","destination_id");
    }
}
function EditChangeDestination(){
    var e=$('.destination_id option:selected');
    $(".destination_id option:selected").each(function () {
        var id=$(this).val();
        if(id >0){
            $(this).parent().attr("name","destination_id");
        }
    });
}
function BrowseServer(startupPath, functionData) {
    var finder = new CKFinder();
    finder.basePath = 'editor/';
    finder.startupPath = startupPath;
    finder.selectActionFunction = SetFileField;
    finder.selectActionData = functionData;
    finder.selectThumbnailActionFunction = ShowThumbnails;
    finder.popup();
}
function SetFileField(fileUrl, data) {
    document.getElementById(data["selectActionData"]).value = fileUrl;
    var img = '<img class="avatar" src="' + fileUrl + '"/>';
    $('.show-img-'+data["selectActionData"]).html("");
    $('.show-img-'+data["selectActionData"]).append(img);
}
function ShowThumbnails(fileUrl, data) {
    var sFileName = this.getSelectedFile().name; // this = CKFinderAPI
    document.getElementById('thumbnails').innerHTML +=
        '<div class="thumb">' +
        '<img src="' + fileUrl + '" />' +
        '<div class="caption">' +
        '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
        '</div>' +
        '</div>';
    document.getElementById('preview').style.display = "";
    return true;
}
function AddColor(){
    $("#ajax-color").append(' <div class="i-tags"> <div class="col-xs-10" style="padding-left: 0px"> <input type="text" name="color[]" class="form-control tag-size" >  <input type="file" name="pic[]"> <input type="hidden" name="old[]" value="NULL"> </div> <div class="col-xs-2"> <i class="fa  fa-minus-circle" onclick="$(this).parent().parent().remove()"></i> </div> </div>');
}
function DeleteTmp(e){
    var cate_id=$(e).attr('data-id');
    var tmp_id=$(e).attr('data-tmp-id');
    var value=$(e).attr('data-value');
    var url=$(e).attr('data-url');
    $.post(url,{cate_id:cate_id,tmp_id:tmp_id,value:value},function(data){
        if(data==1){
            $(e).parent().parent().remove();
        }
    });
}


function DeletePic(e){
    var url=$(e).attr('data-url');
    $.post(url,function(){
        $(e).parent().remove();
    });
}
function DeleteColor(e){
    var url=$(e).attr('data-url');
    $.post(url,function(data){
        $(e).parent().parent().remove();
    });
}
function ChangeChoseUpload(e){
    var data=$(e).attr('data-class');
    if($(e).val()==1){
        $('.'+data).find('.chose_computer').show();
        $('.'+data).find('.chose_web').hide();
    }else{
        $('.'+data).find('.chose_web').show();
        $('.'+data).find('.chose_computer').hide();
    }
}
function LoadChangeChoseUpload(){
    $(".radio-list .radio:checked").each(function () {
        var id=$(this).val();
        var data=$(this).attr('data-class');
        if(id==1){
            $('.'+data).find('.chose_computer').show();
            $('.'+data).find('.chose_web').hide();
        }else{
            $('.'+data).find('.chose_web').show();
            $('.'+data).find('.chose_computer').hide();
        }
    });
}
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
        h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
function ChangeChoseUploadDefault(e){
    var data=$(e).attr('data-value');
    $(".choose").removeClass('active');
    $("."+data).addClass('active');


}
function Load_Font_Awesome(){
    $("#load_font_awesome").fadeIn();
}
function Load_Font_Awesome_Edit(){
    $("#load_font_awesome_edit").fadeIn();
}
function Font_awesome(e){
    var data=$(e).attr('data');
    $('.i-font_awesome').removeClass('active');
    $(e).addClass('active');
    $("#load_font_awesome").fadeOut();
    $(".show-img-Awesome").html('<i class="'+data+'"></i>');
    $("#picture_Awesome").val(data);

}
function Font_awesome_edit(e){
    var data=$(e).attr('data');
    $('.i-font_awesome').removeClass('active');
    $(e).addClass('active');
    $("#load_font_awesome_edit").fadeOut();
    $(".show-img-Awesome-edit").html('<i class="'+data+'"></i>');
    $("#icon").val(data);

}
function numberWithCommas(n) {
    var parts=n.toString().split(".");
    return parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".") + (parts[1] ? "," + parts[1] : "");
}
// * video */
function LoadCity(e){
    var id=$("#country_id option:selected").val();
    var url=$('#country_id').attr('data-url');
    $.post(url,{id:id},function(data){
        $('#city_id').html(data);
    });
}
function LoadSearch(e){
    var url=$(e).attr('data-url');
    $.ajax({
        url: url,
        type: 'POST',
        data:$("#form-location").serialize(),
        success: function(data){
            $('#load-ajax-location').html(data);
        }
    });
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
function ChangeAjax(e){
    var url=$(e).attr('data');
    $.post(url,function(data){
       alert(data);
    });
}
function AddMoreFile(){
    var html='';
    html+='<div class="col-xs-12">';
    html+=' <div class="pull-left"> <i class="fa  fa-minus-circle" onclick="$(this).parent().parent().remove()"></i> </div>';
    html+='<div class="col-xs-2">';
    html+='<input type="file" name="doc[]">';
    html+='</div>';
    html+='<div class="col-xs-6">';
    html+='<div class="input-group col-xs-6">';
    html+='<span class="input-group-addon">Tên file</span>';
    html+='<input type="text" class="form-control" name="name_doc[]" placeholder="Nhập tên file hiển thị">';

    html+='</div>';
    html+='<div class="clear h1"></div>';
    html+='</div>';
    html+='<div class="clear"></div>';
    html+='  <input type="hidden" name="doc_id[]" value="1">';
    html+='</div>';

    $(".round-file").append(html);
}
function ChangeUrl(e){
    var item_link_url=$(e).attr('data-url');
    var link=$("#link-change-url").val();
    var url=$(e).val();
    $.post(link,{value:url},function(data){
        $(item_link_url).val(data);
    });

}