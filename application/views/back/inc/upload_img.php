<div class="col-xs-12">
    <div class="col_full fleft bs-example-bg-classes">
        <p class="bg-warning">- Bạn có thế chọn nhiều file cùng một lúc bằng cách giữ thêm phím Ctrl. Bạn có thể kéo thả để sắp xếp thứ tự sau khi ảnh được tải lên.<br>
            - Sau khi upload hình ảnh hoàn tất, bạn phải chọn một ảnh làm ảnh đại diện sản phẩm.</p>
    </div>
    <div class="row fileupload-buttonbar">
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn green  fileinput-button multiple-upload">
                                            <i class="fa fa-plus"></i>
                                            <span>
                                                Thêm nhiều ảnh...
                                            </span>
                                            <input type="file" name="files" multiple="" class="multiple-upload-file">
                                        </span>
            <button type="button" class="btn red delete">
                <i class="fa fa-times"></i>
                                            <span>
                                                Xóa nhiều ảnh
                                            </span>
            </button>
            <input type="checkbox" class="toggle hide">
            <!-- The global file processing state -->
                                        <span class="fileupload-process">
                                        </span>
        </div>
        <!-- The global progress information -->
        <div class="col-lg-5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar progress-bar-success" style="width:0%;">
                </div>
            </div>
            <!-- The extended global progress information -->
            <div class="progress-extended">
                &nbsp;
            </div>
        </div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped clearfix">
        <tbody class="files">
        </tbody>
    </table>
</div>

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <script id="template-upload" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-upload fade">
                    <td>
                    <span class="preview"></span>
                    </td>
                    <td>
                    <p class="name">{%=file.name%}</p>
                    {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                    </td>

                    <td>
                    {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                    <button class="btn blue start btn-sm">
                    <i class="fa fa-upload"></i>
                    <span>Tải lên</span>
                    </button>
                    {% } %}
                    {% if (!i) { %}
                    <button class="btn red cancel btn-sm">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                    </button>
                    {% } %}
                    </td>
                    </tr>
                    {% } %}


            </script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl">

                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                    <tr class="template-download fade">
                    <td>
                    <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                    </span>
                    </td>
                    <td class='hide'>
                    <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                    <input value="{%=file.id%}" name="image[]" type="hidden">
                    {% } %}
                    </span>
                    </td>

                    <td>
                    <p class="name">
                    {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                    <span>{%=file.name%}</span>
                    {% } %}
                    </p>
                    {% if (file.error) { %}
                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                    </td>
                     <td>

                     <input value="{%=file.alt%}" name="alt[]" type="text" >

                    </td>
                    <td>
                   <span class="preview">
                    {% if (file.primary) { %}
                    <input value="{%=file.id%}" name="primary" type="radio" checked>
                    {% } else { %}
                     <input value="{%=file.id%}" name="primary" type="radio" >
                    {% } %}
                    </span>
                    </td>
                    <td>
                    {% if (file.deleteUrl) { %}
                    <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="fa fa-trash-o"></i>
                    <span>Xóa</span>
                    </button>

                    {% } else { %}
                    <button class="btn yellow cancel btn-sm">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                    </button>
                    {% } %}
                    </td>
                    <td>
                    {% if (file.deleteUrl) { %}
                       <input type="checkbox" name="delete" value="1" class="toggle">

                     {% } %}
                    </td>
                    </tr>
                    {% } %}


            </script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<script src="<?php echo base_url() ?>themes/back/assets/scripts/custom/form-fileupload.js"></script>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link href="<?php echo base_url() ?>themes/back/assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>