<?php

class A_item extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //=================== list item page=================

    function show_list_item_status_where($params,$lang,$page=0) {
        $this->db->select("item.*,itemdetail.*,itemdetail.item_link,itemdetail.item_summary,value,price,category_id,supplier_id,supplier_id");
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        if($page>0){
            $this->db->limit($page);
        }
        if(isset($params['status'])){
        $this->db->where("tmp_item_status.status_id",$params['status']);
        }
        if(isset($params['where'])){
            $this->db->where($params['where']);
        }
        $this->db->from('item');
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        $this->db->join('tmp_item_status', 'tmp_item_status.item_id=item.id','left');
        return $this->db->get()->result();
    }
    function show_list_item_type($type,$lang,$page=0) {
        $this->db->select("item.id,itemdetail.item_name,itemdetail.item_link,itemdetail.item_summary,supplier_id,supplier_id");
        $this->db->where(array("country.name"=>$lang,"item_status"=>1,"tmp_item_status.status_id"=>$type));
        if($page>0){
            $this->db->limit($page);
        }
        $this->db->from('item');
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        $this->db->join('tmp_item_status', 'tmp_item_status.item_id=item.id');
        return $this->db->get()->result();
    }
    function show_list_item_where($where,$lang='vn',$page=0) {
        $this->db->select("item.id,itemdetail.item_name,itemdetail.item_link,itemdetail.item_summary,item.category_id,price,value,supplier_id,supplier_id");
        $this->db->where($where);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        if($page>0){
            $this->db->limit($page);
        }
        $this->db->from('item');
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    // lay hinh dai dien
    function show_thumb($id)
    {
        $this->db->select('images.name');
        $this->db->where(array("images.tmp_id"=>$id,"value"=>"item","primary"=>1));
        $this->db->from('images');
        return $this->db->get()->row();
    }
    function list_thumb($id)
    {
        $this->db->select('images.name');
        $this->db->where(array("images.tmp_id"=>$id,"value"=>"item"));
        $this->db->from('images');
        return $this->db->get()->result();
    }
    function list_thumb_first($id)
    {
        $this->db->select('images.name');
        $this->db->where(array("images.tmp_id"=>$id,"value"=>"item","primary"=>1));
        $this->db->from('images');
        return $this->db->get()->first_row();
    }
    //
    function show_list_item_page_category_limit($where=array(),$lang,$page=0) {
        $this->db->select("item.*,itemdetail.*");
        $this->db->where($where);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        if($page>0){
        $this->db->limit($page);
        }
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        $this->db->join('item_category', 'item_category.item_id=item.id');
        return $this->db->get()->result();
    }
    //=================== list item page=================
    function show_list_item_no_sale_page_category_limit($where=array(),$lang,$page=0) {
        $this->db->select("item.id,itemdetail.item_name,item.value,item.category_id,item.price,itemdetail.item_link,itemdetail.item_summary,supplier_id,supplier_id,material,guarantee,location,number");
        $this->db->where($where);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        if($page>0){
            $this->db->limit($page);
        }
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    // search
    function show_list_item_params($params) {
        if(isset($params['category_id'])) {
            $c = $this->a_category->show_detail_category_where(array("category.id" => $params['category_id']));
            $array = array();
            if ($c->category_top == 0) {
                $list = $this->a_category->show_list_category_page(array("category.category_top" => $params['category_id']));
                if (count($list) > 0) {
                    foreach ($list as $l) {
                        $array[] = $l->id;
                    }
                } else {
                    $array[] = $params['category_id'];
                }
            } else {
                $array[] = $params['category_id'];
            }
            $this->db->where_in("item_category.category_id", $array);
            $this->db->join('item_category', 'item_category.item_id=item.id');
        }
        $this->db->select("item.*,itemdetail.*");

        $this->db->where(array("country.name"=>$params['lang'],"item_status"=>1));
        if (isset($params['sort'])) {
            if ($params['sort'] == 'az') {
                $this->db->order_by('itemdetail.item_name', "ASC");
            } else if ($params['sort'] == 'price-up') {
                $this->db->order_by('item.price', "ASC");
            } else if ($params['sort'] == 'price-down') {
                $this->db->order_by('item.price', "DESC");
            }

        }

        $this->db->group_by('item.id');
        if(isset($params['page']) && $params['page']>0){
            $this->db->limit($params['page']);
        }
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    // product page
    function show_list_item_no_sale_page_category_limit_where_in($id,$lang,$page=0) {

        $this->db->select("item.*,itemdetail.*");
        //$this->db->where_in("item.category_id",$array);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        if($page>0){
            $this->db->limit($page);
        }
        $this->db->from('item');
        $this->db->where_in("item_category.category_id", $id);
        $this->db->join('item_category', 'item_category.item_id=item.id');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function show_list_promotion($lang,$limit, $offset) {

        $this->db->select("item.*,itemdetail.*");
        $this->db->where("item.promotion",1);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->limit($limit, $offset);
        $this->db->from('item');
        $this->db->join('item_category', 'item_category.item_id=item.id');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function show_list_item_category_parent($id,$lang,$limit, $offset) {
        $c=$this->a_category->show_detail_category_where(array("category.id"=>$id));
        $array=array($id);
        if(isset( $c->category_top) && $c->category_top==0){
            $list=$this->a_category->show_list_category_page(array("category.category_top"=>$id));
            if(count($list)>0) {
                foreach ($list as $l){
                    $array[]=$l->id;
                }
            }else {
                $array[]=$id;
            }
        }else{
            $array[]=$id;
        }
        $this->db->select("item.id,itemdetail.item_name,item.value,item.category_id,item.price,itemdetail.item_link,itemdetail.item_summary,item.unit,supplier_id,supplier_id");
        //$this->db->where_in("item.category_id",$array);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->limit($limit, $offset);
        $this->db->from('item');
        $this->db->where_in("item_category.category_id", $array);
        $this->db->join('item_category', 'item_category.item_id=item.id');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    //=================== list item page=================
    // show detail
    function show_detail_item_where($where=array(),$lang = 'vn') {
        $this->db->select("item.*,itemdetail.*");
        $this->db->where($where);
        $this->db->where(array("country.name"=>$lang,"item.item_status"=>1));
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    // show detail item cart
    function show_detail_item_cart($id,$lang = 'vn') {
        $this->db->select("item.*,itemdetail.item_name");
        $this->db->where("item.id",$id);
        $this->db->where(array("country.name"=>$lang,"item.item_status"=>1));
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->row();
    }
    function show_detail_item_cate($where,$lang = 'vn') {
        $this->db->select("category.*,categorydetail.*");
        $this->db->where($where);
        $this->db->where(array("country.name"=>$lang));
        $this->db->group_by('category.id');
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('item_category', 'item_category.category_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->row();
    }
    // show list item category
    function show_list_item_category_page($id,$lang,$limit, $offset) {
        $this->db->select("item.id,itemdetail.item_name,item.value,item.category_id,item.price,itemdetail.item_link,itemdetail.item_summary,item.unit,supplier_id,supplier_id");
        $this->db->where(array("item.category_id"=>$id));
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
       
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->limit($limit, $offset);
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    // count
    function count_list_item_category_page($id,$lang) {
        $this->db->where(array("item.category_id"=>$id));
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
       
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->num_rows();
    }
    //count
    function count_list_result_search($id,$key,$lang) {
        $this->db->select("item.id,itemdetail.item_name,item.value,item.category_id,item.price,itemdetail.item_link");
        $this->db->like("itemdetail.item_link",$key);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1,"category_id"=>$id));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->num_rows();
    }
    // result search key
    function show_list_result_search_key($key,$lang) {
        $this->db->select("item.*,itemdetail.*");
        if(!empty($key)) {
            $this->db->like("itemdetail.item_link", $key);
        }
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        return $this->db->get()->result();
    }
    function show_list_result_search_tag($key,$lang) {
        $this->db->select("item.*,itemdetail.*");
        $this->db->where("tag_tmp.value","item");
        $this->db->where("tagsdetail.tags_link",$key);
        $this->db->where(array("country.name"=>$lang,"item_status"=>1));
        $this->db->order_by('item.item_weight', "DESC");
        $this->db->group_by('item.id');
        $this->db->from('item');
        $this->db->join('itemdetail', 'itemdetail.item_id=item.id');
        $this->db->join('country', 'itemdetail.country_id=country.id');
        $this->db->join('tag_tmp', 'tag_tmp.item_id=item.id');
        $this->db->join('tagsdetail', 'tagsdetail.tags_id=tag_tmp.tag_id');
        return $this->db->get()->result();
    }
    function show_list_category_where($where = array(), $lang = 'vn',$page=0) {
        $this->db->select("categorydetail.category_name,categorydetail.category_link,category.id,category.*");
        $this->db->where("country.name", $lang);
        $this->db->where($where);
        $this->db->order_by('category.category_weight', "ASC");
        if($page>0) $this->db->limit($page);
        $this->db->from('category');
        $this->db->join('categorydetail', 'categorydetail.category_id=category.id');
        $this->db->join('country', 'categorydetail.country_id=country.id');
        return $this->db->get()->result();
    }
}
