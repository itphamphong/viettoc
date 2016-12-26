<?php

class A_order extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //================ check itemdetail is db====================
    function show_list_order($where,$limit, $offset) {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from('od_order');
        $this->db->limit($limit, $offset);
        $this->db->order_by("id","DESC");
        return $this->db->get()->result();
    }
    function count_list_order($where) {
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from('od_order');
        return $this->db->get()->num_rows();
    }
    function Detail($id) {
        $this->db->select('*');
        $this->db->where(array("id"=>$id,"buyer_id"=>$this->session->userdata("user")->id));
        $this->db->from('od_order');
        return $this->db->get()->row();
    }
    function ItemOrderDetail($id) {
        $this->db->select('*');
        $this->db->where("id_order",$id);
        $this->db->from('od_order_item');
        return $this->db->get()->result();
    }
    function sum_total_order($id){
        $this->db->select_sum('od_order_item.total');
        $this->db->where("id_order",$id);
        $this->db->from('od_order_item');
        return $this->db->get()->row()->total;
    }
    // manager order og store
    function show_list_order_store($id,$limit, $offset) {
        $this->db->select('*');
        $this->db->from('od_order');
        $this->db->or_where("change_store_id",$id);
        $this->db->or_where("store_id",$id);
        $this->db->limit($limit, $offset);
        $this->db->order_by("id","DESC");
        return $this->db->get()->result();
    }
    function count_list_order_store($id) {
        $this->db->select('*');
        $this->db->or_where("change_store_id",$id);
        $this->db->or_where("store_id",$id);
        $this->db->from('od_order');
        return $this->db->get()->num_rows();

    }
    function DetailStore($id,$store_id) {
        $this->db->select('*');
        $this->db->where(array("id"=>$id));
        $this->db->or_where("change_store_id",$id);
        $this->db->or_where("store_id",$id);
        $this->db->from('od_order');
        return $this->db->get()->row();
    }


}
