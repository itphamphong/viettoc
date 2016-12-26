<?php
class A_article extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    function get_list_article_where($params)
    {

        if (isset($params["select"])) {
            $this->db->select($params['select']);
        } else {
            $this->db->select('*');
        }
        if (isset($params['where'])) {
            $this->db->where($params['where']);
        }
        if (isset($params['like'])) {
            $this->db->like("hoteldetail.hotel_link", $this->global_function->unicode($params['like']));
        }
        $this->db->where(array("article.article_status"=>'1','country.name'=>$params['lang']));
        $this->db->from('article');
        if (isset($params["limit"]) && $params["limit"] > 0) {
            $this->db->limit($params["limit"], $params["offset"]);
        }
        if (isset($params["sort"])) {
            $this->db->order_by($params["order"], $params["sort"]);
        } else {
            $this->db->order_by("article.article_weight", DSORT);
        }
        $this->db->join('articledetail','articledetail.article_id=article.id');
        $this->db->join('articleterm','articleterm.article_id=article.id');
        $this->db->join('country','articledetail.country_id=country.id');
        if (isset($params["first"])) {
            return $this->db->get()->first_row();
        } else if (isset($params["num_rows"])) {
            return $this->db->get()->num_rows();
        } else {
            return $this->db->get()->result();
        }

    }

}
