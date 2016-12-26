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
		$this->load->helper(array('url', 'text', 'form', 'file'));
        $this->load->library(array('session', 'form_validation', 'ftp'));
        $this->load->database();
        $this->load->model(array('article/m_article','m_session', 'general', "term/m_term", "global_function"));
        $this->template->set_template('admin');        // Set template
    }

    function index($page_no=1)
	{
		if (!($this->general->Checkpermission("view_contact")))
            redirect(site_url("admin/not-permission"));
		$data=array();
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.site_url("admin/contact").'">Quản lý liên hệ</a>';
   		$data['name_project']='Terrace resort';
		$data['mod']='contact';
		if(isset($_POST['delete'])){
			$array=array_keys($this->input->post('checkall'));
			foreach ($array as $a){
				//--------change parent------
				$this->delete_more($a);
			}
			redirect( site_url('admin/contact/index/'.$page_no).'?messager=success' );
		}
		$page_co=20;
		$start=($page_no-1)*$page_co;
		$count=$this->global_function->count_table(array('id !='=>0),'contact');
		$data['page_no']=$page_no;
        $this->template->write('mod', 'contact');
		$data['contact']=$this->general->show_list_contact_page($page_co,$start);
		$data['link']=$this->global_function->paging($page_co,$count,'admin/contact/index/',$page_no);
		//$this->print_arr($data['items']);
		$this->template->write_view('content', 'admin/index', $data, TRUE);
        $this->template->render();
	
	}
    function Contact_Detail($page_no=1)
    {
        if (!($this->general->Checkpermission("view_contact")))
            redirect(site_url("admin/not-permission"));
        $data=array();
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.site_url("admin/contact").'">Quản lý liên hệ</a>';
        $data['name_project']='Terrace resort';
        $data['mod']='contact';
        if(isset($_POST['delete_detail'])){
            $array=array_keys($this->input->post('checkall'));
            foreach ($array as $a){
                //--------change parent------
                $this->delete_more_detail($a);
            }
            redirect( site_url('admin/contact/contact_detail/'.$page_no).'?messager=success' );
        }
        $page_co=20;
        $start=($page_no-1)*$page_co;
        $count=$this->global_function->count_table(array('id !='=>0),'contact_detail');
        $data['page_no']=$page_no;
        $this->template->write('mod', 'contact_detail');
        $data['contact']=$this->general->show_list_contact_page_detail($page_co,$start);
        $data['link']=$this->global_function->paging($page_co,$count,'admin/contact/contact_detail/',$page_no);
        //$this->print_arr($data['items']);
        $this->template->write_view('content', 'admin/contact_detail', $data, TRUE);
        $this->template->render();

    }
    function booking_flight($page_no=1)
    {
        if (!($this->general->Checkpermission("view_contact")))
            redirect(site_url("admin/not-permission"));
        $data=array();
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.site_url("admin/contact").'">Quản lý liên hệ</a>';
        $data['name_project']='Terrace resort';
        $data['mod']='contact';
        if(isset($_POST['delete'])){
            $array=array_keys($this->input->post('checkall'));
            foreach ($array as $a){
                //--------change parent------
                $this->delete_more($a);
            }
            redirect( site_url('admin/contact/index/'.$page_no).'?messager=success' );
        }
        $page_co=20;
        $start=($page_no-1)*$page_co;
        $count=$this->global_function->count_table(array('id !='=>0),'booking_flight');
        $data['page_no']=$page_no;
        $this->template->write('mod', 'booking_flight');
        $data['contact']=$this->general->show_list_booking_flight_page($page_co,$start);
        $data['link']=$this->global_function->paging($page_co,$count,'admin/contact/index/',$page_no);
        //$this->print_arr($data['items']);
        $this->template->write_view('content', 'admin/booking_flight', $data, TRUE);
        $this->template->render();

    }
	//============================================
	function view($id){
		if (!($this->general->Checkpermission("view_contact")))
            redirect(site_url("admin/not-permission"));
			$data=array(); $data['name_project']='';
        $this->template->write('mod', 'contact');
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.site_url("admin/contact").'">Quản lý liên hệ</a>';			$sql = array(
				'status'=>1
                    );
				$this->db->where('id',$id);
				$this->db->update('contact' , $sql);
			$data['order']= $this->global_function->get_tableWhere(array('id'=>$id),'contact');
			$this->template->write_view('content', 'admin/view', $data, TRUE);
        	$this->template->render();
	}
	//============================================\
	function delete($id)
	{
				if (!($this->general->Checkpermission("delete_contact")))
            redirect(site_url("admin/not-permission"));
				$where=array('id'=>$id);
				$this->db->delete('contact',$where);
			
			redirect( site_url('admin/contact/index').'?messager=success' );
	}
    function delete_detail($id)
    {
        if (!($this->general->Checkpermission("delete_contact")))
            redirect(site_url("admin/not-permission"));
        $where=array('id'=>$id);
        $this->db->delete('contact_detail',$where);

        redirect( site_url('admin/contact/contact_detail').'?messager=success' );
    }
    function delete_booking($id)
    {
        $where=array('id'=>$id);
        $this->db->delete('booking_flight',$where);

        redirect( site_url('admin/contact/booking_flight').'?messager=success' );
    }

//============================================\
	function delete_more($id)
	{
        if (!($this->general->Checkpermission("delete_contact")))
            redirect(site_url("admin/not-permission"));
				if (!($this->general->Checkpermission("add")))
            redirect(site_url("admin/not-permission"));
				$where=array('id'=>$id);
				$this->db->delete('contact',$where);
			return true;
	}
    function delete_more_detail($id)
    {
        $where=array('id'=>$id);
        $this->db->delete('contact_detail',$where);
        return true;
    }
//============================================
	function print_arr($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
//============================================
	public function checkuser(){
		if(!$this->m_session->userdata('admin_login')) 
			redirect( site_url('admin/login'));
		$a=$this->m_session->userdata('admin_login')->per;
		$p = unserialize($a);
		return false;
	}
//=================================== Email ===============
    function email($page_no=1)
    {
        if (!($this->general->Checkpermission("view_contact")))
            redirect(site_url("admin/not-permission"));
        $data=array();
        $data['breadcrumb'] = '<a href="'.site_url("admin").'">Trang chủ</a><i class="fa fa-angle-right"></i>
<a href="'.site_url("admin/order").'">Quản lý email</a>';
        if(isset($_POST['delete'])){
            $array=array_keys($this->input->post('checkall'));
            foreach ($array as $a){
                //--------change parent------
                $this->email_delete_more($a);
            }
            redirect( site_url('admin/contact/email/'.$page_no).'?messager=success' );
        }
        $page_co=20;
        $start=($page_no-1)*$page_co;
        $count=$this->model->count_where(array('select'=>'*','name_table'=>'email_letter'));
        $data['page_no']=$page_no;
        $data['contact']=$this->general->show_list_email_page($page_co,$start);
        $data['link']=$this->global_function->paging($page_co,$count,'admin/contact/index/',$page_no);
        //$this->print_arr($data['items']);
        $this->template->write('mod', 'email_list');
        $this->template->write_view('content', 'admin/email_list', $data, TRUE);
        $this->template->render();

    }
    function email_delete($id)
    {
        if (!($this->general->Checkpermission("delete_contact")))
            redirect(site_url("admin/not-permission"));
        $where=array('id'=>$id);
        $this->db->delete('email_letter',$where);
        redirect( site_url('admin/contact/email').'?messager=success' );
    }
    function email_delete_more($id)
    {
        if (!($this->general->Checkpermission("delete_contact")))
            redirect(site_url("admin/not-permission"));
        $where=array('id'=>$id);
        $this->db->delete('email_letter',$where);
        return true;
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
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . 1, 'STT');
        $objPHPExcel->getActiveSheet(0)->setCellValue('B' . 1, 'Email');
        $objPHPExcel->getActiveSheet(0)->setCellValue('C' . 1, 'Ngày gửi');
        $item = $this->general->get_list_table("email_letter");
        for ($i = 0; $i < count($item); $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . ($i + 2), $i+1);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . ($i + 2), $item[$i]->email);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . ($i + 2), $item[$i]->create_date);
        }
        $date = "Danh sách email";
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

}
