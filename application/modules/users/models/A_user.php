<?php

class A_user extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function list_users_where($where = array()) {
        $this->db->select("users.user_name,users.id");
        $this->db->where($where);
        $this->db->from("users");
        $this->db->limit(10);
        return $this->db->get()->result();
    }
    function get_avatar($id) {

        $this->db->select('avatar');
        $this->db->where('status', 1);
        $this->db->where('id', $id);
        $this->db->from("users");
        return $this->db->get()->row();
    }
    function serch_localtion($params = array()) {
        $this->db->select('jobs.*');
        $this->db->where($params['where']);
        $pieces = explode("_", $params['id_localtion']);
        if ($pieces[0] == 'sub') {
            $this->db->where('jobs.agent_id', $pieces[1]);
        } else {
            $this->db->where('jobs.states_id', $params['id_localtion']);
        }
        $this->db->order_by('jobs.highlight', 'DESC');
        $this->db->order_by('jobs.bold', 'DESC');
        $this->db->order_by('created_date', 'DESC');
        $this->db->order_by('jobs.id', 'DESC');
        $this->db->group_by('jobs.id');
        $this->db->limit(10);
        $this->db->from('jobs');
        if ($pieces[0] == 'sub') {
            $this->db->join('location', 'location.id=jobs.agent_id');
        } else {
            $this->db->join('location', 'location.id=jobs.states_id');
        }
        $this->db->join('job_type_post', 'job_type_post.job_id=jobs.id');
        return $this->db->get()->result();
        $this->db->get()->free_result();
    }
    function serch_localtion_user($params = array()) {
        //print_r($params['id_localtion']);exit;
        $this->db->select('users.*');
        $this->db->where($params['where']);
        $pieces = explode("_", $params['id_localtion']);
        if ($pieces[0] == 'sub') {
            $this->db->where('users.agent_id', $pieces[1]);
        } else {
            $this->db->where('users.states_id', $params['id_localtion']);
        }
        $this->db->order_by('created_date', 'DESC');
        $this->db->order_by('users.id', 'DESC');
        $this->db->group_by('users.user_name');
        $this->db->group_by('users.id');
        $this->db->limit(10);
        $this->db->from('users');
        if ($pieces[0] == 'sub') {
            $this->db->join('location', 'location.id=users.agent_id');
        } else {
            $this->db->join('location', 'location.id=users.states_id');
        }
        return $this->db->get()->result();
        $this->db->get()->free_result();
    }
    function get_user($id) {
        $this->db->select('users.id,users.views');
        $this->db->where('users.status', 1);
        $this->db->where('users.id', $id);
        $this->db->from('users');
        return $this->db->get()->row();
    }
    function get_user_where($id) {
        $this->db->select('*');
        $this->db->where('users.status', 1);
        $this->db->where('users.id', $id);
        $this->db->from('users');
        return $this->db->get()->row();
    }
    function get_user_name($id,$select='users.user_name') {
        $this->db->select($select);
        $this->db->where('users.status', 1);
        $this->db->where('users.id', $id);
        $this->db->from('users');
        return $this->db->get()->row();
    }
    function get_recipient_where($id) {
        $this->db->select('users.*');
        $this->db->where('users.status', 1);
        $this->db->where('users.buyer_id', $id);
        $this->db->from('users');
        return $this->db->get()->row();
    }
	/////////////////////////////////////////////////////
	function check_login_gmail($fid)
	{
		$this->db->select('users.user_name');
		$this->db->where("users.fid", $fid);
		$this->db->where("users.flag_login", 2);
		return $this->db->get('users')->num_rows();
	}
    function show_a_course($where,$lang='vn'){
        $this->db->select("course.*,coursedetail.*");
        $this->db->where("country.name",$lang);
        $this->db->where($where);
        $this->db->order_by("course.id","ASC");
        $this->db->from('course');
        $this->db->join('coursedetail','coursedetail.course_id=course.id');
        $this->db->join('country','coursedetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function get_a_course($where,$lang='vn'){
        $this->db->select("course.*,coursedetail.*");
        $this->db->where("country.name",$lang);
        $this->db->where($where);
        $this->db->order_by("course.id","ASC");
        $this->db->from('course');
        $this->db->join('coursedetail','coursedetail.course_id=course.id');
        $this->db->join('country','coursedetail.country_id=country.id');
        return $this->db->get()->row();
    }

}
