<?php

class m_config_language extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list config_languages where
    function show_list_config_language_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("config_languagedetail.*,config_language.*");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('config_languagedetail.value', "ASC");
        $this->db->group_by('config_language.id');
        $this->db->from('config_language');
        $this->db->join('config_languagedetail', 'config_languagedetail.config_language_id=config_language.id');
        $this->db->join('country', 'config_languagedetail.country_id=country.id');
        return $this->db->get()->result();
    }

    // show detail
    function show_detail_config_language_id($id, $lang = 'vn') {
        $this->db->select("config_languagedetail.*,config_language.*");
        $this->db->where("country.name", $lang);
        $this->db->where("config_language.id", $id);
        $this->db->order_by('config_language.id', "ASC");
        $this->db->from('config_language');
        $this->db->join('config_languagedetail', 'config_languagedetail.config_language_id=config_language.id');
        $this->db->join('country', 'config_languagedetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function check_tmp_detail($id, $lang=1){
        $this->db->select("config_languagedetail.config_language_id");
        $this->db->where("config_languagedetail.country_id", $lang);
        $this->db->where("config_languagedetail.config_language_id", $id);
        $this->db->from('config_languagedetail');
        return $this->db->get()->row();
    }

}
