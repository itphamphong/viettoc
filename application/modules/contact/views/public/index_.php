<section id="form-contact">
    <h3>Liên hệ với chúng tôi</h3>

    <div class="row">
        <div class="twelve">
            <div class="col-12">
                <?php
                echo form_error("c-full_name");
                echo form_error("c-phone");
                echo form_error("c-address");
                echo form_error("c-email");
                echo form_error("c-content");
                ?>
                <?php
                $this->load->view('front/inc/messager', array('type_messager' => $this->input->get('messager')));
                ?>
            </div>
            <div class="col-12">
                <div class="form">
                    <form action="" method="post" id="fcotact">
                        <input type="hidden" name="_token" value="sBnaPU8F8jO19e7JxBdX1CzH8MC4L28woiff7mdS">

                        <div class="col-6"><input class="hoten" name="c-full_name" placeholder="<?php echo $l->lang_full_name[$lang] ?>" value="<?php echo set_value('c-full_name')?>"></div>
                        <div class="col-6"><input class="dienthoai" name="c-phone" placeholder="<?php echo $l->lang_phone[$lang] ?>" value="<?php echo set_value('c-phone')?>"></div>
                        <div class="col-6"><input class="address" name="c-address" placeholder="<?php echo $l->lang_address[$lang]?>" value="<?php echo set_value('c-address')?>"></div>
                        <div class="col-6"><input class="email" name="c-email" placeholder="Email" value="<?php echo set_value('c-email')?>"></div>
                        <div class="col-full"><textarea class="noidung" name="c-content" placeholder="<?php echo $l->lang_content[$lang] ?>"><?php echo set_value('c-content')?></textarea>
                            <button class="button" type="submit" name="ok"><?php echo $l->lang_send_require[$lang]?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="maps">
    <div class="row">
        <div class="twelve">
            <div class="col-12">
                <div class="col-full">
                    <div id="map-canvas" style="width:100%; height:450px; padding:0px; margin:0px"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="info-contact">
    <div class="row">
        <div class="twelve">
            <div class="col-12">
                <div class="col-6">
                    <i class="fa fa-industry"></i>
                    <?php echo $info->note?>
                </div>
                <div class="col-6">
                    <i class="fa fa-building-o"></i>
                    <?php echo $info->note_2?>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="address">
    <div class="row">
        <div class="twelve">
            <div class="col-12">
                <div class="col-full">
                    <img src="<?php echo base_url()?>uploads/background/<?php echo $info->bg1 ?>">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- about-us -->
<?php echo modules::run('article/article/loadAbout',$lang); ?>
<!--end about-us-->
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