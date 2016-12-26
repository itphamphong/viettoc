<?php

class M_tags extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list tagss where
    function show_list_tags_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("tagsdetail.*,tags.*,tagsdetail.tags_name as name");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('tags.weight', "ASC");
        $this->db->group_by('tags.id');
        $this->db->from('tags');
        $this->db->join('tagsdetail', 'tagsdetail.tags_id=tags.id');
        $this->db->join('country', 'tagsdetail.country_id=country.id');
        return $this->db->get()->result();
    }

    // show detail
    function show_detail_tags_id($id, $lang = 'vn') {
        $this->db->select("tagsdetail.tags_name as name,tagsdetail.*,tags.*");
        $this->db->where("country.name", $lang);
        $this->db->where("tags.id", $id);
        $this->db->order_by('tags.weight', "ASC");
        $this->db->from('tags');
        $this->db->join('tagsdetail', 'tagsdetail.tags_id=tags.id');
        $this->db->join('country', 'tagsdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function check_tmp_detail($id, $lang=1){
        $this->db->select("tagsdetail.tags_id");
        $this->db->where("tagsdetail.country_id", $lang);
        $this->db->where("tagsdetail.tags_id", $id);
        $this->db->from('tagsdetail');
        return $this->db->get()->row();
    }

}
