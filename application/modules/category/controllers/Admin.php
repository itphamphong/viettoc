<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    protected $meta_title;
    protected $meta_keywords;
    protected $meta_description;
    protected $project = "";

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper(array('url', 'text', 'form', 'file'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
        $this->load->model(array('item/m_item', 'm_session', 'general','a_category'));
        date_default_timezone_set('Asia/Saigon');
        $this->template->set_template('admin');
    }
    function admin() {
        parent::Controller();
    }

    function index($type = 0) {
        if (!($this->general->Checkpermission("view_cate_".$type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['update'])) {
            $array = array_keys($this->input->post('checkall'));
            $weight = $this->input->post('weight');
            if(!empty($weight)) {
                for ($i = 0; $i < count($array); $i++) {
                    $this->update_weight($array[$i], $weight[$i]);
                }
            }
            redirect(site_url('admin/category/index/' . $type) . '?messager=success');
        }
        if (isset($_POST['delete'])) {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                    $this->delete_more($type,$a);
            }
            redirect(site_url('admin/category/index/' . $type) . '?messager=success');
        }
        if($type==1){
            $title="Quản lý mô hình kinh doanh";
        }else if($type==2){
            $title="Quản lý nhóm";
        }else if($type==3){
            $title="Quản lý thương hiệu";
        }
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a> <i class="fa fa-angle-right"></i> <a>'.$title.'</a>';
        $data['category'] = $this->m_item->show_list_category_where(array("category.category_type" => $type));
        $data['type'] = $type;
        $this->template->write('mod', "category_".$type);
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    //============================================
    function add($type = 0) {
        if (!($this->general->Checkpermission("add_cate_".$type)))
            redirect(site_url("admin/not-permission"));
        $data = array();
        $picture = '';
        $data['name_project'] = $this->project;
        $data['mod'] = 'cate_' . $type;
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label><br />');
            if ($this->form_validation->run() == TRUE) {
                $choose=$this->input->post('optionsRadio');
                $picture="NULL";
                if($choose==1){
                    if ((!empty($_FILES['picture']['name']))) {
                        $picture=$this->global_function->upload_img("picture","product",0,0);
                    }
                }else if($choose==2){
                    $picture = substr($this->input->post('picture_galary'), strpos($this->input->post('picture_galary'), "uploads"));
                }else if($choose==3){
                    $picture=$this->input->post('picture_Awesome');
                }
                $sql = array(
                    'category_weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'category_type' => $type,
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'category_hot' => $this->input->post('hot'),
                    'category_status' => $this->input->post('status'),
                    'alt_picture' => $this->input->post('alt_picture'),
                    'picture'=>$picture,
                    'choose_upload'=>$choose
                );
                $this->db->insert('category', $sql);
                $category_id = $this->db->insert_id();
                if(isset($category_id)) {
                    $category=$this->input->post('category');
                    if(!empty($category)){
                        foreach($category as $ca){
                            $this->db->insert('category_parent',array('category_id'=>$category_id,'parent_id'=>$ca));
                        }
                    }
                    foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $name=$this->input->post('name_' . $lang->name);
                        $link=$this->input->post('item_link_' . $lang->name);
                        if(empty($link)) $link= $this->global_function->unicode($name);
                        $sql = array(
                            'category_id' => $category_id,
                            'country_id' => $lang->id,
                            'category_name' => $this->input->post('name_' . $lang->name),
                            'category_link' => $link,
                        );
                        $this->db->insert('categorydetail', $sql);
                    }
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $name_seo = $this->input->post('name_seo_' . $lang->name);
                        $meta_keywords = $this->input->post('meta_keywords' . $lang->name);
                        $meta_descriptions = $this->input->post('meta_descriptions' . $lang->name);
                        if (!empty($name_seo) || !empty($meta_keywords) || !empty($meta_descriptions)) {
                            $sql_seo = array(
                                'tmp_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => "category",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/category/edit/' . $type."/".$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/category/index/' . $type) . '?messager=success');
                    }
                }
                }
            }
        if($type==1){
            $title="Chỉnh sửa  mô hình";
            $ptitle="Quản lý mô hình";
        }else if($type==2){
            $title="Chỉnh sửa nhóm sản phẩm";
            $ptitle="Quản lý nhóm sản phẩm";
        }else{
            $title="Chỉnh sửa thương hiệu";
            $ptitle="Quản lý thương hiệu";
        }
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/category/index/'.$type.'">'.$ptitle.'</a> <i class="fa fa-angle-right"></i> <a>'.$title.'</a>';
        $data['weight']=$this->general->get_max('category', 'category_weight') + 1;
        $data['type'] = $type;
        $this->template->write('mod', "add_category_".$type);
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }

    //============================================
    function edit($type = 0, $id = 0) {
        if (!($this->general->Checkpermission("edit_cate_".$type)))
            redirect(site_url("admin/not-permission"));
        $check_img = $this->input->post('chose_img');
        $data = array();
        $data['mod'] = 'cate_' . $type;
        $data['t']=$t = $this->m_item->show_detail_category_id($id);
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên danh mục -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label> <br />');
        if ($this->form_validation->run() == TRUE) {
            $choose=$this->input->post('optionsRadio');
            $picture=$this->input->post('old_pic');
            if($choose==1){
                if ((!empty($_FILES['picture']['name']))) {
                    $picture=$this->global_function->upload_img("picture","product",0,0);
                }
            }else if($choose==2){
                $picture = substr($this->input->post('picture_galary'), strpos($this->input->post('picture_galary'), "uploads"));
            }else if($choose==3){
                $picture=$this->input->post('picture_Awesome');
            }
            $sql = array(
                'category_weight' => $this->input->post('weight'),
                'date_modify' => date('Y-m-d H:i:s'),
                'category_type' => $type,
                'user_id' => $this->m_session->userdata('admin_login')->user_id,
                'category_hot' => $this->input->post('hot'),
                'category_status' => $this->input->post('status'),
                'alt_picture' => $this->input->post('alt_picture'),
                'picture'=>$picture,
                'choose_upload'=>$choose
            );
            $this->db->where("id", $id);
            $this->db->update('category', $sql);
            $category_id = $id;
            if (isset($category_id)) {
                $this->db->where('category_id',$id);
                $this->db->delete('category_parent');
                $category=$this->input->post('category');
                if(!empty($category)){
                    foreach($category as $ca){
                        $this->db->insert('category_parent',array('category_id'=>$category_id,'parent_id'=>$ca));
                    }
                }
                foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                    if ($this->m_item->check_cate_detail($id, $lang->id)) {
                        $name=$this->input->post('name_' . $lang->name);
                        $link=$this->input->post('item_link_' . $lang->name);
                        if(empty($link)) $link= $this->global_function->unicode($name);
                        $sql = array(
                            'category_name' => $this->input->post('name_' . $lang->name),
                            'category_link' => $link
                        );
                        $this->db->where(array("category_id" => $id, 'country_id' => $lang->id));
                        $this->db->update('categorydetail', $sql);
                    } else {
                        $name=$this->input->post('name_' . $lang->name);
                        $link=$this->input->post('item_link_' . $lang->name);
                        if(empty($link)) $link= $this->global_function->unicode($name);
                        $sql = array(
                            'category_id' => $category_id,
                            'country_id' => $lang->id,
                            'category_name' => $this->input->post('name_' . $lang->name),
                            'category_link' => $link,
                        );
                        $this->db->insert('categorydetail', $sql);
                    }
                }
                // seo
                foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                    $params = array(
                        "where" => array('tmp_id' => $category_id, 'country_id' => $lang->id, 'value' => "category"),
                        "table" => "meta_seo"
                    );
                    if ($this->global_function->count_tableWhere($params) > 0) {
                        $sql_seo = array(
                            'tmp_id' => $category_id,
                            'country_id' => $lang->id,
                            'value' => "category",
                            'name_seo' => $this->input->post('name_seo_' . $lang->name),
                            'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                            'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                        );
                        $this->db->where(array('tmp_id' => $category_id, 'country_id' => $lang->id, 'value' => "item"));
                        $this->db->update('meta_seo', $sql_seo);
                    } else {
                        $sql_seo = array(
                            'tmp_id' => $category_id,
                            'country_id' => $lang->id,
                            'value' => "category",
                            'name_seo' => $this->input->post('name_seo_' . $lang->name),
                            'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                            'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                        );
                        $this->db->insert('meta_seo', $sql_seo);
                    }
                }//foreach
                if(isset($_POST['ok-continues'])){
                    redirect(site_url('admin/category/edit/' . $type."/".$category_id) . '?messager=success');
                }else {
                    redirect(site_url('admin/category/index/' . $type) . '?messager=success');
                }
            }
        }
        }
        if($type==1){
            $title="Chỉnh sửa  mô hình";
            $ptitle="Quản lý mô hình";
        }else if($type==2){
            $title="Chỉnh sửa nhóm sản phẩm";
            $ptitle="Quản lý nhóm sản phẩm";
        }else{
            $title="Chỉnh sửa thương hiệu";
            $ptitle="Quản lý thương hiệu";
        }
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/category/index/'.$type.'">'.$ptitle.'</a> <i class="fa fa-angle-right"></i> <a>'.$title.'</a>';
        $data['id'] = $id;
        $data['type'] = $type;
        $this->template->write('mod', "add_category_".$type);
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }

    //============================================\
    function delete($type = 0, $id) {
        if (!($this->general->Checkpermission("delete_cate_".$type)))redirect(site_url("admin/not-permission"));
        $where = array('category_id' => $id);
        $this->db->delete('categorydetail', $where);
        $where = array('id' => $id);
        $this->db->delete('category', $where);
        redirect(site_url('admin/category/index/' . $type) . '?messager=success');
    }
    //============================================\
    function delete_more($type,$id) {
        if (!($this->general->Checkpermission("delete_cate_".$type)))
            redirect(site_url("admin/not-permission"));
        $where = array('category_id' => $id);
        $this->db->delete('categorydetail', $where);
        $where = array('id' => $id);
        $this->db->delete('category', $where);
        return true;
    }


    function Active() {
        $sql = array('category_status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('category', $sql);
    }
    function Hot() {
        $sql = array('category_hot' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('category', $sql);
    }
    //============================================\
    function update_weight($id,$weight) {
        $sql = array('category_weight' => $weight);
        $this->db->where('id', $id);
        $this->db->update('category', $sql);
        return true;
    }



    //============================================
    public function checkper($id, $per) {
        $a = $this->m_session->userdata('admin_login')->per;
        $p = unserialize($a);
        foreach ($p as $r->value) {
            if ($r->value == 'full')
                return true;
        }
        $a = $this->m_item->show_detail_category_id($id)->per;
        $p = unserialize($a);
        foreach ($p as $r->value) {
            if ($r->value == $per)
                return true;
        }
        return false;
    }

    //============================================


    //============================================
    public function check_child($id) {
        $child = $this->m_item->show_list_term_chil($id);
        if (count($child) > 0)
            return false;
        return true;
    }

    //============================================
    public function check_article($id) {
        $params = array(
            "where" => array('category_id' => $id),
            "table" => "item"
        );
        $article = $this->global_function->count_tableWhere($params);
        if ($article > 0)
            return false;
        return true;
    }

    //===================== check images=========================
    function upimg() {
        if (($_FILES['img']['name'] != '')) {
            $config['upload_path'] = './uploads/danh-muc-san-pham';
            $config['allowed_types'] = '*';
            $config['max_size'] = '5000';
            $config['max_width'] = '4000';
            $config['max_height'] = '4000';
            $this->load->library('upload', $config);
            if (($_FILES['img']['name'] != '')) {
                if (!$this->upload->do_upload('img')) {
                    $this->form_validation->set_message('upimg', $this->upload->display_errors());
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        } else {
            $this->form_validation->set_message('upimg', 'Bạn chưa chọn hình đại diện');
            return FALSE;
        }
    }

}
