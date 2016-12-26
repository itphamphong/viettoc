<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $this->load->model(array('m_item', 'general', 'tags/m_tags'));
        $this->load->model('global_function');
        $this->load->model('m_session');
        $this->template->set_template('admin');
    }

    function admin()
    {
        parent::Controller();
    }

    function index($id = 0, $page_no = 1)
    {
        // tool all
        if (!($this->general->Checkpermission("view_item")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['update'])) {
            $array = array_keys($this->input->post('checkall'));
            $weight = $this->input->post('weight');
            $price = $this->input->post('price');
            if (!empty($weight) && !empty($price)) {
                for ($i = 0; $i < count($array); $i++) {
                    $this->update_more($array[$i], $weight[$i], $price[$i]);
                }
            } else if (!empty($weight)) {
                for ($i = 0; $i < count($array); $i++) {
                    $this->update_weight($array[$i], $weight[$i]);
                }
            } else if (!empty($price)) {
                for ($i = 0; $i < count($array); $i++) {
                    $this->update_price($array[$i], $price[$i]);
                }
            }
            redirect(site_url('admin/item') . '?messager=success');
        }
        if (isset($_POST['delete'])) {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                $this->delete_more($a);
            }
            redirect(site_url('admin/item') . '?messager=success');
        }
        if (isset($_POST['ok'])) {
            $this->Import($_FILES['filename']['tmp_name']);
        }
        //
        $data = array();
        $data['mod'] = 'item_list';
        $data['breadcrumb'] = '<a href="' . base_url() . 'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/item">Quản lý sản phẩm</a>';
        $page_co = ADMIN_PAGE;
        $start = ($page_no - 1) * $page_co;
        $count = $this->global_function->count_tableWhere(array("table" => "item"));
        $data['page_no'] = $page_no;
        $data['id'] = $id;
        $data['item'] = $this->m_item->show_list_item_page($page_co, $start);
        $data['link'] = $this->global_function->paging($page_co, $count, 'admin/item/index/' . $id . "/", $page_no);
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }

    function list_ajax()
    {
        $category_id = $this->input->post("category_id");
        $status = $this->input->post("status");
        $key = $this->input->post("key");
        $data['item'] = $this->m_item->show_list_item_search($category_id, $status, $key);
        $data['id'] = 1;
        $data['page_no'] = 1;
        $this->load->view('item/admin/list_ajax', $data);
    }

    function search_key()
    {
        $key = $this->global_function->unicode($this->input->post("key"));
        $data['item'] = $this->m_item->show_list_item_page_link($key);
        $data['id'] = 1;
        $data['page_no'] = 1;
        $this->load->view('item/admin/list_ajax', $data);
    }

    function edit_other_item_ajax()
    {
        $id = $this->input->post('id');
        $data['row'] = $this->m_item->show_other_detail_item($id);
        $this->load->view('admin/item/detail_other_item', $data);
    }

    function add($type = 0)
    {
        if (!($this->general->Checkpermission("add_item")))
            redirect(site_url("admin/not-permission"));
        $data['breadcrumb'] = '<a href="' . base_url() . 'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/item">Sản phẩm</a> <i class="fa fa-angle-right"></i> <a>Đăng sản phẩm</a>';
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {

            $this->form_validation->set_rules('item_code', 'Mã sản phẩm', 'required');
            $this->form_validation->set_rules('value', "Giá", 'trim');
            $this->form_validation->set_rules('price', "Giá khuyến mãi", 'trim|required');
            $this->form_validation->set_rules('weight', "Thứ tự", 'is_numeric');
            $this->form_validation->set_rules('number', "Tồn kho", 'is_numeric');
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('name_' . $lang->name, "Tên sản phẩm - " . $lang->title, 'trim|required');
                $this->form_validation->set_rules('item_link_' . $lang->name, "Thẻ Url " . $lang->title, 'trim');
                $this->form_validation->set_rules('item_description_' . $lang->name, "Tính năng - " . $lang->title, 'trim');
                $this->form_validation->set_rules('name_seo_' . $lang->name, "Thẻ tiêu đề - " . $lang->title, 'trim|max_length[70]');
                $this->form_validation->set_rules('name_seo_' . $lang->name, "Thẻ tiêu đề - " . $lang->title, 'trim|max_length[70]');
                $this->form_validation->set_rules('meta_keywords_' . $lang->name, "Thẻ từ khóa - " . $lang->title, 'trim|max_length[180]');
                $this->form_validation->set_rules('meta_descriptions_' . $lang->name, "Thẻ mô tả - " . $lang->title, 'trim|max_length[250]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">-', '</label><br />');

            if ($this->form_validation->run() == true) {
                $choose = $this->input->post('optionsRadio');
                $picture = "NULL";
                if ($choose == 1) {
                    if ((!empty($_FILES['picture']['name']))) {
                        $picture = $this->global_function->upload_img("picture", "product", 0, 0);
                    }
                } else if ($choose == 2) {
                    $picture = substr($this->input->post('picture_galary'), strpos($this->input->post('picture_galary'), "uploads"));
                } else if ($choose == 3) {
                    $picture = $this->input->post('picture_Awesome');
                }
                $sql = array(
                    'item_code' => $this->input->post('item_code'),
                    'value' => preg_replace('/\D/', '', $this->input->post('value')),
                    'price' => preg_replace('/\D/', '', $this->input->post('price')),
                    'date_create' => date('Y-m-d H:i:s'),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'item_weight' => $this->input->post('weight'),
                    'supplier_id' => 0,
                    'number' => $this->input->post('number'),
                    'alt_picture' => $this->input->post('alt_picture'),
                    'picture' => $picture,
                    'choose_upload' => $choose
                );
                $this->db->insert('item', $sql);
                $item_id = $this->db->insert_id();
                if (isset($item_id)) {
                    $category = $this->input->post('category');
                    //cate
                    if (!empty($category)) {
                        foreach ($category as $ca) {
                            $this->db->insert("item_category", array("item_id" => $item_id, "category_id" => $ca));
                        }
                    }
                    // seo
                    $tags = $this->input->post("tag_id");
                    if (!empty($tags)) {
                        foreach ($tags as $tag) {
                            $this->db->insert("tag_tmp", array("tmp_id" => $item_id, "tag_id" => $tag, "value" => 'item'));
                        }
                    }
                    $img = $this->input->post("image");
                    $alt_p = $this->input->post("alt");
                    if (!empty($img)) {
                        // images
                        $i = 0;
                        foreach ($this->input->post("image") as $value) {
                            $this->db->where("id", $value);
                            $this->db->update("images", array("tmp_id" => $item_id, 'alt' => $alt_p[$i]));
                            $i++;
                        }
                        foreach ($this->input->post("primary") as $value) {
                            $this->db->where("id", $value);
                            $this->db->update("images", array("primary" => 1));
                        }
                    }

                    $item_status = $this->input->post("item_status");
                    if (!empty($item_status)) {
                        foreach ($item_status as $i) {
                            $this->db->insert("tmp_item_status", array("item_id" => $item_id, "status_id" => $i));
                        }
                    }
                    $doc = $this->input->post('doc');
                    $doc_id = $this->input->post('doc_id');
                    $name_doc = $this->input->post('name_doc');
                    $files = $_FILES;
                    if (!empty($doc_id)) {
                        $i = 0;
                        foreach ($doc_id as $d) {
                            if ((!empty($_FILES['doc']['name'][$i]))) {
                                $_FILES['doc']['name'] = $files['doc']['name'][$i];
                                $_FILES['doc']['type'] = $files['doc']['type'][$i];
                                $_FILES['doc']['tmp_name'] = $files['doc']['tmp_name'][$i];
                                $_FILES['doc']['error'] = $files['doc']['error'][$i];
                                $_FILES['doc']['size'] = $files['doc']['size'][$i];
                                $pic = $this->global_function->upload_img("doc", "doc", 0, 0);
                            } else {
                                $pic = 'NULL';
                            }
                            if($pic!='NULL') {
                                $this->db->insert("item_doc", array("item_id" => $item_id, "doc_name" => $name_doc[$i], 'doc_file' => $pic));
                            }
                            $i++;
                        }
                    }
                    // inser item detail
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $name = $this->input->post('name_' . $lang->name);
                        if (!empty($name)) {
                            $sql_lang = array(
                                'item_id' => $item_id,
                                'country_id' => $lang->id,
                                'item_link' => $this->global_function->unicode( $this->input->post('name_' . $lang->name)),
                                'item_name' => $this->input->post('name_' . $lang->name),
                                'item_description' => $this->input->post('item_description_' . $lang->name),
                                'item_summary' => $this->input->post('item_summary_' . $lang->name),
                                'item_video' => $this->input->post('item_video_' . $lang->name),
                            );

                            $this->db->insert('itemdetail', $sql_lang);
                        }
                    }//foreach
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $name_seo = $this->input->post('name_seo_' . $lang->name);
                        $meta_keywords = $this->input->post('meta_keywords_' . $lang->name);
                        $meta_descriptions = $this->input->post('meta_descriptions_' . $lang->name);
                        if (!empty($name_seo) || !empty($meta_keywords) || !empty($meta_descriptions)) {
                            $sql_seo = array(
                                'tmp_id' => $item_id,
                                'country_id' => $lang->id,
                                'value' => "item",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach

                    if (isset($_POST['ok-continues'])) {
                        redirect(site_url('admin/item/edit/' . $item_id) . '?messager=success');
                    } else {
                        redirect(site_url('admin/item/') . '?messager=success');
                    }
                }
            } else {
            }
        }
        $data["weight"] = $this->general->get_max('item', 'item_weight') + 1;
        $data['code'] = "P_" . $this->global_function->randomPassword(5) . "_" . ($this->general->get_max('item', 'id') + 1);
        $data['type'] = $type;
        $data['nd'] = 'Updating...';
        $data['mod'] = 'item_add';
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/add', $data, TRUE);
        $this->template->render();
    }

    function edit($item_id)
    {
        if (!($this->general->Checkpermission("add_item")))
            redirect(site_url("admin/not-permission"));

        $data['breadcrumb'] = '<a href="' . base_url() . 'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/item">Sản phẩm</a> <i class="fa fa-angle-right"></i> <a>Chình sửa sản phẩm</a>';
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            $this->form_validation->set_rules('item_code', 'Mã sản phẩm', 'required');
            $this->form_validation->set_rules('value', "Giá", 'trim');
            $this->form_validation->set_rules('price', "Giá khuyến mãi", 'trim|required');
            $this->form_validation->set_rules('weight', "Thứ tự", 'is_numeric');
            $this->form_validation->set_rules('number', "Tồn kho", 'is_numeric');
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('name_' . $lang->name, "Tên sản phẩm - " . $lang->title, 'trim|required');
                $this->form_validation->set_rules('item_link_' . $lang->name, "Thẻ Url " . $lang->title, 'trim');
                $this->form_validation->set_rules('item_description_' . $lang->name, "Tính năng - " . $lang->title, 'trim');
                $this->form_validation->set_rules('name_seo_' . $lang->name, "Thẻ tiêu đề - " . $lang->title, 'trim|max_length[70]');
                $this->form_validation->set_rules('name_seo_' . $lang->name, "Thẻ tiêu đề - " . $lang->title, 'trim|max_length[70]');
                $this->form_validation->set_rules('meta_keywords_' . $lang->name, "Thẻ từ khóa - " . $lang->title, 'trim|max_length[180]');
                $this->form_validation->set_rules('meta_descriptions_' . $lang->name, "Thẻ mô tả - " . $lang->title, 'trim|max_length[250]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label>');
            if ($this->form_validation->run() == true) {
                $choose=$this->input->post('optionsRadio');
                $picture=$this->input->post('old_pic');
                if($choose==1){
                    if ((!empty($_FILES['picture']['name']))) {
                        $picture=$this->global_function->upload_img("picture","product",0,0);
                    }
                }else if($choose==2){
                    $picture = substr($this->input->post('picture_galary'), strpos($this->input->post('picture_galary'), "uploads"));
                }else if($choose==3){
                    $picture=$this->input->post('picture_Awesome');
                }
                $sql = array(
                    'item_code' => $this->input->post('item_code'),
                    'value' =>  preg_replace('/\D/', '', $this->input->post('value')),
                    'price' =>  preg_replace('/\D/', '', $this->input->post('price')),
                    'item_weight' => $this->input->post('weight'),
                    'supplier_id' => $this->input->post('supplier'),
                    'number' => $this->input->post('number'),
                    'alt_picture' => $this->input->post('alt_picture'),
                    'picture'=>$picture,
                    'choose_upload'=>$choose
                );
                $this->db->where("id", $item_id);
                $this->db->update('item', $sql);
                $this->db->delete('tmp_item_status', array("item_id" => $item_id));
                if (isset($item_id)) {
                    $category = $this->input->post('category');
                    $this->db->delete("item_category", array("item_id" => $item_id));
                    $tags = $this->input->post("tag_id");
                    $this->db->delete("tag_tmp", array("tmp_id" => $item_id, "value" => 'item'));
                    //cate
                    $item_status = $this->input->post("item_status");
                    if (!empty($item_status)) {
                        foreach ($item_status as $i) {
                            $this->db->insert("tmp_item_status", array("item_id" => $item_id, "status_id" => $i));
                        }
                    }
                    if (!empty($category)) {
                        foreach ($category as $ca) {
                            $this->db->insert("item_category", array("item_id" => $item_id, "category_id" => $ca));
                        }
                    }
                    if (!empty($tags)) {
                        foreach ($tags as $tag) {
                            $this->db->insert("tag_tmp", array("tmp_id" => $item_id, "tag_id" => $tag, "value" => 'item'));
                        }
                    }
                    /*
                    $color = $this->input->post("color");
                    $old = $this->input->post('old');
                    $this->db->delete("item_tmp", array("item_id" => $item_id, "value" => 'color'));
                    //$pic=$this->input->post('pic');
                    $files = $_FILES;
                    if (!empty($color)) {
                        $i = 0;
                        foreach ($color as $c) {
                            if ((!empty($_FILES['pic']['name'][$i]))) {
                                $_FILES['pic']['name'] = $files['pic']['name'][$i];
                                $_FILES['pic']['type'] = $files['pic']['type'][$i];
                                $_FILES['pic']['tmp_name'] = $files['pic']['tmp_name'][$i];
                                $_FILES['pic']['error'] = $files['pic']['error'][$i];
                                $_FILES['pic']['size'] = $files['pic']['size'][$i];
                                $pic = $this->global_function->upload_img("pic", "color", 0, 0);
                            } else {
                                $pic = $old[$i];
                            }
                            $this->db->insert("item_tmp", array("item_id" => $item_id, "value" => 'color', 'picture' => $pic, 'name' => $color[$i]));
                            $i++;
                        }
                    }
                    */
                    $doc = $this->input->post('doc');
                    $doc_id = $this->input->post('doc_id');
                    $name_doc = $this->input->post('name_doc');
                    $files = $_FILES;
                    if (!empty($doc_id)) {
                        $i = 0;
                        foreach ($doc_id as $d) {
                            if ((!empty($_FILES['doc']['name'][$i]))) {
                                $_FILES['doc']['name'] = $files['doc']['name'][$i];
                                $_FILES['doc']['type'] = $files['doc']['type'][$i];
                                $_FILES['doc']['tmp_name'] = $files['doc']['tmp_name'][$i];
                                $_FILES['doc']['error'] = $files['doc']['error'][$i];
                                $_FILES['doc']['size'] = $files['doc']['size'][$i];
                                $pic = $this->global_function->upload_img("doc", "doc", 0, 0);
                            } else {
                                $pic = 'NULL';
                            }
                            if($pic!='NULL') {
                                $this->db->insert("item_doc", array("item_id" => $item_id, "doc_name" => $name_doc[$i], 'doc_file' => $pic));
                            }
                            $i++;
                        }
                    }
                    // images
                    $img = $this->input->post("image");
                    $alt_p = $this->input->post("alt");
                    if (!empty($img)) {
                        $i=0;
                        foreach ($this->input->post("image") as $value) {
                            $this->db->where("id", $value);
                            $this->db->update("images", array("tmp_id" => $item_id, "primary" => "0",'alt'=>$alt_p[$i]));

                            $i++;
                        }
                        $this->db->where("id", $this->input->post("primary"));
                        $this->db->update("images", array("primary" => 1));
                    }
                    // inser item detail
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if (isset($this->m_item->check_item_detail($item_id, $lang->id)->item_id)) {
                            $sql_lang = array(
                                'item_link' => $this->global_function->unicode( $this->input->post('name_' . $lang->name)),
                                'item_name' => $this->input->post('name_' . $lang->name),
                                'item_description' => $this->input->post('item_description_' . $lang->name),
                                'item_summary' => $this->input->post('item_summary_' . $lang->name),
                                'item_video' => $this->input->post('item_video_' . $lang->name),
                            );
                            $this->db->where('item_id', $item_id);
                            $this->db->where('country_id', $lang->id);
                            $this->db->update('itemdetail', $sql_lang);
                        } else {
                            $name_seo = $this->input->post('name_seo_' . $lang->name);
                            $meta_keywords = $this->input->post('meta_keywords_' . $lang->name);
                            $meta_descriptions = $this->input->post('meta_descriptions_' . $lang->name);
                            if (!empty($name_seo) || !empty($meta_keywords) || !empty($meta_descriptions)) {
                                $sql_lang = array(
                                    'item_id' => $item_id,
                                    'country_id' => $lang->id,
                                    'item_link' => $this->global_function->unicode( $this->input->post('name_' . $lang->name)),
                                    'item_name' => $this->input->post('name_' . $lang->name),
                                    'item_description' => $this->input->post('item_description_' . $lang->name),
                                    'item_summary' => $this->input->post('item_summary_' . $lang->name),
                                    'item_video' => $this->input->post('item_video_' . $lang->name),
                                );

                                $this->db->insert('itemdetail', $sql_lang);
                            }
                        }
                    }//foreach
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $params = array(
                            "where" => array('tmp_id' => $item_id, 'country_id' => $lang->id, 'value' => "item"),
                            "table" => "meta_seo"
                        );
                        if ($this->global_function->count_tableWhere($params) > 0) {
                            $sql_seo = array(
                                'tmp_id' => $item_id,
                                'country_id' => $lang->id,
                                'value' => "item",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->where(array('tmp_id' => $item_id, 'country_id' => $lang->id, 'value' => "item"));
                            $this->db->update('meta_seo', $sql_seo);
                        } else {
                            $sql_seo = array(
                                'tmp_id' => $item_id,
                                'country_id' => $lang->id,
                                'value' => "item",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach

                    if (isset($_POST['ok-continues'])) {
                        redirect(site_url('admin/item/edit/' . $item_id) . '?messager=success');
                    } else {
                        redirect(site_url('admin/item/') . '?messager=success');
                    }
                }
            } else {

            }
        }
        $data['item_status'] = $this->global_function->get_tmp_status($item_id);
        $data['item'] = $this->m_item->show_detail_item_id($item_id);
        $data['mod'] = 'item_list';
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/edit', $data);
        $this->template->render();
    }

    function copy($id)
    {
        if (!($this->general->Checkpermission("add_item")))
            redirect(site_url("admin/not-permission"));

        $data['breadcrumb'] = '<a href="' . base_url() . 'admin">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="' . base_url() . 'admin/item">Sản phẩm</a> <i class="fa fa-angle-right"></i> <a>Chình sửa sản phẩm</a>';
        if (isset($_POST['ok']) || isset($_POST['ok-continues'])) {
            $this->form_validation->set_rules('item_code', 'Mã sản phẩm', 'required');
            $this->form_validation->set_rules('value', "Giá thị trường", 'is_numeric');
            $this->form_validation->set_rules('price', "Giá bán", 'is_numeric');
            foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                $this->form_validation->set_rules('name_' . $lang->name, "Tên sản phẩm - " . $lang->title, 'trim');
                $this->form_validation->set_rules('item_summary_' . $lang->name, "Mô tả - " . $lang->title, 'trim');
                $this->form_validation->set_rules('item_description_' . $lang->name, "Tính năng - " . $lang->title, 'trim');
                $this->form_validation->set_rules('item_info_' . $lang->name, "Thông số kĩ thuật - " . $lang->title, 'trim');
                $this->form_validation->set_rules('name_seo_' . $lang->name, "Thẻ tiêu đề - " . $lang->title, 'trim|max_length[70]');
                $this->form_validation->set_rules('meta_keywords_' . $lang->name, "Thẻ từ khóa - " . $lang->title, 'trim|max_length[180]');
                $this->form_validation->set_rules('meta_descriptions' . $lang->name, "Thẻ mô tả - " . $lang->title, 'trim|max_length[250]');
            }
            $this->form_validation->set_error_delimiters('<label class="c-red">', '</label>');
            if ($this->form_validation->run() == true) {
                $sql = array(
                    'item_code' => $this->input->post('item_code'),
                    'value' => $this->input->post('value'),
                    'price' => $this->input->post('price'),
                    'item_status' => $this->input->post("status"),
                    'user_id' => $this->m_session->userdata('admin_login')->user_id,
                    'item_weight' => $this->input->post('weight'),
                    'supplier_id' => $this->input->post('supplier'),
                    'brand_id' => $this->input->post('brand'),
                    'unit' => $this->input->post('unit'),
                    'number' => $this->input->post('number'),
                    'price_spec' => $this->input->post('price_spec'),
                    'price_spec' => $this->input->post('price_spec'),
                );
                $this->db->insert('item', $sql);
                $insert_id = $this->db->insert_id();
                if (isset($insert_id)) {
                    $category = $this->input->post('category');
                    $tags = $this->input->post("tag_id");
                    //cate
                    if (!empty($category)) {
                        foreach ($category as $ca) {
                            $this->db->insert("item_category", array("item_id" => $insert_id, "category_id" => $ca));
                        }
                    }
                    if (!empty($tags)) {
                        foreach ($tags as $tag) {
                            $this->db->insert("tag_tmp", array("tmp_id" => $insert_id, "tag_id" => $tag, "value" => 'item'));
                        }
                    }
                    $color = $this->input->post("color");
                    $old = $this->input->post('old');
                    //$pic=$this->input->post('pic');
                    $files = $_FILES;
                    if (!empty($color)) {
                        $i = 0;
                        foreach ($color as $c) {
                            if ((!empty($_FILES['pic']['name'][$i]))) {
                                $_FILES['pic']['name'] = $files['pic']['name'][$i];
                                $_FILES['pic']['type'] = $files['pic']['type'][$i];
                                $_FILES['pic']['tmp_name'] = $files['pic']['tmp_name'][$i];
                                $_FILES['pic']['error'] = $files['pic']['error'][$i];
                                $_FILES['pic']['size'] = $files['pic']['size'][$i];
                                $pic = $this->global_function->upload_img("pic", "color", 0, 0);
                            } else {
                                $pic = $old[$i];
                            }
                            $this->db->insert("item_tmp", array("item_id" => $insert_id, "value" => 'color', 'picture' => $pic, 'name' => $color[$i]));
                            $i++;
                        }
                    }
                    $item_status = $this->input->post("item_status");
                    if (!empty($item_status)) {
                        foreach ($item_status as $i) {
                            $this->db->insert("tmp_item_status", array("item_id" => $insert_id, "status_id" => $i));
                        }
                    }
                    // images
                    $img = $this->input->post("image");
                    if (!empty($img)) {
                        foreach ($this->input->post("image") as $value) {
                            $this->db->where("id", $value);
                            $this->db->update("images", array("tmp_id" => $insert_id, "primary" => "0"));
                        }
                        $this->db->where("id", $this->input->post("primary"));
                        $this->db->update("images", array("primary" => 1));
                    }
                    // inser item detail
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        if (isset($this->m_item->check_item_detail($insert_id, $lang->id)->item_id)) {
                            $sql_lang = array(
                                'item_link' => $this->input->post('item_link_' . $lang->name),
                                'item_name' => $this->input->post('name_' . $lang->name),
                                'item_description' => $this->input->post('item_description_' . $lang->name),
                                'item_summary' => $this->input->post('item_summary_' . $lang->name),
                                'item_info' => $this->input->post('item_info_' . $lang->name),
                                'video' => $this->input->post('video_' . $lang->name),
                                'location' => $this->input->post('location_' . $lang->name),
                                'material' => $this->input->post('material_' . $lang->name),
                                'guarantee' => $this->input->post('guarantee_' . $lang->name),
                            );
                            $this->db->where('item_id', $insert_id);
                            $this->db->where('country_id', $lang->id);
                            $this->db->update('itemdetail', $sql_lang);
                        } else {
                            $name_seo = $this->input->post('name_seo_' . $lang->name);
                            $meta_keywords = $this->input->post('meta_keywords_' . $lang->name);
                            $meta_descriptions = $this->input->post('meta_descriptions_' . $lang->name);
                            $sql_lang = array(
                                'item_id' => $insert_id,
                                'country_id' => $lang->id,
                                'item_link' => $this->input->post('item_link_' . $lang->name),
                                'item_name' => $this->input->post('name_' . $lang->name),
                                'item_description' => $this->input->post('item_description_' . $lang->name),
                                'item_summary' => $this->input->post('item_summary_' . $lang->name),
                                'item_info' => $this->input->post('item_info_' . $lang->name),
                                'video' => $this->input->post('video_' . $lang->name),
                                'location' => $this->input->post('location_' . $lang->name),
                                'material' => $this->input->post('material_' . $lang->name),
                                'guarantee' => $this->input->post('guarantee_' . $lang->name),
                            );

                            $this->db->insert('itemdetail', $sql_lang);

                        }
                    }//foreach
                    // seo
                    foreach ($this->global_function->list_tableWhere(array("status" => 1), "country") as $lang) {
                        $params = array(
                            "where" => array('tmp_id' => $insert_id, 'country_id' => $lang->id, 'value' => "item"),
                            "table" => "meta_seo"
                        );
                        if ($this->global_function->count_tableWhere($params) > 0) {
                            $sql_seo = array(
                                'tmp_id' => $insert_id,
                                'country_id' => $lang->id,
                                'value' => "item",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->where(array('tmp_id' => $insert_id, 'country_id' => $lang->id, 'value' => "item"));
                            $this->db->update('meta_seo', $sql_seo);
                        } else {
                            $sql_seo = array(
                                'tmp_id' => $insert_id,
                                'country_id' => $lang->id,
                                'value' => "item",
                                'name_seo' => $this->input->post('name_seo_' . $lang->name),
                                'meta_keywords' => $this->input->post('meta_keywords_' . $lang->name),
                                'meta_descriptions' => $this->input->post('meta_descriptions_' . $lang->name),
                            );
                            $this->db->insert('meta_seo', $sql_seo);
                        }
                    }//foreach

                    if (isset($_POST['ok-continues'])) {
                        redirect(site_url('admin/item/edit/' . $insert_id) . '?messager=success');
                    } else {
                        redirect(site_url('admin/item/') . '?messager=success');
                    }
                }
            } else {

            }
        }
        $data['item_status'] = $this->global_function->get_tmp_status($id);
        $data["weight"] = $this->general->get_max('item', 'item_weight') + 1;
        $data['code'] = "P_" . $this->global_function->randomPassword(5) . "_" . ($this->general->get_max('item', 'id') + 1);
        $data['nd'] = 'Updating...';
        $data['item'] = $this->m_item->show_detail_item_id($id);
        $data['mod'] = 'item_list';
        $this->template->write('mod', $data['mod']);
        $this->template->write_view('content', 'admin/copy', $data);
        $this->template->render();
    }

    function delete($id)
    {
        if (!($this->general->Checkpermission("delete_item")))
            redirect(site_url("admin/not-permission"));
        $this->db->delete('itemdetail', array("item_id" => $id));
        $list_img = $this->global_function->list_tableWhere(array('tmp_id' => $id, "value" => "item"), "images");
        if (!empty($list_img)) {
            foreach ($list_img as $row) {
                if (file_exists('uploads/san-pham/' . $row->name)) {
                    unlink('uploads/san-pham/' . $row->name);
                }
                $this->db->delete('images', array("id" => $row->id));
            }
        }
        $this->db->delete("tmp_item_status", array("item_id" => $id));
        $where = array('id' => $id);
        $this->db->delete('item', $where);
        redirect(site_url('admin/item') . '?messager=success');
    }

    function delete_more($id)
    {
        $this->db->delete('itemdetail', array("item_id" => $id));
        $list_img = $this->global_function->list_tableWhere(array('tmp_id' => $id, "value" => "item"), "images");
        if (!empty($list_img)) {
            foreach ($list_img as $row) {
                if (file_exists('uploads/san-pham/' . $row->name)) {
                    unlink('uploads/san-pham/' . $row->name);
                }
                $this->db->delete('images', array("id" => $row->id));
            }
        }
        $this->db->delete("tmp_item_status", array("item_id" => $id));
        $where = array('id' => $id);
        $this->db->delete('item', $where);
        return true;
    }

    function Active()
    {
        if (!($this->general->Checkpermission("edit_item")))
            redirect(site_url("admin/not-permission"));
        $sql = array('item_status' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('item', $sql);
    }
    function Promotion()
    {
        if (!($this->general->Checkpermission("edit_item")))
            redirect(site_url("admin/not-permission"));
        $sql = array('promotion' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('item', $sql);
    }

    function Hot()
    {
        if (!($this->general->Checkpermission("edit_item")))
            redirect(site_url("admin/not-permission"));
        $sql = array('item_hot' => $this->input->post("active"));
        $this->db->where('id', $this->input->post("id"));
        $this->db->update('item', $sql);
    }

    function update_weight($id, $weight)
    {
        if (!($this->general->Checkpermission("edit_item")))
            redirect(site_url("admin/not-permission"));
        $sql = array('item_weight' => $weight);
        $this->db->where('id', $id);
        $this->db->update('item', $sql);
        return true;
    }

    function update_more($id, $weight, $price)
    {
        if (!($this->general->Checkpermission("edit_item")))
            redirect(site_url("admin/not-permission"));
        $sql = array('item_weight' => $weight, "price" => $price);
        $this->db->where('id', $id);
        $this->db->update('item', $sql);
        return true;
    }


//End resize image
    //============================================\
    function delete_img($id_cate = 0, $item_id = 0, $id_img = 0)
    {
        if ($this->m_image->show_detail_image_id($id_img)->thumb != NULL) {
            if (file_exists('uploads/san-pham-cung-loai/' . $this->m_image->show_detail_image_id($id_img)->thumb)) {
                unlink('uploads/san-pham-cung-loai/' . $this->m_image->show_detail_image_id($id_img)->thumb);
            }
        }
        if ($this->counter->count_image_id($id_img) != 0) {
            $where = array('image_id' => $id_img);
            $this->db->delete('imagealbum', $where);
        }
        $where = array('id' => $id_img);
        $this->db->delete('images', $where);
        if ($this->counter->count_image_other_id($id_img) != 0) {
            $where = array('img_id' => $id_img);
            $this->db->delete('other_img', $where);
        }
        redirect(site_url('admin/item/edit/' . $id_cate . "/" . $item_id) . '?messager=success');
    }

    //====================check========================
    function checkcode($title, $id = NULL)
    {
        $slug = $this->input->post('code');
        $child = $this->m_item->check_code($slug, $id);
        if ($child) {
            $this->form_validation->set_message('checkcode', "Mã sản phẩm đã tồn tại");
            return FALSE;
        } else
            return TRUE;
    }


    function Loadajax()
    {
        $this->load->model(array('types/m_type', 'purposes/m_purpose', "product/m_product", "utility/m_utility", "room_types/m_room_type", "food_types/m_food_type", "product/m_product", "menu/m_menu", "food/m_food", "product_cates/m_product_cate", "location/m_location", "transportations/m_transportation", "language/m_language", "career/m_career"));
        $data['id'] = $this->input->post("id");
        $data['item_id'] = $this->input->post("item_id");
        $data['item'] = $this->m_item->show_detail_item_id($this->input->post("item_id"));
        $this->load->view("item/admin/loadajax", $data);
    }

    public function do_upload($item_id = 0)
    {
        $upload_path_url = base_url() . 'uploads/Images/product/';
        $config['upload_path'] = './uploads/Images/product/';
        $config['allowed_types'] = '*';
        $config['max_size'] = '30000';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload("files")) {
            $this->upload->display_errors();
            //$this->load->view('upload', $error);
            //Load the list of existing files in the upload directory
            $existingFiles = $this->global_function->list_tableWhere(array("tmp_id" => $item_id, "value" => "item"), "images");
            $foundFiles = array();
            $f = 0;
            foreach ($existingFiles as $info) {
                $fileName = $info->name;
                //set the data for the json array
                $foundFiles[$f]['name'] = $info->name;
                $foundFiles[$f]['alt'] = $info->alt;
                $foundFiles[$f]['id'] = $info->id;
                if ($info->primary == 1) {
                    $foundFiles[$f]['primary'] = $info->primary;
                }
                $foundFiles[$f]['url'] = $upload_path_url . $info->name;
                $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . $info->name;
                $foundFiles[$f]['deleteUrl'] = base_url() . 'admin/item/deleteImage/' . $info->name;
                $foundFiles[$f]['deleteType'] = 'GET';
                $foundFiles[$f]['error'] = null;

                $f++;
            }
            if ($item_id != 0) {
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('files' => $foundFiles)));
            }
        } else {
            $data = $this->upload->data();
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = TRUE;
            //$config['new_image'] = $data['file_path'] . 'thumbs/';
            $config['maintain_ratio'] = TRUE;
            $config['thumb_marker'] = '';
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $this->db->insert("images", array("name" => $data['file_name'], "value" => 'item', "tmp_id" => $item_id));
            $id = $this->db->insert_id();
            $row = $this->general->get_tableWhere(array("id" => $id, "value" => "item"), "images");;
            //set the data for the json array
            $info = new StdClass;
            $info->name = $row->name;
            $info->id = $row->id;
            $info->primary = $row->primary;
            $info->type = $data['file_type'];
            $info->url = $upload_path_url . $data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnailUrl = $upload_path_url . $data['file_name'];
            $info->deleteUrl = base_url() . 'admin/item/deleteimage/' . $data['file_name'];
            $info->deleteType = 'GET';
            $info->error = null;
            $files[] = $info;
            //this is why we put this in the constants to pass only json data

            echo json_encode(array("files" => $files));
            //this has to be the only data returned or you will get an error.
            //if you don't give this a json array it will give you a Empty file upload result error
            //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
            // so that this will still work if javascript is not enabled
        }
    }

    public function deleteimage($file)
    { //gets the job done but you might want to add error checking and security
        $success = @unlink(base_url() . 'uploads/Images/product/' . $file);
        $success_ = @unlink(base_url() . 'uploads/Images/product/thumbs/' . $file);
        //info to see if it is doing what it is supposed to
        $info = new StdClass;
        $info->sucess = $success;
        $info->path = base_url() . 'uploads/Images/product/' . $file;
        $info->file = is_file(base_url() . 'uploads/Images/product/' . $file);
        $this->db->where("name", $file);
        $this->db->delete("images");
        //I don't think it matters if this is set but good for error checking in the console/firebug
        echo json_encode(array($info));
    }

    function load_tmp()
    {
        $data['item_id'] = $this->input->post('item_id');
        $id = $this->input->post('category');
        $data['size'] = $this->m_item->show_list_category_where_tmp_in(array("value" => "size", "category_type" => 3), $id);
        $data['color'] = $this->m_item->show_list_category_where_tmp_in(array("value" => "color", "category_type" => 4), $id);
        $this->load->view("item/admin/load_tmp", $data);
    }

    function DeletePic($id)
    {
        $this->db->where(array('id' => $id));
        $this->db->update('item_tmp', array('picture' => "NULL"));
    }

    function deletecolor($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('item_tmp');

    }
    function Delete_doc($id,$item){
        $doc=$this->global_function->get_tableWhere(array('id'=>$id),'item_doc');
        if (file_exists('uploads/Images/doc/' .$doc->doc_file)) {
            unlink('uploads/Images/doc/' .$doc->doc_file);
        }
        $this->db->where('id',$id);
        $this->db->delete('item_doc');
        redirect(site_url('admin/item/edit/'.$item));
    }
}

