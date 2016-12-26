<textarea id="<?php echo $name ?>" name="<?php echo $name ?>"><?php echo set_value($name,(isset($value)?$value:""))?></textarea>
<script type="text/javascript">
    CKEDITOR.replace('<?php echo $name ?>', {height: 350, width: "100%", resize_enabled: true,
        filebrowserBrowseUrl: '<?php echo base_url() ?>editor/find/ckfinder.html',
        filebrowserImageBrowseUrl: '<?php echo base_url() ?>editor/find/ckfinder.html',
        filebrowserFlashBrowseUrl: '<?php echo base_url() ?>editor/find/ckfinder.html?Type=Flash',
        filebrowserUploadUrl: '<?php echo base_url() ?>editor/find/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: '<?php echo base_url() ?>editor/find/core/connector/php/connector.php?command=QuickUpload&type=Images',
    });
    function up() {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }

</script>
