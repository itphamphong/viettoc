<?php

class Home extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session'));
        $this->load->helper(array("url"));
        $this->load->library('user_agent');
        $this->load->model(array('item/a_item','article/a_article'));
    }

    function Error()
    {
        redirect(site_url());
    }
    public function index($lang = DLANG)
    {
        $data['lang'] = $lang;
        $data['info'] = $this->global_function->show_company($lang);
        $data["home"] = 1;
        $data['list_cate'] = $this->a_item->show_list_category_where(array("category.category_type" => 1, 'category.category_status' => '1'), $lang, 4);
        $this->template->write('title', $data['info']->name);
        $params=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description,choose_upload,article.picture,article.alt_picture,article_summary',
            'where'=>array('article.article_type'=>4),
            'lang'=>$lang,
            'first'=>'yes'
        );
        $params2=array(
            "select"=>'article_name,article_link,article.id,article_type,article_description,choose_upload,article.picture,article.alt_picture,article_summary',
            'where'=>array('article.article_type'=>5),
            'lang'=>$lang,

        );
        $data['about']=$detail = $this->a_article->get_list_article_where($params);
        $data['blog_two']=$detail = $this->a_article->get_list_article_where($params2);
        $this->template->write_view('content', 'public/index', $data);
        $this->template->render();
    }


    // save email letter
    function save_email_letter($lang = DLANG)
    {
        if ($this->global_function->count_table(array('email' => $this->input->post('email')), "email_letter") == 0) {
            $this->db->insert("email_letter", array('email' => $this->input->post('email'), "create_date" => TIME));
            echo $this->global_function->show_config_language('lang_info_send_successfull', $lang);
        } else {
            echo $this->global_function->show_config_language('lang_email_valiable', $lang);
        }
    }

    function Save_comment($lang = DLANG)
    {
        if ($this->input->post('c-full_name') == '' || $this->input->post('c-note') == '') {
            echo $this->global_function->show_config_language('lang_require', $lang);
        } else {
            $this->db->insert("comment", array(
                'name' => $this->input->post('c-full_name'),
                'note' => $this->input->post('c-note'),
                'tmp_id' => $this->input->post('tmp_id'),
                "created_date" => TIME,
                'value' => $this->input->post('value'),
                'point' => $this->input->post('c-point'),
                'lang' => $lang
            ));
            echo $this->global_function->show_config_language('lang_info_send_successfull', $lang);
        }
    }

    //
    function Book_sucess($lang = DLANG)
    {
        $data['lang'] = $lang;
        $this->template->write('title', $this->global_function->show_config_language('lang_sale_menu', $lang));
        $this->template->write_view('content', 'public/tutor/book_sucess', $data);
        $this->template->render();
    }

    function Captcha()
    {
        $this->load->view('public/ajax/load_captcha');
    }

    //

}