<div class="col-center" id="tutor-singin">
    <div class="clear hg1"></div>
    <div id="form-signin-location">
        <div class="users-col-left">
            <?php $this->load->view('users/public/block_col_left') ?>
        </div>
        <div class="users-col-right">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="col-xs-6 center-block" style="float: none">
                    <hr>
                    <p class="title-price">Chi phí mỗi khóa học</p>
                    <?php
                    $x=1;
                    foreach($list as $row){
                        $tmp=$this->global_function->get_tableWhere(array("users_id" =>$user->id,'utility_id'=>$row->id),"users_price",'*');
                        $type_teach=explode(',',$user->type_teach);
                        ?>
                        <label class="text-transform"><?php echo $row->name?></label>
                        <div class="form-group">
                            <i>Giá</i><br>
                        <input type="text" class="text-input large-input" placeholder="Giá" name="price[]" value="<?php echo isset($tmp->price)?$tmp->price:0?>">
                        <input type="hidden" name="id[]" value="<?php echo $row->id?>">
                    </div>
                    <?php $x++;}?>
                    <div class="clear hg1"></div>
                    <hr>
                    <p class="title-price">Chi phí mỗi giờ</p>
                    <input class="price_hours text-input" value="<?php echo $user->price_hours?>" name="price_hours">(usd)/1h
                    <div class="clear hg1"></div>
                    <hr>
                    <p class="title-price">Hình thức giảng dạy</p>
                    <ul class="type-teach">
                        <li><input type="checkbox" name="type_teach[]" id="tOnline" value="1" <?php if(in_array('1', $type_teach,true)) echo 'checked'?> ><label for="tOnline">Online</label></li>
                        <li>
                            <input type="checkbox" name="type_teach[]" id="tIn-hous" value="2" <?php if(in_array('2', $type_teach,true)) echo 'checked'?>><label for="tIn-hous">In-house</label>
                        </li>
                        <li>
                            <input type="checkbox" name="type_teach[]" id="tIn-class" value="3" <?php if(in_array('3', $type_teach,true)) echo 'checked'?>><label for="tIn-class">In-class</label>
                        </li>
                    </ul>
                    <div class="clear hg1"></div>
                    <i>Ngành nghề chính</i><br>
                    <textarea type="text" class="text-input large-input no_bg" placeholder="Ngành nghề chính" name="major"><?php echo $user->major?></textarea>

                    <div class="clear hg1"></div>
                    <div class="form-group">
                        <a class="i-btn btn-continue" onclick="$('#btn-singup').trigger('click')">Cập nhật</a>
                        <input type="submit" class="hide" name="ok" id="btn-singup">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>