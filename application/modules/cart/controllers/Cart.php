<?php

class Cart extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model(array('item/a_item'));
    }

    function add()
    {
        $id = $this->input->post('id');
        $gia = "123";
        $sl = $this->input->post('number');
        $fag = false;
        foreach ($this->cart->contents() as $row) {
            if ($row['id'] == $id) {
                $rid = $row['rowid'];
                $qty = $row['qty'] + $sl;
                $fag = true;
                break;
            }
        }
        if (!$fag) {
            //echo "b";die;
            $data = array(
                "id" => $id,
                "name" => "cart",
                "qty" => $sl,
                "price" => $gia,
            );
            $this->cart->insert($data);
            echo $this->cart->total_items();
        } else {
            $data = array(
                'rowid' => $rid,
                'qty' => $qty
            );
            $this->cart->update($data);
            echo $this->cart->total_items();
        }
    }
    // show cart
    function info($lang = DLANG)
    {
        if(isset($_POST['ok'])){
            $this->form_validation->set_rules('c-full_name',$this->global_function->show_config_language('lang_full_name', $lang), 'trim|required');
            $this->form_validation->set_rules('c-phone',$this->global_function->show_config_language('lang_phone', $lang) , 'trim|required|numeric');
            $this->form_validation->set_rules('c-email',"Email", 'trim|required|valid_email');
            $this->form_validation->set_rules('c-captcha',"Captcha", 'trim|required|callback_checkcaptcha');
            $this->form_validation->set_rules('c-content',$this->global_function->show_config_language('lang_notice', $lang) , 'trim');
            $this->form_validation->set_error_delimiters('<p class="red">', '</label>');

            if ($this->form_validation->run($this) == true) {
                $sql=array(
                    'full_name'=>$this->input->post('c-full_name'),
                    'email'=>$this->input->post('c-email'),
                    'phone'=>$this->input->post('c-phone'),
                    'notice'=>$this->input->post('c-content'),
                    'require_special'=>'',
                    "code_booking"=>$this->global_function->randomPassword(5)."-".date("Y-m"),
                    "date_create"=>date('Y-m-d'),
                    'type'=>0,
                    'tmp_id'=>0,

                );
                $this->db->insert('od_order',$sql);
                $id_order=$this->db->insert_id();
                $tongtien=0;
                foreach ($this->cart->contents() as $row) {
                    $id = $row['id'];
                    $item=$this->a_item->show_detail_item_cart($id,$lang);
                    if(isset($item->id)) {
                        $time = TIME;
                        if ($item->price != 0) {
                            $price = $item->price;
                        } else {
                            $price = $item->value;
                        }
                        $tongtien = $tongtien + ($price * $row['qty']);
                        $sql4 = array(
                            "id_order" => $id_order,
                            "id_item" => $id,
                            "quantity" => $row['qty'],
                            "price" => $price,
                            "total" => $price * $row['qty'],
                            "p_name" => $item->item_name,
                            "options" => 'NULL',
                        );
                        $this->db->insert("od_order_item", $sql4);

                        //mysql_query("update item set number=number-" . $row['qty'] . " WHERE item.id=" . $id);
                    }
                }
                redirect(site_url($lang."/success"));
            }
        }
        $data['title'] = $title = "Giỏ hàng";
        $data['lang'] = $lang;
        $this->template->write('mod', 'Giỏ hàng');
        $this->template->write('title', 'Giỏ hàng');
        $data['breadcrumb'] = '<li>' . $title . '</li>';
        $this->template->write_view('content', 'public/cart', $data);
        $this->template->render();
    }
    function update_cart() {
        $rowid = $this->input->post('id');
        $qty = $this->input->post('qty');
        $data = array(
            'rowid' => $rowid,
            'qty' => $qty
        );
        $this->cart->update($data);
        echo '1';

    }
    function Load_ajax($lang = DLANG){
        $data['lang'] = $lang;
        $this->load->view('public/load_ajax',$data);

    }
    function Success($lang = DLANG){
        $data['title'] = $title = "Giỏ hàng";
        $data['lang'] = $lang;
        $this->template->write('mod', 'Giỏ hàng');
        $this->template->write('title', 'Giỏ hàng');
        $data['breadcrumb'] = '<li>' . $title . '</li>';
        $this->template->write_view('content', 'public/success', $data);
        $this->template->render();
    }
    function checkcaptcha()
    {
        if ($this->input->post('c-captcha') == $_SESSION['random_number']) {
            return TRUE;
        } else {
            $this->form_validation->set_message('checkcaptcha', 'Mã xác nhận không đúng');
            return FALSE;
        }
    }
}