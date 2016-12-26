<?php

class A_location extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    // get list hotel
    function get_list_location_where($params)
    {
        if(isset($params["select"])) {
            $this->db->select($params['select']);
        }else{
            $this->db->select('*');
        }
        if(isset($params['where'])) {
            $this->db->where($params['where']);
        }
        if(isset($params['modules'])){
            $this->db->where("tmp_modules.value",$params['modules']);
            $this->db->join('tmp_modules', 'tmp_modules.location_id=location.id');
        }
        $this->db->where(array("location.status"=>'1','country.name'=>$params['lang']));
        $this->db->from('location');
        if(isset($params["limit"])) {
            $this->db->limit($params["limit"], $params["offset"]);
        }
        $this->db->order_by('locationdetail.location_name', "ASC");
        $this->db->order_by("location.id","DESC");
        $this->db->join('locationdetail','locationdetail.location_id=location.id');
        $this->db->join('country','locationdetail.country_id=country.id');
        if(isset($params["first"])) {
            return $this->db->get()->first_row();
        }else {
            return $this->db->get()->result();
        }

    }


}
