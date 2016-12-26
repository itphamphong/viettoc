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
        $this->load->model(array("moderator/m_moderator", "general", "m_session", "global_function","order/m_order","item/m_item","users/m_users"));
        $this->template->set_template('admin');        // Set template
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
                redirect(site_url('admin/moderator') . '?messager=success');
            }
            if (isset($_POST['hide']) && $this->input->post('checkall') != "") {
                $array = array_keys($this->input->post('checkall'));
                foreach ($array as $a) {
//--------change parent------
                    $this->hide_more($a);
                }
                redirect(site_url('admin/moderator') . '?messager=success');
            }
            if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
                $array = array_keys($this->input->post('checkall'));
                foreach ($array as $a) {
//--------change parent------
                    $this->delete_more($a);
                }
                redirect(site_url('admin/moderator') . '?messager=success');
            }
//end toll
            $this->template->write('mod', "moderator"); // set mod
            $page_co = 20;
            $start = ($page_no - 1) * $page_co;
            $count = $this->global_function->count_table(array("type" => 1), "tbl_user");
            $data['page_no'] = $page_no;
            $data['list'] = $this->m_moderator->show_list_user_where($page_co, $start);
            $data['link'] = $this->general->paging($page_co, $count, 'admin/user' . "/", $page_no);
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
                $this->form_validation->set_rules('user_name', 'Họ & Tên', 'trim|required|max_length[100]');
                $this->form_validation->set_rules('user_loginname', 'Tài khoản đăng nhập', 'trim|required|max_length[100]|callback_checkusername');
                $this->form_validation->set_rules('user_email', 'Email', 'trim|required|max_length[100]|callback_checkemail');
                $this->form_validation->set_message('checkemail', 'Email is already in use, please try another');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[32]|matches[re_password]');
                $this->form_validation->set_rules('re_password', 'Re-Password', 'trim|required|max_length[32]');
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                $this->form_validation->set_message('checkusername', 'username   is already in use, please try another.');
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                if ($this->form_validation->run() == TRUE) {
//------ insert du lieu -------
                    $password = md5($this->input->post('password'));
                    $sql = array(
                        'user_loginname' => $this->input->post('user_loginname'),
                        'user_status' => $this->input->post('status'),
                        'user_email' => $this->input->post('user_email'),
                        'user_name' => $this->input->post('user_name'),
                        'user_password' => $password,
                        'store_id' => $this->input->post('store_id'),
                    );

                    $this->db->insert('tbl_user', $sql);
                    $id = $this->db->insert_id();
                    if (isset($_POST['ok-continues'])) {
                        redirect(site_url('admin/moderator/edit/' . $id) . '?messager=success');
                    } else {
                        redirect(site_url('admin/moderator') . '?messager=success');
                    }
                }
            }
            $this->template->write('mod', "moderator_add"); // set mod
                $this->template->write_view('content', 'admin/add', $data, TRUE);
                $this->template->render();

        }
    }
    function edit($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data['ma'] = $this->global_function->randomPassword(5) . (str_replace("-", "", date("y-m-d")));
            $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/article/index">Quản lý danh sách</a>';
            $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id, "user_id !=" => 1),"tbl_user");
            if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
            if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
                $this->form_validation->set_rules('user_name', 'Full name', 'trim|required|max_length[100]');
                $this->form_validation->set_rules('user_loginname', 'User name', 'trim|required|max_length[100]|callback_checkusername');
                $this->form_validation->set_rules('user_email', 'Email', 'trim|required|max_length[100]|callback_checkemail');
                $this->form_validation->set_message('checkemail', 'Email is already in use, please try another');
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                $this->form_validation->set_message('checkusername', 'username   is already in use, please try another.');
                $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
                if ($this->form_validation->run() == TRUE) {
                //------ insert du lieu -------
                    $password = md5($this->input->post('password'));
                    $sql = array(
                        'user_loginname' => $this->input->post('user_loginname'),
                        'user_address' => $this->input->post('user_address'),
                        'user_status' => $this->input->post('status'),
                        'user_email' => $this->input->post('user_email'),
                        'user_phone' => $this->input->post('user_phone'),
                        'user_name' => $this->input->post('user_name'),
                        'store_id' => $this->input->post('store_id'),
                    );
                    if($this->input->post('password')!=''){
                        $sql['user_password']=md5($this->input->post('password'));
                    }
                    $this->db->where("user_id", $id);
                    $this->db->update("tbl_user", $sql);
                    if (isset($_POST['ok-continues'])) {
                        redirect(site_url('admin/moderator/edit/' . $id) . '?messager=success');
                    } else {
                        redirect(site_url('admin/moderator') . '?messager=success');
                    }
                }
            }
            $this->template->write('mod', "moderator"); // set mod
                $this->template->write_view('content', 'admin/edit', $data, TRUE);
                $this->template->render();
            }
    }
    function M_permission($id) {
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            $p = "";
            $x = 0;
            $count = count($this->input->post("level"));
            foreach ($this->input->post("level") as $r) {
                if ($x != ($count - 1))
                    $p.=$r . ",";
                else {
                    $p.=$r;
                }
                $x++;
            }
            $this->db->where("user_id", $id);
            $this->db->update("tbl_user", array("permission" => base64_encode($p)));
            if (isset($_POST['ok-continues'])) {
                redirect(site_url('admin/moderator/m_permission/' . $id) . '?messager=success');
            } else {
                redirect(site_url('admin/moderator') . '?messager=success');
            }
        }
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/permission">Phân quyền</a>';
        $this->template->write('mod', "moderator_add"); // set mod
        $user = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
        $array = array();
        $array = explode(",", $user->permission);
        $data["id"] = $id;
        $data['list_permission']=$this->global_function->list_tableWhere(array('status'=>1),"table_permission");
        $this->template->write_view('content', 'admin/permission', $data, TRUE);
        $this->template->render();
    }

// ============================================
    function delete($id) {
        if (!($this->general->Checkpermission("delete"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
            if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
            $this->db->delete('tbl_user', array('user_id' => $id));
            redirect(site_url('admin/moderator') . '?messager=success');
        }
    }
    function delete_more($id) {
        if (!($this->general->Checkpermission("delete"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
            if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
            $this->db->delete('tbl_user', array('user_id' => $id));
            return true;
        }
    }

//=========================================== 
    function hide($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
            if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
            $this->db->where("user_id", $id);
            $this->db->update("tbl_user", array('user_status' => 0));
            redirect(site_url('admin/moderator') . '?messager=success');
        }
    }

//============================================\
    function hide_more($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
            if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
            $this->db->where("user_id", $id);
            $this->db->update("tbl_user", array('user_status' => 0));
            return true;
        }
    }

//============================================\
    function show_more($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
            if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
            $this->db->where("user_id", $id);
            $this->db->update("tbl_user", array('user_status' => 1));
            return true;
        }
    }

//============================================\
    function show($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
            if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
            $this->db->where("user_id", $id);
            $this->db->update("tbl_user", array('user_status' => 1));
            redirect(site_url('admin/moderator') . '?messager=success');
        }
    }
    public function checkemail() {
        $check = $this->global_function->get_tableWhere(array("user_email" => $this->input->post("user_email"), "user_id !=" => $this->input->post("user_id")),"tbl_user");
        if (isset($check->user_id))
            return false;
        else
            return true;
    }
    public function checkusername() {
        $check =  $this->global_function->get_tableWhere( array("user_loginname" => $this->input->post("user_loginname"), "user_id !=" => $this->input->post("user_id")),"tbl_user");
        if (isset($check->user_id))
            return false;
        else
            return true;
    }

    function Change_pass($id) {
        if (!($this->general->Checkpermission("edit")))
            redirect(site_url("admin/not-permission"));
        $data = array();
        $data["user"] = $this->global_function->get_tableWhere( array("user_id" => $id),"tbl_user");
        if(isset($data["user"]->type) && $data["user"]->type==2) redirect(site_url("admin/users"));
        if (isset($_POST['ok'])) {
            //$this->form_validation->set_rules('old_pass', 'Password', 'trim|required|max_length[24]');
            $customers = $this->a_general->get_row("tbl_user", array("user_id" => $id));
            /*if ($customers->user_password != MD5($this->input->post('old_pass'))) {
                $this->form_validation->set_rules('old_pass', 'Password', 'callback_check_oldpass');
            }*/
            $this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|max_length[24]');
            $this->form_validation->set_rules('re_new_pass', 'Confirm Password', 'trim|required|max_length[24]|callback_checknewpass');
            $this->form_validation->set_message('check_oldpass', 'Password Error');
            $this->form_validation->set_message('checknewpass', 'Confirm Password is false');
            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
            if ($this->form_validation->run() == TRUE) {
                $sql = array(
                    'user_password' => MD5($this->input->post('new_pass')),
                );
                $this->db->where('user_id', $id);
                if ($this->db->update('tbl_user', $sql)) {
                    if ($this->m_session->userdata('admin_login')) {

                    }
                    redirect(site_url('admin/moderator/change_pass/' . $id) . '?messager=success');
                } else {

                    redirect(site_url('admin/moderator/change_pass/' . $id) . '?messager=error');
                }
            }
        }
        $this->template->write_view('content', 'admin/change_pass', $data, TRUE);
        $this->template->render();
    }

    // admin change
    function Change_my_pass() {
        $id = $this->m_session->userdata('admin_login')->user_id;
        $data = array();
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            $this->form_validation->set_rules('new_pass', 'Mật khẩu mới', 'trim|required|max_length[24]');
            $this->form_validation->set_rules('re_new_pass', 'Xác nhận mật khẩu', 'trim|required|max_length[24]|callback_checknewpass');
            $this->form_validation->set_message('checknewpass', 'Xác nhận mật khẩu không chính xác');
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label>');
            if ($this->form_validation->run($this) == TRUE) {
                $sql = array(
                    'user_password' => MD5($this->input->post('new_pass')),
                );
                $this->db->where('user_id', $id);
                if ($this->db->update('tbl_user', $sql)) {
                    if ($this->m_session->userdata('admin_login')) {

                    }
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/change-my-pass') . '?messager=success');
                    }else {
                        redirect(site_url('admin/change-my-pass') . '?messager=success');
                    }
                } else {

                    redirect(site_url('admin/change-my-pass') . '?messager=error');
                }
            }
        }
        $this->template->write_view('content', 'admin/change_pass', $data, TRUE);
        $this->template->render();
    }

    // change my info admin
    function ChangeMyInfo() {
        $id = $this->m_session->userdata('admin_login')->user_id;
        $data['ma'] = $this->global_function->randomPassword(5) . (str_replace("-", "", date("y-m-d")));
        $data['breadcrumb'] = '<li>>></li><li class="current">Thành viên</li>';
        $data["user"] = $this->a_general->get_row("tbl_user", array("user_id" => $id));
        if ($this->input->post('ok')) {
            $this->form_validation->set_rules('user_name', 'Full name', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('user_loginname', 'User name', 'trim|required|max_length[100]|callback_checkusername');
            $this->form_validation->set_rules('user_email', 'Email', 'trim|required|max_length[100]|callback_checkemail');
            $this->form_validation->set_message('checkemail', 'Email is already in use, please try another');
            $this->form_validation->set_rules('user_address', 'Address', 'trim');
            $this->form_validation->set_rules('user_phone', 'Phone', 'trim');
            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

            $this->form_validation->set_message('checkusername', 'username   is already in use, please try another.');

            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');

            if ($this->form_validation->run() == TRUE) {
//------ insert du lieu -------
                $password = md5($this->input->post('password'));
                $sql = array(
                    'user_loginname' => $this->input->post('user_loginname'),
                    'user_address' => $this->input->post('user_address'),
                    'user_status' => $this->input->post('user_status'),
                    'user_email' => $this->input->post('user_email'),
                    'user_phone' => $this->input->post('user_phone'),
                    'user_name' => $this->input->post('user_name'),
                );
                $this->db->where("user_id", $id);
                $this->db->update("tbl_user", $sql);
                redirect(site_url('admin/change-info') . '?messager=success');
            } else {
                $this->template->write_view('content', 'admin/edit', $data, TRUE);
                $this->template->render();
            }
        } else {

            $this->template->write_view('content', 'admin/edit', $data, TRUE);
            $this->template->render();
        }
    }

    function checknewpass() {
        if ($_POST['new_pass'] == $_POST['re_new_pass'])
            return true;
        else
            return false;
    }

    function check_oldpass($id) {
        return false;
    }
    function Active() {
        $sql = array('user_status' => $this->input->post("active"));
        $this->db->where('user_id', $this->input->post("id"));
        $this->db->update('tbl_user', $sql);
    }
    // login
    function Login() {

        $this->load->library('form_validation');
        //-----------------------
        if ($this->input->post()) {
            $this->form_validation->set_rules('user', 'Username', 'required|trim');
            $this->form_validation->set_rules('pass', 'Password', 'required|trim|callback_checklogin');
            $this->form_validation->set_error_delimiters('<label class="error">', '</label>');
            $this->form_validation->set_message('checklogin', 'Sai username hoặc password');
            if ($this->form_validation->run() == true) {
                $user = strtolower($this->input->post('user'));
                $pass = $this->input->post('pass');
                $record = $this->general->login($user, $pass); //TRUY VẤN DỮ LIỆU
                if ($record->num_rows() == 1) {
                    $login = $record->row();
                    //$this->session->set_userdata( 'admin_login', $login );
                    $this->m_session->set_userdata('admin_login', $login);
                    @session_start();
                    @$_SESSION['active_log'] = true;
                    $this->db->insert('online_history',array('users_id'=>$this->m_session->userdata('admin_login')->user_id,'last_login'=>time()));
                    redirect(site_url('admin/'));
                } else {
                    redirect(site_url('admin/login'));
                }
            }
        }
        //------------------------
        $this->load->view('back/login');
    }

    function checklogin() {

        if ($this->general->get_admin(0, $_POST['user'], $_POST['pass']) == 1)
            return true;
        else
            return false;
    }

    //--LOGOUT---------------
    public function logout() {
        if ($this->m_session->userdata('admin_login')) {
            $this->m_session->destroy();
        }
        redirect(site_url('admin/'));
    }
    public function admin() {
        //exit('hello');
        if (!$this->m_session->userdata('admin_login')) {
            redirect(site_url('admin/login'));
        } else {
            redirect(site_url('admin/dashboard'));
        }
    }
    function Dashboard(){
        //redirect('admin/company/site');
        $this->template->set_template('admin');
        $data['total_order']=$this->m_order->sum_total();
        $data['list_order']=$this->m_order->show_list_order(5, 0);
        $data['top_buy']=$this->m_order->show_list_item_top();
        $data['list_most_view']=$this->m_item->show_list_item_page_most_view(10,0);
        $data['list_user']=$this->m_users->show_list_user_where(array('id !='=>0),10,0);
        $data['list_order_day']=$this->m_order->list_ajax('',0,0,date('Y-m-d',strtotime("-10 day")),date('Y-m-d'));// Set template
        $data['mod'] = '';
        $data['list_user']=$this->global_function->get_list_table_where(array('table'=>'online_history'));
        $data['list_contact']=$this->general->show_list_contact_page(20,0);
        $data['meta_title'] = 'Thống kê';
        $this->template->write('title', $data['meta_title']);
        $this->template->add_css('themes/css/default/register.css');
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'back/thongke', $data, TRUE);
        $this->template->render();
    }

}
