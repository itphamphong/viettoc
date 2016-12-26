<?php
class Contact extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session'));
        $this->load->helper(array("url"));
        $this->load->view("front/inc/lang/block");
        $this->load->model(array("term/a_term", 'article/a_article'));
        $this->load->model('a_about');
        $this->load->library('form_validation');
        $this->load->library('user_agent');
    }

    function index($lang = DLANG)
    {

        $data['lang']=$lang;
        $data['info'] = $this->global_function->show_company($lang);
        if ($lang == 'vn') {
            $this->lang->load('form_validation_lang', 'vietnamese');
        } else {
            $this->config->set_item('language', 'english');
        }

        if (isset($_REQUEST['ok'])) {
            $this->form_validation->set_rules('c-full_name', $this->global_function->show_config_language('lang_full_name', $lang), 'trim|required');
            $this->form_validation->set_rules('c-email', "Email", 'trim|required|valid_email');
            $this->form_validation->set_rules('c-address', $this->global_function->show_config_language('lang_address', $lang), 'trim');
            $this->form_validation->set_rules('c-content', $this->global_function->show_config_language('lang_notice', $lang), 'trim|required');
            $this->form_validation->set_error_delimiters('<p class="red">', '</p>');
            if ($this->form_validation->run($this) == true) {
                $sql = array(
                    "name" => $this->input->post("c-full_name"),
                    "email" => $this->input->post("c-email"),
                    "title" => $this->input->post("c-title"),
                    "phone" => $this->input->post("c-phone"),
                    "note" => $this->input->post("c-content"),
                    "date_reseive" => TIME,
                );
                $this->db->insert("contact", $sql);
                $data['msg']=$this->global_function->show_config_language('lang_info_send_successfull', $lang);
            } else {

            }
        }
        $data['menu_active'] = $this->global_function->show_config_language('lang_contact', $lang, 'url');
        $data['title'] = $this->global_function->show_config_language('lang_contact', $lang);
        $data['breadcrumb']='<li>'.$this->global_function->show_config_language('lang_contact_us', $lang).'</li>';
        $this->template->write('title', $data['title']);
            $this->template->write_view('content', 'contact/public/index', $data);
        $this->template->render();
    }

    function form()
    {
        $sql = array(
            "name" => $this->input->post("name"),
            "email" => $this->input->post("email"),
            "title" => $this->input->post("address"),
            "phone" => $this->input->post("phone"),
            "note" => $this->input->post("noidung"),
            "date_reseive" => TIME,
        );
        $this->db->insert("contact", $sql);
        echo "Bạn đã gửi thông tin thành công !";
    }

    function send_mail($mail, $txtName, $txtEmail, $txtPhone, $txtMessage)
    {
        $info = $this->a_general->show_company('en');
        $noidung = "<html><body><table width='715' border='0'>
										  <tr>
											<td colspan='2' align='left'><font color='#0B5D08'  size='+2'> Thông tin liên hệ</font></td>
										  </tr>
										  <tr>
											<td width='199'>Họ tên:</td>
											<td width='500'>" . $txtName . "</td>
										  </tr>
									
											<td width='199'>Email:</td>
											<td width='500'>" . $txtEmail . "</td>
										  </tr>
										  <tr>
											<td width='199'>Điện thoại:</td>
											<td width='500'>" . $txtPhone . "</td>
										  </tr>
										  <tr>
											<td width='199'>Nội dung:</td>
											<td width='500'>" . $txtMessage . "</td>
										  </tr>
										 ";
        $noidung .= "</table></body></html>";

        $this->load->library('My_PHPMailer');
        $body = $noidung;
        $mail = new PHPMailer();
        $mail->IsSMTP();

        $mail->SMTPAuth = true;                  // enable SMTP authentication
        $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
        $mail->Host = $this->host_mail;      // sets GMAIL as the SMTP server
        $mail->Port = 465;                   // set the SMTP port for the GMAIL server
        $mail->IsHTML(true);
        $mail->Username = $this->email_server;  // GMAIL username
        $mail->Password = $this->pass_server;            // GMAIL password

        $mail->SetFrom($this->email_server, 'Worknsave');
        $mail->AddReplyTo($this->email_server, 'Worknsave');
        $mail->Subject = "Contact us";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
        $mail->MsgHTML($body);

        //dia chi mail nhan
        $mail->AddAddress($info->$mail, 'Worksave');
        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            //echo 'thanh cong';
            //$this->load->view('send_info');
        }

    }
    //===========================================
    //===============================================
    function checkcaptcha()
    {
        $lang = 'vn';
        $data['lang'] = '';
        $l = new lang();

        if ($lang == '')
            $data['lang'] = 'en';
        else
            $data['lang'] = $lang;

        $data['l'] = $l;
        if ($this->input->post('c-captcha') == $_SESSION['random_number']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('checkcaptcha', $l->lang_error_captcha[$lang]);
            return FALSE;
        }
    }

    //========================================================
    public function Captcha(){
        $string = $this->global_function->randomPassword(5);
        $this->session->set_userdata('random_number', $string);
        $dir = 'fonts/';

        $image = imagecreatetruecolor(165, 50);

// random number 1 or 2
        $num = rand(1,2);
        if($num==1)
        {
            $font = "Capture it 2.ttf"; // font style
        }
        else
        {
            $font = "Molot.otf";// font style
        }

// random number 1 or 2
        $num2 = rand(1,2);
        if($num2==1)
        {
            $color = imagecolorallocate($image, 113, 193, 217);// color
        }
        else
        {
            $color = imagecolorallocate($image, 163, 197, 82);// color
        }

        $white = imagecolorallocate($image, 255, 255, 255); // background color white
        imagefilledrectangle($image,0,0,399,99,$white);

        imagettftext ($image, 30, 0, 10, 40, $color, $dir.$font, $this->session->userdata('random_number'));

        header("Content-type: image/png");
        imagepng($image);

    }
    function SaveEmail()
    {
        $email = $this->input->post("email");
        $lang = $this->input->post("lang");
        $data['lang'] = '';
        $l = new lang();

        if ($lang == '')
            $data['lang'] = 'en';
        else
            $data['lang'] = $lang;

        $data['l'] = $l;
        $message = 0;
        if ($this->global_function->count_table(array("email" => $email), "email_letter") > 0) {
            $message = $l->lang_email_valiable[$lang];
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == '') {
            $message = $l->lang_email_false[$lang];
        } else {
            $this->db->insert("email_letter", array("email" => $email, "create_date" => TIME));
            $message = 1;
        }
        echo $message;
    }
}

?>