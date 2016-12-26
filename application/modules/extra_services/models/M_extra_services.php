<?php

class M_extra_services extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list extra_servicess where
    function show_list_extra_services_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("extra_servicesdetail.*,extra_services.*,extra_servicesdetail.extra_services_name as name");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('extra_services.weight', "ASC");
        $this->db->group_by('extra_services.id');
        $this->db->from('extra_services');
        $this->db->join('extra_servicesdetail', 'extra_servicesdetail.extra_services_id=extra_services.id');
        $this->db->join('country', 'extra_servicesdetail.country_id=country.id');
        return $this->db->get()->result();
    }

    // show detail
    function show_detail_extra_services_id($id, $lang = 'vn') {
        $this->db->select("extra_servicesdetail.extra_services_name as name,extra_servicesdetail.*,extra_services.*");
        $this->db->where("country.name", $lang);
        $this->db->where("extra_services.id", $id);
        $this->db->order_by('extra_services.weight', "ASC");
        $this->db->from('extra_services');
        $this->db->join('extra_servicesdetail', 'extra_servicesdetail.extra_services_id=extra_services.id');
        $this->db->join('country', 'extra_servicesdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function check_tmp_detail($id, $lang=1){
        $this->db->select("extra_servicesdetail.extra_services_id");
        $this->db->where("extra_servicesdetail.country_id", $lang);
        $this->db->where("extra_servicesdetail.extra_services_id", $id);
        $this->db->from('extra_servicesdetail');
        return $this->db->get()->row();
    }

}
