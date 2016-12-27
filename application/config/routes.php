<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
require_once( BASEPATH .'database/DB'. EXT ); $db =& DB();
//$route['translate_uri_dashes'] = TRUE;
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['(en|vn)/(trang-chu|home)'] = 'home/index/$1';
$route["(en|vn)/(customer|khach-hang|dich-vu|service|thu-vien)"] = "article/ListPage/$1/$2";
$route["(en|vn)/(customer|khach-hang|dich-vu|service|thu-vien)/(.+)"] = "article/Detail/$1/$3";
$route["(en|vn)/(lien-he|contact-us)"] = "contact/index/$1";
$route['(load-captcha)'] = "contact/Captcha";
$route['(en|vn)/(video)'] = 'video';
$route['(en|vn)/(search-key)'] = 'item/Search/$1';
$route['(en|vn)/(san-pham|product)'] = 'item/Product/$1';
$route['(en|vn)/(gioi-thieu|about-us)'] = 'article/About/$1';
$route["(en|vn)/(tin-tuc|news)"] = "article/ListNews/$1/$2";
$route["(en|vn)/(tin-tuc|news)/(.+)"] = "article/DetailNews/$1/$3";
$route['(en|vn)/(du-an|project)'] = 'item/project/$1';
$route['(en|vn)/(promotion)'] = 'item/Promotion/$1';
$product=$db
    ->select("itemdetail.item_link")
    ->get('itemdetail')->result();
foreach ($product as $p){
    if($p->item_link!=''){
        $route["(.+)/(".$p->item_link.")"] = "item/Detail/vn/".$p->item_link;
    }
}
$cate_parent=$db
    ->select("categorydetail.category_link")
    ->get('categorydetail')->result();
if(count($cate_parent)>0){foreach ($cate_parent as $cate){
    if($cate->category_link!=''){

        $route["(".$cate->category_link.")"] = "item/Category/vn/$cate->category_link";
        $route["(.+)/(".$cate->category_link.")"] = "item/Category/vn/$2";


    }}}

// Cart
$route['(add-cart)'] = "cart/add";
$route['(cart)'] = "cart/info/vn";
$route['(update-cart)'] = "cart/update_cart";
$route['(.+)/(load-ajax-cart)'] = "cart/load_ajax/$1";
$route['(.+)/(success)'] = "cart/success/$1";
/* * ********************End video******************** */
/* * ***************admin********************** */
//for paging

//end
$route['message'] = 'message';
$route['admin/thongke'] = 'moderator/admin/Dashboard';
$route['admin'] = 'moderator/admin/admin';
$route['admin/login'] = 'moderator/admin/login';
$route['admin/logout'] = 'moderator/admin/logout';
$route['admin/dashboard'] = 'moderator/admin/dashboard';
$route['admin/change-my-pass'] = 'moderator/admin/change_my_pass';
$route['admin/change-info'] = 'moderator/admin/ChangeMyInfo';
$route['admin/change-info'] = 'moderator/admin/ChangeMyInfo';
$route['admin/not-permission'] = 'users/administrator/NotPermission';
$route['admin/([a-zA-Z0-9_\-%]+)/(:num)'] = '$1/admin/index/$2';
$route['admin/([a-zA-Z0-9_\-%]+)/(:num)/(:num)'] = '$1/admin/index/$2/$3';
//end
$route['admin/([a-zA-Z_-]+)/(.+)'] = '$1/admin/$2';
$route['admin/(.+)'] = '$1/admin';
$company=$db
    ->select("company.*")
    ->get('company')->row();
define("ADMIN_PAGE",$company->page);
/* End of file routes.php */
/* Location: ./application/config/routes.php */
