<?php

class M_language extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list language
    function show_list_language($lang = 'vn') {
        $this->db->select("*");
        $this->db->order_by('weight', "ASC");
        $this->db->from('language');
        $this->db->join("languagedetail", "languagedetail.language_id=language.id");
        $this->db->group_by("language.id");
        return $this->db->get()->result();
    }

    // show list language where
    function show_list_language_where($where = array(), $limit, $offset, $page = 0) {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->order_by('language.weight', "ASC");
        $this->db->from('language');
        $this->db->join("languagedetail", "languagedetail.language_id=language.id");
        if ($page != 0) {
            $this->db->limit($limit, $offset);
        }
        $this->db->group_by("language.id");
        return $this->db->get()->result();
    }

    function show_list_language_detail($id, $lang) {
        $this->db->select("*");
        $this->db->where("language.id", $id);
        $this->db->where("languagedetail.country_id", $lang);
        $this->db->order_by('language.weight', "ASC");
        $this->db->from('language');
        $this->db->join("languagedetail", "languagedetail.language_id=language.id");
        return $this->db->get()->row();
    }

}
