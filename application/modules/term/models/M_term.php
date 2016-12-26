<?php

class M_term extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list terms where
    function show_list_term_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("termdetail.*,term.*,termdetail.term_name as name");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('term.weight', "ASC");
        $this->db->group_by('term.id');
        $this->db->from('term');
        $this->db->join('termdetail', 'termdetail.term_id=term.id');
        $this->db->join('country', 'termdetail.country_id=country.id');
        return $this->db->get()->result();
    }

    // show detail
    function show_detail_term_id($id, $lang = 'vn') {
        $this->db->select("termdetail.term_name as name,termdetail.*,term.*");
        $this->db->where("country.name", $lang);
        $this->db->where("term.id", $id);
        $this->db->order_by('term.weight', "ASC");
        $this->db->from('term');
        $this->db->join('termdetail', 'termdetail.term_id=term.id');
        $this->db->join('country', 'termdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function check_tmp_detail($id, $lang=1){
        $this->db->select("termdetail.term_id");
        $this->db->where("termdetail.country_id", $lang);
        $this->db->where("termdetail.term_id", $id);
        $this->db->from('termdetail');
        return $this->db->get()->row();
    }

}
