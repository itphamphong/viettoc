<?php
class Users extends MX_Controller {

    protected $email_server = '';
    protected $pass_server = '';
    protected $host_mail = '';           // sets the prefix to the servier

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session', 'cart'));
        $this->load->helper(array("url", 'file'));
        $this->load->model(array("global_function", "users/a_user","location/a_location","order/a_order","utility/m_utility",'time_work/m_time_work','browse_lession/m_browse_lession','location/m_location','degree/m_degree'));
        //$this->load->model('m_session');
        $this->load->library('form_validation');
    }
    //-------------------------- LOGIN----------------------------
    function Login($lang = DLANG) {
        $data['lang'] = $lang;
        $data['title'] = "Login";
        $data['mod'] = "login";
        if(isset($_POST['ok'])){
            $this->form_validation->set_rules('user_name',"User name", 'trim|required');
            $this->form_validation->set_rules('password',$this->global_function->show_config_language('lang_password', $lang), 'trim|required');
            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');
            if ($this->form_validation->run($this) == true) {
                $user = $this->global_function->get_tableWhere(array("user_name" =>$this->input->post('user_name'),"password"=>md5($this->input->post('password'))),"users",'email,id,full_name');
                if(isset($user->id)) {
                    $this->session->set_userdata('user', $user);
                    redirect(site_url($lang.'/for-tutor-signin-location'));
                }else{
                   $data['msg']=$this->global_function->show_config_language('lang_error_login', $lang);
                }
            }
        }
        $this->template->write('mod', 'home');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'public/login', $data, TRUE);
        $this->template->render();
    }
    function LoginAjax($lang=DLANG){
        $lang = $this->input->post('lang');
        @header('Content-Type: application/json');
        $users = $this->global_function->get_tableWhere(array("user_name" =>$this->input->post('user_name'),"password"=>md5($this->input->post('password'))),"users",'email,id,full_name');
        $data['lang']=$lang;
        if (count($users) > 0) {
            $this->session->set_userdata('user', $users);
            echo json_encode(array("msg" => 1));
        } else {
            echo json_encode(array("message" => $this->global_function->show_config_language('lang_login_error', $lang), "msg" => 0));
        }
    }
    function LoginAjaxMod(){
        $email = $this->input->post('email');
        $password = $this->input->post('pass');
        $lang = $this->input->post('lang');
        $l = new lang();
        if ($lang == '')
            $data['lang'] = 'vn';
        else
            $data['lang'] = $lang;
        $data['l'] = $l;
        @header('Content-Type: application/json');
        $users=$this->m_user->login_mod($email, $password);
        if (count($users) > 0) {
            $this->session->set_userdata('mod', $users);
            echo json_encode(array("message" => $l->lang_success_login[$lang], "msg" => 1));
        } else {
            echo json_encode(array("message" => $l->lang_error_login[$lang], "msg" => 0));
        }
    }

    //-------------------------- Register----------------------------
    function Register($lang=DLANG){
        redirect(site_url());
        $data['lang']=$lang;
        $data['title'] = $this->global_function->show_config_language('lang_singup', $lang);
        $data['mod'] = "login";
        $data['beadcrum']=' <a href="'.site_url($lang . "/" . $this->global_function->show_config_language('lang_hotel', $lang, 'url')).'">'.
            $this->global_function->show_config_language('lang_hotel', $lang).'</a> <i class="fa fa-angle-right"></i> '.$data['title'];
        if(isset($_POST['ok'])){
            $this->form_validation->set_rules('user_name',"User name", 'trim|required|callback_check_user_name');
            $this->form_validation->set_rules('password',$this->global_function->show_config_language('lang_password', $lang), 'trim|required');
            $this->form_validation->set_rules('confim_pass',$this->global_function->show_config_language('lang_confim_pass', $lang), 'trim|required|matches[password]');
            $this->form_validation->set_rules('phone',$this->global_function->show_config_language('lang_phone', $lang), 'trim');
            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');
            if ($this->form_validation->run($this) == true) {
                $sql=array(
                    "full_name" =>$this->input->post('full_name'),
                    "cell_phone" => $this->input->post('phone'),
                    "user_name" => $this->input->post('user_name'),
                    "buyer_id" => $this->input->post('buyer_id'),
                    "password" => md5($this->input->post('password')),
                    "status" =>1,
                    "user_code"=>$this->global_function->randomPassword(10),
                    'created_date'=>date('Y-m-d',time())
                );
                $id=$this->db->insert("users",$sql);
                $user = $this->global_function->get_tableWhere(array("user_name" =>  $this->input->post('user_name')),"users",'email,id,full_name,user_name');
                $this->session->set_userdata('user',$user);
                redirect(site_url($lang."/for-tutor-signin-location"));
            }
        }
        $this->template->write('mod', 'home');
        $this->template->write('title', $data['title']);
        $this->template->write_view('content', 'public/register', $data, TRUE);
        $this->template->render();
    }
    function RegisterAjax($lang=DLANG)
    {
        $data['lang'] = $lang;
        $full_name = $this->input->post("full_name");
        $password = $this->input->post("password");
        $user_name = $this->input->post("user_name");
        $captcha = $this->input->post("captcha");
        $captcha_hide = $this->input->post("captcha_hide");
        $array = array();
        $error = $error1 = -$error2 = $error3 = $error4 = 0;
        $buyer_id = $this->input->post("buyer_id");
        if ($full_name == '') {
            $error1 = 1;
            $array = array("v1" => 1, "message_1" => $this->global_function->show_config_language('lang_full_name_required', $lang));
        } else {
            $error1 = 0;
        }
        if ($this->check_user_name_ajax($user_name) == false) {
            $array = array("v2" => 1, "message_2" => $this->global_function->show_config_language('lang_user_name_indb', $lang));
            $error2 = 1;
        } else {
            $error2 = 0;
        }
        if ($password == '' || strlen($password) < 6) {
            $array = array("v3" => 1, "message_3" => $this->global_function->show_config_language('lang_error_pass', $lang));
            $error3 = 1;
        } else {
            $error3 = 0;
        }
        if ($captcha != $captcha_hide) {
            $array = array("v4" => 1, "message_4" => $this->global_function->show_config_language('lang_captcha_error', $lang));
            $error4 = 1;

        } else {
            $error4 = 0;
        }

        $error = $error1 + $error2 + $error3 + $error4;
        if ($error == 0) {

            $sql = array(
                "full_name" => $full_name,
                "user_name" => $user_name,
                "password" => md5($password),
                "status" => 1,
                "user_code" => $this->global_function->randomPassword(10),
                "buyer_id" => $buyer_id,
            );
            $this->db->insert("users", $sql);
            $array = array("success" => 1, "message_success" => $this->global_function->show_config_language('lang_register_success', $lang));
            $users = $this->global_function->get_tableWhere(array("user_name" => $user_name, "password" => md5($password)), "users", 'email,id,full_name');
            if (count($users) > 0) {
                $this->session->set_userdata('user', $users);
            }

        }
        @header('Content-Type: application/json');
        echo json_encode($array);
    }
    // forgot pass
    function ForgotPass($lang = 'vn') {
        $l = new lang();
        if ($lang == '')
            $data['lang'] = 'vn';
        else
            $data['lang'] = $lang;
        $data['l'] = $l;
        $data['title'] = "Login";
        $data['mod'] = "login";
        $this->load->view('users/public/forgot_pass', $data);
    }
    function Forgot_Ajax(){
        $lang=$this->input->post("lang");
        $dates = time();
        $error=0;
        $array=array();
        $l = new lang();
        if ($lang == '')
            $data['lang'] = 'en';
        else
            $data['lang'] = $lang;
        $data['l'] = $l;
        $email=$this->input->post("email");
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && $this->check_email($email)==true){
            $array = array("vemail"=>1,"message_email"=>$l->lang_email_valiable[$lang]);
            $error = 1;
        }else {
            $error = 0;
            $array = array("vemail"=>0,"message_success"=>$l->lang_send_forgot_pass[$lang]);
        }
        if($error==0){
            $user = $this->a_general->get_row("users", array("email" => $email,"buyer_id"=>0));
            $pass=$this->global_function->randomPassword(6);
            $this->db->where("id",$user->id);
            $this->db->update("users",array("password"=>md5($pass)));
            $title=$l->lang_forgot_pass[$lang];
            $text=$l->lang_title_forgot[$lang]."<br />";
            $text.=$l->lang_account_info[$lang].": ".$user->full_name."<br />";
            $text.="Email".": ".$user->email."<br />";
            $text.=$l->lang_new_password[$lang].": ".$pass."<br />";
            $this->SendMail($email,$text,$title);
        }
        @header('Content-Type: application/json');
        echo json_encode($array);
    }

// check email is db
    function check_email() {
        $check =$this->global_function->get_tableWhere(array("email" => $this->input->post('email')),"users");
        if (isset($check->id)) {
            return FALSE;
            $this->form_validation->set_message('check_email', "Email đã tồn tại");
        } else
            return TRUE;
    }
    function check_email_edit() {
        $check = $this->a_general->get_row("users", array("email" => $this->input->post('email_one'),"id !=" => $this->input->post("user_id"),"buyer_id"=>$this->input->post("buyer_id")));
        if (isset($check->id)) {
            $this->form_validation->set_message('check_email_edit', "Email đã tồn tại");
            return FALSE;
        } else
            return TRUE;
    }
    function check_user_name() {
        $check =$this->global_function->get_tableWhere(array("user_name" => $this->input->post('user_name')),"users");
        if (isset($check->id)) {
            return FALSE;
            $this->form_validation->set_message('check_user_name',$this->global_function->show_config_language('lang_user_name_indb', $lang));
        } else
            return TRUE;
    }
    function check_user_name_ajax($user_name) {
        $check =$this->global_function->get_tableWhere(array("user_name" => $user_name),"users");
        if (isset($check->id)) {
            return FALSE;
        } else
            return TRUE;
    }
    function check_user_name_edit() {
        $lang=$this->input->post('lang_id');
        $check =$this->global_function->get_tableWhere(array("user_name" => $this->input->post('user_name'),"id !=" => $this->input->post("user_id")),"users");
        if (isset($check->id)) {

            $this->form_validation->set_message('check_user_name_edit',$this->global_function->show_config_language('lang_user_name_indb', $lang));
            return FALSE;
        } else
            return TRUE;
    }
// check old pass
    function check_old_pass() {
        $lang=$this->uri->segment(1);
        $check =$this->global_function->get_tableWhere(array("id" => $this->session->userdata('user')->id, "password" => md5($this->input->post("old_password"))),"users");
        if (!isset($check->id)) {
            if($lang=='en'){
                $this->form_validation->set_message('check_old_pass', "Current Password was false");
            }else{
            $this->form_validation->set_message('check_old_pass', "Mật khẩu cũ không chính xác");
            }
            return FALSE;
        } else
            return TRUE;
    }
    function logout($lang = DLANG) {
        $data['lang'] = $lang;
        $this->session->sess_destroy(); redirect(site_url());
    }
    function SendMail($email = '', $text = '',$title) {
        $company = $this-> a_general->show_company('vn');
        $noidung = '<table width="650" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#fff" style="border:10px solid #689A1D;" >
    <tbody >
        <tr >
            <td align="left" valign="top" ><table width="650" border="0" align="center" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #cccccc;" >
                    <tbody >
                        <tr>
                            <td width="275" align="left" valign="middle" style="padding:30px;"  width="190" height="47"><img  src="'.base_url().'uploads/default/'.$company->logo.'"></td>
                            <td width="255" align="right" valign="middle" style="font-family:Arial;font-size:14px;color:#555555;padding:30px;" ><strong>Ngày</strong><br>
                                ' . date("d-m-Y", now()) . '</td>
                        </tr>
                    </tbody>
                </table></td>
        </tr>
        <tr id="yui_3_13_0_ym1_1_1395644868798_18063">
            <td align="left" valign="top" ><table width="650" border="0" cellspacing="0" cellpadding="0" style="margin:auto;" >
                    <tbody >
                        <tr >
                            <td colspan="3" width="100%" height="30" ><img width="1" height="1"></td>
                        </tr>
                        <tr >
                            <td width="30" ><img width="1" height="1"></td>
                            <td width="590" ><p style="font-family:Arial;font-size:20px;margin-bottom:0.5em;margin-top:0;" >Xin chào,</p></td>
                            <td width="30"><img width="1" height="1"></td>
                        </tr>
                        <tr >
                            <td width="30"><img width="1" height="1"></td>
                            <td width="590" style="font-family:Arial;font-size:14px;padding-bottom:15px;" ><div style="font-family:Arial, Helvetica, sans-serif;" >' . $text . '</div></td>
                        </tr>
                    </tbody>
                </table></td>
        </tr>
    </tbody>
</table>';

        $this->load->library('My_PHPMailer');
        $body = $noidung;
        $mail = new PHPMailer();
        $mail->CharSet = "utf-8";
        //$mail->IsSMTP();
        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->Port = 25;                   // set the SMTP port for the GMAIL server
        $mail->IsHTML(true);
        $mail->SMTPDebug = 1;
        $mail->SetFrom($company->email,$title);
        $mail->AddReplyTo($company->email, $title);
        $mail->Subject = $company->name;
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
        $mail->MsgHTML($body);

//dia chi mail nhan
        $mail->AddAddress($email, $company->name);
        if (!$mail->Send()) {
            return 0;
        } else {
            return 1;
        }
    }
    function checkcap() {
        if ($this->input->post('code') == $this->session->userdata('captcha')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('checkcap', 'Captcha not true');
            return FALSE;
        }
    }
    function Active($lang='',$code) {
        $l = new lang();
        if ($lang == '')
            $data['lang'] = 'en';
        else
            $data['lang'] = $lang;
        $data['l'] = $l;
        $message = "";
        $user = $this->a_general->get_row("users", array("users.user_code" => $code, "users.status" => 0));
        if (isset($user->id)) {
            $this->db->where("users.id", $user->id);
            $this->db->update("users", array("status" => 1,"user_code"=>$this->global_function->randomPassword(10)));
            $this->session->set_userdata('user', $this->m_user->set_login_customer_update($user->email, $user->password));
            $message = $l->lang_actived_account[$lang];
        } else {
            $message = $l->lang_actived_false[$lang];
        }
        if($lang=='vn') $site=site_url();
        else $site=site_url($lang."/".$l->lang_url_home[$lang]);
        $data['site']=$site;
        $data['message'] = $message;
        $this->template->write('title', $l->lang_active_account[$lang]);
        $this->template->write('mod', "");
        $this->template->write_view('content', 'public/active', $data, TRUE);
        $this->template->render();
    }
    function AccountInfo($lang=DLANG){
        $data['lang'] = $lang;
        if(!isset($this->session->userdata("user")->id)) redirect(site_url());
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        if(!isset($data['user']->id)) redirect(site_url());
        if(isset($_POST['ok'])){

            $this->form_validation->set_rules('password',$this->global_function->show_config_language('lang_password', $lang), 'trim');
            $this->form_validation->set_rules('phone',$this->global_function->show_config_language('lang_phone', $lang), 'trim|required');
            //$this->form_validation->set_rules('user_name',"User name", 'trim|required|callback_check_user_name_edit');
            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');
            if ($this->form_validation->run($this) == true) {

                if ((!empty($_FILES['img']['name']))) {
                    $picture=$this->global_function->upload_img('img',"users/".$data['user']->user_name,0,0);
                }else{
                    $picture=$this->input->post('old_img');
                }
                $sql=array(
                    "full_name" =>$this->input->post('full_name'),
                    "cell_phone" => $this->input->post('phone'),
                    "email" =>$this->input->post('email'),
                    "age" =>$this->input->post('age'),
                    "address" =>$this->input->post('address'),
                    "country_id" =>$this->input->post('country_id'),
                    "city_id" =>$this->input->post('city_id'),
                    "agent_id" =>$this->input->post('agent_id'),
                    'avatar'=>$picture,
                    "facebook" =>$this->input->post('facebook'),
                    "google" =>$this->input->post('google'),
                    "website" =>$this->input->post('website'),
                );
                $this->db->where(array("id"=>$this->session->userdata("user")->id));
                $this->db->update("users",$sql);

                $company=$this->input->post('company');
                $major=$this->input->post('major');
                $degree=$this->input->post('degree');
                if(!empty($company)){
                    $this->db->delete('users_graduated',array('users_id'=>$data['user']->id));
                    $i=0;
                    foreach($company as $co){
                        $sql_co=array(
                            'company'=>$co,
                            'major'=>$major[$i],
                            'users_id'=>$data['user']->id,
                        );
                        $this->db->insert('users_graduated',$sql_co);
                        $i++;
                    }
                }
                if(!empty($degree)){
                    $this->db->delete('users_degree',array('users_id'=>$data['user']->id));
                    foreach($degree as $de){
                        $this->db->insert('users_degree',array('users_id'=>$data['user']->id,'degree'=>$de));
                    }
                }
                foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                    if($this->global_function->count_table(array('users_id'=>$data['user']->id,'country_id'=>$rlang->id),'usersdetail')==0) {
                        $sql_lang = array(
                            'users_id' => $data['user']->id,
                            'country_id' => $rlang->id,
                            "info" => $this->input->post('info-' . $rlang->name)
                        );
                        $this->db->insert('usersdetail', $sql_lang);

                    }else{
                        $this->db->where(array('users_id'=>$data['user']->id,'country_id'=>$rlang->id));
                        $sql_lang = array(
                            "info" => $this->input->post('info-' . $rlang->name)
                        );
                        $this->db->update('usersdetail', $sql_lang);
                    }
                }
                $this->session->set_userdata('user',  $data['user']);
                $data['msg']="Cập nhật thành công";
            }else{
            }
        }
        $data['left_active']='account';
        $data['title'] = $this->global_function->show_config_language('lang_update', $lang);
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        $this->template->write_view('content', 'public/account_info', $data, TRUE);
        $this->template->render();
    }
    //
    function Notification($lang=DLANG){
        if(!isset($this->session->userdata("user")->id)) redirect(site_url());
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        if(!isset($data['user']->id) || $data['user']->buyer_id==0) redirect(site_url());
        $data['lang'] = $lang;
        $data['list']=$this->global_function->list_tableWhere_status(array("tutor_id" => $this->session->userdata("user")->id), "user_book_tutor_count");
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        $this->template->write_view('content', 'public/notification', $data, TRUE);
        $this->template->render();
    }
    //
    function RegisteredCourse($lang=DLANG){
        if(!isset($this->session->userdata("user")->id)) redirect(site_url());
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        if(!isset($data['user']->id) || $data['user']->buyer_id==0) redirect(site_url());
        $data['lang'] = $lang;
        $data['left_active']='registered-course';
        $data['title'] = $this->global_function->show_config_language('lang_update', $lang);
        $data['list_course']=$this->a_user->show_a_course(array('users_id'=>$this->session->userdata("user")->id),$lang);
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        $this->template->write_view('content', 'public/registered_course', $data, TRUE);
        $this->template->render();
    }
    function AddCourse($lang=DLANG,$id=0){
        if(!isset($this->session->userdata("user")->id)) redirect(site_url());
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        if(!isset($data['user']->id) || $data['user']->buyer_id==0) redirect(site_url());
        $data['course']=$this->a_user->get_a_course(array('course.id'=>$id));

        if(isset($_POST['ok'])){
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $rlang) {
                $this->form_validation->set_rules('course_name_' . $rlang->name, $this->global_function->show_config_language('lang_course_name', $lang)."-".$rlang->title_2, 'trim|required');
                $this->form_validation->set_rules('course_note_1_' . $rlang->name, $this->global_function->show_config_language('lang_course_note_1', $lang)."-".$rlang->title_2, 'trim|required');
                $this->form_validation->set_rules('course_note_2_' . $rlang->name, $this->global_function->show_config_language('lang_course_note_2', $lang)."-".$rlang->title_2, 'trim|required');
            }
            $this->form_validation->set_rules('fee','Fee Each Hour', 'trim');

            //$this->form_validation->set_rules('subject', $this->global_function->show_config_language('lang_subject', $lang), 'trim|required');

            $this->form_validation->set_error_delimiters('<div class="col_full text-error">', '</div>');
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
                    $type="";
                    if(!empty($type_teach)){

                        foreach($type_teach as $t){
                            $type.=$t.",";
                        }
                    }
                    if($id==0) {

                        $sql = array(
                            'course_status' => 0,
                            'created_date' => date('Y-m-d', time()),
                            'users_id' => $this->session->userdata("user")->id,
                            'picture' => $picture,
                            'large_picture' => $large_picture,
                            'youtube' => $this->input->post('youtube'),
                            'alt_picture' => $this->input->post('alt-course'),
                            'alt_large_picture' => $this->input->post('alt-large-picture'),
                            'fee' => $this->input->post('fee'),
                            'subject_id' => $this->input->post('subject_id'),
                            'type_teach'=>rtrim($type,',')
                        );
                        $this->db->insert('course', $sql);
                        $id = $this->db->insert_id();
                        if(!empty($type_teach)) {
                            foreach ($type_teach as $t) {
                                $this->db->insert('course_type_teach',array('course_id'=>$id,'type_teach_id'=>$t));
                            }
                        }

                    }else{
                        $sql = array(
                            'picture' => $picture,
                            'large_picture' => $large_picture,
                            'youtube' => $this->input->post('youtube'),
                            'alt_picture' => $this->input->post('alt-course'),
                            'alt_large_picture' => $this->input->post('alt-large-picture'),
                            'fee' => $this->input->post('fee'),
                            'subject_id' => $this->input->post('subject_id'),
                            'type_teach'=>rtrim($type,',')
                        );
                        $this->db->where('course.id',$id);
                        $this->db->update('course', $sql);
                        $this->db->delete('course_type_teach',array('course_id'=>$id));
                        if(!empty($type_teach)) {
                            foreach ($type_teach as $t) {
                                $this->db->insert('course_type_teach',array('course_id'=>$id,'type_teach_id'=>$t));
                            }
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
                            $sql = array(
                                'course_id' => $id,
                                'day' => $d,
                                "start_time" => $start_time[$i],
                                "end_time" => $end_time[$i],
                            );
                            $this->db->insert('course_available_time', $sql);
                            $i++;
                        }
                    }
                   redirect(site_url($lang."/registered-course"));
                }
            }

        $data['list_degree'] = $this->m_degree->show_list_degree_where(array('degree.status' => 1), 0, 0, $lang, 0);
        $data['utility'] = $this->m_utility->show_list_utility_where(array("utility.id !=" => 0), 0, 0,$lang,0);
        $data['list_browse'] = $this->m_browse_lession->show_list_browse_lession_where(array("browse_lession.browse_lession_type" => 1, "browse_lession.browse_lession_top" => 0, 'browse_lession_status' => 1),$lang);
        $data['lang'] = $lang;
        $data['left_active']='registered-course';
        $data['list'] = $this->m_time_work->show_list_time_work_where(array('time_work.status' => 1), 0, 0, $lang, 0);
        $data['title'] = $this->global_function->show_config_language('lang_update', $lang);
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        $this->template->write_view('content', 'public/add_course', $data, TRUE);
        $this->template->render();
    }
    //
    function ChangeMyPass($lang=DLANG){
        if(!isset($this->session->userdata("user")->id)) redirect(site_url());
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        if(!isset($data['user']->id)) redirect(site_url());
        $data['lang'] = $lang;
        if(isset($_POST['ok'])){
            $this->form_validation->set_rules('old_password',$this->global_function->show_config_language('lang_old_password', $lang), 'trim|required|callback_check_old_pass');
            $this->form_validation->set_rules('new_password',$this->global_function->show_config_language('lang_password', $lang), 'trim|required');
            $this->form_validation->set_rules('re_password',$this->global_function->show_config_language('lang_confirm_password', $lang), 'trim|required|matches[new_password]');
            $this->form_validation->set_error_delimiters('<div class="col_full red">', '</div>');
            if ($this->form_validation->run($this) == true) {
                $this->db->where("id",$this->session->userdata("user")->id);
                $this->db->update("users",array("password"=>md5($this->input->post("new_password"))));
                $data['msg']="Cập nhật thành công";
            }else{

            }
        }
        $this->template->write_view('content', 'public/change_my_pass', $data, TRUE);
        $this->template->render();
    }
    //
    function DeleteCourse($lang=DLANG,$id){
        if(!isset($this->session->userdata("user")->id)) redirect(site_url());
        $data['user']=$this->a_user->get_user_where($this->session->userdata("user")->id);
        if(!isset($data['user']->id) || $data['user']->buyer_id==0) redirect(site_url());
        $data['course']=$course=$this->a_user->get_a_course(array('course.id'=>$id,'users_id'=>$this->session->userdata("user")->id));
        if(!isset($data['course']->id)) redirect(site_url($lang."/registered-course"));
        $this->db->delete('course_available_time', array('course_id'=>$data['course']->id));
        $this->db->delete('course_type_teach',array($data['course']->id));
        $this->db->delete('coursedetail', array('course_id'=>$data['course']->id));
        @unlink('uploads/Images/users/'.$data['user']->user_name."/course/".$course->picture);
        @unlink('uploads/Images/users/'.$data['user']->user_name."/course/".$course->large_picture);
        $this->db->delete('course', array('id'=>$data['course']->id));
        site_url($lang."/registered-course");

    }

}
?>
