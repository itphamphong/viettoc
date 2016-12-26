<?php
$this->load->view('back/inc/messager', array('type_messager' => $this->input->get('messager')));
?>
<div class="contentcontainer med left">
    <div class="headings altheading"><h2>Thêm mới</h2></div>
    <div class="contentbox">
        <p  style="float: right"><?php $this->load->view("back/inc/menu_lang") ?></p>
        <form name="them" method="post" id="them" action="" enctype="multipart/form-data">
            <!-- -----------------Danh muc theo ngon ngu------------------------------- -->
            <?php
            foreach ($this->general->show_list_lang() as $lang) {
                $name = $this->input->post("name_" . $lang->name);
                ?><!-- languages -->
                <p class="div_lang <?php echo $lang->name ?>" >
                    <label for="textfield"><strong>Tên Loại</strong></label>
                    <input type="text" id="textfield"	class="inputbox" name="name_<?php echo $lang->name ?>" value="<?php if (isset($name) && $name != '') echo $name;
            else echo "Updating..." ?>" /><img  src="theme_admin/img/flag/<?php echo $lang->picture ?>"/>                          
                </p>
            <?php } ?><!-- languages -->
            <?php foreach ($this->general->show_list_lang() as $lang) { ?><!-- languages -->
                <?php echo form_error('name_' . $lang->name); ?>
<?php } ?>
            <!-- -------------------Set vi tri----------------------------------------- -->
            <p>
                <label for="smallbox"><strong>Thứ Tự: </strong></label>
                <input type="text" name="weight"  value="1" style="width: 30px; text-align: center" class="inputbox">
                <br>
                <span class="smltxt">(Số thứ tự càng lớn, độ ưu tiên càng cao)</span>
            </p>
            <p>
                <input type="radio" value="1" name="status" checked>Hiển thị bài
                <input type="radio" value="0" name="status">Ẩn bài
            </p>
            <!-- ---------------------------------------------------------------------- -->
            <input type="submit" value="Thêm mới" name="ok" class="" />
        </form>
    </div><!-- end contentbox -->
</div>