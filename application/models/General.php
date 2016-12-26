<?php

class General extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_max($table, $var) {
        $this->db->select_max($var);
        $this->db->from($table);
        return $this->db->get()->row()->$var;
    }

    // paging function
    function paging($page, $total, $url, $id = 1) {
        $previous_btn = true;
        $next_btn = true;
        $first_btn = true;
        $last_btn = true;
        //kiem tra
        $count = $total;
        $tongtrang = ceil($total / $page);
        $num = "";
        if ($count != 0) {
            if ($id >= 7) {
                $start_loop = $id - 4;
                if ($tongtrang > $id + 4)
                    $end_loop = $id + 4;
                else if ($id <= $tongtrang && $id > $tongtrang - 6) {
                    $start_loop = $tongtrang - 6;
                    $end_loop = $tongtrang;
                } else {
                    $end_loop = $tongtrang;
                }
            } else {
                $start_loop = 1;
                if ($tongtrang > 7)
                    $end_loop = 7;
                else
                    $end_loop = $tongtrang;
            }
        }


        // FOR ENABLING THE FIRST BUTTON
        if ($first_btn && $id > 1) {
            $dau = "<li  class=''><a href='" . site_url($url) . "'>Đầu</a></li>";
        } else if ($first_btn) {
            $dau = "<li  class='text'>Đầu</li>";
        }

        // FOR ENABLING THE PREVIOUS BUTTON
        if ($previous_btn && $id > 1) {
            $tam = $id - 1;
            $lui = "<li class=''><a href='" . site_url($url . $tam) . "'>Lùi</a></li>";
        } else if ($previous_btn) {
            $lui = "<li class='text'>Lùi</li>";
        }


        if ($next_btn && $id < $tongtrang) {
            $tam2 = $id + 1;
            $toi = "<li class=''><a href='" . site_url($url . $tam2) . "'> Tới </a></li>";
        } else if ($next_btn) {
            $toi = "<li class='text'>Tới</li>";
        }

        // TO ENABLE THE END BUTTON
        if ($last_btn && $id < $tongtrang) {
            $cuoi = "<li  class=''><a href='" . site_url($url . $tongtrang) . "'> Cuối </a></li>";
        } else if ($last_btn) {
            $cuoi = "<li class='text'>Cuối</li>";
        }
        if ($count > 0) {
            for ($i = $start_loop; $i <= $end_loop; $i++) {
                if ($i == $id)
                    $num.="<li class='page'><a href='#' title='' onclick='return false'>$i</a></li>";
                else
                    $num.="<li><a href='" . site_url($url . $i) . "' title=''>$i</a></li>";
            }
        }
        if ($count > 0 && $tongtrang > 1)
            $link = "
		<ul class='pagination'>
            
			" .  $lui . $num . $toi . "
			
		</ul>
			";
        else
            $link = '';

        return $link;
    }

    //====================================
    //====================================
    function show_list_lang() {
        $this->db->where("status", 1);
        return $this->db->get('country')->result();
    }

//====================================
    function show_company($lang = "vn") {
        $this->db->select('companydetail.*,company.*');
        $this->db->where("country.name", $lang);
        $this->db->from('company');
        $this->db->join('companydetail', 'companydetail.id_company=company.id');
        $this->db->join('country', 'companydetail.id_country=country.id');
        return $this->db->get()->row();
    }

    //================= Table ====================
    function show_list_table($where = array(), $limit, $offset, $table, $page = 0) {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->order_by('weight', "DESC");
        if ($page != 0)
            $this->db->limit($limit, $offset);
        $this->db->from($table);
        return $this->db->get()->result();
    }

    function show_list_table_where($where = array(), $table) {
        $this->db->select();
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->result();
    }

    //=====================================
    function get_tableID($id, $table) {
        $this->db->select("*");
        $this->db->where($table . '.id', $id);
        $this->db->from($table);
        return $this->db->get()->row();
    }

    function get_tableWhere($where = array(), $table) {
        $this->db->select("*");
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->row();
    }

    function get_list_table($table) {
        $this->db->select("*");
        $this->db->from($table);
        return $this->db->get()->result();
    }

    // funtion update
    function update_tableID($id, $sql = array(), $table) {
        $this->db->where('id', $id);
        $this->db->update($table, $sql);
    }

    // count table where
    function count_tableWhere($where = array(), $table) {
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->num_rows();
    }

    function count_table_where($where = array(), $table) {
        $this->db->where($where);
        $this->db->from($table);
        return $this->db->get()->num_rows();
    }

    //====================================
    function admin_detail($id) {
        $this->db->select("*");
        $this->db->where("user_id", $id);
        $this->db->from('tbl_user');
        return $this->db->get()->row();
    }
    function Checkpermission($name) {
        if (!isset($_SESSION['active_log'])) {
            redirect(site_url('admin/login'));
        }
        $check = $this->global_function->get_tableWhere(array("user_id" => $this->m_session->userdata('admin_login')->user_id),"tbl_user");
        $array = array();
        $array = explode(",", base64_decode($check->permission));
        foreach ($array as $r) {
            if ($r == $name || $this->m_session->userdata('admin_login')->type == 2)
                return true;
        }
        return false;
    }
    // check permission users
    function Checkpermission_check($id, $name) {
        if (!isset($_SESSION['active_log'])) {
            redirect(site_url('admin/login'));
        }
        $check = $this->get_tableWhere(array("user_id" => $id), "tbl_user");
        $array = array();
        $array = explode(",", base64_decode($check->permission));
        foreach ($array as $r) {
            if ($r == $name)
                return 1;
        }
        return 0;
    }

    //====================================
    function show_list_contact_no($id) {
        $this->db->where("id <>", $id);
        $this->db->limit(10);
        $this->db->order_by('date_reseive', "DESC");
        return $this->db->get("contact")->result();
    }

    //====================================
    function show_list_contact_page($limit, $offset) {
        $this->db->select("*");
        $this->db->order_by('date_reseive', "DESC");
        $this->db->limit($limit, $offset);
        $this->db->from('contact');
        return $this->db->get()->result();
    }
    function show_list_booking_flight_page($limit, $offset) {
        $this->db->select("*");
        $this->db->order_by('date_reseive', "DESC");
        $this->db->limit($limit, $offset);
        $this->db->from('booking_flight');
        return $this->db->get()->result();
    }
    function show_list_email_page($limit, $offset) {
        $this->db->select("*");
        $this->db->limit($limit, $offset);
        $this->db->from('email_letter');
        return $this->db->get()->result();
    }
    function get_admin($check,$t,$p)
    {
        $this->db->where('user_loginname',$t);
        $this->db->where('user_password',md5($p));
        if($check==1)
            return $this->db->get('tbl_user')->first_row();
        else
            return $this->db->get('tbl_user')->num_rows();

    }
    function login($user , $pass)
    {
        $this->db->where('user_loginname', trim($user) )->where('user_password', md5($pass) );
        $this->db->where('user_status', 1, true);
        $this->db->where('store_id',0);
        return $this->db->get('tbl_user');
    }


}
