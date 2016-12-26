<?php

class Global_function extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));
        //if($this->uri->segment(1) == 'en') { redirect(base_url()) ;}
    }
    // get logo
    function get_img_company($name){
        $this->db->where(array("company_id" => 1, "status" => 1,'menu'=>'site','name'=>$name));
        $this->db->from('company_extra');
        $data=$this->db->get()->row();
        if($data->choose_upload==1){
            return array('picture'=>base_url()."uploads/Images/config/".$data->value,"alt"=>$data->alt);

        }else{
            return array('picture'=>$this->get_picture($data->value),"alt"=>$data->alt);

        }
    }


    //
    function catchuoi($str, $limit) {
        if (strlen($str) > $limit) {
            $re = substr($str, 0, $limit);
            $re = substr($re, 0, strrpos($re, " "));
            $re .="...";
            return $re;
        } else {
            return $str;
        }
    }

    //-----------------------
    function unicode($text) {
        $trans = array('à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẫ' => 'a',
            'ẩ' => 'a', 'ậ' => 'a', 'ú' => 'a', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'à' => 'a', 'á' => 'a',
            'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o',
            'õ' => 'o', 'ọ' => 'o', 'ẽ' => 'e', 'ê' => 'e', 'è' => 'e', 'ế' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i',
            'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ơ' => 'o', 'ớ' => 'o', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y',
            'ỹ' => 'y', 'ỵ' => 'y', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u',
            'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'đ' => 'd', 'ẹ' => 'e', 'À' => 'A', 'Á' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A',
            'Â' => 'A', 'Ấ' => 'A', 'À' => 'A', 'Ẫ' => 'A', 'Ẩ' => 'A', 'Ậ' => 'A', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U',
            'Ũ' => 'U', 'Ụ' => 'U', 'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ê' => 'E',
            'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I',
            'Ị' => 'I', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ư' => 'U', 'Ừ' => 'U',
            'Ứ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Đ' => 'D', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y',
            'Ỵ' => 'Y', 'Ằ' => 'A', 'Ầ' => 'A', 'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a',
            'ắ' => 'a', 'ằ' => 'a', 'ẻ' => 'e', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a',
            'ẫ' => 'a', 'ậ' => 'a', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u',
            'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i',
            'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ổ' => 'o',
            'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'đ' => 'd',
            'Đ' => 'D', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'Á' => 'A', 'À' => 'A', 'Ả' => 'A',
            'Ã' => 'A', 'Ạ' => 'A', 'Ă' => 'A', 'Ắ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Â' => 'A', 'Ấ' => 'A',
            'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A', 'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'Ế' => 'E',
            'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U',
            'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I',
            'Ĩ' => 'I', 'Ị' => 'I', 'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O', 'Ô' => 'O', 'Ố' => 'O',
            'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O',
            'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', ' ' => '-', '----' => '-', '---' => '-', '--' => '-',
            '"' => ''
        );

        $text_convert = strtr($text, $trans);
        $text_convert = str_replace('"', '', $text_convert);
        $text_convert = str_replace('&#39;', '', $text_convert);
        $text_convert = str_replace(',', '', $text_convert);
        $text_convert = str_replace(':', '', $text_convert);
        $text_convert = str_replace('(', '', $text_convert);
        $text_convert = str_replace(')', '', $text_convert);
        $text_convert = str_replace('"', '', $text_convert);
        $text_convert = str_replace('"', '', $text_convert);
        $text_convert = str_replace('/', '-', $text_convert);
        $text_convert = str_replace('.', '', $text_convert);
        $text_convert = str_replace('!', '', $text_convert);
        $text_convert = str_replace('@', '', $text_convert);
        $text_convert = str_replace('#', '', $text_convert);
        $text_convert = str_replace('$', '', $text_convert);
        $text_convert = str_replace('%', '', $text_convert);
        $text_convert = str_replace('^', '', $text_convert);
        $text_convert = str_replace('*', '', $text_convert);
        $text_convert = str_replace('&', '', $text_convert);
        $text_convert = str_replace('{', '', $text_convert);
        $text_convert = str_replace('}', '', $text_convert);
        $text_convert = str_replace('[', '', $text_convert);
        $text_convert = str_replace(']', '', $text_convert);
        $text_convert = str_replace('|', '', $text_convert);
        $text_convert = str_replace('é', 'e', $text_convert);
        $text_convert = str_replace('!', '', $text_convert);
        $text_convert = str_replace('?', '', $text_convert);
        $text_convert = str_replace('%', '', $text_convert);
        $text_convert = str_replace('+', '', $text_convert);
        $text_convert = preg_replace("/('|')/", '', $text_convert);


        $text_convert = str_replace('*', '', $text_convert);
        $text_convert = str_replace('&', '', $text_convert);
        $text_convert = str_replace('^', '', $text_convert);
        $text_convert = str_replace(',', '', $text_convert);
        $text_convert = str_replace('---', '-', $text_convert);
        $text_convert = str_replace('&#39;', '', $text_convert);
        $text_convert = str_replace("'", "", $text_convert);
        $text_convert = str_replace("~", "", $text_convert);
        $text_convert = str_replace("`", "", $text_convert);
        $text_convert = strtolower($text_convert);

        //Special string
        $text_convert = preg_replace("/( |!|#|$|%|')/", '', $text_convert);
        $text_convert = preg_replace('/("|")/', '', $text_convert);
        $text_convert = preg_replace("/(̀|́|̉|$|>)/", '', $text_convert);
        $text_convert = preg_replace("'<[/!]*?[^<>]*?>'si", "", $text_convert);
        $text_convert = str_replace('"', '', $text_convert);
        $text_convert = str_replace("----", "-", $text_convert);
        $text_convert = str_replace("---", "-", $text_convert);
        $text_convert = str_replace("--", "-", $text_convert);
        $text_convert = str_replace("\\", "", $text_convert);
        return $text_convert;
    }

    // random code
    function randomPassword($n) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .
                '0123456789';
        $str = '';
        $max = strlen($chars) - 1;

        for ($i = 0; $i < $n; $i++)
            $str .= $chars[rand(0, $max)];

        return $str;
    }

    function paging($page, $total, $url, $id = 1) {
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        //kiem tra
        $count = $total;
        $tongtrang = ceil($total / $page);
        $num = "";
        if ($count != 0) {
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
            $dau = "<li  class=''><a href='" . site_url($url) . "'>Đầu</a></li>";
        } else if ($first_btn) {
            $dau = "<li  class='text'>Đầu</li>";
        }

        // FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $id > 1) {
            $tam = $id - 1;
            $lui = "<li class=''><a href='" . site_url($url . $tam) . "'>Lùi</a></li>";
        } else if ($previous_btn) {
            $lui = "<li class='text'>Lùi</li>";
        }


        if ($next_btn && $id < $tongtrang) {
            $tam2 = $id + 1;
            $toi = "<li class=''><a href='" . site_url($url . $tam2) . "'> Tới </a></li>";
        } else if ($next_btn) {
            $toi = "<li class='text'>Tới</li>";
        }

        // TO ENABLE THE END BUTTON
        if ($last_btn && $id < $tongtrang) {
            $cuoi = "<li  class=''><a href='" . site_url($url . $tongtrang) . "'> Cuối </a></li>";
        } else if ($last_btn) {
            $cuoi = "<li class='text'>Cuối</li>";
        }
        if ($count > 0) {
            for ($i = $start_loop; $i <= $end_loop; $i++) {
                if ($i == $id)
                    $num.="<li class='page'><a href='#' title='' onclick='return false'>$i</a></li>";
                else
                    $num.="<li><a href='" . site_url($url . $i) . "' title=''>$i</a></li>";
            }
        }
        if ($count > 0 && $tongtrang > 1)
            $link = "
		<ul class='pagination'>

			" .$num ."

		</ul>
			";
        else
            $link = '';

        return $link;
    }
    function paging_ajax($page, $total, $url, $id = 1) {
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        //kiem tra
        $count = $total;
        $tongtrang = ceil($total / $page);
        $num = "";
        if ($count != 0) {
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


        // FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $id > 1) {
            $tam = $id - 1;
            $lui = "<li class='p-prev' onclick='PageSearch(this)' data-href='" . site_url($url . $tam) . "'><a ><</a></li>";
        } else if ($previous_btn) {
            $lui = "<li class='p-prev'><</li>";
        }


        if ($next_btn && $id < $tongtrang) {
            $tam2 = $id + 1;
            $toi = "<li class='p-next' onclick='PageSearch(this)' data-href='" . site_url($url . $tam2) . "'><a > > </a></li>";
        } else if ($next_btn) {
            $toi = "<li class='p-next'> > </li>";
        }
        if ($count > 0 && $tongtrang > 1)
            $link = "
			".$lui."  <li class='num-page'>".$id."</li>" .$toi."
			";
        else
            $link = '';

        return $link;
    }
    function getAge($birthdate = '0000-00-00') {
        if ($birthdate == '0000-00-00') return 'Unknown';

        $bits = explode('-', $birthdate);
        $age = date('Y') - $bits[0] - 1;

        $arr[1] = 'm';
        $arr[2] = 'd';

        for ($i = 1; $arr[$i]; $i++) {
            $n = date($arr[$i]);
            if ($n < $bits[$i])
                break;
            if ($n > $bits[$i]) {
                ++$age;
                break;
            }
        }
        return $age;
    }
    function show_company($lang = "vn") {
        $this->db->select('companydetail.*,company.*');
        $this->db->where("country.name", $lang);
        $this->db->from('company');
        $this->db->join('companydetail', 'companydetail.id_company=company.id');
        $this->db->join('country', 'companydetail.id_country=country.id');
        return $this->db->get()->row();
    }
    // show config language
    function show_config_language($name,$lang = "vn",$type='value') {
        $this->db->select('config_languagedetail.value,config_languagedetail.url');
        $this->db->where("config_language.name", $name);
        $this->db->where("country.name", $lang);
        $this->db->from('config_language');
        $this->db->join('config_languagedetail', 'config_languagedetail.config_language_id=config_language.id');
        $this->db->join('country', 'config_languagedetail.country_id=country.id');
        $data=$this->db->get()->row();
        if($type=='value' && isset($data->value)){
            return $data->value;
        }else if($type=='url' && isset($data->url)){
            return $data->url;
        }else{
            return "";
        }
    }
    function get_tableWhere($where = array(), $table,$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->row();
    }
    function list_tableWhere($where = array(), $table,$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->result();
    }
    function list_tableWhere_status($where = array(), $table,$select="*") {
        $this->db->select($select);
        $this->db->where($where);
        $this->db->from($table);
        $this->db->order_by('status','ASC');
        return $this->db->get()->result();
    }
    function count_tableWhere($params) {
        if(!empty($params['where'])) {
            $this->db->where($params['where']);
        }
        $this->db->from($params['table']);
        return $this->db->get()->num_rows();
    }
    function count_table($where = array(),$table) {
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->num_rows();
    }
    function count_footer($table,$where=''){
        $params=array(
            "table"=>$table,
            'where'=>$where
        );
       return  $this->count_tableWhere($params);
    }
    //
    function count_table_total($where = array(), $table) {
        $this->db->select_sum("point");
        $this->db->where($where);
        $this->db->from($table);
        $data= $this->db->get();
        if(isset($data->point)) return $data->point;else return 0;
    }
    // get seo
    function show_detail_meta_seo_id_lang($item_id, $lang = 'vn',$type="item") {
        $this->db->select("meta_seo.*");
        $this->db->where(array("meta_seo.tmp_id"=>$item_id,"value"=>$type));
        $this->db->where("country.name", $lang);
        $this->db->from('meta_seo');
        $this->db->join('country', 'meta_seo.country_id=country.id');
        return $this->db->get()->row();
    }
    // upload images
    function upload_img($img,$folder,$w,$h)
    {
        if (!file_exists("uploads/Images/".$folder)) {
            mkdir("uploads/Images/" . $folder, 0777);
        }
        $config['upload_path'] = './uploads/Images/' . $folder;
        $config['allowed_types'] = '*';
        $config['encrypt_name'] = TRUE;
        $this->load->library("upload", $config);
        if ($this->upload->do_upload($img)) {
            $check = $this->upload->data();
            $this->load->library("image_lib");
            $config['image_library'] = 'gd2';
            $config['source_image'] = './uploads/Images/' . $folder . "/" . $check['file_name'];
            $config['maintain_ratio'] = TRUE;
            if($w !=0) {
                $config['width'] = $w;
            }
            if($h !=0) {
                $config['height'] = $h;
            }
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            return $check['file_name'];
        } else {
            return $this->upload->display_errors();
        }
    }
    function get_tmp_status($id){
        $array=array();
        $this->db->where("item_id",$id);
        $this->db->from('tmp_item_status');
        $data=$this->db->get()->result();
        foreach($data as $d){
            $array[]=$d->status_id;
        }
        return $array;
    }
    function get_tmp_album($album_id,$img){
        $this->db->where("album_id",$album_id);
        $this->db->where("image_id",$img);
        $this->db->from('imagealbum');
        return $this->db->get()->num_rows();
    }
    function Checkpermission($name) {
        if (!isset($_SESSION['active_log'])) {
            redirect(site_url('admin/login'));
        }
        $check = $this->global_function->get_tableWhere(array("user_id" => $this->m_session->userdata('admin_login')->user_id),"tbl_user");
        $array = array();
        $array = explode(",", base64_decode($check->permission));
        foreach ($array as $r) {
            if ($r == $name || $this->m_session->userdata('admin_login')->type == 2){
                return true;
            }

        }
        return false;
    }
    // check permission users
    function Checkpermission_check($id, $name) {
        if (!isset($_SESSION['active_log'])) {
            redirect(site_url('admin/login'));
        }
        $check = $this->get_tableWhere(array("user_id" => $id), "tbl_user");
        $array = array();
        $array = explode(",", base64_decode($check->permission));
        foreach ($array as $r) {
            if ($r == $name)
                return 1;
        }
        return 0;
    }
    function get_max($table, $var) {
        $this->db->select_max($var);
        $this->db->from($table);
        return $this->db->get()->row()->$var;
    }
    function show_list_lang() {
        $this->db->where("status", 1);
        return $this->db->get('country')->result();
    }
    function count_table_group_by($where = array(),$table) {
        $this->db->where($where);
        $this->db->from($table);
        $this->db->group_by('session');
        return $this->db->get()->num_rows();
    }
    // show table join table detail
    function get_list_table_where($params)
    {
        if(isset($params["select"])) {
            $this->db->select($params['select']);
        }else{
            $this->db->select('*');
        }
        if(isset($params['where'])) {
            $this->db->where($params['where']);
        }

        $this->db->from($params['table']);
        if(isset($params["limit"])) {
            $this->db->limit($params["limit"], $params["offset"]);
        }
        if(isset($params["order"])) {
            $this->db->order_by($params['order'], DSORT);
        }
        if(isset($params['table_detail'])) {
            $this->db->where(array('country.name'=>$params['lang']));
            $this->db->join($params['table_detail'], $params['join_where']);
            $this->db->join('country', $params['table_detail'] . '.country_id=country.id');
        }
        if(isset($params["first"])) {
            return $this->db->get()->first_row();
        }else {
            return $this->db->get()->result();
        }
    }
    // lay du lieu khu vuc theo ve may bay, tour , khach san
    function get_list_table_where_location_in($params)
    {
        if(isset($params["select"])) {
            $this->db->select($params['select']);
        }else{
            $this->db->select('*');
        }
        if(isset($params['where'])) {
            $this->db->where($params['where']);
        }
        if(isset($params['modules'])){
            $this->db->where("tmp_modules.value",$params['modules']);
            $this->db->join('tmp_modules', 'tmp_modules.location_id=location.id');
        }
        $this->db->from($params['table']);
        if(isset($params["limit"])) {
            $this->db->limit($params["limit"], $params["offset"]);
        }
        if(isset($params["order"])) {
            $this->db->order_by($params['order'], DSORT);
        }
        if(isset($params['table_detail'])) {
            $this->db->where(array('country.name'=>$params['lang']));
            $this->db->join($params['table_detail'], $params['join_where']);
            $this->db->join('country', $params['table_detail'] . '.country_id=country.id');
        }
        if(isset($params["first"])) {
            return $this->db->get()->first_row();
        }else {
            return $this->db->get()->result();
        }
    }
    // get percent
    function percent($value,$price){
        if($value >0) {
            return round(($price - $value) / $value * 100);
        }else{
            return "0";
        }
    }
    // format price
    function get_price($price,$contact=1){
        if($price>0){
            return number_format($price,0,",",".")." đ";
        }else{
            if($contact==1) {
                return "Liên hệ";
            }else{
                return number_format($price,0,",",".")." đ";
            }
        }
    }
    // get price hang phong theo tung khuyen mai
    function get_price_detail($hotel_room_id,$value,$price,$price_weekend){
        $price_day=$this->get_tableWhere(array("start_date"=>date('Y-m-d'),"hotel_room_id"=>$hotel_room_id),"room_holiday",$value);
        if(!empty($price_day)){
            return $price_day->$value;
        }else if($price_weekend>0 && (date('w')==0 || date('w')==6)){
            return $price_weekend;
        }else{
            return $price;
        }
    }
    // list images hotel
    function list_thumb($id,$value)
    {
        $this->db->select('images.name,images.id');
        $this->db->where(array("images.tmp_id"=>$id,"value"=>$value));
        $this->db->from('images');
        return $this->db->get()->result();
    }
    // ket qua danh gia
    function resutl_vote($vote,$lang){
        if($vote==0){
            return '';
        }
        else if($vote >0 && $vote < 5){
            return $this->global_function->show_config_language('lang_vote_3', $lang);
        }else if($vote >=5 && $vote <=6){
            return $this->global_function->show_config_language('lang_vote_2', $lang);
        }else{
            return $this->global_function->show_config_language('lang_vote_1', $lang);
        }
    }
    function get_departure($day_of_week,$type_date,$lang){
        $result='';

        if($type_date==0){
            $array=explode(",",trim($day_of_week));
            foreach($array as $a){
                $result.=$this->name_day($a).",";
            }
        }else{
            $array=explode(", ",trim($day_of_week));
            foreach($array as $a){
                    $result.="<li>".date('d-m',strtotime($a)).",&nbsp</li>";
            }
        }
        return rtrim($result,",");

    }
    // name day
    function name_day($day){
        switch($day){
            case 0:$title="CN";break;
            case 1:$title="T2";break;
            case 2:$title="T3";break;
            case 3:$title="T4";break;
            case 4:$title="T5";break;
            case 5:$title="T6";break;
            case 6:$title="T7";break;
            default:$title="";
        }
        return $title;
    }
    // show pic
    function get_picture($url){
        return base_url().$url;
    }
    // get arrange
    function arrange(){
       $this->db->select('arrange');
       $this->db->from('company');
        $data=$this->db->get()->row();
        if(isset($data->arrange)) return $data->arrange;
        else return 1;
    }
    //dong dau
    function Water($fileName)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = './uploads/san-pham-cung-loai/' . $fileName;
        $config['wm_text'] = 'satrafoods.vn';
        $config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = 'watermark.png';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $config['wm_opacity'] = '0.5';
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $this->image_lib->initialize($config);
        $this->image_lib->watermark();
    }
    public function new_api_key($level,$ignore_limits,$is_private_key,$ip_addresses)
    {
        //generamos la key
        $key = $this->generate_token();
        //comprobamos si existe
        $check_exists_key = $this->db->get_where("keys", array("key"   =>   $key));

        //mientras exista la clave en la base de datos buscamos otra
        while($check_exists_key->num_rows() > 0){
            $key = "";
            $key = $this->generate_token();
        }
        //creamos el array con los datos
        $data = array(
            "key"           =>      $key,
            "level"         =>      $level,
            "ignore_limits" =>      $ignore_limits,
            "is_private_key"=>      $is_private_key,
            "ip_addresses"  =>      $ip_addresses
        );

        $this->db->insert("keys", $data);
        return $key;
    }

    //función que genera una clave segura de 40 carácteres, este será nuestro generador de keys para la api
    //https://gist.github.com/jeffreybarke/5347572
    //autor jeffreybarke
    private function generate_token($len = 40)
    {
        //un array perfecto para crear claves
        $chars = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
            'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'
        );
        //desordenamos el array chars
        shuffle($chars);
        $num_chars = count($chars) - 1;
        $token = '';

        //creamos una key de 40 carácteres
        for ($i = 0; $i < $len; $i++)
        {
            $token .= $chars[mt_rand(0, $num_chars)];
        }
        return $token;
    }
}

?>