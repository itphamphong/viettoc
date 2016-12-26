<?php

class A_term extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list terms where
    function show_list_term_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("termdetail.term_name as name,term.id,term.type,termdetail.term_link");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->where(array("term.status"=>'1','country.name'=>$lang));
        $this->db->order_by('term.weight', "ASC");
        $this->db->group_by('term.id');
        $this->db->from('term');
        $this->db->join('termdetail', 'termdetail.term_id=term.id');
        $this->db->join('country', 'termdetail.country_id=country.id');
        return $this->db->get()->result();
    }

    // show detail
    function show_detail_term_where($where=array(), $lang = 'vn') {
        $this->db->select("termdetail.term_name as name,term.id,termdetail.term_link,term.type");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        $this->db->order_by('term.weight', "ASC");
        $this->db->from('term');
        $this->db->join('termdetail', 'termdetail.term_id=term.id');
        $this->db->join('country', 'termdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    // show detail with article_id
    function show_detail_term_with_article($id, $lang = 'vn') {
        $this->db->select("termdetail.term_name as name,term.id,termdetail.term_link,term.type");
        $this->db->where("country.name", $lang);
        $this->db->where("articleterm.article_id",$id);
        $this->db->order_by('term.weight', "ASC");
        $this->db->from('term');
        $this->db->join('termdetail', 'termdetail.term_id=term.id');
        $this->db->join('country', 'termdetail.country_id=country.id');
        $this->db->join('articleterm','articleterm.term_id=term.id');
        return $this->db->get()->row();
    }

}
