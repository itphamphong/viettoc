<?php

class M_permission extends CI_Model {

    function show_list_permission_where($limit, $offset) {
        $this->db->select("*");
        $this->db->limit($limit, $offset);
        $this->db->from('table_permission');
        $this->db->order_by('table_permission.name','ASC');
        return $this->db->get()->result();
    }
}
