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
        $this->load->model(array("users/m_users", "general", "m_session", "global_function","location/m_location","users/a_user",'browse_lession/m_browse_lession','time_work/m_time_work','degree/m_degree'));
        $this->template->set_template('admin');        // Set template 
    }
    function index($type=1,$page_no = 1) {
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
            $this->template->write('mod', "users_".$type); // set mod
            $page_co = 20;
            $start = ($page_no - 1) * $page_co;
            $count = $this->global_function->count_table(array("users.buyer_id" =>$type), "users");
            $data['page_no'] = $page_no;
            $data['type']=$type;
            $data['list'] = $this->m_users->show_list_user_where(array("users.buyer_id" =>$type),$page_co, $start);
            $data['link'] = $this->general->paging($page_co, $count, 'admin/user' . "/", $page_no);
            $this->template->write_view('content', 'admin/index', $data, TRUE);
            $this->template->render();
        }
    }
    function Add($type,$id=0) {
        if (!($this->general->Checkpermission("edit_user"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data['rlang'] = 'vn';
            $data['user'] = $this->general->get_tableID($id, "users");
            if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {
                $this->form_validation->set_rules('user_name',"Tài khoản đăng nhập", 'trim|required');
                $this->form_validation->set_rules('password',"Mật  khẩu", 'trim|required');
                $this->form_validation->set_rules('full_name',"Họ và tên", 'trim|required');
                $this->form_validation->set_error_delimiters('<label class="red">', '</label><br>');
                if ($this->form_validation->run($this) == true) {
                    if ((!empty($_FILES['img']['name']))) {
                        $picture = $this->global_function->upload_img('img', "users/" . $data['user']->user_name, 0, 0);
                    } else {
                        $picture = $this->input->post('old_img');
                    }
                    $sql = array(
                        "full_name" => $this->input->post('full_name'),
                        "cell_phone" => $this->input->post('phone'),
                        "email" => $this->input->post('email'),
                        "age" => $this->input->post('age'),
                        "address" => $this->input->post('address'),
                        "country_id" => $this->input->post('country_id'),
                        "city_id" => $this->input->post('city_id'),
                        "agent_id" => $this->input->post('agent_id'),
                        'avatar' => $picture,
                        "user_repair" => $this->m_session->userdata('admin_login')->user_id,
                        "user_name" => str_replace(" ", "", $this->input->post('user_name')),
                        "password" => md5($this->input->post('password')),
                        "status" =>1,
                        "user_code"=>$this->global_function->randomPassword(10),
                    );
                    $this->db->insert("users", $sql);
                    $id=$this->db->insert_id();
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                        if ($this->global_function->count_table(array('users_id' => $data['user']->id, 'country_id' => $rlang->id), 'usersdetail') == 0) {
                            $sql_lang = array(
                                'users_id' => $id,
                                'country_id' => $rlang->id,
                                "info" => $this->input->post('info-' . $rlang->name)
                            );
                            $this->db->insert('usersdetail', $sql_lang);

                        } else {
                            $this->db->where(array('users_id' => $data['user']->id, 'country_id' => $rlang->id));
                            $sql_lang = array(
                                "info" => $this->input->post('info-' . $rlang->name)
                            );
                            $this->db->update('usersdetail', $sql_lang);
                        }
                    }
                    $this->session->set_userdata('user', $data['user']);
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/users/edit/'.$type."/" . $id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/users/index/'.$type) . '?messager=success');
                    }
                }
            }
            $data['type']=$type;
            $this->template->write('mod', "users_".$type); // set mod
            $this->template->write_view('content', 'admin/add', $data);
            $this->template->render();
        }
    }
    function Edit($type,$id) {
        if (!($this->general->Checkpermission("edit_user"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $data['rlang'] = 'vn';
            $data['user'] = $this->general->get_tableID($id, "users");
            if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {
                $this->form_validation->set_rules('full_name',"Họ và tên", 'trim|required');
                $this->form_validation->set_rules('user_name',"Tài khoản đăng nhập", 'trim|required');
                if ($this->form_validation->run($this) == true) {

                    if ((!empty($_FILES['img']['name']))) {
                        $picture = $this->global_function->upload_img('img', "users/" . $data['user']->user_name, 0, 0);
                    } else {
                        $picture = $this->input->post('old_img');
                    }
                    $sql = array(
                        "full_name" => $this->input->post('full_name'),
                        "user_name" => str_replace(" ", "", $this->input->post('user_name')),
                        "cell_phone" => $this->input->post('phone'),
                        "email" => $this->input->post('email'),
                        "age" => $this->input->post('age'),
                        "address" => $this->input->post('address'),
                        "country_id" => $this->input->post('country_id'),
                        "city_id" => $this->input->post('city_id'),
                        "agent_id" => $this->input->post('agent_id'),
                        'avatar' => $picture,
                        "user_repair" => $this->m_session->userdata('admin_login')->user_id,
                    );
                    $this->db->where(array("id" => $id));
                    $this->db->update("users", $sql);
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                        if ($this->global_function->count_table(array('users_id' => $data['user']->id, 'country_id' => $rlang->id), 'usersdetail') == 0) {
                            $sql_lang = array(
                                'users_id' => $id,
                                'country_id' => $rlang->id,
                                "info" => $this->input->post('info-' . $rlang->name)
                            );
                            $this->db->insert('usersdetail', $sql_lang);

                        } else {
                            $this->db->where(array('users_id' => $data['user']->id, 'country_id' => $rlang->id));
                            $sql_lang = array(
                                "info" => $this->input->post('info-' . $rlang->name)
                            );
                            $this->db->update('usersdetail', $sql_lang);
                        }
                    }
                    $this->session->set_userdata('user', $data['user']);
                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/users/edit/'.$type."/" . $id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/users/index/'.$type) . '?messager=success');
                    }
                }
            }
            $data['type']=$type;
            $this->template->write('mod', "users_".$type); // set mod
            $this->template->write_view('content', 'admin/edit', $data);
            $this->template->render();
        }
    }
    // course
    function Course($type=1,$id)
    {
        if (!($this->general->Checkpermission("edit_user"))) redirect(site_url("admin/not-permission"));
        $data['rlang'] = 'vn';
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
//--------change parent------
                $this->delete_more_course($type,$id,$a);
            }
            redirect(site_url('admin/users/course/'.$type."/".$id) . '?messager=success');
        }
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/users">Quản lý tài khoản</a>';
        $data['user'] = $this->general->get_tableID($id, "users");
        $data['list_course']=$this->a_user->show_a_course(array('users_id'=>$id),'vn');
        $data['type']=$type;
        $this->template->write('mod', "users_".$type); // set mod
        $this->template->write_view('content', 'admin/course/index', $data);
        $this->template->render();
    }
    function Add_course($type=1,$user_id,$id=0){
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/users">Quản lý tài khoản</a>';
        $data['user'] = $this->general->get_tableID($user_id, "users");
        $data['list_course']=$this->a_user->show_a_course(array('users_id'=>$user_id),'vn');
        $data['list_browse'] = $this->m_browse_lession->show_list_browse_lession_where(array("browse_lession.browse_lession_type" => 1, "browse_lession.browse_lession_top" => 0, 'browse_lession_status' => 1),'vn');
        $data['list'] = $this->m_time_work->show_list_time_work_where(array('time_work.status' => 1), 0, 0, 'vn', 0);
        $data['course']=$this->a_user->get_a_course(array('course.id'=>$id));
        if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('course_name_' . $lang->name, $this->global_function->show_config_language('lang_course_name', 'vn')."-".$lang->title_2, 'trim|required');
                $this->form_validation->set_rules('course_note_1_' . $lang->name, $this->global_function->show_config_language('lang_course_note_1', 'vn')."-".$lang->title_2, 'trim|required');
                $this->form_validation->set_rules('course_note_2_' . $lang->name, $this->global_function->show_config_language('lang_course_note_2', 'vn')."-".$lang->title_2, 'trim|required');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">-', '</label><br />');

            //$this->form_validation->set_rules('subject', $this->global_function->show_config_language('lang_subject', $lang), 'trim|required');
            if ($this->form_validation->run($this) == true) {
                if ((!empty($_FILES['course-avatar']['name']))) {
                    $picture=$this->global_function->upload_img("course-avatar","users/".$data['user']->user_name."/course",0,0);
                }else {
                    $picture=$this->input->post("course-avatar-old");
                }
                if ((!empty($_FILES['large-picture']['name']))) {
                    $large_picture=$this->global_function->upload_img("large-picture","users/".$data['user']->user_name."/course",0,0);
                }else {
                    $large_picture=$this->input->post("large-picture-old");
                }
                $type_teach=$this->input->post('type_teach');
                $type_="";
                if(!empty($type_teach)){

                    foreach($type_teach as $t){
                        $type_.=$t.",";
                    }
                }

                $sql = array(
                    'picture' => $picture,
                    'large_picture' => $large_picture,
                    'youtube' => $this->input->post('youtube'),
                    'alt_picture' => $this->input->post('alt-course'),
                    'alt_large_picture' => $this->input->post('alt-large-picture'),
                    'fee' => $this->input->post('fee'),
                    'subject_id' => $this->input->post('subject_id'),
                    'type_teach'=>rtrim($type_,','),
                    "user_repair" => $this->m_session->userdata('admin_login')->user_id,
                    "users_id"=>$user_id,
                    'created_date' => date('Y-m-d', time()),
                );
                $this->db->insert('course', $sql);
                $id=$this->db->insert_id();
                if(!empty($type_)) {
                    foreach ($type_ as $t) {
                        $this->db->insert('course_type_teach',array('course_id'=>$id,'type_teach_id'=>$t));
                    }
                }
                foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                    if ($this->global_function->count_table(array('course_id' => $id, 'country_id' => $rlang->id), 'coursedetail') == 0) {
                        $sql_lang = array(
                            'course_id' => $id,
                            'country_id' => $rlang->id,
                            'course_name' => $this->input->post('course_name_' . $rlang->name),
                            'note_1' => $this->input->post('course_note_1_' . $rlang->name),
                            'note_2' => $this->input->post('course_note_2_' . $rlang->name),
                            'info' => $this->input->post('info_' . $rlang->name),

                        );
                        $this->db->insert('coursedetail', $sql_lang);
                    } else {
                        $this->db->where(array('course_id' => $id, 'country_id' => $rlang->id));
                        $sql_lang = array(
                            'course_name' => $this->input->post('course_name_' . $rlang->name),
                            'note_1' => $this->input->post('course_note_1_' . $rlang->name),
                            'note_2' => $this->input->post('course_note_2_' . $rlang->name),
                            'info' => $this->input->post('info_' . $rlang->name),

                        );
                        $this->db->update('coursedetail', $sql_lang);
                    }
                }
                //

                $day = $this->input->post('day');
                $start_time = $this->input->post('start_time');
                $end_time = $this->input->post('end_time');
                if (!empty($day)) {
                    $i = 0;
                    foreach ($day as $d) {
                        $sql_time = array(
                            'course_id' => $id,
                            'day' => $d,
                            "start_time" => $start_time[$i],
                            "end_time" => $end_time[$i],
                        );
                        $this->db->insert('course_available_time', $sql_time);
                        $i++;
                    }
                }
                if(isset($_POST['ok-continues'])){
                    redirect(site_url('admin/users/edit_course/'.$type."/".$user_id."/" . $id) . '?messager=success');
                }else {
                    redirect(site_url('admin/users/course/'.$type."/".$user_id) . '?messager=success');
                }
            }
        }
        $data['list_degree'] = $this->m_degree->show_list_degree_where(array('degree.status' => 1), 0, 0, 'vn', 0);

        $data['type']=$type;
        $this->template->write('mod', "users_".$type); // set mod
        $this->template->write_view('content', 'admin/course/add', $data);
        $this->template->render();
    }
    function Edit_course($type=1,$user_id,$id){
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/users">Quản lý tài khoản</a>';
        $data['user'] = $this->general->get_tableID($user_id, "users");
        $data['list_course']=$this->a_user->show_a_course(array('users_id'=>$user_id),'vn');
        $data['list_browse'] = $this->m_browse_lession->show_list_browse_lession_where(array("browse_lession.browse_lession_type" => 1, "browse_lession.browse_lession_top" => 0, 'browse_lession_status' => 1),'vn');
        $data['list'] = $this->m_time_work->show_list_time_work_where(array('time_work.status' => 1), 0, 0, 'vn', 0);
        $data['course']=$this->a_user->get_a_course(array('course.id'=>$id));
        if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('course_name_' . $lang->name, $this->global_function->show_config_language('lang_course_name', 'vn')."-".$lang->title_2, 'trim|required');
                $this->form_validation->set_rules('course_note_1_' . $lang->name, $this->global_function->show_config_language('lang_course_note_1', 'vn')."-".$lang->title_2, 'trim|required');
                $this->form_validation->set_rules('course_note_2_' . $lang->name, $this->global_function->show_config_language('lang_course_note_2', 'vn')."-".$lang->title_2, 'trim|required');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">-', '</label><br />');

            //$this->form_validation->set_rules('subject', $this->global_function->show_config_language('lang_subject', $lang), 'trim|required');
            if ($this->form_validation->run($this) == true) {
                if ((!empty($_FILES['course-avatar']['name']))) {
                    $picture=$this->global_function->upload_img("course-avatar","users/".$data['user']->user_name."/course",0,0);
                }else {
                    $picture=$this->input->post("course-avatar-old");
                }
                if ((!empty($_FILES['large-picture']['name']))) {
                    $large_picture=$this->global_function->upload_img("large-picture","users/".$data['user']->user_name."/course",0,0);
                }else {
                    $large_picture=$this->input->post("large-picture-old");
                }
                $type_teach=$this->input->post('type_teach');
                $type_="";
                if(!empty($type_teach)){

                    foreach($type_teach as $t){
                        $type_.=$t.",";
                    }
                }
                    $sql = array(
                        'picture' => $picture,
                        'large_picture' => $large_picture,
                        'youtube' => $this->input->post('youtube'),
                        'alt_picture' => $this->input->post('alt-course'),
                        'alt_large_picture' => $this->input->post('alt-large-picture'),
                        'fee' => $this->input->post('fee'),
                        'subject_id' => $this->input->post('subject_id'),
                        'type_teach'=>rtrim($type_,','),
                        "user_repair" => $this->m_session->userdata('admin_login')->user_id,
                    );
                    $this->db->where('course.id',$id);
                    $this->db->update('course', $sql);
                $this->db->delete('course_type_teach',array('course_id'=>$id));
                if(!empty($type_)) {
                    foreach ($type_ as $t) {
                        $this->db->insert('course_type_teach',array('course_id'=>$id,'type_teach_id'=>$t));
                    }
                }
                foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                    if ($this->global_function->count_table(array('course_id' => $id, 'country_id' => $rlang->id), 'coursedetail') == 0) {
                        $sql_lang = array(
                            'course_id' => $id,
                            'country_id' => $rlang->id,
                            'course_name' => $this->input->post('course_name_' . $rlang->name),
                            'note_1' => $this->input->post('course_note_1_' . $rlang->name),
                            'note_2' => $this->input->post('course_note_2_' . $rlang->name),
                            'info' => $this->input->post('info_' . $rlang->name),

                        );
                        $this->db->insert('coursedetail', $sql_lang);
                    } else {
                        $this->db->where(array('course_id' => $id, 'country_id' => $rlang->id));
                        $sql_lang = array(
                            'course_name' => $this->input->post('course_name_' . $rlang->name),
                            'note_1' => $this->input->post('course_note_1_' . $rlang->name),
                            'note_2' => $this->input->post('course_note_2_' . $rlang->name),
                            'info' => $this->input->post('info_' . $rlang->name),

                        );
                        $this->db->update('coursedetail', $sql_lang);
                    }
                }
                //

                $day = $this->input->post('day');
                $start_time = $this->input->post('start_time');
                $end_time = $this->input->post('end_time');
                $this->db->where('course_id',$id);
                $this->db->delete('course_available_time');
                if (!empty($day)) {
                    $i = 0;
                    foreach ($day as $d) {
                        $sql_time = array(
                            'course_id' => $id,
                            'day' => $d,
                            "start_time" => $start_time[$i],
                            "end_time" => $end_time[$i],
                        );
                        $this->db->insert('course_available_time', $sql_time);
                        $i++;
                    }
                }
                if(isset($_POST['ok-continues'])){
                    redirect(site_url('admin/users/edit_course/'.$type."/".$user_id."/" . $id) . '?messager=success');
                }else {
                    redirect(site_url('admin/users/course/'.$type."/".$user_id) . '?messager=success');
                }
            }
        }
        $data['list_degree'] = $this->m_degree->show_list_degree_where(array('degree.status' => 1), 0, 0, 'vn', 0);
        $data['type']=$type;
        $this->template->write('mod', "users_".$type); // set mod
        $this->template->write_view('content', 'admin/course/edit', $data);
        $this->template->render();
    }
    function Delete_course($type=1,$user_id,$id){
        if (!($this->general->Checkpermission("delete_user"))) redirect(site_url("admin/not-permission"));
        $data['user']=$this->a_user->get_user_where($user_id);
        if(!isset($data['user']->id) || $data['user']->buyer_id==0)  redirect(site_url('admin/users/course/'.$type."/".$user_id) . '?messager=success');
        $data['course']=$course=$this->a_user->get_a_course(array('course.id'=>$id,'users_id'=>$user_id));
        if(!isset($data['course']->id))   redirect(site_url('admin/users/course/'.$type."/".$user_id) . '?messager=success');
        $this->db->delete('course_available_time', array('course_id'=>$data['course']->id));
        $this->db->delete('coursedetail', array('course_id'=>$data['course']->id));
        $this->db->delete('course_type_teach',array($data['course']->id));
        @unlink('uploads/Images/users/'.$data['user']->user_name."/course/".$course->picture);
        @unlink('uploads/Images/users/'.$data['user']->user_name."/course/".$course->large_picture);
        $this->db->delete('course', array('id'=>$data['course']->id));
        redirect(site_url('admin/users/course/'.$type."/".$user_id) . '?messager=success');

    }
    function Delete_more_course($type=1,$user_id,$id){
        $data['user']=$this->a_user->get_user_where($user_id);
        if(!isset($data['user']->id) || $data['user']->buyer_id==0) return false;
        $data['course']=$course=$this->a_user->get_a_course(array('course.id'=>$id,'users_id'=>$user_id));
        if(!isset($data['course']->id))   return false;
        $this->db->delete('course_available_time', array('course_id'=>$data['course']->id));
        $this->db->delete('course_type_teach',array($data['course']->id));
        $this->db->delete('coursedetail', array('course_id'=>$data['course']->id));
        @unlink('uploads/Images/users/'.$data['user']->user_name."/course/".$course->picture);
        @unlink('uploads/Images/users/'.$data['user']->user_name."/course/".$course->large_picture);
        $this->db->delete('course', array('id'=>$data['course']->id));
       return true;

    }
    function Book_tutor($page_no=1)
    {
        if (!($this->general->Checkpermission("edit_book_tutor"))) redirect(site_url("admin/not-permission"));
        $page_co =50;
        $start = ($page_no - 1) * $page_co;
        $data['page_no'] = $page_no;
        $count=$this->m_users->count_list_book_tutor();
        $data['list']=$this->m_users->show_list_book_tutor($page_co, $start);
        $data['link'] = $this->global_function->paging($page_co, $count, 'admin/users/book_tutor/', $page_no);
        $data['rlang'] = 'vn';
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/users/book_tutor">Book Tutor</a>';
        $this->template->write('mod', "book"); // set mod
        $this->template->write_view('content', 'admin/book/index', $data);
        $this->template->render();
    }
    function Book_detail($id)
    {
        if (!($this->general->Checkpermission("edit_book_tutor"))) redirect(site_url("admin/not-permission"));

        $data['detail']=$this->global_function->get_tableWhere(array('id' => $id), "booking_tutor", '*');
        $data['course']=$this->global_function->get_tableWhere(array('id' => $data['detail']->course_id), "course", '*');
        $data['rlang'] = 'vn';
        $data['subject']=$this->m_browse_lession->show_detail_browse_lession_id(isset($data['course']->subject_id)?$data['course']->subject_id:0,'vn');

        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/users/book_tutor">Book Tutor</a>';
        $data['status']=$this->general->get_list_table("order_status");
        if(isset($_REQUEST['ok']) || isset($_REQUEST['ok-continues'])){
            $sql=array(
                "status"=>$this->input->post("status")
            );
            $this->db->where("id",$id);
            $this->db->update("booking_tutor",$sql);
            if(isset($_REQUEST['ok-continues'])) {
                redirect(site_url('admin/users/book_detail/' . $id) . '?messager=success');
            }else{
                redirect(site_url('admin/users/book_tutor') . '?messager=success');
            }
        }
        $this->template->write('mod', "book"); // set mod
        $this->template->write_view('content', 'admin/book/view', $data);
        $this->template->render();
    }



	function permition($id) {
        if (!($this->general->Checkpermission("view_user"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->load->model(array("global_function", "a_general", "m_user", "counter", "users/a_user", "general"));
            $data['title'] = "MyProfile";
            $data['user'] = $this->general->get_tableID($id, "users");
			//var_dump($data['user']);
          	   if (isset($_POST['ok'])) {
				   $user_per = $this->input->post("user_per");
				   //exit($user_per);
				   if($user_per == 1){
					   $per_location_user = $this->input->post("per_item");
					   $user = $this->input->post("user");
						$this->db->delete('user_per_item', array('user_id' => $user)); 
						  if(!empty($per_location_user))
						  {
								   foreach($per_location_user as $value)
								   {
									   $sql = array(
										'user_id' => $user,
										'item_id' => $value,
									);
									$this->db->insert('user_per_item', $sql);
								   }
						   }
						   //cap nhat quyen cho thanh vien
						     	$data1 = array(
												'type_account' => $user_per
											);
					   			$this->db->update('users', $data1, array('id' => $data['user']->id));
								 redirect(site_url("admin/users/permition/".$id));
				   }else{
					   $data1 = array(
										'type_account' => $user_per
									);
					   $this->db->update('users', $data1, array('id' => $data['user']->id));
					   redirect(site_url("admin/users/permition/".$id));
				   }
			   }
            $this->template->write('mod', "users"); // set mod
            $this->template->write_view('content', 'admin/permit', $data, TRUE);
            $this->template->render();
        }
    }

// ============================================
    function delete($type,$id) {
        if (!($this->general->Checkpermission("delete_user"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->db->delete('users', array('id' => $id));
            redirect(site_url('admin/users/index/'.$type) . '?messager=success');
        }
    }

    function delete_more($id) {
        if (!($this->general->Checkpermission("delete_user"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->db->delete('users', array('id' => $id));
            return true;
        }
    }

//=========================================== 
    function hide($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->general->update_tableID($id, array('status' => 0), "users");
            redirect(site_url('admin/users') . '?messager=success');
        }
    }

//============================================\
    function hide_more($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->general->update_tableID($id, array('status' => 0), "users");
            return true;
        }
    }

//============================================\
    function show_more($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->general->update_tableID($id, array('status' => 1), "users");
            return true;
        }
    }

//============================================\
    function show($id) {
        if (!($this->general->Checkpermission("edit"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $this->general->update_tableID($id, array('status' => 1), "users");
            redirect(site_url('admin/users') . '?messager=success');
        }
    }
    function all_export() {
        $this->load->library('my_excel');
// Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
// Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . 1, 'id');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B' . 1, 'Họ & Tên');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C' . 1, 'Email');
        $objPHPExcel->getActiveSheet(0)->setCellValue('D' . 1, 'Di động');
        $objPHPExcel->getActiveSheet(0)->setCellValue('E' . 1, 'Địa chỉ');
        $objPHPExcel->getActiveSheet(0)->setCellValue('F' . 1, 'Quận/Huyện');
        $objPHPExcel->getActiveSheet(0)->setCellValue('G' . 1, 'Tỉnh/Tp');
        $objPHPExcel->getActiveSheet(0)->setCellValue('H' . 1, 'Ngày sinh');
        $objPHPExcel->getActiveSheet(0)->setCellValue('I' . 1, 'Giới tính');
        $key=$this->input->post("key");
        $city_id=$this->input->post("city_id");
        $sex=$this->input->post("sex");
        $from=$this->input->post("from");
        $to=$this->input->post("to");
        $user = $this->m_users->show_list_user_key($key,$city_id,$sex,$from,$to);
        for ($i = 0; $i < count($user); $i++) {
            if($user[$i]->sex==1) $sex="Nữ";
            else if($user[$i]->sex==2) $sex='Nam';
            else $sex="Không xác định";
            $agent = $this->general->get_tableID($user[$i]->agent_id, "location");
            $city = $this->general->get_tableID($user[$i]->city_id, "location");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . ($i + 2), $i+1);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . ($i + 2), $user[$i]->full_name);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($i + 2), $user[$i]->email);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . ($i + 2), $user[$i]->cell_phone);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . ($i + 2), $user[$i]->address);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . ($i + 2), isset($agent->name_vn) ? $agent->name_vn : "Updating...");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . ($i + 2), isset($city->name_vn) ? $city->name_vn : "Updating...");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . ($i + 2),$user[$i]->birthday );
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . ($i + 2),$sex);
        }
        $date = "Danh sách thành viên";
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($date);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client's web browser (Excel2007)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $date . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
    function Active() {
        if (!($this->general->Checkpermission("edit_user"))) {
            redirect(site_url("admin/not-permission"));
        } else {
            $sql = array('status' => $this->input->post("active"));
            $this->db->where('id', $this->input->post("id"));
            $this->db->update('users', $sql);
        }
    }
    function course_active() {
            $sql = array('course_status' => $this->input->post("active"));
            $this->db->where('id', $this->input->post("id"));
            $this->db->update('course', $sql);

    }
    function change_pass($type,$user_id){
        $pass=$this->global_function->randomPassword(6);
       $this->db->where('id',$user_id);
        $this->db->update('users',array('password'=>md5($pass)));
        echo 'Mật khẩu mới là: '.$pass;


    }
    function url_title(){
        echo $this->global_function->unicode($this->input->post('value'));
    }
}
