<?php

class Article extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session'));
        $this->load->helper(array("url"));
        $this->load->model(array('a_article',"term/a_term",'video/a_video'));
        $this->load->library('user_agent');
    }
    function Detail($lang=DLANG,$url)
    {
        $data['lang']=$lang;
        $params=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description',
            'where'=>array('article_link'=>$url),
            'lang'=>$lang,
            'first'=>'yes'
        );
        $data['detail']=$detail = $this->a_article->get_list_article_where($params);
        if (!isset($data['detail']->id)) redirect(site_url());
        $data['type']=$data['detail']->article_type;
        //$this->query("update article set article_views=article_views+1 where id=".$data['detail']->id);
        //$data['list_article'] = $this->a_article->get_article_list_type_other($data['detail']->id, $data['detail']->article_type, $lang);
        $data['title'] = $data['detail']->article_name;
        $data['type'] = $data['detail']->article_type;
        if($data['detail']->article_type==3){
            $data['url']=$url='tin-tuc-suc-khoe';$data['ptitle']="Tin tức sức khỏe";
        }
        $data['info']=$this->global_function->show_company($lang);
        $data['list_video']=$this->a_video->show_list_video_where(array('video.status'=>1),1,0,$lang);
        $seo=$this->global_function->show_detail_meta_seo_id_lang($data['detail']->id,$lang,"article");
        $this->template->write('title',  !empty($seo->name_seo)?$seo->name_seo:$data['detail']->article_name);
        $this->template->write('description', !empty($seo->meta_descriptions)?$seo->meta_descriptions:"");
        $this->template->write('keywords', !empty($seo->meta_keywords)?$seo->meta_keywords:"");
        switch($this->uri->segment(2)){
            case $this->global_function->show_config_language('lang_customer', $lang,'url'):$type=3;$title=$this->global_function->show_config_language('lang_customer', $lang); break;
            case $this->global_function->show_config_language('lang_service', $lang,'url'):$type=2;$title=$this->global_function->show_config_language('lang_service', $lang); break;
            case 'thu-vien':$type=6;$title=$this->global_function->show_config_language('lang_resource_lib', $lang); break;
        }
        $data['breadcrumb']='<li><a href="'.site_url($lang."/".$url).'"></a>'.$title.'</li><li>'.$data['title'].'</li>';

        $this->template->write_view('content', 'public/detail', $data, TRUE);

        $this->template->render();
    }
    function DetailNews($lang=DLANG,$url)
    {
        $data['lang']=$lang;
        $params=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description',
            'where'=>array('article_link'=>$url),
            'lang'=>$lang,
            'first'=>'yes'
        );
        $data['detail']=$detail = $this->a_article->get_list_article_where($params);
        if (!isset($data['detail']->id)) redirect(site_url());
        $data['type']=$data['detail']->article_type;
        //$this->query("update article set article_views=article_views+1 where id=".$data['detail']->id);
        $params_other=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description,article.picture,article_summary,choose_upload,article.alt_picture',
            'where'=>array('article_type'=>5),
            'lang'=>$lang,

        );
        $data['list'] = $this->a_article->get_list_article_where($params_other);
        $data['title']=$title = $data['detail']->article_name;
        $data['type'] = $data['detail']->article_type;
        $data['info']=$this->global_function->show_company($lang);
        $data['list_video']=$this->a_video->show_list_video_where(array('video.status'=>1),1,0,$lang);
        $seo=$this->global_function->show_detail_meta_seo_id_lang($data['detail']->id,$lang,"article");
        $this->template->write('title',  !empty($seo->name_seo)?$seo->name_seo:$data['detail']->article_name);
        $this->template->write('description', !empty($seo->meta_descriptions)?$seo->meta_descriptions:"");
        $this->template->write('keywords', !empty($seo->meta_keywords)?$seo->meta_keywords:"");
        $data['breadcrumb']='<li><a href="'.site_url($lang."/".$this->global_function->show_config_language('lang_news', $lang,'url')).'">'.$this->global_function->show_config_language('lang_news', $lang).'</a></li> <i class="fa fa-angle-right "></i> <li>'.$data['title'].'</li>';

        $this->template->write_view('content', 'public/detail_news', $data, TRUE);

        $this->template->render();
    }
    function About($lang=DLANG)
    {
        $data['lang']=$lang;
        $params=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description',
            'where'=>array('article.article_type'=>1),
            'lang'=>$lang,
            'first'=>'yes'
        );
        $data['detail']=$detail = $this->a_article->get_list_article_where($params);
        if (!isset($data['detail']->id)) redirect(site_url());

        $data['title'] =$title= $data['detail']->article_name;
        $data['type'] = $data['detail']->article_type;
           $data['info']=$this->global_function->show_company($lang);
        $data['list_video']=$this->a_video->show_list_video_where(array('video.status'=>1),1,0,$lang);
        $seo=$this->global_function->show_detail_meta_seo_id_lang($data['detail']->id,$lang,"article");
        $this->template->write('title',  !empty($seo->name_seo)?$seo->name_seo:$data['detail']->article_name);
        $this->template->write('description', !empty($seo->meta_descriptions)?$seo->meta_descriptions:"");
        $this->template->write('keywords', !empty($seo->meta_keywords)?$seo->meta_keywords:"");
              $data['breadcrumb']='<li>'.$data['title'].'</li>';

        $this->template->write_view('content', 'public/about', $data, TRUE);

        $this->template->render();
    }
    function ListPage($lang=DLANG,$url,$page_no=1){
        switch($url){
            case $this->global_function->show_config_language('lang_customer', $lang,'url'):$type=3;$title=$this->global_function->show_config_language('lang_customer', $lang); break;
            case $this->global_function->show_config_language('lang_service', $lang,'url'):$type=2;$title=$this->global_function->show_config_language('lang_service', $lang); break;
            case 'thu-vien':$type=6;$title=$this->global_function->show_config_language('lang_resource_lib', $lang); break;

        }
        $params_count=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description',
            'where'=>array('article_type'=>$type),
            'lang'=>$lang,
            'num_rows'=>'yes'
        );
        $count=$detail = $this->a_article->get_list_article_where($params_count);
        $page_co = 20;
        $start = ($page_no - 1) * $page_co;
        $params=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description,article.picture,article_summary,choose_upload,article.alt_picture',
            'where'=>array('article_type'=>$type),
            'lang'=>$lang,
            'limit'=>$page_co,
            'offset'=>$start
        );
        $data['list_video']=$this->a_video->show_list_video_where(array('video.status'=>1),1,0,$lang);
        $data['info']=$this->global_function->show_company($lang);
        $data['list']=$detail = $this->a_article->get_list_article_where($params);
        $data['link'] = $this->global_function->paging($page_co, $count,"/".$lang. '/'.$url ."/", $page_no);
        $data['title']=$title;
        $data['lang']=$lang;
        $data['url']=$url;
        $data['breadcrumb']='<li><a href="'.site_url($lang."/".$url).'"></a>'.$title.'</li>';

        $this->template->write('title',  $title);
        $this->template->write_view('content', 'public/list', $data, TRUE);
        $this->template->render();
    }
    function ListNews($lang=DLANG,$url,$page_no=1){
             $params_count=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description',
            'where'=>array('article_type'=>5),
            'lang'=>$lang,
            'num_rows'=>'yes'
        );
        $count=$detail = $this->a_article->get_list_article_where($params_count);
        $page_co = 20;
        $start = ($page_no - 1) * $page_co;
        $params=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description,article.picture,article_summary,choose_upload,article.alt_picture',
            'where'=>array('article_type'=>5),
            'lang'=>$lang,
            'limit'=>$page_co,
            'offset'=>$start
        );
        $data['list_video']=$this->a_video->show_list_video_where(array('video.status'=>1),1,0,$lang);
        $data['info']=$this->global_function->show_company($lang);
        $data['list']=$detail = $this->a_article->get_list_article_where($params);
        $data['link'] = $this->global_function->paging($page_co, $count,"/".$lang. '/'.$url ."/", $page_no);
        $data['title']=$title=$this->global_function->show_config_language('lang_news', $lang);
        $data['lang']=$lang;
        $data['url']=$url;
        $data['breadcrumb']='<li><a href="'.site_url($lang."/".$url).'"></a>'.$title.'</li>';

        $this->template->write('title',  $title);
        $this->template->write_view('content', 'public/list_news', $data, TRUE);
        $this->template->render();
    }
    // Blog slide home

    function BlockViewMost(){
        $data['list_article']=$this->a_article->get_list_article_view_most(array('article_type !='=>6,'article_type !='=>7),'vn',10);
        $this->load->view('public/block/block_view_most',$data);
    }

    function Block_footer($lang=DLANG,$type){
        $data['lang']=$lang;
        $params=array(
            "select"=>'article_name,article_link,article.id,article_type',
            'where'=>array('article_type'=>$type),
            'lang'=>$lang,
        );
        $data['list']=$detail = $this->a_article->get_list_article_where($params);
        $this->load->view('public/block/block_footer',$data);

    }
}
