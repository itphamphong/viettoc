<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
$file=$this->general->catalog();
if(file_exists('./uploads/file/'.$file->name))
	{
$this->load->helper('download');
$image_name = $source->hinh;
	$image_path ="./uploads/file/".$file->name;
	header('Content-Type: application/octet-stream');
	header("Content-Disposition: attachment; filename=".$file->name);
	ob_clean();
	flush();
	readfile($image_path);
	}else
	{
		 echo '
			<script>alert("File không tồn tại"); location.href="'.site_url().'";</script>
		';	
	}
?>

</body>
</html>