<?php

class M_users extends CI_Model {

    function show_list_user_where($where = array(), $limit, $offset) {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->order_by('users.id', "DESC");
        $this->db->limit($limit, $offset);
        $this->db->from('users');
        return $this->db->get()->result();
    }
    function show_list_user_key($key,$city_id,$sex,$from,$to) {
        $this->db->select("*");
        if($key!=''){
        $this->db->or_like("full_name", $key);
        $this->db->or_like("email", $key);
        $this->db->or_like("cell_phone", $key);
        }
        if($city_id!=0){
            $this->db->where("city_id", $city_id);
        }
        if($sex!=0){
            $this->db->where("sex", $sex);
        }
        if($from!=0 && $to!=0 && $from > $to){
            $this->db->where("YEAR(birthday) >=", $to,NULL, FALSE);
            $this->db->where("YEAR(birthday) <", $from,NULL, FALSE);
        }
        $this->db->order_by('users.id', "DESC");
        $this->db->from('users');
        return $this->db->get()->result();
    }
    function show_list_message_report($limit, $offset) {
        $this->db->select("users.*,users.id as user_id,reports.*, reports.id as report_id");
        $this->db->where('type', "user");
        $this->db->limit($limit, $offset);
        $this->db->from('reports');
        $this->db->group_by("users.id");
        $this->db->join("users", "users.id=reports.id_report");
        return $this->db->get()->result();
    }
    function count_list_payment_report() {
        $this->db->select("users.*,users.id as user_id,user_send_money.*");
        $this->db->from('user_send_money');
        $this->db->group_by("users.id");
        $this->db->join("users", "users.id=user_send_money.user_id_from");
        return $this->db->get()->num_rows();
    }
    function show_list_payment_report($limit, $offset) {
        $this->db->select("users.*,users.id as user_id,user_send_money.*");
        $this->db->limit($limit, $offset);
        $this->db->from('user_send_money');
        $this->db->group_by("users.id");
        $this->db->join("users", "users.id=user_send_money.user_id_from");
        return $this->db->get()->result();
    }
    function show_list_user_to_payment($id) {
        $this->db->select("user_send_money_item.*,user_send_money.user_id_from,user_send_money.user_id_to,user_send_money_item.note,user_send_money.job_id,user_send_money.admin_status,user_send_money_item.id as send_money_id");
        $this->db->where("user_send_money_item.id_send", $id);
        $this->db->from('user_send_money_item');
        $this->db->join("user_send_money", "user_send_money.id=user_send_money_item.id_send");
        return $this->db->get()->result();
    }
     function count_show_list_user_to_payment_news($id) {
        $this->db->select("user_send_money_item.*,user_send_money.user_id_from,user_send_money.user_id_to,user_send_money.note,user_send_money.job_id,user_send_money.admin_status,user_send_money_item.id as send_money_id");
        $this->db->where("user_send_money.user_id_from", $id);
        $this->db->where("user_send_money_item.status", 0);
        $this->db->from('user_send_money_item');
        $this->db->join("user_send_money", "user_send_money.id=user_send_money_item.id_send");
        return $this->db->get()->num_rows();
    }
    function show_list_message_send($limit, $offset) {
        $this->db->select("*");
        $this->db->limit($limit, $offset);
        $this->db->from('user_messages');
        return $this->db->get()->result();
    }
    function show_list_blacklist($limit, $offset) {
        $this->db->select("*");
        $this->db->limit($limit, $offset);
        $this->db->from('blacklist');
        return $this->db->get()->result();
    }
    function user_message_job($limit, $offset) {
        $this->db->select("*");
        $this->db->limit($limit, $offset);
        $this->db->from('user_message_job');
        return $this->db->get()->result();
    }

    function show_list_message_send_admin($limit, $offset) {
        $this->db->select("*");
        $this->db->limit($limit, $offset);
        $this->db->from('user_to_admin_messages');
        return $this->db->get()->result();
    }

    function show_list_message_get_money($limit, $offset) {
        $this->db->select("*");
        $this->db->limit($limit, $offset);
        $this->db->from('user_admin_message');
        $this->db->order_by("id","DESC");
        return $this->db->get()->result();
    }
    function user_send_money($id) {
        $this->db->select("user_send_money.job_id,jobs.title,user_send_money.id as id_send,user_send_money.money");
        $this->db->where("user_send_money.user_id_from", $id);
        $this->db->from('user_send_money');
        $this->db->join("jobs", "jobs.id=user_send_money.job_id");
        return $this->db->get()->result();
    }
    function select_sum_money($id) {
        return $this->db->select_sum('money')
                        ->where("id_send", $id)
                        ->from("user_send_money_item")
                        ->get()
                        ->row()->money;
    }
    function select_sum_surplus_wns($id) {
        return $this->db->select_sum('surplus_wns')
                        ->where("id_send", $id)
                        ->from("user_send_money_item")
                        ->get()
                        ->row()->surplus_wns;
    }
    function show_list_buy_item($limit, $offset, $page = 1) {
        $this->db->select("*");
        if ($page == 1) {
            $this->db->limit($limit, $offset);
            $this->db->group_by("type");
            $this->db->from('manager_item_buy');
            return $this->db->get()->result();
        } else {
            $this->db->from('manager_item_buy');
            return $this->db->get()->num_rows();
        }
    }

    function select_sum_item_buy_money($type) {
        return $this->db->select_sum('total_money')
                        ->where("type", $type)
                        ->from("manager_item_buy")
                        ->get()
                        ->row()->total_money;
    }

    function select_sum_item_buy_quantity($type) {
        return $this->db->select_sum('quantity')
                        ->where("type", $type)
                        ->from("manager_item_buy")
                        ->get()
                        ->row()->quantity;
    }

    function show_list_surplus($limit, $offset, $page = 1) {
        $this->db->select("*");
        $this->db->where("status !=", 0);
        if ($page == 1) {
            $this->db->limit($limit, $offset);
            $this->db->from('user_send_money');
            return $this->db->get()->result();
        } else {
            $this->db->from('user_send_money');
            return $this->db->get()->num_rows();
        }
    }

    function show_list_surplus_item($limit, $offset, $page = 1) {
        $this->db->select("*");
        $this->db->where("status", 1);
        $this->db->where("surplus_wns >", 0);
        $this->db->from('user_send_money_item');
        if ($page == 1) {
            $this->db->limit($limit, $offset);
            return $this->db->get()->result();
        } else {
            return $this->db->get()->num_rows();
        }
    }

    function get_data_buy_user( $limit, $offset, $where = array()) {
        $this->db->select("users.*, manager_item_buy.total_money, manager_item_buy.quantity, manager_item_buy.buy_date");
        $this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->group_by('manager_item_buy.user_id');
        $this->db->from('manager_item_buy');
        $this->db->join("users", "users.id=manager_item_buy.user_id");
        return $this->db->get()->result();
    }
	function get_data_buy_user_count($where = array()) {
        $this->db->select("users.*, manager_item_buy.total_money, manager_item_buy.quantity, manager_item_buy.buy_date");
        $this->db->where($where);
		$this->db->group_by('manager_item_buy.user_id');
        $this->db->from('manager_item_buy');
        $this->db->join("users", "users.id=manager_item_buy.user_id");
        return $this->db->get()->num_rows();
    }
    function show_list_surplus_item_search($date, $limit, $offset, $page = 1) {
        $data = array();
        $this->db->select("*");
        $this->db->where("status", 1);
        $this->db->where("surplus_wns >", 0);
        $this->db->from('user_send_money_item');
        $re = $this->db->get();
        if ($re->num_rows() > 0) {
            foreach ($re->result_array() as $row) {
                $d = date("m/d/Y", $row['created_date']);
                if ($date == $d)
                    $data[] = $row;
            }
        }
        $re->free_result();
        if ($page == 1)
            return $data;
        else
            return count($data);
    }
    function show_list_surplus_item_search_one($date, $limit, $offset, $page = 1) {
        $data = array();
        $this->db->select("*");
        $this->db->where("status !=", 0);
        $this->db->from('user_send_money');
        $re = $this->db->get();
        if ($re->num_rows() > 0) {
            foreach ($re->result_array() as $row) {
                $d = date("m/d/Y", $row['created_date']);
                if ($date == $d)
                    $data[] = $row;
            }
        }
        $re->free_result();
        if ($page == 1)
            return $data;
        else
            return count($data);
    }
	function show_list_item() {
        $this->db->select("item.id,item.date_create,item.item_status,itemdetail.item_name,item.item_hot,item.item_weight");
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->where('itemdetail.country_id', 1);
        $this->db->group_by('item.id');
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        return $this->db->get()->result();  $this->db->get()->free_result();
    }
	//for per item user
	function check_item($user_id, $item_id) {
        $this->db->select("*");
        $this->db->where('user_id', $user_id);
		$this->db->where('item_id', $item_id);
        return $this->db->get('user_per_item')->num_rows();
    }
    function show_list_book_tutor($limit, $offset) {
        $this->db->select("*");
        $this->db->order_by('id', "DESC");
        $this->db->limit($limit, $offset);
        $this->db->from('booking_tutor');
        return $this->db->get()->result();
    }
    function count_list_book_tutor() {
        $this->db->select("*");
        $this->db->order_by('id', "DESC");
        $this->db->from('booking_tutor');
        return $this->db->get()->num_rows();
    }
	//end
}
