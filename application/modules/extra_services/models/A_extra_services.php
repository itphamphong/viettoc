<?php

class A_extra_services extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function get_list_where($params)
    {
        if(isset($params["select"])) {
            $this->db->select($params['select']);
        }else{
            $this->db->select('*');
        }
        if(isset($params['where'])) {
            $this->db->where($params['where']);
        }
        $this->db->where(array("extra_services.status"=>'1','country.name'=>$params['lang']));
        $this->db->from('extra_services');
        if(isset($params["limit"])) {
            $this->db->limit($params["limit"], $params["offset"]);
        }
        if(isset($params["order"])) {
            $this->db->order_by($params["order"], $params["desc"]);
        }

        $this->db->join('extra_servicesdetail','extra_servicesdetail.extra_services_id=extra_services.id');
        $this->db->join('country','extra_servicesdetail.country_id=country.id');
        if(isset($params["join_tmp"])) {
            $this->db->join("services_tmp",'services_tmp.utility_id=extra_services.id');
        }
        if(isset($params["first"])) {
            return $this->db->get()->first_row();
        }else {
            return $this->db->get()->result();
        }

    }
}