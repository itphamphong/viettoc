<?php
class M_article extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	
	//==================list artilce=============
	function show_list_article_page_m($type,$limit,$offset,$lang='vn'){
		$this->db->select("articledetail.*,article.*");
		$this->db->where("country.name",$lang);
		$this->db->where("article.article_type",$type);
        $this->db->order_by("article.article_weight","ASC");
		$this->db->limit($limit,$offset);
		$this->db->from('article');
		$this->db->join('articledetail','articledetail.article_id=article.id');
		$this->db->join('country','articledetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//================== list artilce category==================
	function show_list_term_where($where=array(),$lang='vn'){
		$this->db->select("termdetail.term_name,term.id,term.date_create,term.date_modify,term.status,term.type");
		$this->db->where("country.name",$lang);
        $this->db->where($where);
		$this->db->order_by("article.article_weight","ASC");
        $this->db->group_by('term.id');
		$this->db->from('term');
		$this->db->join('termdetail','termdetail.term_id=term.id');
		$this->db->join('country','termdetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//=============== Detail artilce category=====================
	function show_detail_term_id($id,$lang='vn'){
		$this->db->select("termdetail.term_name,term.id,term.date_create,term.author,term.weight,term.edit,term.per,term.date_modify,term.status,term.parent_id");
		$this->db->where("country.name",$lang);
		$this->db->where("term.id",$id);
		$this->db->order_by("article.article_weight","ASC");
		$this->db->from('term');
		$this->db->join('termdetail','termdetail.term_id=term.id');
		$this->db->join('country','termdetail.country_id=country.id');
		return $this->db->get()->row();
	}
	//================= detail Article===================
	function show_detail_article_id($id,$lang='vn'){
		$this->db->select("articledetail.*,article.*");
		$this->db->where("country.name",$lang);
		$this->db->where("article.id",$id);
		$this->db->from('article');
		$this->db->join('articledetail','articledetail.article_id=article.id');
		$this->db->join('country','articledetail.country_id=country.id');
		return $this->db->get()->row();
	}
        // serach header
	function show_list_article_limit_search($key,$limit,$lang='vn'){
		$this->db->select("articledetail.article_name,articledetail.article_summary,article.id,article.date_create,article.date_modify,article.article_status,images.thumb");
		$this->db->where("country.name",$lang);
		$this->db->like("articledetail.article_name",$key);
		$this->db->order_by("article.article_weight","ASC");
		$this->db->limit($limit);
		$this->db->from('article');
		$this->db->join('articledetail','articledetail.article_id=article.id');
		$this->db->join('articleimages','articleimages.article_id=article.id');
		$this->db->join('images','articleimages.image_id=images.id');
		$this->db->join('country','articledetail.country_id=country.id');
		return $this->db->get()->result();
	}	
	function show_list_term_search($key,$limit,$lang='vn'){
		$this->db->select("termdetail.term_name,term.id,term.date_create,term.date_modify,term.status");
		$this->db->where("country.name",$lang);
		$this->db->like("termdetail.term_name",$key);
		$this->db->order_by("article.article_weight","ASC");
		$this->db->limit($limit);
		$this->db->from('term');
		$this->db->join('termdetail','termdetail.term_id=term.id');
		$this->db->join('country','termdetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//====================================
	function count_article_admin_where(){
		$this->db->select("articledetail.article_name,articledetail.article_summary,article.id,article.date_create,article.date_modify,article.article_status, article.article_weight,images.thumb");
		$this->db->where('article.article_type','0');
        $this->db->order_by("article.id","DESC");
		$this->db->order_by('article.date_modify',"DESC");
		$this->db->from('article');
		$this->db->join('articledetail','articledetail.article_id=article.id');
		$this->db->join('articleimages','articleimages.article_id=article.id');
		$this->db->join('images','articleimages.image_id=images.id');
		$this->db->join('country','articledetail.country_id=country.id');
		return $this->db->get()->num_rows();
	}
	function show_list_article_page_true($limit,$offset){
		$this->db->select("articledetail.article_name,articledetail.article_summary,article.id,article.date_create,article.date_modify,article.article_status, article.article_weight, images.thumb");
		$this->db->where('article.article_type','0');
		$this->db->order_by("article.article_weight","ASC");
		$this->db->limit($limit,$offset);
		$this->db->from('article');
		$this->db->join('articledetail','articledetail.article_id=article.id');
		$this->db->join('articleimages','articleimages.article_id=article.id');
		$this->db->join('images','articleimages.image_id=images.id');
		$this->db->join('country','articledetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//====================================
	function show_list_term($lang='vn'){
		$this->db->select("termdetail.term_name,term.*");
		$this->db->where("country.name",$lang);
		$this->db->order_by("article.article_weight","ASC");
		$this->db->from('term');
		$this->db->join('termdetail','termdetail.term_id=term.id');
		$this->db->join('country','termdetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//===============Địa điểm=====================
	function get_local_map($lang='vn', $id){
		$this->db->select("location_to_map_detail.*");
		$this->db->where("country.name",$lang); 
		$this->db->where("location_to_article.article_id",$id);
		$this->db->from('location_to_article');
		$this->db->join('location_to_map_detail','location_to_map_detail.location_to_map_detail_id	=location_to_article.location_to_map_detail_id');
		$this->db->join('country','location_to_map_detail.country_id=country.id');
		return $this->db->get()->result();$this->db->get()->free_result();
	}

}
