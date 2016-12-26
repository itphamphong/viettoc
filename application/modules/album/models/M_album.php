<?php

class m_album extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    // show list albums where
    function show_list_album_where($where = array(), $limit, $offset, $lang = 'vn', $page = 1) {
        $this->db->select("*");
        $this->db->where($where);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('album.weight', "ASC");
        $this->db->group_by('album.id');
        $this->db->from('album');
        return $this->db->get()->result();
    }
    // show detail
    function show_detail_album_id($id, $lang = 'vn') {
        $this->db->select("*");
        $this->db->where("album.id", $id);
        $this->db->order_by('album.weight', "ASC");
        $this->db->from('album');
        return $this->db->get()->row();
    }
}
