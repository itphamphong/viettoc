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
        $this->load->model(array("extra_services/m_extra_services", "general", "m_session", "global_function"));
        $this->template->set_template('admin');        // Set template 
    }
    function index($page_no = 1) {
        if (!($this->general->Checkpermission("view_extra_services")))
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
            redirect(site_url('admin/extra_services') . '?messager=success');
        }
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a);
            }
            redirect(site_url('admin/extra_services') . '?messager=success');
        }
        //end toll
        $page_co = 50;
        $start = ($page_no - 1) * $page_co;
        $count = $this->general->count_tableWhere(array("extra_services.id !="=>0), "extra_services");
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a>Quản lý danh mục</a>';
        $data['page_no'] = $page_no;
        $data['list'] = $this->m_extra_services->show_list_extra_services_where(array("extra_services.id !=" => 0), $page_co, $start);
        $data['link'] = $this->general->paging($page_co, $count, 'admin/extra_services/index' . "/", $page_no);
        $this->template->write('mod', "extra_services_list" ); // set mod
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function add() {
        if (!($this->general->Checkpermission("add_extra_services")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên danh mục -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label><br />');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                );
                $this->db->insert('extra_services', $sql);
                $category_id = $this->db->insert_id();
                if(isset($category_id)) {
                    foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                        $sql = array(
                            'extra_services_id' => $category_id,
                            'country_id' => $lang->id,
                            'extra_services_name' => $this->input->post('name_' . $lang->name),
                            'extra_services_link' => $this->input->post('item_link_' . $lang->name),
                        );
                        $this->db->insert('extra_servicesdetail', $sql);
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
                                'value' => "extra_services",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/extra_services/edit/' .$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/extra_services') . '?messager=success');
                    }
                }
            }
        }
        $data['weight']=$this->general->get_max('extra_services', 'weight') + 1;
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a> <i class="fa fa-angle-right"></i> <a href="'.site_url("admin/extra_services").'">Quản lý</a> <i class="fa fa-angle-right"></i><a>Thêm mới</a>';
        $this->template->write('mod', "extra_services_add"); // set mod
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }
    function Save()
    {
        $list = $this->global_function->list_tableWhere(array("cozy_old.iCozyID !=" => 0), "cozy_old", "*");
        foreach ($list as $row) {
            if ($this->global_function->count_table(array('extra_services.id' => $row->iCozyID), "extra_services") == 0) {

                $sql = array(
                    'weight' => $row->iOrder,
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $row->iStatus,
                    'id' => $row->iCozyID,
                );
                $this->db->insert('extra_services', $sql);
                $category_id = $this->db->insert_id();
                if (isset($category_id)) {
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if ($lang->name == 'vn') {
                            $name = $row->sCozyName_VN;
                        } else {
                            $name = $row->sCozyName_EN;
                        }
                        $sql = array(
                            'extra_services_id' => $category_id,
                            'country_id' => $lang->id,
                            'extra_services_name' => $name,
                            'extra_services_link' => $this->global_function->unicode($name),
                        );
                        $this->db->insert('extra_servicesdetail', $sql);
                    }

                } else {

                }
            }

        }
    }
    function edit($id) {
        if (!($this->general->Checkpermission("edit_extra_services")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            //$this->form_validation->set_rules('id_cate', 'Thư mục gốc', 'is_natural_no_zero');
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên danh mục -' . $lang->title . ' ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label> <br />');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'weight' => $this->input->post('weight'),
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'status' => $this->input->post('status'),
                );
                $this->db->where("id", $id);
                $this->db->update('extra_services', $sql);
                $category_id = $id;
                if (isset($category_id)) {
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if (isset($this->m_extra_services->check_tmp_detail($id, $lang->id)->extra_services_id)) {
                            $sql = array(
                                'extra_services_name' => $this->input->post('name_' . $lang->name),
                                'extra_services_link' => $this->input->post('item_link_' . $lang->name),
                            );
                            $this->db->where(array("extra_services_id" => $id, 'country_id' => $lang->id));
                            $this->db->update('extra_servicesdetail', $sql);
                        } else {
                            $sql = array(
                                'extra_services_id' => $category_id,
                                'country_id' => $lang->id,
                                'extra_services_name' => $this->input->post('name_' . $lang->name),
                                'extra_services_link' => $this->input->post('item_link_' . $lang->name),
                            );
                            $this->db->insert('extra_servicesdetail', $sql);
                        }
                    }
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $params = array(
                            "where" => array('tmp_id' => $category_id, 'country_id' => $lang->id, 'value' => "extra_services"),
                            "table" => "meta_seo"
                        );
                        if ($this->global_function->count_tableWhere($params) > 0) {
                            $sql_seo = array(
                                'tmp_id' => $category_id,
                                'country_id' => $lang->id,
                                'value' => "extra_services",
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
                                'value' => "extra_services",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/extra_services/edit/'.$category_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/extra_services') . '?messager=success');
                    }
                }
            }
        }
        $data['breadcrumb'] = '<a href="admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/extra_services/index">Quản lý danh mục</a> <i class="fa fa-angle-right"></i> <a>Chỉnh sửa danh mục</a>';
        $data["item"] = $this->m_extra_services->show_detail_extra_services_id($id);
        $data['id'] = $id;
        $this->template->write('mod', "extra_services_edit"); // set mod
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }

    function Active() {
        $sql = array('status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('extra_services', $sql);
    }
    function update_weight($id,$weight) {
        if (!($this->general->Checkpermission("edit_item")))
            redirect(site_url("admin/not-permission"));
        $sql = array('weight' => $weight);
        $this->db->where('id', $id);
        $this->db->update('extra_services', $sql);
        return true;
    }
// ============================================
    function delete($id) {
        if (!($this->general->Checkpermission("delete_extra_services")))
            redirect(site_url("admin/not-permission"));
            $this->db->delete('extra_services_tmp', array('extra_services_id' => $id));
            $this->db->delete('extra_services', array('id' => $id));
            $this->db->delete('extra_servicesdetail', array('extra_services_id' => $id));
            redirect(site_url('admin/extra_services') . '?messager=success');

    }

    function delete_more($id) {
        if (!($this->general->Checkpermission("delete_extra_services")))
            redirect(site_url("admin/not-permission"));
        $this->db->delete('extra_services_tmp', array('extra_services_id' => $id));
        $this->db->delete('extra_servicesdetail', array('extra_services_id' => $id));
        $this->db->delete('extra_services', array('id' => $id));
        return true;

    }

}
