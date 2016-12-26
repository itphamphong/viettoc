<?php

class A_about extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
	function intro($id,$lang='vn')
	{
		//echo $lang; exit;
		$this->db->select("articledetail.*,article.id,article.date_create,article.date_modify,article.article_status,images.thumb");
		$this->db->where('country.name',$lang);
		$this->db->where('article.id',$id);
		$this->db->where("article.article_status",'1');
		$this->db->where("article.article_type", '0');
		$this->db->limit(1);
		$this->db->from('article');
		$this->db->join('articledetail','articledetail.article_id=article.id');
		//$this->db->join('articleterm','articleterm.article_id=article.id');
		$this->db->join('articleimages','articleimages.article_id=article.id');
		$this->db->join('images','articleimages.image_id=images.id');
		$this->db->join('country','articledetail.country_id=country.id');
		return $this->db->get()->row();
		//return $this->db->get()->result(); $this->db->get()->free_result();
	}
	

}
