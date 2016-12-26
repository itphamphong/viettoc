<?php

class A_tags extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list tagss where
    function show_list_tags_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("tagsdetail.tags_name as name,tags.id,tags.type,tagsdetail.tags_link");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->where(array("tags.status"=>'1','country.name'=>$lang));
        $this->db->order_by('tags.weight', "ASC");
        $this->db->group_by('tags.id');
        $this->db->from('tags');
        $this->db->join('tagsdetail', 'tagsdetail.tags_id=tags.id');
        $this->db->join('country', 'tagsdetail.country_id=country.id');
        return $this->db->get()->result();
    }

    // show detail
    function show_detail_tags_where($where=array(), $lang = 'vn') {
        $this->db->select("tagsdetail.tags_name as name,tags.id,tagsdetail.tags_link,tags.type");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        $this->db->order_by('tags.weight', "ASC");
        $this->db->from('tags');
        $this->db->join('tagsdetail', 'tagsdetail.tags_id=tags.id');
        $this->db->join('country', 'tagsdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    // show detail with article_id
    function show_detail_tags_with_article($id, $lang = 'vn') {
        $this->db->select("tagsdetail.tags_name as name,tags.id,tagsdetail.tags_link,tags.type");
        $this->db->where("country.name", $lang);
        $this->db->where("articletags.article_id",$id);
        $this->db->order_by('tags.weight', "ASC");
        $this->db->from('tags');
        $this->db->join('tagsdetail', 'tagsdetail.tags_id=tags.id');
        $this->db->join('country', 'tagsdetail.country_id=country.id');
        $this->db->join('articletags','articletags.tags_id=tags.id');
        return $this->db->get()->row();
    }

}
