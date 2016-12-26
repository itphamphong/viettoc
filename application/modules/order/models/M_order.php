<?php

class M_order extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //================ check itemdetail is db====================
    // top ban chay
    function show_list_item_top() {
        $this->db->select('SUM(od_order_item.quantity) as q,id_item,SUM(od_order_item.total) as total_money');
        $this->db->from('od_order_item');
        $this->db->limit(10);
        $this->db->group_by('id_item');
        $this->db->order_by("q","DESC");
        $this->db->join("item","item.id=od_order_item.id_item");
        return $this->db->get()->result();
    }
    function show_list_order($limit, $offset) {
        $this->db->select('*');
        $this->db->from('od_order');
        $this->db->limit($limit, $offset);
        $this->db->order_by("id","DESC");
        return $this->db->get()->result();
    }
    function count_list_order() {
        $this->db->select('*');
        $this->db->from('od_order');
        return $this->db->get()->num_rows();
    }
    function Detail($id) {
        $this->db->select('*');
        $this->db->where("id",$id);
        $this->db->from('od_order');
        return $this->db->get()->row();
    }
    function ItemOrderDetail($id) {
        $this->db->select('*');
        $this->db->where("id_order",$id);
        $this->db->from('od_order_item');
        return $this->db->get()->result();
    }
    function sum_total($id=0){
        $this->db->select_sum('od_order_item.total');
        if($id!=0) {
            $this->db->where("id_order", $id);
        }
        $this->db->from('od_order_item');
        return $this->db->get()->row()->total;
    }
    function sum_ship($id=0){
        $this->db->select_sum('od_order.ship');
        if($id!=0) {
            $this->db->where("id_order", $id);
        }
        $this->db->from('od_order');
        return $this->db->get()->row()->ship;
    }
    function list_ajax($key,$store_id,$status,$from,$to) {
        $this->db->select('od_order.*');

        if($status!=0){
            $this->db->where("od_order.status", $status);
        }
        if($from !='' && $to!=''){
            $this->db->where("od_order.date_create >=", $from);
            $this->db->where("od_order.date_create <", $to);
        }
        if($key!=''){
            $this->db->or_where("code_booking", $key);
            $this->db->or_where("users.cell_phone",$key);
            $this->db->or_where("user_buy.cell_phone",$key);
            $this->db->or_where("user_buy.email",$key);
            $this->db->or_where("users.email",$key);
            $this->db->join("users","users.id=od_order.buyer_id AND od_order.type_account=1",'left outer');
            $this->db->join("user_buy","user_buy.id=od_order.buyer_id AND od_order.type_account=0",'left outer');
        }
        $this->db->from('od_order');
        return $this->db->get()->result();
    }

}
