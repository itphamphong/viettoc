<div class="col_full fleft">
    <div class="col-xs-6">
        <p class="i-note">Lưu ý: Những dữ liệu có dấu * là bắt buộc</p>
    </div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin")) ?>
    <div class="clear he1"></div>
    <div class="col_full fleft bs-example-bg-classes">
    </div>
    <div class="clear he1"></div>
    <div class="col-lx-12 pr0">
        <form class="form-horizontal" id="fileupload" method="post" enctype="multipart/form-data">
            <?php $this->load->view("back/inc/menu_lang") ?>
            <div class="col_full fleft info-item">
                <div class="title col_full fleft">BẢN ĐỒ</div>
                <div class="clear he1"></div>
                <div class="col-xs-12">
                    <?php foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $row = $this->general->show_company($lang->name);
                        ?>

                        <div class="form-group col-lang col-lang col-<?php echo $lang->name ?>">
                            <label class="col-xs-2 control-label normal">Thông tin liên hệ</label>
                            <div class="col-sm-10">
                                <?php $this->load->view("back/inc/editor_small", array("name" => "info_contact_" . $lang->name, 'value' => isset($row->info_contact) ? $row->info_contact : "")) ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-xs-12">

                    <div class="form-group">
                        <label class="col-xs-2 control-label normal">Bản đồ</label>

                        <div class="col-sm-10">
                            <div style="float:left; height:50px; width: 90%">
                                <input style="width: 100%" onchange="codeAddress(this)" name="map"
                                       onblur="if (this.value == '') this.value = 'Updating...';"
                                       onfocus="if (this.value == 'Updating...') this.value = '';"
                                       value="<?php echo $info->map ?>" type="text" id="textfield"
                                       class="inputbox address_input form-control">
                            </div>
                            <input style="margin-bottom:13px;" type="button" value="Xem" onclick="codeAddress(this)"
                                   class="btn click_d" value="Xem"/>
                            </p>
                            <div id="map-canvas" style="width:100%; height:400px; padding:0px; margin:0px;"></div>
                            <input type="hidden" id="LangLoc" name="LangLoc" value="<?php echo $info->LangLoc?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="clear he1"></div>
            <?php $this->load->view("back/inc/list_hide_button") ?>

        </form>
    </div>
    <div class="clear he3"></div>
    <?php $this->load->view("back/inc/list_button", array("link" => "admin/company")) ?>
    <div class="clear he3"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
    $(document).ready(function(){
        initialize();
        codeAddressEdit();

    })
    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(10.8230989, 106.6296638);
        var mapOptions = {
            zoom: 10,
            center: latlng
        }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var myLatlng = new google.maps.LatLng(-25.363882,131.044922);

    }
    function codeAddress() {

        var address = $(".address_input").val();
        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                map.setZoom(15);
                //////////Info window/////////////////////////////////////////////////
                var infowindow = new google.maps.InfoWindow({
                    content: address
                });
                var marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    title: address
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });
                /////////End info window//////////////////////////////////////////////
                $('html, body').animate({
                    scrollTop: $("#map-canvas").offset().top
                }, 2000);
                $("#LangLoc").val(results[0].geometry.location);
            } else {
                alert('Geocode was not successful for the following reason:' + status);
            }
        });
        google.maps.event.addDomListener(window, 'load', initialize);
    }
    function codeAddressEdit() {
        var address = $(".address_input").val();
        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                map.setZoom(15);
                //////////Info window/////////////////////////////////////////////////
                var infowindow = new google.maps.InfoWindow({
                    content: address
                });
                var marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    title: address
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });
                /////////End info window//////////////////////////////////////////////

                $("#LangLoc").val(results[0].geometry.location);
            } else {
                alert('Geocode was not successful for the following reason:' + status);
            }
        });
    }
    //google.maps.event.addDomListener(window, 'load', initialize);
    ///////////////////////////////////////////////////////////
</script>