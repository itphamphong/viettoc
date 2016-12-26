<?php

class M_moderator extends CI_Model {

    function show_list_user_where($limit, $offset) {
        $this->db->select("*,tbl_user.user_id as id,tbl_user.user_status as status");
        $this->db->order_by('tbl_user.user_id', "DESC");
        $this->db->where("type !=", 2);
        $this->db->limit($limit, $offset);
        $this->db->from('tbl_user');
        return $this->db->get()->result();
    }

}
