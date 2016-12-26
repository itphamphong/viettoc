<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
        $this->load->model(array('m_banner', 'general','item/m_item','category/a_category'));
        $this->load->model('m_session');
        $this->template->set_template('admin');  // Set template


    }
    function index($type=0,$page_no = 1) {
        if (!($this->general->Checkpermission("view_banner")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['update'])) {
            $array = array_keys($this->input->post('checkall'));
            $weight = $this->input->post('weight');
            if(!empty($weight)) {
                for ($i = 0; $i < count($array); $i++) {
                    $this->update_weight($array[$i], $weight[$i]);
                }
            }
            redirect(site_url('admin/banner/index/'. $page_no) . '?messager=success');
        }
        if (isset($_POST['delete'])) {
            $array = array_keys($this->input->post('checkall'));
                for ($i = 0; $i < count($array); $i++) {
                    $this->delete_more($array[$i]);
                }
            redirect(site_url('admin/banner/index/'. $page_no) . '?messager=success');
        }
        $data = array();
        $this->template->write('mod', "banner_".$type); // set mod
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/banner">Quản lý banner</a>';

        $page_co = 12;
        $start = ($page_no - 1) * $page_co;
        $count = count($this->m_banner->show_list_image_album_where());
        $data['type']=$type;
        $data['page_no'] = $page_no;
        $data['item'] = $this->m_banner->show_list_image_page_m_where($page_co, $start,$type);
        $data['link'] = $this->paging($page_co, $count, 'admin/banner/index/', $page_no);
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    //============================================
    function add($level = 0) {
        if (!($this->general->Checkpermission("add_banner")))
            redirect(site_url("admin/not-permission"));
        $data = array();
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/banner">Quản lý banner</a>';
        if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, "Tên - ".$lang->title, 'trim|required');
            }
            $this->form_validation->set_error_delimiters('<i>', '</i>');
            if ($this->form_validation->run() == TRUE) {
                if ((!empty($_FILES['userfile']['name']))) {
                    $picture=$this->global_function->upload_img("userfile","quang-cao",0,0);
                }else{
                    $picture="NULL";
                }
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'alt' => $this->input->post('alt'),
                    "name" => $picture,
                    'status' => $this->input->post('status'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    "value"=>"banner"

                );
                $this->db->insert('images', $sql);
                $insert_id = $this->db->insert_id();
                $cate=$this->input->post('category');
                if(!empty($cate)){
                    foreach($cate as $c){
                        $this->db->insert('tmp_banner',array('tmp_id'=>$c,'banner_id'=>$insert_id));
                    }
                }
                if(isset($insert_id)){
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $name=$this->input->post('name_' . $lang->name);
                        if(!empty($name)) {
                            $sql_lang = array(
                                'image_id' => $insert_id,
                                'country_id' => $lang->id,
                                'images_link' => $this->input->post('item_link_' . $lang->name),
                                'images_name' => $this->input->post('name_' . $lang->name),
                                'images_summary' => $this->input->post('item_description_' . $lang->name),
                            );

                            $this->db->insert('imagedetail', $sql_lang);
                        }
                    }//foreach
                    $this->db->where("image_id",$insert_id);
                    $this->db->delete("imagealbum");
                    $this->db->insert("imagealbum",array("album_id"=>$this->input->post("term_id"),"image_id"=>$insert_id));
                }
                if(isset($_POST['ok-continues'])){
                    redirect(site_url('admin/banner/edit/'.$level."/".$insert_id) . '?messager=success');
                }else {
                    redirect(site_url('admin/banner/index/'.$level) . '?messager=success');
                }
            }
        }
        $data['type']=$level;
        $this->template->write('mod', "banner_add_".$level); // set mod
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }
	
    //===========================================
    function edit($level=0,$id) {
        if (!($this->general->Checkpermission("edit_location")))
            redirect(site_url("admin/not-permission"));
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/banner">Quản lý banner</a>';
        $data['banner']=$banner=$this->m_banner->show_detail_image($id);
        if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, "Tên bài viết - ".$lang->title, 'trim|required');
            }
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                if ($this->form_validation->run() == TRUE) {
                    $old=$this->input->post("old");
                    if($this->input->post('check_delete')==1){
                        if (file_exists('./uploads/Images/quang-cao/'. $banner->name)) {
                            @unlink('./uploads/Images/quang-cao/'. $banner->name);
                        }
                        $old="NULL";
                    }
                    if ((!empty($_FILES['userfile']['name']))) {
                        if (file_exists('./uploads/Images/quang-cao/'. $banner->name)) {
                            @unlink('./uploads/Images/quang-cao/'. $banner->name);
                        }
                        $picture=$this->global_function->upload_img("userfile","quang-cao",0,0);
                    }else{
                        $picture=$old;
                    }

                    $sql = array(
                        'weight' => $this->input->post('weight'),
                        "name" => $picture,
                        'status' => $this->input->post('status'),
                        'user_id' => $this->m_session->userdata('admin_login')->user_id,
                        'alt' => $this->input->post('alt'),
                        "value"=>"banner"
                    );
                    $this->db->where("id", $id);
                    $this->db->update('images', $sql);
                        $this->db->where("image_id",$id);
                        $this->db->delete("imagealbum");
                        $this->db->insert("imagealbum",array("album_id"=>$this->input->post("term_id"),"image_id"=>$id));
                    // inser item detail
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if($this->general->count_table_where(array('image_id'=>$id,'country_id'=>$lang->id),"imagedetail") >0 ){
                            $sql_lang = array(
                                'images_link' => $this->input->post('item_link_' . $lang->name),
                                'images_name' => $this->input->post('name_' . $lang->name),
                                'images_summary' => $this->input->post('item_description_' . $lang->name),
                            );
                            $this->db->where('image_id', $id);
                            $this->db->where('country_id', $lang->id);
                            $this->db->update('imagedetail', $sql_lang);
                        }else{
                            $sql_lang = array(
                                'image_id' => $id,
                                'country_id' => $lang->id,
                                'images_link' => $this->input->post('item_link_' . $lang->name),
                                'images_name' => $this->input->post('name_' . $lang->name),
                                'images_summary' => $this->input->post('item_description_' . $lang->name),
                            );
                            $this->db->insert('imagedetail', $sql_lang);
                        }
                    }//foreach
                    $this->db->delete('tmp_banner',array('banner_id'=>$id));
                    $cate=$this->input->post('category');
                    if(!empty($cate)){
                        foreach($cate as $c){
                            $this->db->insert('tmp_banner',array('tmp_id'=>$c,'banner_id'=>$id));
                        }
                    }
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/banner/edit/'.$level."/".$id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/banner/index/'.$level) . '?messager=success');
                    }
                }

        }
        $data['type']=$level;
        $this->template->write('mod', "banner_add_".$level); // set mod
        $data['banner']=$this->m_banner->show_detail_image($id);
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }

    //===========================================
    function top_album_add($key, $image_id) {
        if ($this->counter->count_image_album($key, $image_id) == 0) {
            $sql = array(
                'image_id' => $image_id,
                'album_id' => $key
            );
            $this->db->insert('imagealbum', $sql);
            if ($this->m_banner->show_detail_album_id($key)->top_album)
                $this->top_album_add($this->m_banner->show_detail_album_id($key)->top_album, $image_id);
        }
    }

    //===============================================
    //============================================\
    function delete($level=0,$id, $page_no=1) {
        if (!($this->general->Checkpermission("delete_banner")))
            redirect(site_url("admin/not-permission"));
        $banner=$this->m_banner->show_detail_image($id);
        if (isset($banner->id)) {
            $where = array('image_id' => $banner->id);
            $this->db->delete('imagealbum', $where);
        }
        if ($banner->name != NULL) {
            if (file_exists('./uploads/quang-cao/'. $banner->name)) {
                @unlink('./uploads/quang-cao/'. $banner->name);
            }
        }
        $where = array('image_id' => $id);
        $this->db->delete('imagedetail', $where);
        $where = array('id' => $id);
        $this->db->delete('images', $where);

        redirect(site_url('admin/banner/index/'.$level) . '?messager=success');
    }

    //============================================\
    function delete_more($id) {
        if (!($this->general->Checkpermission("delete_banner")))
            redirect(site_url("admin/not-permission"));
        $banner=$this->m_banner->show_detail_image($id);
        if (isset($banner->id)) {
            $where = array('image_id' => $banner->id);
            $this->db->delete('imagealbum', $where);
        }
        $where = array('image_id' => $id);
        $this->db->delete('imagedetail', $where);
        if ($banner->name != NULL) {
            if (file_exists('./uploads/quang-cao/'. $banner->name)) {
                @unlink('./uploads/quang-cao/'. $banner->name);
            }
        }
        $where = array('id' => $id);
        $this->db->delete('images', $where);

        return true;
    }
    function Active() {
        $sql = array('status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('images', $sql);
    }
    function Hot() {
        $sql = array('hot' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('images', $sql);
    }
    function update_weight($id,$weight) {
        if (!($this->general->Checkpermission("edit_item")))
            redirect(site_url("admin/not-permission"));
        $sql = array('weight' => $weight);
        $this->db->where('id', $id);
        $this->db->update('images', $sql);
        return true;
    }
    //============================================
    public function checkuser() {
        if (!$this->m_session->userdata('admin_login'))
            redirect(site_url('admin/login'));
        $a = $this->m_session->userdata('admin_login')->per;
        $p = unserialize($a);
        return true;
    }

    //===========================================
    public function paging($page, $total, $url, $id = 1) {

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
            
			" . $dau . $lui . $num . $toi . $cuoi . "
			
		</ul>
			";
        else
            $link = '';

        return $link;
    }

}
