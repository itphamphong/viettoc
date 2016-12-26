<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Banner extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model(array("banner/a_banner"));
    }

    function Top($lang=DLANG) {
        $data['info']=$this->global_function->show_company($lang);
       $data['lang']=$lang;
        $data['banner']=$this->a_banner->get_list_image_with_id_album(3,$lang);
        $this->load->view("public/banner_top",$data);
    }
    function Student($lang=DLANG) {
        $data['lang']=$lang;
        $data['banner']=$this->a_banner->get_list_image_with_id_album(1,$lang);
        $this->load->view("public/student",$data);
    }
    function Student_page($lang=DLANG) {
        $data['lang']=$lang;
        $data['banner']=$this->a_banner->get_list_image_with_id_album(1,$lang,0);
        $this->load->view("public/student_page",$data);
    }
    function Tutor($lang=DLANG) {
        $data['lang']=$lang;
        $data['banner']=$this->a_banner->get_list_image_with_id_album(2,$lang);
        $this->load->view("public/tutor",$data);
    }
    function Line($album_id,$tmp_id,$lang=DLANG) {
        $data['lang']=$lang;
        $data['banner']=$this->a_banner->get_list_image_with_id_album_line($album_id,$tmp_id,$lang);
        $this->load->view("public/line",$data);
    }
    function Bottom_tutor($lang=DLANG) {
        $data['lang']=$lang;
        $data['banner']=$this->a_banner->get_list_image_with_id_album(4,$lang);
        $this->load->view("public/bottom_tutor",$data);
    }


}
