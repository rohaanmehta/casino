<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function view()
    {
        if($this->session->get('username') != ''){
            return view('dashboard');   
        }
        return view('login');   
    }
    public function Auth(){
        $pass = md5($_POST['password']);
        $data = array(
            'user_email' => $_POST['email'],
            'user_password' => $pass,
        );

        $time = array(
            'lastlogin'=> date('Y-m-d H:i:s')
        );
        $count = $this->db->table('user')->where($data)->countAllResults();

        if($count == 0){
            $result['result'] = '400';
        }else{
            $result['result'] = '200';
            $user = $this->db->table('user')->where($data)->get()->getResultArray();
            $this->session->set('username',$user[0]['user_name']);
            $this->session->set('user_id',$user[0]['user_id']);
            $this->db->table('user')->set($time)->where('user_email',$_POST['email'])->update();
        }
        return $this->response->setJSON($result);
    }

    public function logout(){
        $this->session->remove('username');
        $this->session->remove('user_id');
        return redirect()->to(base_url('/'));
    }

    public function register(){
        $data = array(
            'user_name'=>$_POST['user_name'],
            'user_email'=>$_POST['user_email'],
            'user_phone'=>$_POST['user_phone'],
            'user_password'=> md5($_POST['user_password']),
            'lastlogin'=> date('Y-m-d H:i:s')
        );        
        // print_r($_POST);
        $this->validation->setRule("user_name", "UserName ", "required|is_unique[user.user_name]");
        $this->validation->setRule("user_email", "Email ", "required|is_unique[user.user_email]");
        $this->validation->setRule("user_phone", "Phone ", "required|is_unique[user.user_phone]");
        $this->validation->setRule("user_password", "Password ", "required");
        $this->validation->setRule("age_confirmation", "Terms and Confirmation ", "required");

        if ($this->validation->withRequest($this->request)->run()) {
            $this->db->table('user')->insert($data);
            $last_id = $this->db->insertID();            
            $coin_data = array(
                'user_id'=>$last_id,
                'coins'=> 0,
            );
            $this->db->table('coin')->insert($coin_data);

            $this->session->set('username',$data['user_name']);
            $this->session->set('user_id',$last_id);
            $json['result'] = '200';
        } else {
            $json = array(
                "error" => true,
                "user_name" => $this->validation->getError("user_name"),
                "user_email" => $this->validation->getError("user_email"),
                "user_phone" => $this->validation->getError("user_phone"),
                "user_password" => $this->validation->getError("user_password"),
                "age_confirmation" => $this->validation->getError("age_confirmation")
            );
        }
        // $json['result'] = '400';
        return $this->response->setJson($json);
    }

    public function user_edit_form(){
        $user_id = $this->session->get('user_id');
        $data = array(
            'user_name'=>$_POST['edit_user_name'],
            // 'user_email'=>$_POST['edit_user_email'],
            'user_phone'=>$_POST['edit_user_phone'],
            // 'user_password'=>$_POST['edit_user_password'],
            'updated_at'=> date('Y-m-d H:i:s')
        );        

        
        if($_POST['payment-method'] == 'bank-account'){
            $data['user_account_no']=$_POST['user_account_number'];
            $data['user_account_name'] = $_POST['user_account_name'];
            $data['user_account_ifsc'] = $_POST['user_account_ifsc'];
            $data['user_upi'] = '';
            $this->validation->setRule("user_account_number", "Account no ", "required|trim");
            $this->validation->setRule("user_account_name", "Account name ", "required|trim");
            $this->validation->setRule("user_account_ifsc", "IFSC ", "required|trim");
        }else{
            $data['user_upi'] = $_POST['user_upi'];
            $data['user_account_no']= '';
            $data['user_account_name'] =  '';
            $data['user_account_ifsc'] =  '';
            $this->validation->setRule("user_upi", "UPI ", "required|is_unique[user.user_upi,user_id,".$user_id."]|trim");
        }

        // print_r($_POST);exit;
        $this->validation->setRule("edit_user_name", "UserName ", "required|is_unique[user.user_name,user_id,".$user_id."]|trim");
        // $this->validation->setRule("edit_user_email", "Email ", "required|is_unique[user.user_email,user_id,".$user_id."]|trim");
        $this->validation->setRule("edit_user_phone", "Phone ", "required|is_unique[user.user_phone,user_id,".$user_id."]|trim");
        // $this->validation->setRule("edit_user_password", "Password ", "required");

        if ($this->validation->withRequest($this->request)->run()) {
            $this->db->table('user')->set($data)->where('user_id',$user_id)->update();
            $json['result'] = '200';
        } else {
            $json = array(
                "error" => true,
                "edit_user_name" => $this->validation->getError("edit_user_name"),
                // "edit_user_email" => $this->validation->getError("edit_user_email"),
                "edit_user_phone" => $this->validation->getError("edit_user_phone"),
                // "edit_user_password" => $this->validation->getError("edit_user_password"),
                "user_upi" => $this->validation->getError("user_upi"),
                "user_account_number" => $this->validation->getError("user_account_number"),
                "user_account_name" => $this->validation->getError("user_account_name"),
                "user_account_ifsc" => $this->validation->getError("user_account_ifsc"),
            );
        }
        // $json['result'] = '400';
        return $this->response->setJson($json);
    }
}
