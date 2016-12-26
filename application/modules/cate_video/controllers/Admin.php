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
        $this->load->model(array("cate_video/m_cate_video", "general", "m_session", "global_function"));
        $this->template->set_template('admin');        // Set template 
    }

    function index($type = 1, $page_no = 1) {
        if (!($this->general->Checkpermission("view_cate_video_".$type)))
            redirect(site_url("admin/not-permission"));
        // tool all
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a,$type);
            }
            redirect(site_url('admin/cate_video/index/' . $type) . '?messager=success');
        }
        //end toll
        $page_co = 20;
        $start = ($page_no - 1) * $page_co;
        $count = $this->general->count_tableWhere(array("parent_id" => 0,"type"=>$type), "cate_video");
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a>Quản lý nhóm</a>';
        $data['page_no'] = $page_no;
        $data['list'] = $this->m_cate_video->show_list_cate_video_where(array("parent_id" => 0,"type"=>$type), $page_co, $start);
        $data['link'] = $this->general->paging($page_co, $count, 'admin/cate_video/index' . "/" . $type . "/", $page_no);
        $data['type'] = $type;
        $this->template->write('mod', "cate_video_" . $type); // set mod
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function add($type = 1) {
        if (!($this->general->Checkpermission("add_cate_video_".$type)))
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
                    'type' => $type,
                    'parent_id' => $this->input->post('category'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                );
                $this->db->insert('cate_video', $sql);
                $category_id = $this->db->insert_id();
                if(isset($category_id)) {
                    foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $sql = array(
                            'cate_video_id' => $category_id,
                            'country_id' => $lang->id,
                            'cate_video_name' => $this->input->post('name_' . $lang->name),
                            'cate_video_link' => $this->input->post('item_link_' . $lang->name),
                        );
                        $this->db->insert('cate_videodetail', $sql);
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
                                'value' => "cate_video",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/cate_video/edit/' . $type."/".$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/cate_video/index/' . $type) . '?messager=success');
                    }
                }
            }
        }
        $data['weight']=$this->general->get_max('cate_video', 'weight') + 1;
        $data["parents"] = $this->m_cate_video->show_list_cate_video_where(array("parent_id" => 0), 1, 1, "en", 0);
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a href="'.site_url("admin/cate_video/index/".$type).'">Quản lý nhóm</a> <i class="fa fa-angle-right"></i><a>Thêm mới nhóm</a>';
        $data['type'] = $type;
        $this->template->write('mod', "cate_video_" . $type); // set mod
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }

    function edit($type = 1, $id) {
        if (!($this->general->Checkpermission("edit_cate_video_".$type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên nhóm -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label> <br />');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'type' => $type,
                    'parent_id' => $this->input->post('category'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                );
                $this->db->where("id", $id);
                $this->db->update('cate_video', $sql);
                $category_id = $id;
                if (isset($category_id)) {
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if (isset($this->m_cate_video->check_tmp_detail($id, $lang->id)->cate_video_id)) {
                            $sql = array(
                                'cate_video_name' => $this->input->post('name_' . $lang->name),
                                'cate_video_link' => $this->input->post('item_link_' . $lang->name),
                            );
                            $this->db->where(array("cate_video_id" => $id, 'country_id' => $lang->id));
                            $this->db->update('cate_videodetail', $sql);
                        } else {
                            $sql = array(
                                'cate_video_id' => $category_id,
                                'country_id' => $lang->id,
                                'cate_video_name' => $this->input->post('name_' . $lang->name),
                                'cate_video_link' => $this->input->post('item_link_' . $lang->name),
                            );
                            $this->db->insert('cate_videodetail', $sql);
                        }
                    }
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $params = array(
                            "where" => array('tmp_id' => $category_id, 'country_id' => $lang->id, 'value' => "cate_video"),
                            "table" => "meta_seo"
                        );
                        if ($this->global_function->count_tableWhere($params) > 0) {
                            $sql_seo = array(
                                'tmp_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => "cate_video",
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
                                'value' => "cate_video",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/cate_video/edit/' . $type."/".$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/cate_video/index/' . $type) . '?messager=success');
                    }
                }
            }
        }
        $data['breadcrumb'] = '<a href="admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/cate_video/index/'.$type.'">Quản lý nhóm</a> <i class="fa fa-angle-right"></i> <a>Chỉnh sửa nhóm</a>';
        $data["parents"] = $this->m_cate_video->show_list_cate_video_where(array("parent_id" => 0), 1, 1, "en", 0);
        $data["item"] = $this->m_cate_video->show_detail_cate_video_id($id);
        $data["type"] = $type;
        $data['id'] = $id;
        $this->template->write('mod', "cate_video_" . $type); // set mod
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }

//=========================================== 
    function hide($type=1,$id) {
        if (!($this->general->Checkpermission("edit_cate_video_".$type)))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 0), "cate_video");
        redirect(site_url('admin/cate_video/index/'.$type) . '?messager=success');
    }

//============================================\
    function hide_more($id) {
        if (!($this->general->Checkpermission("edit_cate_video_".$type)))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 0), "cate_video");
        return true;
    }

//============================================\
    function show($type=1,$id) {
        if (!($this->general->Checkpermission("edit_cate_video_".$type)))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 1), "cate_video");
        redirect(site_url('admin/cate_video/index/'.$type) . '?messager=success');
    }

// ============================================
    function delete($type=1,$id) {
        if (!($this->general->Checkpermission("delete_cate_video_".$type)))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "cate_video") > 0) {
            redirect(site_url('admin/cate_video/index/'.$type) . '?messager=warning');
        } else {
            $this->db->delete('cate_video', array('id' => $id));
            $this->db->delete('cate_videodetail', array('cate_video_id' => $id));
            redirect(site_url('admin/cate_video/index/'.$type) . '?messager=success');
        }
    }

    function delete_more($id,$type) {
        if (!($this->general->Checkpermission("delete_cate_video_".$type)))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "cate_video") > 0) {
            redirect(site_url('admin/cate_video/') . '?messager=warning');
        } else {
             $this->db->delete('cate_videodetail', array('cate_video_id' => $id));
            $this->db->delete('cate_video', array('id' => $id));
            return true;
        }
    }
    function Active() {
        if (!($this->general->Checkpermission("edit_article_1"))) {
            redirect(site_url("admin/not-permission"));
        }else {
            $sql = array('status' => $this->input->post("active"));
            $this->db->where('id', $this->input->post("id"));
            $this->db->update('cate_video', $sql);
        }
    }

}
