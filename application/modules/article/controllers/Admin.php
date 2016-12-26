<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    protected $meta_title;
    protected $meta_keywords;
    protected $meta_description;
    protected $project = "";

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper(array('url', 'text', 'form', 'file'));
        $this->load->library(array('session', 'form_validation', 'ftp'));
        $this->load->database();
        $this->load->model(array('article/m_article', 'm_session', 'general', "term/m_term", "global_function",'location/m_location'));
        $this->template->set_template('admin');        // Set template 
    }

    function admin() {
        parent::Controller();
    }
    function index($type = 1, $page_no = 1) {

        if (!($this->general->Checkpermission("view_article_" . $type)))
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
            redirect(site_url('admin/article/index/' . $type . "/" . $page_no) . '?messager=success');
        }
        if (isset($_POST['delete']) && $this->input->post('checkall') != "") {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a);
            }
            redirect(site_url('admin/article/index/' . $type . "/" . $page_no) . '?messager=success');
        }
        //end toll
        $ptitle="Quản lý";
        $data = array();
        $data['mod'] = 'article_' . $type;
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/article/index/'.$type.'">'.$ptitle.'</a></a>';
        $page_co = 10;
        $start = ($page_no - 1) * $page_co;
        $count = $this->general->count_tableWhere(array("id !=" => 0, "article_type" => $type), "article");
        $data['page_no'] = $page_no;
        $data['type'] = $type;
        $data['item'] = $this->m_article->show_list_article_page_m($type, $page_co, $start);
        $data['link'] = $this->general->paging($page_co, $count, 'admin/article/index' . "/" . $type . "/", $page_no);
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function list_ajax() {
        $data['item'] = $this->m_article->show_list_article_term($this->input->post('id_cate'), $this->input->post('type'));
        $data['type'] = $this->input->post('type');
        $data['page_no'] = 1;
        $this->load->view('admin/article/list_ajax', $data);
    }

    //============================================
    function add($type = 1) {
        if (!($this->general->Checkpermission("add_article_" . $type)))
            redirect(site_url("admin/not-permission"));
        $this->template->write('mod', "article_add_" . $type);

        if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {

            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, "Tên - ".$lang->title, 'trim|required');
                $this->form_validation->set_rules('item_summary_' . $lang->name, "Mô tả - ".$lang->title, 'trim');
                $this->form_validation->set_rules('item_description_' . $lang->name, "Thông tin - ".$lang->title, 'trim');
                $this->form_validation->set_rules('name_seo_' . $lang->name, "Thẻ tiêu đề - ".$lang->title, 'trim|max_length[70]');
                $this->form_validation->set_rules('meta_keywords_' . $lang->name, "Thẻ từ khóa - ".$lang->title, 'trim|max_length[180]');
                $this->form_validation->set_rules('meta_descriptions' . $lang->name, "Thẻ mô tả - ".$lang->title, 'trim|max_length[250]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">-', '</label><br />');
            if ($this->form_validation->run() == true) {
                $choose=$this->input->post('optionsRadio');
                $picture=$this->input->post('old_pic');
                if($choose==1){
                    if ((!empty($_FILES['picture']['name']))) {
                        $picture=$this->global_function->upload_img("picture","article",0,0);
                    }
                }else if($choose==2){
                    $picture = substr($this->input->post('picture_galary'), strpos($this->input->post('picture_galary'), "uploads"));
                }else if($choose==3){
                    $picture=$this->input->post('picture_Awesome');
                }
                $sql = array(
                    'article_status' => $this->input->post('status'),
                    'article_weight' => $this->input->post('weight'),
                    'article_hot' => $this->input->post('hot'),
                    'article_type' => $type,
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'alt_picture' => $this->input->post('alt_picture'),
                    'picture'=>$picture,
                    'choose_upload'=>$choose
                );
                $this->db->insert('article', $sql);
                $item_id = $this->db->insert_id();
                if(isset($item_id)) {
                    foreach ($this->input->post("term_id") as $term) {
                        $this->db->insert("articleterm", array("article_id" => $item_id, "term_id" => $term));
                    }
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $name=$this->input->post('name_' . $lang->name);
                        $link=$this->input->post('item_link_' . $lang->name);
                        if(empty($link)) $link= $this->global_function->unicode($name);
                        if(!empty($name)) {
                            $sql_lang = array(
                                'article_id' => $item_id,
                                'country_id' => $lang->id,
                                'article_link' =>$link,
                                'article_name' => $this->input->post('name_' . $lang->name),
                                'article_description' => $this->input->post('item_description_' . $lang->name),
                                'article_summary' => $this->input->post('item_summary_' . $lang->name),
                            );

                            $this->db->insert('articledetail', $sql_lang);
                        }
                    }//foreach
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $name_seo=$this->input->post('name_seo_' . $lang->name);
                        $meta_keywords=$this->input->post('meta_keywords' . $lang->name);
                        $meta_descriptions=$this->input->post('meta_descriptions' . $lang->name);
                        if(!empty($name_seo) || !empty($meta_keywords) || !empty($meta_descriptions)) {
                            $sql_seo = array(
                                'tmp_id' => $item_id,
                                'country_id' => $lang->id,
                                'value' => "article",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach

                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/article/edit/' . $type."/".$item_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/article/index/' . $type) . '?messager=success');
                    }
                }
            }else{

            }
        }
        $ptitle="Thêm mới";

        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/article/index/'.$type.'">'.$ptitle.'</a>';
        $data['weight']=$this->general->get_max('article', 'article_weight') + 1;
        $data['list_cate'] = $this->m_term->show_list_term_where(array("parent_id" => 0, "type" => $type), 1, 1, "vn", 0);
        $data['type'] = $type;
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }

    //===========================================
    function edit($type = 1, $id) {
        if (!($this->general->Checkpermission("edit_article_" . $type)))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['ok'])|| isset($_POST['ok-continues'])) {
            foreach($this->global_function->list_tableWhere(array("status"=>1),"country") as $lang){
                $this->form_validation->set_rules('name_' . $lang->name, "Tên bài viết - ".$lang->title, 'trim|required');
                $this->form_validation->set_rules('item_summary_' . $lang->name, "Mô tả - ".$lang->title, 'trim');
                $this->form_validation->set_rules('item_description_' . $lang->name, "Thông tin - ".$lang->title, 'trim');
                $this->form_validation->set_rules('name_seo_' . $lang->name, "Thẻ tiêu đề - ".$lang->title, 'trim|max_length[70]');
                $this->form_validation->set_rules('meta_keywords_' . $lang->name, "Thẻ từ khóa - ".$lang->title, 'trim|max_length[180]');
                $this->form_validation->set_rules('meta_descriptions' . $lang->name, "Thẻ mô tả - ".$lang->title, 'trim|max_length[250]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">-', '</label><br />');
            if ($this->form_validation->run() == true) {
                $choose=$this->input->post('optionsRadio');
                $picture=$this->input->post('old_pic');
                if($choose==1){
                    if ((!empty($_FILES['picture']['name']))) {
                        $picture=$this->global_function->upload_img("picture","article",0,0);
                    }
                }else if($choose==2){
                    $picture = substr($this->input->post('picture_galary'), strpos($this->input->post('picture_galary'), "uploads"));
                }else if($choose==3){
                    $picture=$this->input->post('picture_Awesome');
                }
                $sql = array(
                    'article_status' => $this->input->post('status'),
                    'article_weight' => $this->input->post('weight'),
                    'article_hot' => $this->input->post('hot'),
                    'article_type' => $type,
                    'date_modify' => date('Y-m-d H:i:s'),
                    'date_create' => date('Y-m-d H:i:s'),
                    "picture"=>$picture,
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'alt_picture' => $this->input->post('alt_picture'),
                    'picture'=>$picture,
                    'choose_upload'=>$choose
                );
                $item_id=$id;
                $this->db->where("id",$item_id);
                $this->db->update('article', $sql);
                if(isset($item_id)) {
                        $this->db->delete("articleterm",array('article_id' => $item_id));
                        foreach ($this->input->post("term_id") as $term) {
                            $this->db->insert("articleterm", array("article_id" => $item_id, "term_id" => $term));
                        }
                    // inser item detail
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if($this->general->count_table_where(array('article_id'=>$id,'country_id'=>$lang->id),"articledetail") >0 ){
                            $name=$this->input->post('name_' . $lang->name);
                            $link=$this->input->post('item_link_' . $lang->name);
                            if(empty($link)) $link= $this->global_function->unicode($name);
                            $sql_lang = array(
                                'article_link' => $link,
                                'article_name' => $this->input->post('name_' . $lang->name),
                                'article_description' => $this->input->post('item_description_' . $lang->name),
                                'article_summary' => $this->input->post('item_summary_' . $lang->name),
                            );
                            $this->db->where('article_id', $item_id);
                            $this->db->where('country_id', $lang->id);
                            $this->db->update('articledetail', $sql_lang);
                        }else{
                            $name=$this->input->post('name_' . $lang->name);
                            $link=$this->input->post('item_link_' . $lang->name);
                            if(empty($link)) $link= $this->global_function->unicode($name);
                            $sql_lang = array(
                                'article_id' => $item_id,
                                'country_id' => $lang->id,
                                'article_link' => $link,
                                'article_name' => $this->input->post('name_' . $lang->name),
                                'article_description' => $this->input->post('item_description_' . $lang->name),
                                'article_summary' => $this->input->post('item_summary_' . $lang->name),
                            );
                            $this->db->insert('articledetail', $sql_lang);
                        }
                    }//foreach
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $params=array(
                            "where"=>array('tmp_id' => $item_id,'country_id' => $lang->id,'value' => "article"),
                            "table"=>"meta_seo"
                        );
                        if($this->global_function->count_tableWhere($params)>0) {
                            $sql_seo = array(
                                'tmp_id' => $item_id,
                                'country_id' => $lang->id,
                                'value' => "article",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->where(array('tmp_id' => $item_id,'country_id' => $lang->id,'value' => "article"));
                            $this->db->update('meta_seo', $sql_seo);
                        }else{
                            $sql_seo = array(
                                'tmp_id' => $item_id,
                                'country_id' => $lang->id,
                                'value' => "article",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach

                    if(isset($_POST['ok-continues'])){
                        redirect(site_url('admin/article/edit/' . $type."/".$item_id) . '?messager=success');
                    }else {
                        redirect(site_url('admin/article/index/' . $type) . '?messager=success');
                    }
                }
            }else{

            }

        }
        $data['breadcrumb'] = '<a href="'.base_url().'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.base_url().'admin/article/index/'.$type.'">Thêm mới</a>';
        $data['type'] = $type;
        $data['id'] = $id;
        $data['article'] = $this->m_article->show_detail_article_id($id);
        $data['list_cate'] = $this->m_term->show_list_term_where(array("parent_id" => 0, "type" => $type), 1, 1, "vn", 0);
        $this->template->write('mod', 'article_' . $type);
        $this->template->write_view('content', 'admin/edit', $data, TRUE);
        $this->template->render();
    }
    //============================================\
    function delete($type = 1, $id, $page_no = 1)
    {
        if (!($this->general->Checkpermission("delete_article_" . $type)))
            redirect(site_url("admin/not-permission"));
        if (file_exists('uploads/tin-tuc/' . $this->m_article->show_detail_article_id($id)->picture)) {
            @unlink('uploads/tin-tuc/' . $this->m_article->show_detail_article_id($id)->picture);
        }
        $where = array('article_id' => $id);
        $this->db->delete('articledetail', $where);
        $params = array(
            "where" => array('article_id' => $id),
            "table" => "articleterm"
        );
        if ($this->global_function->count_tableWhere($params) > 0) {
                $where = array('article_id' => $id);
                $this->db->delete('articleterm', $where);
            }
            $where = array('id' => $id);
            $this->db->delete('article', $where);
            redirect(site_url('admin/article/index' . '/' . $type . "/" . $page_no) . '?messager=success');
    }

    //============================================\
    function delete_more($id)
    {
        if ($id != 0) {
            if (file_exists('uploads/tin-tuc/' . $this->m_article->show_detail_article_id($id)->picture)) {
                @unlink('uploads/tin-tuc/' . $this->m_article->show_detail_article_id($id)->picture);
            }
            $where = array('article_id' => $id);
            $this->db->delete('articledetail', $where);
            $params = array(
                "where" => array('article_id' => $id),
                "table" => "articleterm"
            );
            if ($this->global_function->count_tableWhere($params) > 0) {
                $where = array('article_id' => $id);
                $this->db->delete('articleterm', $where);
            }
            $where = array('id' => $id);
            $this->db->delete('article', $where);
            return true;
        }
    }
    function Active() {
            $sql = array('article_status' => $this->input->post("active"));
            $this->db->where('id', $this->input->post("id"));
            $this->db->update('article', $sql);
    }
    function Hot() {
        $sql = array('article_hot' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('article', $sql);
    }
    function update_weight($id,$weight) {
        if (!($this->general->Checkpermission("edit_article_1"))) {
            redirect(site_url("admin/not-permission"));
        }else {
            $sql = array('article_weight' => $weight);
            $this->db->where('id', $id);
            $this->db->update('article', $sql);
            return true;
        }
    }
}

