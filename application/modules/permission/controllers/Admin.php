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
        $this->load->library('form_validation');
        $this->load->helper(array("url"));
        $this->load->model(array("permission/m_permission", "general", "m_session", "global_function"));
        $this->template->set_template('admin');        // Set template 
        $this->template->write('mod', "permission"); // set mod
    }

    function index($page_no = 1) {
        if ($this->m_session->userdata('admin_login')->type != 2)
            redirect(site_url("admin/not-permission"));;
        if (!($this->general->Checkpermission("view"))) {
            redirect(site_url("admin/not-permission"));
        } else {
// tool all    
            if (isset($_POST['show']) && $this->input->post('checkall') != "") {
                $array = array_keys($this->input->post('checkall'));
                foreach ($array as $a) {
                    $this->show_more($a);
                }
                redirect(site_url('admin/permission') . '?messager=success');
            }
            if (isset($_POST['hide']) && $this->input->post('checkall') != "") {
                $array = array_keys($this->input->post('checkall'));
                foreach ($array as $a) {
//--------change parent------
                    $this->hide_more($a);
                }
                redirect(site_url('admin/permission') . '?messager=success');
            }
            if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
                $array = array_keys($this->input->post('checkall'));
                foreach ($array as $a) {
//--------change parent------
                    $this->delete_more($a);
                }
                redirect(site_url('admin/permission') . '?messager=success');
            }
//end toll
            $page_co = 100;
            $start = ($page_no - 1) * $page_co;
            $count = $this->global_function->count_table(array("id !=" => 0), "table_permission");
            $data['page_no'] = $page_no;
            $data['list'] = $this->m_permission->show_list_permission_where($page_co, $start);
            $data['link'] = $this->general->paging($page_co, $count, 'admin/permission' . "/", $page_no);
            $this->template->write_view('content', 'admin/index', $data, TRUE);
            $this->template->render();
        }
    }

    function add()
    {
        if (!($this->general->Checkpermission("add"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data['ma'] = $this->global_function->randomPassword(5) . (str_replace("-", "", date("y-m-d")));
            $data['breadcrumb'] = '<a href="' . base_url() . 'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/article/index">Quản lý danh sách</a>';
            if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
                $this->form_validation->set_rules('name', 'Tên', 'trim|required|max_length[100]');
                $this->form_validation->set_rules('value', 'Giá trị', 'trim|required');
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                if ($this->form_validation->run() == TRUE) {
//------ insert du lieu -------
                    $sql = array(
                        'name' => $this->input->post('name'),
                        'value' => $this->input->post('value'),
                        'status' => $this->input->post('status'),
                    );
                    $this->db->insert('table_permission', $sql);
                    $id = $this->db->insert_id();
                    if (isset($_POST['ok-continues'])) {
                        redirect(site_url('admin/permission/edit/' . $id) . '?messager=success');
                    } else {
                        redirect(site_url('admin/permission') . '?messager=success');
                    }
                }
            }
                $this->template->write_view('content', 'admin/add', $data, TRUE);
                $this->template->render();

        }
    }
    function edit($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/article/index">Quản lý danh sách</a>';
            $data["permission"] = $this->global_function->get_tableWhere( array("id" => $id),"table_permission");
            if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
                $this->form_validation->set_rules('name', 'Tên', 'trim|required|max_length[100]');
                $this->form_validation->set_rules('value', 'Giá trị', 'trim|required');
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                if ($this->form_validation->run() == TRUE) {
//------ insert du lieu -------
                    $password = md5($this->input->post('password'));
                    $sql = array(
                        'name' => $this->input->post('name'),
                        'value' => $this->input->post('value'),
                        'status' => $this->input->post('status'),
                    );
                    $this->db->where("id", $id);
                    $this->db->update("table_permission", $sql);
                    if (isset($_POST['ok-continues'])) {
                        redirect(site_url('admin/permission/edit/' . $id) . '?messager=success');
                    } else {
                        redirect(site_url('admin/permission') . '?messager=success');
                    }
                }
            }
                $this->template->write_view('content', 'admin/edit', $data, TRUE);
                $this->template->render();
            }
    }
// ============================================
    function delete($id) {
        if (!($this->general->Checkpermission("delete"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->db->delete('table_permission', array('id' => $id));
            redirect(site_url('admin/permission') . '?messager=success');
        }
    }
    function delete_more($id) {
        if (!($this->general->Checkpermission("delete"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->db->delete('table_permission', array('id' => $id));
            return true;
        }
    }

//=========================================== 
    function hide($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->db->where("id", $id);
            $this->db->update("table_permission", array('status' => 0));
            redirect(site_url('admin/permission') . '?messager=success');
        }
    }
    function Active() {
        $sql = array('status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('table_permission', $sql);
    }

}
