<?php

class Tags extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session'));
        $this->load->helper(array("url"));

        $this->load->model(array("tags/a_tags"));
    }
    function BlockAll($lang=DLANG){

        $data['list_tags']=$this->a_tags->show_list_tags_where(array('tags.status'=>1),10,0,$lang,1);
       $this->load->view('public/block/tags_all',$data);
    }
}
