<?php

class M_item extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //================ check itemdetail is db====================
    function check_item_detail($id_cate, $lang) {
        $this->db->where('item_id', $id_cate);
        $this->db->where('country_id', $lang);
        $this->db->from('itemdetail');
        return $this->db->get()->row();
    }

    //=============img item====================
    function show_thumb($id = 0) {
        $this->db->select('*');
        $this->db->where(array("images.tmp_id"=> $id,"value"=>"item","primary"=>1));
        $this->db->from('images');
        return $this->db->get()->row();
    }

    //=================== list item page  most view=================
    function show_list_item_page_most_view($limit, $offset) {
        $this->db->select("item.*,itemdetail.*");
        $this->db->order_by('item.item_view', "DESC");
        $this->db->where('itemdetail.country_id',1);
        $this->db->group_by('item.id');
        $this->db->limit($limit, $offset);
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        return $this->db->get()->result();
    }
    //=================== list item page=================
    function show_list_item_page($limit, $offset) {
        $this->db->select("item.*,itemdetail.*");
        $this->db->order_by('item.id', "DESC");
        $this->db->where('itemdetail.country_id',1);
        $this->db->group_by('item.id');
        $this->db->limit($limit, $offset);
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        return $this->db->get()->result();
    }
    function show_list_item_page_link($slug = '') {
        $this->db->select("item.id,item.date_create,item.item_status,itemdetail.item_name,item.item_hot,item.item_weight");
        $this->db->like("itemdetail.item_link", $slug);
        $this->db->order_by('item.id', "DESC");
        $this->db->where('itemdetail.country_id', 1);
        $this->db->group_by('item.id');
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        return $this->db->get()->result();
    }
    //================== show list item in category_top =0,1==================
    function show_list_item_category_page($id, $top = 1) {
        $array = array(0);
        if ($top == 0) {
            $list = $this->show_list_category_child($id);
            foreach ($list as $l) {
                $array[] = $l->id;
            }
        }
        $this->db->select("item.id,item.date_create,item.item_status,itemdetail.item_name,item.item_hot,item.item_weight");
        $this->db->where('itemdetail.country_id', 1);
        if ($top == 0)
            $this->db->where_in("item.category_id", $array);
        else
            $this->db->where_in("item.category_id", $id);
        $this->db->from('item');
        $this->db->order_by('item.item_weight', 'DESC');
        $this->db->group_by('item.id');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        return $this->db->get()->result();
    }

    // show list category child
    function show_list_category_child($category_top, $lang = 'vn') {
        $this->db->select("category.id");
        $this->db->where("category.category_top", $category_top);
        $this->db->from('category');
        return $this->db->get()->result();
    }

    //=================== show item detail lang=================
    function show_detail_item_id_lang($item_id, $lang = 'vn') {
        $this->db->select("item.*,itemdetail.*");
        $this->db->where("item.id", $item_id);
        $this->db->where("country.name", $lang);
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function show_detail_meta_seo_id_lang($item_id, $lang = 'vn',$type="item") {
        $this->db->select("meta_seo.*");
        $this->db->where(array("meta_seo.tmp_id"=>$item_id,"value"=>$type));
        $this->db->where("country.name", $lang);
        $this->db->from('meta_seo');
        $this->db->join('country', 'meta_seo.country_id=country.id');
        return $this->db->get()->row();
    }
    //================= detail item id===================
    function show_detail_item_id($item_id) {
        $this->db->select("item.*");
        $this->db->where("item.id", $item_id);
        $this->db->from('item');
        return $this->db->get()->row();
    }

    /**
      TABLE ABOUT CATEGORY
     */
    //===============check is category language=====================
    function check_cate_detail($id_cate, $lang) {
        $this->db->where('category_id', $id_cate);
        $this->db->where('country_id', $lang);
        $this->db->from('categorydetail');
        return $this->db->get()->row();
    }

    //================= show list category===================
    function show_list_category_where($where = array(), $lang = 'vn') {
        $this->db->select("categorydetail.category_name,category.id,category.date_create,category.date_modify,category.category_status,category.category_top,category.category_weight,category.category_type,categorydetail.category_link,category.category_hot");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        $this->db->order_by('category.id', "DESC");
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('category_parent', 'category_parent.parent_id != category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->result();
    }

    //================ detail category ====================
    function show_detail_category_id($id, $lang = 'vn') {
        $this->db->select("categorydetail.*,category.*");
        $this->db->where("country.name", $lang);
        $this->db->where("category.id", $id);
        $this->db->order_by('category.category_weight', "ASC");
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function show_detail_category_where($link, $lang = 'vn',$type) {
        $this->db->select("categorydetail.*,category.*");
        $this->db->where("country.name", $lang);
        $this->db->where("categorydetail.category_link", $link);
        $this->db->where("category.category_type", $type);
        $this->db->order_by('category.category_weight', "ASC");
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function show_detail_category_parent($id, $lang = 'vn') {
        $this->db->select("categorydetail.*,category.*");
        $this->db->where("country.name", $lang);
        $this->db->where("category.id", $id);
        $this->db->order_by('category.category_weight', "ASC");
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        $data= $this->db->get()->row();
        if($data->category_top==0){
           $name=$data->category_name;
        }else{
            $d=$this->show_detail_category_id($data->category_top);
            $name=$d->category_name."<br> |--".wordwrap($data->category_name, 20, "<br />\n");
        }
        return $name;
    }
    //=============== check code item=====================
    function check_code($slug, $id = 0) {
        $this->db->where('code', $slug);
        $this->db->where('id !=', $id);
        $this->db->from('item');
        return $this->db->get()->row();
    }
    // export
    function show_list_item_all() {
        $this->db->select("item.id, item.item_code, item.unit, item.value,item.price,item.start_date,item.end_date");
        $this->db->from('item');
        $this->db->order_by('item.item_weight', 'DESC');
        return $this->db->get()->result();
    }
    function show_detail_item_export_id($item_id, $lang) {
        $this->db->select("itemdetail.item_name,itemdetail.country_name,itemdetail.qcdg,itemdetail.gif");
        $this->db->where("itemdetail.item_id", $item_id);
        $this->db->where("itemdetail.country_id", $lang);
        $this->db->from('itemdetail');
        return $this->db->get()->row();
    }
    function show_list_item_category_export($id, $top = 1) {
        $array = array(0);
        if ($top == 0) {
            $list = $this->show_list_category_child($id);
            foreach ($list as $l) {
                $array[] = $l->id;
            }
        }
        $this->db->select("item.id, item.item_code, item.unit, item.value,item.price,item.start_date,item.end_date");
        if ($top == 0)
            $this->db->where_in("item.category_id", $array);
        else
            $this->db->where_in("item.category_id", $id);
        $this->db->from('item');
        $this->db->order_by('item.item_weight', 'DESC');
        return $this->db->get()->result();
    }
    function show_list_item_search($category_id, $status,$key) {
        if($category_id !=0){
            $cate=$this->show_detail_category_id($category_id);

            if($cate->category_top ==0){
                $array=array(0);
                $list = $this->show_list_category_child($cate->category_top);
                foreach ($list as $l) {
                    $array[] = $l->id;
                }
                $this->db->where_in("item_category.category_id", $array);
            }else {
                $this->db->where("item_category.category_id", $category_id);
            }
            $this->db->join('item_category', 'item_category.item_id=item.id');
        }
        if($status!='null'){
            $this->db->where("item.item_status", $status);
        }
        if(!empty($key)){
            $this->db->like("itemdetail.item_link", $this->global_function->unicode($key));
        }
        $this->db->select("item.*,itemdetail.*");
        $this->db->order_by('item.id', "DESC");
        $this->db->where('itemdetail.country_id',1);
        $this->db->group_by('item.id');
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        return $this->db->get()->result();
    }
    //
    function show_list_category_where_tmp($where = array(), $lang = 'vn') {
        $this->db->select("*");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        $this->db->order_by('category.id', "DESC");
        $this->db->group_by('category.id');
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('category_tmp', 'category_tmp.tmp_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function show_list_category_where_tmp_in($where = array(),$id, $lang = 'vn') {
        $this->db->select("category.id,category_name");
        $this->db->where("country.name", $lang);
        $this->db->where_in('category_tmp.category_id',$id);
        $this->db->where($where);
        $this->db->order_by('category.id', "DESC");
        $this->db->group_by('category.id');
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('category_tmp', 'category_tmp.tmp_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->result();
    }
    // item status
    function show_list_item_status() {
        $this->db->select("item_status.*,item_statusdetail.*");
        $this->db->order_by('item_status.weight', "ASC");
        $this->db->where('item_statusdetail.country_id',1);
        $this->db->group_by('item_status.id');
        $this->db->from('item_status');
        $this->db->join('item_statusdetail', 'item_statusdetail.item_status_id=item_status.id');
        return $this->db->get()->result();
    }

}
