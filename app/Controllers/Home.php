<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function view()
    {
        $userid = $this->session->get('user_id');
        $data['last_roll'] = $this->db->table('rolls')->select('dice1,dice2')->orderBy('id','desc')->limit(1)->get()->getResultArray();
        $data['first_deposit'] = $this->db->table('coin')->select('first_deposit')->where('user_id',$userid)->get()->getResultArray();
        $data['user_info'] = $this->db->table('user')->select('*')->where('user_id',$userid)->get()->getResultArray();
        if(empty($data['first_deposit'])){
            $data['first_deposit'] = 1;
        }else{
            $data['first_deposit'] = $data['first_deposit'][0]['first_deposit'];
        }
        // echo'<pre>';print_r($data['first_deposit']);exit;
        return view('index',$data);
    }
}
