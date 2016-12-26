<?php

class M_location extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function show_list_location_where_array($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("locationdetail.*,location.*,locationdetail.location_name as name");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('locationdetail.location_name', "ASC");
        $this->db->group_by('location.id');
        $this->db->from('location');
        $this->db->join('locationdetail', 'locationdetail.location_id=location.id');
        $this->db->join('country', 'locationdetail.country_id=country.id');
        return $this->db->get()->result_array();
    }
    // show list locations where
    function show_list_location_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("locationdetail.*,location.*,locationdetail.location_name as name");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('locationdetail.location_name', "ASC");
        $this->db->group_by('location.id');
        $this->db->from('location');
        $this->db->join('locationdetail', 'locationdetail.location_id=location.id');
        $this->db->join('country', 'locationdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function show_list_location_where_in($where,$modules=0,$lang) {
        $this->db->select("locationdetail.*,location.*,locationdetail.location_name as name");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if($modules!=0){
            $this->db->where("tmp_modules.value",$modules);
            $this->db->join('tmp_modules', 'tmp_modules.location_id=location.id');
        }
        $this->db->order_by('locationdetail.location_name', "ASC");
        $this->db->group_by('location.id');
        $this->db->from('location');
        $this->db->join('locationdetail', 'locationdetail.location_id=location.id');
        $this->db->join('country', 'locationdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    // show detail
    function show_detail_location_id($id, $lang = 'vn') {
        $this->db->select("locationdetail.location_name as name,locationdetail.*,location.*");
        $this->db->where("country.name", $lang);
        $this->db->where("location.id", $id);
        $this->db->order_by('locationdetail.location_name', "ASC");
        $this->db->from('location');
        $this->db->join('locationdetail', 'locationdetail.location_id=location.id');
        $this->db->join('country', 'locationdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function check_tmp_detail($id, $lang=1){
        $this->db->select("locationdetail.location_id");
        $this->db->where("locationdetail.country_id", $lang);
        $this->db->where("locationdetail.location_id", $id);
        $this->db->from('locationdetail');
        return $this->db->get()->row();
    }
    function show_list_location_search($key,$category,$lang = 'vn', $page = 1) {
        $this->db->select("locationdetail.*,location.*,locationdetail.location_name as name");
        $this->db->where("country.name", $lang);
        if (!empty($key)) {
            $this->db->like('locationdetail.location_link', $this->global_function->unicode($key));
        }
        if (!empty($category) && $category!=0) {
            $this->db->where('location.parent_id', $category);
        }
        $this->db->order_by('locationdetail.location_name', "ASC");
        $this->db->group_by('location.id');
        $this->db->from('location');
        $this->db->join('locationdetail', 'locationdetail.location_id=location.id');
        $this->db->join('country', 'locationdetail.country_id=country.id');
        return $this->db->get()->result();
    }

}
