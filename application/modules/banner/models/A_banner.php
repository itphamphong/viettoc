<?php
class A_banner extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	function get_list_image_with_id_album($id,$lang=DLANG,$hot=1)
	{
		$this->db->select('images.id,images.name,imagedetail.*');
		$this->db->where(array('imagealbum.album_id'=>$id,'country.name'=>$lang));
		$this->db->where('images.status', 1);
		if($hot==0) {
			$this->db->where('images.hot', $hot);
		}
		$this->db->order_by('images.weight',"ASC");
        $this->db->group_by("images.id");
		$this->db->from('images');
		$this->db->join('imagealbum', 'imagealbum.image_id = images.id');
        $this->db->join('imagedetail', 'imagedetail.image_id = images.id');
        $this->db->join('country','imagedetail.country_id=country.id');
		return $this->db->get()->result();$this->db->get()->free_result();
	}
	function get_list_image_with_id_album_line($id,$tmp_id,$lang=DLANG)
	{
		$this->db->select('images.id,images.name,imagedetail.*');
		$this->db->where(array('imagealbum.album_id'=>$id,'country.name'=>$lang));
		$this->db->where('images.status', 1);
		if($tmp_id!=0) {
			$this->db->where('tmp_banner.tmp_id', $tmp_id);
			$this->db->join('tmp_banner', 'tmp_banner.banner_id = images.id');
		}
		$this->db->order_by('images.weight',"ASC");
		$this->db->group_by("images.id");
		$this->db->from('images');
		$this->db->join('imagealbum', 'imagealbum.image_id = images.id');
		$this->db->join('imagedetail', 'imagedetail.image_id = images.id');
		$this->db->join('country','imagedetail.country_id=country.id');

		return $this->db->get()->row();$this->db->get()->free_result();
	}
}