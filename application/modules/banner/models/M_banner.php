<?php
class M_banner extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	//====================================
	function show_image_in_album($id,$id_album){
		$this->db->where("image_id",$id);
		$this->db->where_in("album_id",$id_album);
		return $this->db->get("imagealbum")->num_rows();
	}

	//====================================
	function show_list_image_album_where(){
		$this->db->select("images.*");
		$this->db->order_by('images.weight',"ASC");
		$this->db->from('images');
		$this->db->join('imagealbum','imagealbum.image_id=images.id');
		$this->db->join('album','imagealbum.album_id=album.id');
		$this->db->group_by('images.id');
		return $this->db->get()->result();
	}
	function show_list_image_page_m_where($limit,$offset,$type=0){
		$this->db->select("images.*,imagealbum.album_id,album.name as album_name");
		if($type!=0) {
			$this->db->where(array('imagealbum.album_id'=>$type));

		}
		$this->db->order_by('images.weight', "DESC");
        $this->db->where("value",'banner');
		$this->db->limit($limit,$offset);
		$this->db->from('images');
		$this->db->join('imagealbum','imagealbum.image_id=images.id',"left");
		$this->db->join('album','imagealbum.album_id=album.id',"left");
		$this->db->group_by('images.id');
		return $this->db->get()->result();
	}
	function show_list_album_image($id,$lang='en'){
		$this->db->select('albumdetail.name,album.id');
		$this->db->where("country.name",$lang);
		$this->db->where("imagealbum.image_id",$id);
		$this->db->order_by('images.weight',"ASC");
		$this->db->from('album');
		$this->db->join('imagealbum','imagealbum.album_id=album.id');
		$this->db->join('albumdetail','albumdetail.album_id=album.id');
		$this->db->join('country','albumdetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//====================================
	function show_detail_album_id($id,$lang='en'){
		$this->db->select("albumdetail.name,album.id,album.date_create,album.author,album.weight,album.edit,album.per,album.date_modify,album.status,album.top_album,album.product,album.hot");
		$this->db->where("country.name",$lang);
		$this->db->where("album.id",$id);
		$this->db->order_by('images.weight',"ASC");
		$this->db->from('album');
		$this->db->group_by('album.id');
		$this->db->join('albumdetail','albumdetail.album_id=album.id');
		$this->db->join('country','albumdetail.country_id=country.id');
		return $this->db->get()->row();
	}
	function show_list_album_where($where=array(),$lang='en'){
		$this->db->select("albumdetail.name,album.id,album.date_create,album.date_modify,album.status");
		$this->db->where("country.name",$lang);
		$this->db->where($where);
		$this->db->order_by('images.weight',"ASC");
		$this->db->from('album');
		$this->db->join('albumdetail','albumdetail.album_id=album.id');
		$this->db->join('country','albumdetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//====================================
	function show_list_album_chil($id,$lang='en'){
		$this->db->select("albumdetail.name,album.id,album.date_create,album.date_modify,album.status");
		$this->db->where("country.name",$lang);
		$this->db->where("album.top_album",$id);
		$this->db->order_by('album.weight',"ASC");
		$this->db->from('album');
		$this->db->join('albumdetail','albumdetail.album_id=album.id');
		$this->db->join('country','albumdetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//====================================
	function show_detail_image_id($id){
		$this->db->select("images.*");
		$this->db->where("images.id",$id);
		$this->db->from('images');
		return $this->db->get()->row();
	}
	//====================================
	//====================================
	function show_list_album($lang='en'){
		$this->db->select("albumdetail.name,album.id,album.date_create,album.date_modify,album.status");
		$this->db->where("country.name",$lang);
		$this->db->order_by('images.weight',"ASC");
		$this->db->from('album');
		$this->db->join('albumdetail','albumdetail.album_id=album.id');
		$this->db->join('country','albumdetail.country_id=country.id');
		return $this->db->get()->result();
	}
	//============= Detail lang====================
    function show_detail_image($id){
        $this->db->select("images.*");
        $this->db->where("images.id",$id);
        $this->db->from('images');
        return $this->db->get()->row();
    }
    function check_tmp_detail($id, $lang=1){
        $this->db->where("imagedetail.country_id", $lang);
        $this->db->where("imagedetail.image_id", $id);
        $this->db->from('imagedetail');
        return $this->db->get()->row();
    }
	
	
}
