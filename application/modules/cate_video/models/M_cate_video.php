<?php

class M_cate_video extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // show list cate_videos where
    function show_list_cate_video_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("cate_videodetail.*,cate_video.*,cate_videodetail.cate_video_name as name");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('cate_video.weight', "ASC");
        $this->db->group_by('cate_video.id');
        $this->db->from('cate_video');
        $this->db->join('cate_videodetail', 'cate_videodetail.cate_video_id=cate_video.id');
        $this->db->join('country', 'cate_videodetail.country_id=country.id');
        return $this->db->get()->result();
    }

    // show detail
    function show_detail_cate_video_id($id, $lang = 'vn') {
        $this->db->select("cate_videodetail.cate_video_name as name,cate_videodetail.*,cate_video.*");
        $this->db->where("country.name", $lang);
        $this->db->where("cate_video.id", $id);
        $this->db->order_by('cate_video.weight', "ASC");
        $this->db->from('cate_video');
        $this->db->join('cate_videodetail', 'cate_videodetail.cate_video_id=cate_video.id');
        $this->db->join('country', 'cate_videodetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function check_tmp_detail($id, $lang=1){
        $this->db->select("cate_videodetail.cate_video_id");
        $this->db->where("cate_videodetail.country_id", $lang);
        $this->db->where("cate_videodetail.cate_video_id", $id);
        $this->db->from('cate_videodetail');
        return $this->db->get()->row();
    }

}
