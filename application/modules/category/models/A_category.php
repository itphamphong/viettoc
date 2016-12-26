<?php

class A_category extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function show_list_category_page($where=array(),$lang='vn',$page=0){
        $this->db->select("categorydetail.category_name,categorydetail.category_link,category.picture,category.id,category.category_top,category.category_hot,category.choose_upload,category.category_type");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        $this->db->where(array("categorydetail.active"=>1));
        $this->db->order_by('category.category_weight', "ASC");
        $this->db->group_by("category.id");
        if($page!=0){
        $this->db->limit($page);
        }
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('category_parent', 'category_parent.category_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function show_detail_category_where($where=array(), $lang = 'vn') {
        $this->db->select("categorydetail.category_name,category.id,categorydetail.category_link,category.category_top,category.category_type");
        $this->db->where($where);
        $this->db->where(array("country.name"=>$lang,"category.category_status"=>1));
        $this->db->order_by('category.category_weight', "ASC");
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function show_list_category_where($where = array(), $lang = 'vn') {
        $this->db->select("categorydetail.*,category.*");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        $this->db->order_by('category.id', "DESC");
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('category_parent', 'category_parent.parent_id != category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function show_list_category_parent($id,$lang='vn',$page=0){
        $this->db->select("categorydetail.*,category.*");
        $this->db->where("country.name", $lang);
        $this->db->where_in('category_parent.category_id',$id);
        $this->db->where(array("categorydetail.active"=>1));
        $this->db->order_by('category.category_weight', "ASC");
        $this->db->group_by("category.id");
        if($page!=0){
            $this->db->limit($page);
        }
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('category_parent', 'category_parent.parent_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->result();
    }


}