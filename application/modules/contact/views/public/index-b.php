<div class="clear h1"></div>
<div class="col_full fleft">
    <ul class="nav-bred">
        <li><a href="<?php echo site_url()?>"><?php echo $l->lang_home[$lang]?></a></li>
        <li><?php echo $l->lang_contact[$lang]?></li>
    </ul>
    <div class="clear h1"></div>
    <div class="content-left fleft">
        <h1 class="title col_full"> <?php echo $l->lang_contact[$lang]?></h1>
        <div class="content-detail fleft col_full">
            <div id="map-canvas" style="width:100%; height:400px; padding:0px; margin:0px"></div>
            <div class="clear h1"></div>
            <form action="" method="post" id="fcotact">
                <table width="100%">
                    <tr>
                        <td>
                            <label class="c-full_name"><?php echo $l->lang_full_name[$lang] ?> *</label>
                            <input  placeholder="<?php echo $l->lang_full_name[$lang] ?>" type="text" class="input" name="c-full_name"  value="<?php echo isset($user->full_name) ? $user->full_name : '' ?>"/>
                            <?php echo form_error("c-full_name") ?>
                        </td>
                        <td><div class="fleft" style="width: 20px"></div></td>
                        <td>  <label class="c-email"><?php echo "Email *" ?></label>
                            <input  placeholder="Email" type="text" class="input" name="c-email" value="<?php echo isset($user->email) ? $user->email : '' ?>"/>
                            <?php echo form_error("c-email") ?>
                        </td>
                    </tr>
                </table>
                <div class="clear h1"></div>
                <table width="100%">
                    <tr>
                        <td width="65%"><label class="c-title"><?php echo $l->lang_title_contact[$lang] ?> *</label>
                            <input  placeholder="<?php echo $l->lang_title_contact[$lang] ?>" type="text" class="input" name="c-title" />
                            <?php echo form_error("c-title") ?></td>
                    <td><div class="fleft" style="width: 20px"></div></td>
                    <td>
                        <label class="c-title"><?php echo $l->lang_phone[$lang] ?> *</label>
                        <input  placeholder="<?php echo $l->lang_phone[$lang] ?>" type="text" class="input" name="c-phone" />
                        <?php echo form_error("c-phone") ?>
                    </td>
                    </tr>
                    </table>
                <div class="clear h1"></div>
                <label class="c-content"><?php echo $l->lang_content[$lang] ?> *</label>
                <textarea class="input" placeholder="<?php echo $l->lang_content[$lang] ?>" name="c-content"></textarea>
                <?php echo form_error("c-content") ?>
                <div class="clear h1"></div>
                <div class="btn-accept mtop1 text-center" onclick="$jq('#submit').trigger('click')"><?php echo $l->lang_send[$lang] ?></div>
                <div class="round-btn" style="display: none"><input id="submit" type="submit" class="btn" value="<?php echo $l->lang_update[$lang] ?>" name="ok"></div>
            </form>
        </div>

    </div>
    <div class="content-right fright">
        <div class="col-box fleft  col_full">
            <div class="title fleft col_full">DỊCH VỤ</div>
            <div class="clear h1"></div>
            <ul class="list-right">

                <li><a href="<?php echo site_url($lang."/".$dv->term_link)?>"><?php echo $dv->name?></a></li>
                <li><a href="<?php echo site_url($lang."/".$hm->term_link)?>"><?php echo $hm->name?></a></li>
            </ul>
        </div>
        <div class="col-box fleft  col_full">
            <div class="title fleft col_full">THƯ VIỆN</div>
            <div class="clear h1"></div>
            <ul class="list-right">
                <li><a href="#">Xem Catalogue Nhật Minh</a></li>
                <li><a href="<?php echo site_url($lang."/".$hs->term_link)?>"><?php echo $hs->name?></a></li>

            </ul>
        </div>
        <?php $this->load->view("article/public/form_idea")?>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        initialize();
        codeLatLng();
    });
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(10.775001, 106.702148);
        var mapOptions = {
            zoom: 10,
            center: latlng
        }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var myLatlng = new google.maps.LatLng(-25.363882,131.044922);

    }
    function codeLatLng() {
        var input='<?php echo str_replace("(","",str_replace(")","",$info->LangLoc))?>';
        var latlngStr = input.split(',', 2);
        var lat = parseFloat(latlngStr[0]);
        var lng = parseFloat(latlngStr[1]);
        var latl = new google.maps.LatLng(lat,lng);
        geocoder.geocode({'latLng': latl}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(latl);
                map.setZoom(15);
                var marker = new google.maps.Marker({
                    position: latl,
                    map: map,
                    draggable: true,
                    title:'<?php echo $info->map?> '
                });

                var infowindow = new google.maps.InfoWindow({
                    content: "<p class='col_full fleft'><?php echo $info->map?></p>"
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });
                // Javascript//
                google.maps.event.addListener(marker, 'dragend', function(evt){
                    document.getElementById('LangLoc').value =+ evt.latLng.lat().toFixed(6) + ', ' + evt.latLng.lng().toFixed(6);
                });
            } else {
                alert('Geocoder failed due to: ' + status);
            }
        });
    }
</script>