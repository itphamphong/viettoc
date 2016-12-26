<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session', 'cart'));
        $this->load->helper(array("url"));
        $this->load->model(array("location/m_location", "general", "m_session", "global_function"));
        $this->template->set_template('admin');        // Set template 
    }
    function index($type = 1,$modules=0, $page_no = 1) {
        if (!($this->general->Checkpermission("view_location_".$type)))
            redirect(site_url("admin/not-permission"));
        // tool all
        if (isset($_POST['show']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                $this->show_more($a);
            }
            redirect(site_url('admin/location/index/' . $type) . '?messager=success');
        }
        if (isset($_POST['hide']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->hide_more($a);
            }
            redirect(site_url('admin/location/index/' . $type) . '?messager=success');
        }
        if (isset($_POST['update'])) {
            $array = array_keys($this->input->post('checkall'));
            $weight = $this->input->post('weight');
            if(!empty($weight)) {
                for ($i = 0; $i < count($array); $i++) {
                    $this->update_weight($array[$i], $weight[$i]);
                }
            }
            redirect(site_url('admin/location/index/' . $type . "/" . $page_no) . '?messager=success');
        }
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a,$type);
            }
            redirect(site_url('admin/location/index/' . $type) . '?messager=success');
        }
        //end toll
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a>Quản lý danh sách</a>';
        $data['list'] = $this->m_location->show_list_location_where_in(array("type"=>$type),0,"vn");
        $data['link'] = '';
        $data['type'] = $type;
        $data['modules'] = $modules;
        $data["country"] = $this->m_location->show_list_location_where(array("type" => 1), 1, 1, "vn", 0);
        $this->template->write('mod', "location_" . $type); // set mod
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function add($type = 1,$modules=0) {
        if (!($this->general->Checkpermission("add_location_".$type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            if($type==3) {
                $this->form_validation->set_rules('category', 'tỉnh/tp', 'is_natural_no_zero');
            }
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên khu vực -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label><br />');
            if ($this->form_validation->run() == TRUE) {
                if ((!empty($_FILES['userfile']['name']))) {
                    $picture=$this->global_function->upload_img("userfile","location",0,0);
                }else{
                    $picture="NULL";
                }
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'type' => $type,
                    'parent_id' => $this->input->post('category'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                    'hot' => $this->input->post('hot'),
                    'picture'=>$picture,
                );
                $this->db->insert('location', $sql);
                $category_id = $this->db->insert_id();
                if(isset($category_id)) {
                    foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $sql = array(
                            'location_id' => $category_id,
                            'country_id' => $lang->id,
                            'location_name' => $this->input->post('name_' . $lang->name),
                            'location_link' => $this->input->post('item_link_' . $lang->name),
                        );
                        $this->db->insert('locationdetail', $sql);
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
                                'value' => "location",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/location/edit/' . $type."/".$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/location/index/' . $type) . '?messager=success');
                    }
                }
            }
        }
        $data['weight']=$this->general->get_max('location', 'weight') + 1;
        if($type==1) $pa=0;else $pa=$type-1;
        $data["country"] = $this->m_location->show_list_location_where(array("type" => 1), 1, 1, "vn", 0);
        $data["parents"]= $this->m_location->show_list_location_where(array("type" => $pa), 1, 1, "vn", 0);
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a href="'.site_url("admin/location/index/".$type).'">Quản lý danh sách</a> <i class="fa fa-angle-right"></i><a>Thêm mới khu vực</a>';
        $data['type'] = $type;
        $this->template->write('mod', "location_add_" . $type); // set mod
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }
    function edit($type = 1, $id) {
        if (!($this->general->Checkpermission("edit_location_".$type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên khu vực -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label> <br />');
            if ($this->form_validation->run() == TRUE) {
                if ((!empty($_FILES['userfile']['name']))) {
                    $picture=$this->global_function->upload_img("userfile","location",0,0);
                }else{
                    $picture=$this->input->post("old");
                }
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'type' => $type,
                    'parent_id' => $this->input->post('category'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                    'hot' => $this->input->post('hot'),
                    'picture'=>$picture
                );
                $this->db->where("id", $id);
                $this->db->update('location', $sql);
                $category_id = $id;
                if (isset($category_id)) {
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if (isset($this->m_location->check_tmp_detail($id, $lang->id)->location_id)) {
                            $sql = array(
                                'location_name' => $this->input->post('name_' . $lang->name),
                                'location_link' => $this->input->post('item_link_' . $lang->name),
                            );
                            $this->db->where(array("location_id" => $id, 'country_id' => $lang->id));
                            $this->db->update('locationdetail', $sql);
                        } else {
                            $sql = array(
                                'location_id' => $category_id,
                                'country_id' => $lang->id,
                                'location_name' => $this->input->post('name_' . $lang->name),
                                'location_link' => $this->input->post('item_link_' . $lang->name),
                            );
                            $this->db->insert('locationdetail', $sql);
                        }
                    }
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $params = array(
                            "where" => array('tmp_id' => $category_id, 'country_id' => $lang->id, 'value' => "location"),
                            "table" => "meta_seo"
                        );
                        if ($this->global_function->count_tableWhere($params) > 0) {
                            $sql_seo = array(
                                'tmp_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => "location",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->where(array('tmp_id' => $category_id, 'country_id' => $lang->id, 'value' => "item"));
                            $this->db->update('meta_seo', $sql_seo);
                        }else {
                            $sql_seo = array(
                                'tmp_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => "location",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/location/edit/' . $type."/".$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/location/index/' . $type) . '?messager=success');
                    }
                }
            }
        }
        $data['breadcrumb'] = '<a href="admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/location/index/'.$type.'">Quản lý danh sách</a> <i class="fa fa-angle-right"></i> <a>Chỉnh sửa khu vực</a>';
        if($type==1) $pa=0;else $pa=$type-1;
        $data["country"] = $this->m_location->show_list_location_where(array("type" => 1), 1, 1, "vn", 0);
        $data["parents"] = $this->m_location->show_list_location_where(array("type" => $pa), 1, 1, "vn", 0);
        $data["item"] = $this->m_location->show_detail_location_id($id);
        if($type==3) {
            $data["parent_id"] = $parent_id = $this->m_location->show_detail_location_id($data["item"]->parent_id);
            $data["parent_child"] = $this->m_location->show_detail_location_id($parent_id->parent_id);
            $data["list_parent"] = $parent_id = $this->m_location->show_list_location_where(array("location.parent_id" => $parent_id->parent_id), 1, 1, "vn", 0);
        }
        $data["type"] = $type;
        $data['id'] = $id;
        $this->template->write('mod', "location_" . $type); // set mod
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }
//=========================================== 
    function hide($type=1,$id) {
        if (!($this->general->Checkpermission("edit_location_".$type)))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 0), "location");
        redirect(site_url('admin/location/index/'.$type) . '?messager=success');
    }
//============================================\
    function hide_more($id,$type=1) {
        if (!($this->general->Checkpermission("edit_location_".$type)))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 0), "location");
        return true;
    }
//============================================\
    function show_more($id,$type=1) {
        if (!($this->general->Checkpermission("edit_location_".$type)))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 1), "location");
        return true;
    }
//============================================\
    function show($type=1,$id) {
        if (!($this->general->Checkpermission("edit_location_".$type)))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 1), "location");
        redirect(site_url('admin/location/index/'.$type) . '?messager=success');
    }
    function update_weight($id,$weight) {
            $sql = array('weight' => $weight);
            $this->db->where('id', $id);
            $this->db->update('location', $sql);
            return true;

    }
// ============================================
    function delete($type=1,$id) {
        if (!($this->general->Checkpermission("delete_location_".$type)))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "location") > 0) {
            redirect(site_url('admin/location/index/'.$type) . '?messager=warning');
        } else {
            $this->db->delete('location', array('id' => $id));
            $this->db->delete('locationdetail', array('location_id' => $id));
            redirect(site_url('admin/location/index/'.$type) . '?messager=success');
        }
    }
    function delete_more($id,$type) {
        if (!($this->general->Checkpermission("delete_location_".$type)))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "location") > 0) {
            redirect(site_url('admin/location/') . '?messager=warning');
        } else {
             $this->db->delete('locationdetail', array('location_id' => $id));
            $this->db->delete('location', array('id' => $id));
            return true;
        }
    }
    function Active() {
        $sql = array('status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('location', $sql);
    }
    function Hot() {
        $sql = array('hot' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('location', $sql);
    }
    function Sale() {
        $this->db->update('location',array('sale'=>0));
        $sql = array('sale' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('location', $sql);
    }
    function Hot_tour() {
        $sql = array('hot_tour' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('location', $sql);
    }
    function change_modules() {
        $this->db->where('location_id', $this->input->post("id"));
        $this->db->delete('tmp_modules');
        $modules = explode(",", trim($this->input->post("active")));
        foreach($modules as $m){
            if($m!=0) {
                $this->db->insert("tmp_modules", array("location_id" => $this->input->post("id"), "value" => $m));
            }
        }
    }
    function remove_modules() {
        $this->db->where(array('location_id'=>$this->input->post("id"),"value"=>$this->input->post("active")));
        $this->db->delete('tmp_modules');

    }
    function load_city(){
        $data["list"]= $this->m_location->show_list_location_where(array("parent_id" => $this->input->post('id')), 1, 1, "vn", 0);
        $this->load->view('admin/load_city',$data);
    }
    function load_location_ajax($type){
        $data['type']=$type;
        $key=$this->input->post('key');
        $category=$this->input->post('category');
        $data["list"]= $this->m_location->show_list_location_search($key,$category);
        $this->load->view('admin/load_ajax',$data);
    }


}
