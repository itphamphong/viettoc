<?php

class Item extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session'));
        $this->load->helper(array("url"));
        $this->load->model(array("item/a_item","category/a_category"));
    }
    function index($lang=DLANG){
        $this->load->view("front/inc/lang/block");
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        if($lang=='vn'){
            $data["link_site"]=site_url("en/".$l->lang_url_home['en']);
        }else{
            $data["link_site"]=site_url();
        }
        $data['most_buy']=$this->a_item->show_list_item_type(1,$lang,6);
        $data['most_new']=$this->a_item->show_list_item_type(2,$lang,4);
        $data['most_hot']=$this->a_item->show_list_item_type(3,$lang,2);
        $this->template->write('mod',$l->lang_url_product[$lang]);
        $this->template->write('title', $l->lang_product[$lang]);
        $this->template->write_view('content','public/index', $data);
        $this->template->render();
    }
    function Hot($lang=DLANG){
        $data['lang']=$lang;
        $params=array(
            'lang'=>$lang,
            'status'=>2,
        );
        $data['list_product']=$this->a_item->show_list_item_params($params);
        $data['info']=$this->global_function->show_company($lang);
        $this->load->view("block/block_hot",$data);
    }
    function BuyMost($lang=DLANG){
        $data['info']=$this->global_function->show_company($lang);
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        $data['list_product']=$this->a_item->show_list_item_status_where(array("status"=>1),$lang,0);
        $this->load->view("public/block_buy_most",$data);
    }
    // Menu product
    function Load($lang){
        $this->load->view("front/inc/lang/block");
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        $data['list_cate']=$this->a_item->show_list_item_category_parent($this->input->post('id'), $lang, 10, 0);
        $this->load->view('public/load',$data);
    }
    function ProductSale($lang="vn",$page_no=1)
    {
        $this->load->view("front/inc/lang/block");
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        if($lang=='vn'){
            $data["link_site"]=site_url("en/".$l->lang_url_product_sale['en']);
        }else{
            $data["link_site"]=site_url("vn/".$l->lang_url_product_sale['vn']);
        }
        $this->template->add_js('themes/js/custom/tooltip/tooltip.js');
        $this->template->add_css('themes/js/custom/tooltip/tooltip.css');
        $this->template->add_css('themes/css/default/ddsmoothmenu-v.css');
        $this->template->add_css('themes/css/default/ddsmoothmenu.css');
        $page_co = 20;
        $start = ($page_no - 1) * $page_co;
        $count = $this->a_item->count_list_item_page_sale_page($lang);
        $data['list_item'] = $this->a_item->show_list_item_page_sale_page($lang, $page_co, $start);
        $data['link'] = $this->global_function->paging($page_co, $count, $lang . '/' . $this->uri->segment(2) . "/", $page_no);
        $data['h1']=1;
        $this->template->write('mod',$l->lang_url_product_sale[$lang]);
        $this->template->write('title', $l->lang_product[$lang]);
        $this->template->write_view('content','public/product_sale', $data, TRUE);
        $this->template->render();
    }
    // Show detail product
    function Detail($lang=DLANG,$url_item){
        $data['lang']=$lang;
        $data['detail']=$detail=$this->a_item->show_detail_item_where(array("itemdetail.item_link"=>$url_item),$lang);
        if(!isset($data['detail']->id)) redirect(site_url());
        $data['list_images']=$this->a_item->list_thumb($data['detail']->id);
        $data['first_images']=$this->a_item->list_thumb_first($data['detail']->id);
        $data['title']=$data['detail']->item_name;
        $data['info']=$this->global_function->show_company($lang);
        $category=$this->a_category->show_detail_category_where(array("category_link"=>$this->uri->segment(3)),$lang);
        $data['list_other_product']=$this->a_item->show_list_item_page_category_limit(array("item_category.category_id"=>isset($category->id)?$category->id:0,"item.id !="=>$data['detail']->id),$lang,5);
        $data['list_hot']=$this->a_item->show_list_item_page_category_limit(array("item_hot"=>1,"item.id !="=>$data['detail']->id),$lang,5);
        $data['breadcrumb']='<span typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="'.site_url($lang."/san-pham").'">'."Sản phẩm".'</a>  / <span class="current">'.$data['title'].'</span>';
        $data['none']="hide";
        $data['brand']=$this->a_item->show_detail_item_cate(array('item_id'=>$detail->id,'category_type'=>3),$lang);
        $this->template->write('mod','product');
        $this->template->write('title', $data['detail']->item_name);
        $this->template->write_view('content','public/detail', $data, TRUE);
        $this->template->render();
    }
    // Show list product with category
    function Category($lang='vn',$url){
        $this->load->view("front/inc/lang/block");
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        $data['l']=$l;
        if($lang=='vn') $site=site_url();
        else $site=site_url($lang);
        $data['category']=$category=$this->a_category->show_detail_category_where(array("category_link"=>$url),$lang);
        if(!isset($data['category']->id)) redirect($site);
        $data['title']=$data['category']->category_name;
        $data['info']=$this->global_function->show_company($lang);
        if($data['category']->category_top==0) {
            $data['list_child'] = $this->a_category->show_list_category_page(array("category_top" => $data['category']->id, "category_status" => 1), $lang, 0);
            $data['breadcrumb']='<li><a href="'.$data['category']->category_link.'">'.$data['category']->category_name.'</a></li>';
            $this->template->write_view('content', 'public/category', $data, TRUE);
        }else{
            $params = array(
                'lang' => $lang,
                'status' => 2,
                'category_id' => $data['category']->id
            );
            $data['list_item'] = $this->a_item->show_list_item_params($params);
            $data['breadcrumb'] = '<li><a href="' . $data['category']->category_link . '">' . $data['category']->category_name . '</a></li>';
            $data['list_product'] = $this->a_item->show_list_item_no_sale_page_category_limit_where_in($category->id, $lang, 0);
            $this->template->write_view('content', 'public/product', $data, TRUE);
        }

        $this->template->write('title', $data['category']->category_name);

        $this->template->render();
    }
    function CheckInfo($lang='vn'){
        $this->load->view("front/inc/lang/block");
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        if($this->cart->total_items()==0) redirect(site_url($lang."/".$l->lang_url_cart[$lang]));
        if($lang=='vn'){
            $data['link_site']=site_url($l->lang_url_cart['en']);
        }else{
            $data['link_site']=site_url($l->lang_url_cart['vn']);
        }

        if(isset($_REQUEST['ok'])){
            $this->form_validation->set_rules('full_name_one',$l->lang_full_name[$lang], 'trim|required');
            $this->form_validation->set_rules('cell_phone_one',$l->lang_cellphone[$lang], 'trim|required|numeric');
            $this->form_validation->set_rules('email_one',"Email", 'trim|required|valid_email');
            $this->form_validation->set_rules('address_one',$l->lang_address[$lang], 'trim|required');
            $this->form_validation->set_rules('content',$l->lang_content[$lang], 'trim');
            $this->form_validation->set_error_delimiters('<label class="red">', '</label>');

            if ($this->form_validation->run($this) == true) {
                $city_id=$this->input->post('city_id');
                $params_row=array(
                    "where"=>array("location.id"=>$city_id,"location.status"=>1),
                    'lang'=>'vn',
                    'first'=>'yes'
                );
                $city=$this->a_location->get_list_location_where($params_row);
                if(isset($city->id)){
                    $address=$this->input->post('address_one').", ".$city->location_name;
                    $ship=$city->ship;
                }else{
                    $address=$this->input->post('address_one');
                    $ship=0;
                }
                $sql=array(
                    'full_name'=>$this->input->post('full_name_one'),
                    'email'=>$this->input->post('email_one'),
                    'phone'=>$this->input->post('cell_phone_one'),
                    'landline'=>'',
                    'address'=>$address,
                    'notice'=>$this->input->post('content'),
                    'require_special'=>'',
                    "code_booking"=>$this->global_function->randomPassword(5)."-".date("Y-m"),
                    "date_create"=>date('Y-m-d'),
                    'type'=>0,
                    'tmp_id'=>0,
                    'type_pay'=>$this->input->post('type_pay'),
                    'ship'=>$ship,

                );
                $this->db->insert('od_order',$sql);
                $id_order=$this->db->insert_id();
                foreach ($this->cart->contents() as $row) {
                    $option=$this->cart->product_options($row['rowid']);
                    $Size=$this->a_category->show_detail_category_where(array("category.id"=>$option['Size']),$lang);
                    $Color=$this->a_category->show_detail_category_where(array("category.id"=>$option['Color']),$lang);
                    $id = $row['id'];
                    $item=$this->a_item->show_detail_item_cart($id,$lang);
                    $time=TIME;
                    if(isset($this->session->userdata("user")->id) && $this->session->userdata("user")->special==1){
                        if($item->price_spec >0) $price = $item->price_spec;else $price=0;
                    }else if ($item->price != 0) {
                        $price=$item->price;
                    }else{
                        $price=$item->value;
                    }
                    $thumb= $this->a_item->show_thumb($id);
                    $sql4=array(
                        "id_order"=>$id_order,
                        "id_item"=>$id,
                        "quantity"=>$row['qty'],
                        "price"=>$price,
                        "total"=>$price*$row['qty'],
                        "p_name"=>$item->item_name,
                        "options"=>'Size :'.$Size->category_name."- Color: ".$Color->category_name,
                    );
                    $this->db->insert("od_order_item",$sql4);
                    mysql_query("update item set number=number-".$row['qty']." WHERE item.id=".$id);
                }
              redirect(site_url($lang."/".$l->lang_url_checkout[$lang]));

            }
        }
        $params=array(
            "where"=>array("location.parent_id"=>0,"location.status"=>1),
            'lang'=>'vn'
        );
        $data['city']=$this->a_location->get_list_location_where($params);
        $user_id=isset($this->session->userdata("user")->id)?$this->session->userdata("user")->id:0;
        $data['user']=$this->a_user->get_user_where($user_id);
        $this->template->write('mod',$l->lang_url_product[$lang]);
        $this->template->write('title', $l->lang_cart[$lang]);
        $this->template->write_view('content','public/check_info', $data, TRUE);
        $this->template->render();

    }
    function LoadShip(){
        $params=array(
            "where"=>array("location.parent_id"=>0,"location.status"=>1),
            'lang'=>'vn',
            'first'=>'yes'
        );
        $city=$this->a_location->get_list_location_where($params);
        echo $city->ship;
    }
    function Checkout($lang){
        $this->load->view("front/inc/lang/block");
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
            $this->cart->destroy();
            $this->template->write('mod',$l->lang_url_product[$lang]);
            $this->template->write('title', $l->lang_cart[$lang]);
            $this->template->write_view('content','public/checkout_success', $data, TRUE);
            $this->template->render();
    }
    // random code
    function random_codeBooking() {
        $ma = date("y-m-d") . "-" . $this->global_function->randomPassword(5);
        return $ma;
    }
    function Result($lang='vn'){
        $this->load->view("front/inc/lang/block");
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        if($lang=='vn'){
            $data['link_site']=site_url("en/home");
        }else{
            $data['link_site']=site_url();
        }
        $data['info']=$this->global_function->show_company($lang);
        if(empty($this->input->post('key'))) redirect(site_url('san-pham'));
        $key=$this->global_function->unicode($this->input->post('key'));
        $data['list_product']=$this->a_item->show_list_result_search_key($key,$lang);
        $data['breadcrumb']='<span typeof="v:Breadcrumb"></span><span class="current">'.$l->lang_btn_search[$lang].'</span>';
        $data['title']=$l->lang_btn_search[$lang];
        $this->template->write('mod',$l->lang_url_product[$lang]);
        $this->template->write('title',$l->lang_btn_search[$lang]);
        $this->template->write_view('content','public/result', $data, TRUE);
        $this->template->render();
    }
    function Search_tag($lang='vn',$tag=''){
        $l= new lang();
        if($lang=='')
            $data['lang']='vn';
        else
            $data['lang']=$lang;
        $data['l']=$l;
        if($lang=='vn'){
            $data['link_site']=site_url("en/home");
        }else{
            $data['link_site']=site_url();
        }
        $data['info']=$this->global_function->show_company($lang);
        $data['list_product']=$this->a_item->show_list_result_search_tag($tag,$lang);
        $data['breadcrumb']='<span class="current">Tags</span>';
        $data['title']=$l->lang_btn_search[$lang];
        $this->template->write('mod',$l->lang_url_product[$lang]);
        $this->template->write('title',"Tags");
        $this->template->write_view('content','public/result', $data, TRUE);
        $this->template->render();
    }
    function ChangePic(){
        $id=$this->input->post('id');
        $item_id=$this->input->post('item_id');
        $data['list']=$this->global_function->get_tableWhere(array('tmp_id'=>$id,'item_id'=>$item_id,'value'=>'color'),'item_tmp');
        $this->load->view('public/load_change_pic',$data);

    }
    function Search($lang=DLANG){
        $data['lang']=$lang;
        $key=$this->global_function->unicode($this->input->post('key'));
        $data['list_product']=$this->a_item->show_list_result_search_key($key,$lang);
        $data['breadcrumb']='<li>Tìm kiếm</li>';
        $this->template->write('title',"Tìm kiểu");
        $this->template->write_view('content','public/result', $data, TRUE);
        $this->template->render();
    }
    function Product($lang=DLANG){
        $data['lang']=$lang;
        $data['list_product']=$this->a_item->show_list_result_search_key('',$lang);
        $data['breadcrumb']='<li>Tìm kiếm</li>';
        $this->template->write('title',"Tìm kiểu");
        $this->template->write_view('content','public/result', $data, TRUE);
        $this->template->render();
    }
    function Promotion($lang=DLANG,$page_no=1){
        $data['lang']=$lang;
        $page_co = 20;
        $start = ($page_no - 1) * $page_co;
        $count = $this->a_project->count_list_item_page($lang);
        $data['list'] = $this->a_item->show_list_promotion($lang, $page_co, $start);
        $data['link'] = $this->global_function->paging($page_co, $count, $lang ."/".$this->global_function->show_config_language('lang_promotion', $lang,'url')."/", $page_no);

        $data['breadcrumb']='<li>Promotion</li>';
        $this->template->write('title',"Tìm kiểu");
        $this->template->write_view('content','public/promotion', $data, TRUE);
        $this->template->render();
    }
    function Project($lang=DLANG,$page_no=1){
        $page_co = 20;
        $start = ($page_no - 1) * $page_co;
        $count = $this->a_project->count_list_item_page($lang);
        $data['list'] = $this->a_project->show_list_item_page($lang, $page_co, $start,1);
        $data['link'] = $this->global_function->paging($page_co, $count, $lang ."/".$this->global_function->show_config_language('lang_project', $lang,'url')."/", $page_no);
        $data['title']=$this->global_function->show_config_language('lang_project', $lang);
        $data['lang']=$lang;
        $data['breadcrumb']='<li>Dự án</li>';
        $this->template->write('title',"Dự án");
        $this->template->write_view('content','public/project', $data, TRUE);
        $this->template->render();
    }

}
