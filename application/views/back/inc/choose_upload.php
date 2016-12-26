<?php if (isset($choose)) {
    $upload = $choose;

} else {
    $upload = 1;

} ?>
<div class="clear he1"></div>
<div class="col-xs-12">
    <p class="sub-title">
        <i class="fa fa-gg-circle"></i>HÌNH ĐẠI DIỆN
    </p>
</div>
<div class="col_full fleft bs-example-bg-classes col-xs-12">
    <p class="bg-warning">- Chọn 1 trong 3 hình thức : Chọn ảnh từ máy, Chọn ảnh từ thư viện, Chọn ảnh dạng biểu tượng Font-Awesome</p>
</div>

<div class="clear he1"></div>
<div class="col-xs-12">
    <div class="radio-list">

        <label class="col-xs-4">
            <div class="radio">
                <span><input data-class='upload-round' data-value="choose_computer" onchange="ChangeChoseUploadDefault(this)" type="radio" name="optionsRadio" value="1"
                        <?php if ($upload == 1) echo 'checked' ?> ></span>
            </div>
            Chọn ảnh từ máy tính
        </label>
        <label class="col-xs-4">
            <div class="radio" id="uniform-optionsRadios2">
                                            <span>
                                                <input <?php if ($upload == 2) echo 'checked' ?> data-class='upload-round' data-value="choose_galary"
                                                                                                 onchange="ChangeChoseUploadDefault(this)" type="radio"
                                                                                                 name="optionsRadio" value="2">
                                            </span>
            </div>
            Chọn ảnh từ thư viện
        </label>
        <label class="col-xs-4">
            <div class="radio" id="uniform-optionsRadios2">
                                            <span>
                                                <input <?php if ($upload == 3) echo 'checked' ?> data-class='upload-round' data-value="choose_Awesome"
                                                                                                 onchange="ChangeChoseUploadDefault(this)" type="radio"
                                                                                                 name="optionsRadio" value="3">
                                            </span>
            </div>
            Font-Awesome
        </label>
    </div>
    <div class="clear h1"></div>
    <div class="col-xs-4 choose choose_computer <?php if ($upload == 1) echo 'active' ?>">
        <div class="round-hide"></div>
        <div class="form-group last">
            <div class="col-md-9">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                        <?php if ($upload == 1 && isset($picture)) {?>
                            <img src="<?php echo base_url() ?>uploads/Images/<?php echo $folder ."/".$picture?>" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';"  alt=""/>
                        <?php }else{?>
                        <img src="<?php echo base_url() ?>themes/back/images/text.png" alt=""/>
                        <?php }?>
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                    </div>
                    <div>
													<span class="btn default btn-file">
														<span class="fileinput-new">
															 Chọn ảnh từ máy tính
														</span>
														<span class="fileinput-exists">
															 Change
														</span>
														<input type="file" name="picture">
													</span>
                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                            Xóa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-4 choose choose_galary <?php if ($upload == 2) echo 'active' ?>">
        <div class="round-hide"></div>
        <input type="hidden" name="picture_galary" id="picture" class="txt" value="<?php echo isset($picture)?$picture:""?>"/>
        <div class="show-img show-img-picture thumbnail" style="width: 200px; height: 150px;">
            <?php if ($upload == 2) {?>
                <img src="<?php echo base_url()?><?php echo $picture?>" onerror="this.src='<?php echo base_url()?>themes/back/images/text.png';" alt=""/>

            <?php }else{?>
            <img src="<?php echo base_url() ?>themes/back/images/text.png" alt=""/>
            <?php }?>
        </div>
        <input onclick="BrowseServer('Images:/', 'picture')" type="button" name="btnChonFile" id="btnChonFile"
               value="Chọn ảnh từ thư viện" class="btn"/>
    </div>
    <div class="col-xs-4 choose choose_Awesome <?php if ($upload == 3) echo 'active' ?>">
        <div class="round-hide"></div>
        <div class="show-img show-img-Awesome thumbnail" style="width: 200px; height: 150px;">
            <?php if ($upload == 3) {?>
            <i class="<?php echo $picture?>"></i>
            <?php }else{?>
                <img src="<?php echo base_url() ?>themes/back/images/text.png" alt=""/>
            <?php }?>
        </div>
        <input type="hidden" name="picture_Awesome" id="picture_Awesome" value="<?php echo isset($picture)?$picture:""?>">
        <input type="button" class="btn" value="Chọn ảnh từ Font-Awesome" onclick="Load_Font_Awesome()">
    </div>
    <div class="clear h1"></div>
    <div class="col-xs-12" id="load_font_awesome">
        <ul>
            <?php foreach ($this->global_function->list_tableWhere(array("id !=" => 0), 'font_awesome') as $font_awesome) { ?>
                <li class="i-font_awesome" data="<?php echo $font_awesome->value ?>" onclick="Font_awesome(this)"><i class="<?php echo $font_awesome->value ?>"></i></li>
            <?php } ?>
        </ul>
    </div>

<input type="hidden" name="old_pic" value="<?php echo isset($picture)?$picture:""?>">
</div>