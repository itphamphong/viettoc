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
        $this->load->model(array("album/m_album", "general", "m_session", "global_function"));
        $this->template->set_template('admin');        // Set template 
    }

    function index($type = 1, $page_no = 1) {
        if (!($this->general->Checkpermission("view_album_".$type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a);
            }
            redirect(site_url('admin/album/index/' . $type) . '?messager=success');
        }
        //end toll
        $page_co = 20;
        $start = ($page_no - 1) * $page_co;
        $count = $this->general->count_tableWhere(array("parent_id" => 0), "album");
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a>Quản lý nhóm</a>';
        $data['page_no'] = $page_no;
        $data['list'] = $this->m_album->show_list_album_where(array("parent_id" => 0), $page_co, $start);
        $data['link'] = $this->general->paging($page_co, $count, 'admin/album'."/", $page_no);
        $data['type'] = $type;
        $this->template->write('mod', "album_" . $type); // set mod
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function add($type = 1) {
        if (!($this->general->Checkpermission("add_album_".$type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên nhóm -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label><br />');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'parent_id' => $this->input->post('category'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                );
                $this->db->insert('album', $sql);
                $category_id = $this->db->insert_id();
                if(isset($category_id)) {
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $name_seo = $this->input->post('name_seo_' . $lang->name);
                        $meta_keywords = $this->input->post('meta_keywords' . $lang->name);
                        $meta_descriptions = $this->input->post('meta_descriptions' . $lang->name);
                        if (!empty($name_seo) || !empty($meta_keywords) || !empty($meta_descriptions)) {
                            $sql_seo = array(
                                'tmp_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => "album",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/album/edit/' . $type."/".$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/album/index/' . $type) . '?messager=success');
                    }
                }
            }
        }
        $data['weight']=$this->general->get_max('album', 'weight') + 1;
        $data["parents"] = $this->m_album->show_list_album_where(array("parent_id" => 0), 1, 1, "en", 0);
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a href="'.site_url("admin/album/index/".$type).'">Quản lý nhóm</a> <i class="fa fa-angle-right"></i><a>Thêm mới Album</a>';
        $data['type'] = $type;
        $this->template->write('mod', "album_" . $type); // set mod
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }

    function edit($type = 1, $id) {
        if (!($this->general->Checkpermission("edit_album_".$type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên Album -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label> <br />');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'parent_id' => $this->input->post('category'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                );
                $this->db->where("id", $id);
                $this->db->update('album', $sql);
                $category_id = $id;
                if (isset($category_id)) {
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $params = array(
                            "where" => array('tmp_id' => $category_id, 'country_id' => $lang->id, 'value' => "album"),
                            "table" => "meta_seo"
                        );
                        if ($this->global_function->count_tableWhere($params) > 0) {
                            $sql_seo = array(
                                'tmp_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => "album",
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
                                'value' => "album",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/album/edit/' . $type."/".$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/album/index/' . $type) . '?messager=success');
                    }
                }
            }
        }
        $data['breadcrumb'] = '<a href="'.base_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/album/index/'.$type.'">Quản lý nhóm</a> <i class="fa fa-angle-right"></i> <a>Chỉnh sửa nhóm</a>';
        $data["parents"] = $this->m_album->show_list_album_where(array("parent_id" => 0), 1, 1, "en", 0);
        $data["item"] = $this->m_album->show_detail_album_id($id);
        $data["type"] = $type;
        $data['id'] = $id;
        $this->template->write('mod', "album_" . $type); // set mod
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }

// ============================================
    function delete($type=1,$id) {
        if (!($this->general->Checkpermission("delete_album_".$type)))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "album") > 0) {
            redirect(site_url('admin/album/index/'.$type) . '?messager=warning');
        }else{
            $this->db->delete('album', array('id' => $id));
            redirect(site_url('admin/album/index/'.$type) . '?messager=success');
        }
    }
    function delete_more($id,$type=1) {
        if (!($this->general->Checkpermission("delete_album")))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "album") > 0) {
            redirect(site_url('admin/album/') . '?messager=warning');
        } else {
            $this->db->delete('album', array('id' => $id));
            return true;
        }
    }
    function Active() {
        $sql = array('status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('album', $sql);
    }
}
