<?php
function paging($page,$total,$url,$id=1)
	{
		
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		//kiem tra
		
		
		$count=$total;
		$tongtrang=ceil($total/$page);
		$num="";
		
		if($count!=0)
		{
			if ($id >= 7) {
				$start_loop = $id - 4;
				if ($tongtrang > $id + 4)
					$end_loop = $id + 4;
				else if ($id <= $tongtrang && $id > $tongtrang - 6) {
					$start_loop = $tongtrang - 6;
					$end_loop = $tongtrang;
				} else {
					$end_loop = $tongtrang;
				}
			} else {
				$start_loop = 1;
				if ($tongtrang > 7)
					$end_loop = 7;
				else
					$end_loop = $tongtrang;
			}
		}
		
		
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $id > 1) {
			$dau = "<li  class='on'><a href='".site_url($url)."'>Đầu</a></li>";
		} else if ($first_btn) {
			$dau= "<li  class='off'> <a> Đầu</a></li>";
		}
		
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $id > 1) {
			$tam=$id-1;
			$lui = "<li class='on'><a href='".site_url($url. $tam)."'> &laquo;</a></li>";
		} else if ($previous_btn) {
			$lui = "<li class='off'><a>&laquo;</a></li>";
		}
		
		
		if ($next_btn && $id < $tongtrang) {
			$tam2=$id+1;
			$toi = "<li class='on'><a href='".site_url($url. $tam2)."'> &raquo; </a></li>";
		} else if ($next_btn) {
			$toi = "<li class='off'> <a>&raquo; </a></li>";
		}
		
		// TO ENABLE THE END BUTTON
		if ($last_btn && $id < $tongtrang) {
			$cuoi= "<li  class='on'><a href='".site_url($url.$tongtrang)."'> Cuối </a></li>";
		} else if ($last_btn) {
			$cuoi = "<li class='off'><a>Cuối</a></li>";
		}
		if($count>0)
		{
			for($i=$start_loop;$i<=$end_loop;$i++)
			{
				if($i==$id)
				$num.="<li class='p'><a>$i</a></li>";
				else
				$num.="<li class='on'><a href='".site_url($url . $i)."' title=''>$i</a></li>";
			}
		}
		if($count>0&&$tongtrang>1)
		$link=" 
		<ul class='pagination'>
            
			".$dau.$lui.$num.$toi.$cuoi."
			
		</ul>
			";
		else
		$link='';
		
		return $link;
		
}

function paging_ajax($page,$total,$url,$id=1)
	{
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		//kiem tra
		
		
		$count=$total;
		$tongtrang=ceil($total/$page);
		$num="";
		
		if($count!=0)
		{
			if ($id >= 7) {
				$start_loop = $id - 4;
				if ($tongtrang > $id + 4)
					$end_loop = $id + 4;
				else if ($id <= $tongtrang && $id > $tongtrang - 6) {
					$start_loop = $tongtrang - 6;
					$end_loop = $tongtrang;
				} else {
					$end_loop = $tongtrang;
				}
			} else {
				$start_loop = 1;
				if ($tongtrang > 7)
					$end_loop = 7;
				else
					$end_loop = $tongtrang;
			}
		}
		
		
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $id > 1) {
			$dau = "<li  class='on'><a href='".$url."#trang-". 1 ."'>Đầu</a></li>";
		} else if ($first_btn) {
			$dau= "<li  class='off'> <a> Đầu</a></li>";
		}
		
		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $id > 1) {
			$tam=$id-1;
			$lui = "<li class='on'><a rel='".$tam."' href='".$url."#trang-".$tam."'> Lùi</a></li>";
		} else if ($previous_btn) {
			$lui = "<li class='off'><a>Lùi</a></li>";
		}
		
		
		if ($next_btn && $id < $tongtrang) {
			$tam2=$id+1;
			$toi = "<li class='on'><a rel='".$tam2."' href='".$url."#trang-".$tam2."'> Tới </a></li>";
		} else if ($next_btn) {
			$toi = "<li class='off'> <a>Tới </a></li>";
		}
		
		// TO ENABLE THE END BUTTON
		if ($last_btn && $id < $tongtrang) {
			$cuoi= "<li  class='on'><a rel='".$tongtrang."' href='".$url."#trang-".$tongtrang."'> Cuối </a></li>";
		} else if ($last_btn) {
			$cuoi = "<li class='off'><a>Cuối</a></li>";
		}
		if($count>0)
		{
			for($i=$start_loop;$i<=$end_loop;$i++)
			{
				if($i==$id)
				$num.="<li class='p'><a>$i</a></li>";
				else
				$num.="<li class='on'><a rel='".$i."'  href='".$url."#trang-".$i."' title=''>$i</a></li>";
			}
		}
		if($count>0&&$tongtrang>1)
		$link=" 
		<ul class='pagination'>
            
			".$dau.$lui.$num.$toi.$cuoi."
			
		</ul>
			";
		else
		$link='';
		
		return $link;
		
}

function khongdau($fragment)
{
	$translite_simbols = array (
	'/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/',
	'/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/',
	'/(ì|í|ị|ỉ|ĩ)/',
	'/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/',
	'/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/',
	'/(ỳ|ý|ỵ|ỷ|ỹ)/',
	'/(đ)/',
	'/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/',
	'/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/',
	'/(Ì|Í|Ị|Ỉ|Ĩ)/',
	'/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/',
	'/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/',
	'/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/',
	'/(Đ)/',
	"/[^a-zA-Z0-9\-]/",
	'/(--)/',
	'/(---)/',
	'/(--)/',
	) ;
	$replace = array (
	'a',
	'e',
	'i',
	'o',
	'u',
	'y',
	'd',
	'A',
	'E',
	'I',
	'O',
	'U',
	'Y',
	'D',
	'-',
	'-',
	'-',
	'-',
	
) ;
	$fragment = preg_replace($translite_simbols, $replace, trim($fragment));
	$fragment = preg_replace('/( )+/', '-', $fragment);
	$tam=explode('-',$fragment);
	$count=count($tam);
	if($tam[$count-1]=="")
	$fragment=substr($fragment,0,-1);
	return $fragment; 
}

function yahoo($yahooid){

  $status = file_get_contents("http://opi.yahoo.com/online?u=$yahooid&m=a&t=1");

  if ($status == '00'){

return false;
  }
  elseif ($status == '01')
{
return true;
}
}

// dien thoai
	function check_null($text,$value)
	{
		if(trim($value)!='')
		echo "<tr><td width='30%'>$text</td><td>$value</td></tr>";
	}
	function title_pk($text)
	{
		echo "<tr class='title_ct'><td colspan='2'>$text</td></tr>";
	}
	function day()
	{
			$timezone  = +7; //(GMT +7:00) 
         	$date= gmdate("Y-m-d H:i:s", time() + 3600*($timezone+date("0")));
			return $date;
	}
	
	function swf_img($file,$w='',$h='')
	{
		$data=explode('.', basename($file));
		if($data[1]=='swf')
		echo '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" 
            width="'.$w.'" height="'.$h.'" >
              <param name="movie" value="'.$file.'" />
              <param name="quality" value="high" />
              <param name="wmode" value="transparent" />
              <embed src="'.$file.'" wmode="transparent" quality="high"
            pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"
            width="'.$w.'" height="'.$h.'">
            </embed>
            </object>';
		else 
		{
			if($w==''&&$h=='')
			echo '<img alt="image" src="'.$file.'" >';
			else if($h=='')
			echo '<img alt="'.$file.'" src="'.$file.'"  width="'.$w.'px">';
			else echo '<img alt="image" src="'.$file.'"  width="'.$w.'px" height="'.$h.'">';
		} 
	}
	
	function check_row($row)
	{
		if($row==0)
		return false;
		else 
		return true;
	}
	
	function subdomain()
	{
		$url =$_SERVER['HTTP_HOST'];
		$parsedUrl = parse_url($url);
		
		$host = explode('.', $parsedUrl['path']);
		return $host[0]; 
	}
?>