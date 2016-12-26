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
        $this->load->model(array("config_language/m_config_language", "general", "m_session", "global_function"));
        $this->template->set_template('admin');        // Set template 
    }

    function index($type = 1, $page_no = 1) {
        if (!($this->general->Checkpermission("view_config_language_".$type)))
            redirect(site_url("admin/not-permission"));
        // tool all
        if (isset($_POST['update'])) {
            $array = array_keys($this->input->post('checkall'));
            $weight = $this->input->post('weight');
            if(!empty($weight)) {
                for ($i = 0; $i < count($array); $i++) {
                    $this->update_weight($array[$i], $weight[$i]);
                }
            }
            redirect(site_url('admin/config_language/index/' . $type) . '?messager=success');
        }
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a);
            }
            redirect(site_url('admin/config_language/index/' . $type) . '?messager=success');
        }
        //end toll
        if( $this->m_session->userdata('admin_login')->type == 2){
            $where=array("config_language.id !="=>0,"config_language.type"=>$type);
        }else{
            $where=array("config_language.status "=>1,"config_language.type"=>$type);
        }
        $page_co = 0;
        $start = ($page_no - 1) * $page_co;
        $count = $this->general->count_tableWhere($where, "config_language");
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a>Quản lý ngôn ngữ</a>';
        $data['page_no'] = $page_no;
        $data['list'] = $this->m_config_language->show_list_config_language_where($where, $page_co, $start,'vn',0);
        $data['link'] = ''; //$this->general->paging($page_co, $count, 'admin/config_language/index' . "/" . $type . "/", $page_no);
        $data['type'] = $type;
        $this->template->write('mod', "config_language_".$type); // set mod
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function add($type = 1) {
        if (!($this->general->Checkpermission("add_config_language")))
            redirect(site_url("admin/not-permission"));
        if( $this->m_session->userdata('admin_login')->type != 2){
            redirect(site_url("admin/not-permission"));
        }
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            $this->form_validation->set_rules('name', 'Biến', 'trim|required');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('value_' . $lang->name, 'Tên -' . $lang->title . ' ', 'trim|required');

            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label><br />');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'name' => $this->input->post('name'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                );
                $this->db->insert('config_language', $sql);
                $category_id = $this->db->insert_id();
                if(isset($category_id)) {
                    foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $sql = array(
                            'config_language_id' => $category_id,
                            'country_id' => $lang->id,
                            'value' => $this->input->post('value_' . $lang->name),
                            'url' => $this->input->post('url_' . $lang->name),
                        );
                        $this->db->insert('config_languagedetail', $sql);
                    }
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/config_language/edit/'.$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/config_language') . '?messager=success');
                    }
                }
            }
        }
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a href="'.site_url("admin/config_language/index/".$type).'">Quản lý ngôn ngữ</a> <i class="fa fa-angle-right"></i><a>Thêm mới ngôn ngữ</a>';
        $data['type'] = $type;
        $this->template->write('mod', "config_language_" . $type); // set mod
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }

    function edit($id) {
        if (!($this->general->Checkpermission("edit_config_language")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            $this->form_validation->set_rules('name', 'Biến', 'trim|required');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('value_' . $lang->name, 'Tên -' . $lang->title . ' ', 'trim|required');

            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label> <br />');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'name' => $this->input->post('name'),
                );
                $this->db->where("id", $id);
                $this->db->update('config_language', $sql);
                $category_id = $id;
                if (isset($category_id)) {
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if (isset($this->m_config_language->check_tmp_detail($id, $lang->id)->config_language_id)) {
                            $sql = array(
                                'value' => $this->input->post('value_' . $lang->name),
                                'url' => $this->input->post('url_' . $lang->name),
                            );
                            $this->db->where(array("config_language_id" => $id, 'country_id' => $lang->id));
                            $this->db->update('config_languagedetail', $sql);
                        } else {
                            $sql = array(
                                'config_language_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => $this->input->post('value_' . $lang->name),
                                'url' => $this->input->post('url_' . $lang->name),
                            );
                            $this->db->insert('config_languagedetail', $sql);
                        }
                    }
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/config_language/edit/'.$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/config_language/') . '?messager=success');
                    }
                }
            }
        }
        $data['breadcrumb'] = '<a href="admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/config_language/">Quản lý ngôn ngữ</a> <i class="fa fa-angle-right"></i> <a>Chỉnh sửa ngôn ngữ</a>';
        $data["item"] = $this->m_config_language->show_detail_config_language_id($id);
        $data['id']=$id;
        $this->template->write('mod', "config_language"); // set mod
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }
    function Active()
    {
        $sql = array('status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('config_language', $sql);
    }
    function Type()
    {
        $sql = array('type' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('config_language', $sql);
    }
// ============================================
    function delete($id) {
        if (!($this->general->Checkpermission("delete_config_language")))
            redirect(site_url("admin/not-permission"));
        if( $this->m_session->userdata('admin_login')->type != 2){
            redirect(site_url("admin/not-permission"));
        }
        $this->db->delete('config_language', array('id' => $id));
            $this->db->delete('config_languagedetail', array('config_language_id' => $id));
            redirect(site_url('admin/config_language/') . '?messager=success');

    }

    function delete_more($type=1,$id) {
        if (!($this->general->Checkpermission("delete_config_language_".$type)))
            redirect(site_url("admin/not-permission"));
        if( $this->m_session->userdata('admin_login')->type != 2){
            redirect(site_url("admin/not-permission"));
        }
             $this->db->delete('config_languagedetail', array('config_language_id' => $id));
            $this->db->delete('config_language', array('id' => $id));
            return true;

    }

}
