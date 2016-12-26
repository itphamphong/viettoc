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
        $this->load->model(array("language/m_language", "general", "m_session", "global_function", "menu/m_menu"));
        $this->template->set_template('admin');        // Set template 
        $this->template->write('mod', "language"); // set mod
    }

    function index($type = 0, $page_no = 1) {
        if (!($this->general->Checkpermission("view")))
            redirect(site_url("admin/not-permission"));
        // tool all
        if (isset($_POST['show']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                $this->show_more($a);
            }
            redirect(site_url('admin/language') . '?messager=success');
        }
        if (isset($_POST['hide']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->hide_more($a);
            }
            redirect(site_url('admin/language') . '?messager=success');
        }
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a);
            }
            redirect(site_url('admin/language') . '?messager=success');
        }
        //end toll
        $page_co = 10;
        $start = ($page_no - 1) * $page_co;
        $data['page_no'] = $page_no;
        if ($type == 0) {

            $count = $this->general->count_tableWhere(array("id !=" => 0), "language");
            $data['list'] = $this->m_language->show_list_language_where(array("id !=" => 0), $page_co, $start, 1);
        } else {
            $count = $this->general->count_tableWhere(array("parent_id " => 0, "type_directory_id" => $type), "language");
            $data['list'] = $this->m_language->show_list_language_where(array("parent_id" => 0, "type_directory_id" => $type), $page_co, $start, 1);
        }
        $data['link'] = $this->general->paging($page_co, $count, 'admin/language/' . $type . "/", $page_no);
        $data['page_co'] = $page_co;
        $data['start'] = $start;
        $data['type'] = $type;
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function add() {
        if (!($this->general->Checkpermission("add")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST["ok"])) {
            foreach ($this->general->show_list_lang() as $lang) {
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên Loại (' . $lang->name . ')', 'trim|required');
            }
            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    "parent_id" => $this->input->post("parent_id"),
                    "weight" => $this->input->post("weight"),
                    "status" => $this->input->post("status"),
                    "type_directory_id" => 0,
                );
                $this->db->insert("language", $sql);
                $id_insert = $this->db->insert_id();
                foreach ($this->general->show_list_lang() as $lang) {
                    $sql = array(
                        'language_id' => $id_insert,
                        'country_id' => $lang->id,
                        'language_name' => $this->input->post('name_' . $lang->name),
                        'language_link' => $this->global_function->unicode($this->input->post('name_' . $lang->name)),
                    );
                    $this->db->insert('languagedetail', $sql);
                }
                if (isset($id_insert)) {
                    redirect(site_url('admin/language') . '?messager=success');
                } else {
                    redirect(site_url('admin/language') . '?messager=warning');
                }
            }
        }

        $data["parents"] = $this->m_language->show_list_language_where(array("parent_id" => 0), 1, 1);
        $data["menu"] = $this->m_menu->show_list_menu_where(array("parent_id" => 0), 1, 1);
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }

    function edit($id) {
        if (!($this->general->Checkpermission("edit")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST["ok"])) {
            foreach ($this->general->show_list_lang() as $lang) {
                $this->form_validation->set_rules('name_' . $lang->name, 'Tên danh mục (' . $lang->name . ') ', 'trim|required|max_length[500]');
            }
            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    "weight" => $this->input->post("weight"),
                    "type_directory_id" => $this->input->post("type_directory_id"),
                    "parent_id" => 0,
                );
                $this->db->where("id", $id);
                $this->db->update("language", $sql);
                $this->db->delete("languagedetail", array("language_id" => $id));
                foreach ($this->general->show_list_lang() as $lang) {
                    $sql = array(
                        'language_id' => $id,
                        'country_id' => $lang->id,
                        'language_name' => $this->input->post('name_' . $lang->name),
                        'language_link' => $this->global_function->unicode($this->input->post('name_' . $lang->name)),
                    );
                    $this->db->insert('languagedetail', $sql);
                }
                redirect(site_url('admin/language') . '?messager=success');
            } else {
                redirect(site_url('admin/language') . '?messager=warning');
            }
        }
        $data["parents"] = $this->m_language->show_list_language_where(array("parent_id" => 0), 1, 1);
        $data["item"] = $this->general->get_tableID($id, "language");
        $data["menu"] = $this->m_menu->show_list_menu_where(array("parent_id" => 0), 1, 1);
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }

//=========================================== 
    function hide($id) {
        if (!($this->general->Checkpermission("edit")))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 0), "language");
        redirect(site_url('admin/language') . '?messager=success');
    }

//============================================\
    function hide_more($id) {
        if (!($this->general->Checkpermission("edit")))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 0), "language");
        return true;
    }

//============================================\
    function show_more($id) {
        if (!($this->general->Checkpermission("edit")))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 1), "language");
        return true;
    }

//============================================\
    function show($id) {
        if (!($this->general->Checkpermission("edit")))
            redirect(site_url("admin/not-permission"));
        $this->general->update_tableID($id, array('status' => 1), "language");
        redirect(site_url('admin/language') . '?messager=success');
    }

// ============================================
    function delete($id) {
        if (!($this->general->Checkpermission("delete")))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "language") > 0) {
            redirect(site_url('admin/language/') . '?messager=warning');
        } else {
            $this->db->delete('language', array('id' => $id));
            redirect(site_url('admin/language') . '?messager=success');
        }
    }

    function delete_more($id) {
        if (!($this->general->Checkpermission("delete")))
            redirect(site_url("admin/not-permission"));
        if ($this->general->count_tableWhere(array("parent_id" => $id), "language") > 0) {
            redirect(site_url('admin/language/') . '?messager=warning');
        } else {
            $this->db->delete('language', array('id' => $id));
            return true;
        }
    }

}
