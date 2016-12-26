<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper(array('url', 'text', 'form', 'file'));
        $this->load->library(array('session', 'form_validation', 'ftp'));
        $this->load->database();
        $this->load->model(array('m_order', 'general'));
        $this->load->model('global_function');
        $this->load->model('m_session');
        date_default_timezone_set('Asia/Saigon');
        $this->template->set_template('admin');

    }
    // Block 5 ddon hang moi nhat

    function index($page_no=1) {
        if (!($this->general->Checkpermission("view_order")))
            redirect(site_url("admin/not-permission"));
        if (isset($_POST['delete'])) {
            $array = array_keys($this->input->post('checkall'));
            foreach ($array as $a) {
                //--------change parent------
                    $this->delete_more($a);
            }
            redirect(site_url('admin/order') . '?messager=success');
        }
        $page_co =50;
        $start = ($page_no - 1) * $page_co;
        $data['page_no'] = $page_no;
        $count=$this->m_order->count_list_order();
        $data['list']=$this->m_order->show_list_order($page_co, $start);
        $data['link'] = $this->global_function->paging($page_co, $count, 'admin/order/index/', $page_no);
        $data['status']=$this->general->get_list_table("order_status");
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.site_url("admin/order").'">Quản lý đơn hàng</a>';
        $this->template->write('mod', "order");
        $this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
    }
    function view($id){
        if (!($this->general->Checkpermission("edit_order")))
            redirect(site_url("admin/not-permission"));
        $data['detail']=$this->m_order->Detail($id);
        $data['list_item']=$this->m_order->ItemOrderDetail($id);
        $data['status']=$this->general->get_list_table("order_status");
        if(isset($_REQUEST['ok']) || isset($_REQUEST['ok-continues'])){
            $sql=array(
                "status"=>$this->input->post("status")
            );
            $this->db->where("id",$id);
            $this->db->update("od_order",$sql);
            if(isset($_REQUEST['ok-continues'])) {
                redirect(site_url('admin/order/view/' . $id) . '?messager=success');
            }else{
                redirect(site_url('admin/order') . '?messager=success');
            }
        }
        $this->template->write('mod', "order");
        $this->template->write_view('content', 'admin/view', $data, TRUE);
        $this->template->render();
    }
    function delete_more($id){
        $this->db->where(array("id"=>$id));
        $this->db->delete("od_order");
        $this->db->where("id_order",$id);
        $this->db->delete("od_order_item");
        return true;
    }
    function list_ajax(){
        $key=$this->input->post("key");
        $store_id=$this->input->post("store_id");
        $status=$this->input->post("order_status");
        $from=$this->input->post("date_one");
        $to=$this->input->post("date_two");
        $data['list']=$this->m_order->list_ajax($key,$store_id,$status,$from,$to);
        $this->load->view("order/admin/list_ajax",$data);
    }
    function ChangeStore($id,$lang='vn'){
        $this->load->view("front/inc/lang/block");
        $this->load->model(array("store/a_store","notice/a_notice"));
        $l = new lang();
        if ($lang == '')
            $data['lang'] = 'en';
        else
            $data['lang'] = $lang;
        $data['l'] = $l;
        if($lang=='vn') {
            $site=site_url();
            $mes="cap-nhat-thanh-cong";
        }
        else {
            $site=site_url($lang."/".$l->lang_url_home[$lang]);
            $mes="update-success";
        }
        if(isset($_REQUEST['ok'])){
            $this->form_validation->set_rules('note-change-store',$l->lang_note[$lang], 'trim|required');
            $this->form_validation->set_error_delimiters('<label class="red bold">*', '</label>');
            if ($this->form_validation->run() == true) {
                $sql=array(
                    "change_store_id"=>$this->input->post("store_id"),
                    "change_store_note"=>$this->input->post("note-change-store"),
                    "change_store_date"=>TIME,
                );
                $this->db->where("id",$id);
                $this->db->update("od_order",$sql);
                redirect(site_url('admin/order') . '?messager=success');
            }else{

            }
        }
        $data['list']=$this->a_store->show_list_store_where(array("store.status"=>1),$lang);
        $this->template->write('mod', "order");
        $this->template->write_view('content', 'admin/change_store',$data);
        $this->template->render();
    }
}