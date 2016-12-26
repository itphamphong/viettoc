<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller
{

    protected $meta_title;
    protected $meta_keywords;
    protected $meta_description;
    protected $project = "";

    function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->helper(array('url', 'text', 'form', 'file'));
        $this->load->library(array('session', 'form_validation', 'ftp'));
        $this->load->database();
        $this->load->model(array('article/m_article', 'm_session', 'general', "term/m_term", "global_function"));
        $this->template->set_template('admin');        // Set template 

    }

    function admin()
    {
        parent::Controller();
    }

    //===============================================

    function Site()
    {
        if (!($this->general->Checkpermission("edit_company"))) redirect(site_url("admin/not-permission"));
        $data = array();
        // ban trung gian hinh anh cua company: logo, favicon, bg,..
        $params = array(
            'where' => array("company_id" => 1, "status" => 1,'menu'=>'site'),
            'table' => 'company_extra'
        );
        $data['company_pic'] = $company_pic = $this->global_function->get_list_table_where($params);
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('name_' . $lang->name, "Tên bài viết - " . $lang->title, 'trim|required');
            }
            if ($this->form_validation->run() == true) {
                $sql = array(
                    'copyright' => $this->input->post('copyright'),

                );
                $this->db->where('id', 1);
                $this->db->update('company', $sql);
                foreach ($this->general->show_list_lang() as $lang) {
                    $sql = array(
                        'name' => $this->input->post('name_' . $lang->name),
                        'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                        'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                        'about_company' => $this->input->post('about_company_' . $lang->name),
                        'time_work' => $this->input->post('time_work_' . $lang->name),
                        'address' => $this->input->post('address_' . $lang->name),
                        'note_home' => $this->input->post('note_home_' . $lang->name),

                    );
                    $this->db->where('id_company', 1);
                    $this->db->where('id_country', $lang->id);
                    $this->db->update('companydetail', $sql);

                }
                foreach ($company_pic as $pic) {
                    $optionsRadios=$this->input->post('optionsRadios-'.$pic->name);
                    if($optionsRadios==1){
                        if ((!empty($_FILES[$pic->name]['name']))) {
                            $picture=$this->global_function->upload_img($pic->name,"config",0,0);
                        }else{
                            $picture=$this->input->post('old_'.$pic->name);
                        }
                    }else {
                        $picture = substr($this->input->post($pic->name), strpos($this->input->post($pic->name), "uploads"));
                    }
                    $sql_co=array(
                        "value"=>$picture,
                        "alt"=>$this->input->post('alt_'.$pic->name),
                        'choose_upload'=>$optionsRadios
                    );
                    $this->db->where('id',$pic->id);
                    $this->db->update('company_extra',$sql_co);
                }
                redirect(site_url('admin/company/site') . '?messager=success');

            }
        }
        $data['mod'] = 'company_site';
        $data['breadcrumb'] = '<a href="' . base_url("admin/compnay/site") . '">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/company">Thông tin site</a></a>';
        $data['info'] = $this->general->show_company("vn");
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/site', $data, TRUE);
        $this->template->render();
    }
    function Map()
    {
        if (!($this->general->Checkpermission("edit_company"))) redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('info_contact_' . $lang->name, "Thông tin liên hệ - " . $lang->title, 'trim');
            }
            if ($this->form_validation->run() == true) {
                $sql = array(
                    'map' => $this->input->post('map'),
                    'LangLoc' => $this->input->post('LangLoc'),
                );
                $this->db->where('id', 1);
                $this->db->update('company', $sql);
                foreach ($this->general->show_list_lang() as $lang) {
                    $sql = array(
                        'info_contact' => $this->input->post('info_contact_' . $lang->name),

                    );
                    $this->db->where('id_company', 1);
                    $this->db->where('id_country', $lang->id);
                    $this->db->update('companydetail', $sql);

                }
                redirect(site_url('admin/company/map') . '?messager=success');

            }
        }
        $data['mod'] = 'company_map';
        $data['breadcrumb'] = '<a href="' . base_url("admin/compnay/site") . '">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/company">Thông tin site</a></a>';
        $data['info'] = $this->general->show_company("vn");
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/map', $data, TRUE);
        $this->template->render();
    }
    function Socail()
    {
        if (!($this->general->Checkpermission("edit_company"))) redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('info_contact_' . $lang->name, "Thông tin liên hệ - " . $lang->title, 'trim');
            }
            if ($this->form_validation->run() == true) {
                foreach ($this->general->show_list_lang() as $lang) {
                    $sql = array(
                        'email' => $this->input->post('email'),
                        'fax' => $this->input->post('fax'),
                        'phone' => $this->input->post('phone'),
                        'facebook' => $this->input->post('facebook'),
                        'google' => $this->input->post('google'),
                        'twitter' => $this->input->post('twitter'),
                        'linkin' => $this->input->post('linkin'),
                        'youtube' => $this->input->post('youtube'),
                        'website' => $this->input->post('website'),
                        'hotline' => $this->input->post('hotline'),
                    );
                    $this->db->where('id', 1);
                    $this->db->update('company', $sql);

                }
                redirect(site_url('admin/company/socail') . '?messager=success');

            }
        }
        $data['mod'] = 'company_social';
        $data['breadcrumb'] = '<a href="' . base_url("admin/compnay/site") . '">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/company">Thông tin site</a></a>';
        $data['info'] = $this->general->show_company("vn");
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/social', $data, TRUE);
        $this->template->render();
    }

}
