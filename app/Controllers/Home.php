<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function view()
    {
        $userid = $this->session->get('user_id');
        $data['last_roll'] = $this->db->table('rolls')->select('dice1,dice2,total')->orderBy('id','desc')->limit(1)->get()->getResultArray();
        $data['first_deposit'] = $this->db->table('coin')->select('first_deposit')->where('user_id',$userid)->limit(1)->get()->getResultArray();
        $data['user_info'] = $this->db->table('user')->select('*')->where('user_id',$userid)->limit(1)->get()->getResultArray();
        $data['user_bet_history'] = $this->db->table('bets')->select('*')->where('user_id',$userid)->orderBy('id','desc')->limit(100)->get()->getResultArray();
        $data['previous_activity'] = $this->db->table('rolls')->select('*')->orderBy('id','desc')->limit(100)->get()->getResultArray();
        $data['transactions_deposit'] = $this->db->table('deposit')->select('*')->where('depo_user_id',$userid)->orderBy('created_at','desc')->limit(100)->get()->getResultArray();
        $data['transactions_withdraw'] = $this->db->table('withdraw')->select('*')->where('with_user_id',$userid)->orderBy('created_at','desc')->limit(100)->get()->getResultArray();
        
        $transactions = array_merge($data['transactions_deposit'],$data['transactions_withdraw']);
        krsort($transactions,$created_at);
        echo'<pre>';print_r($transactions);exit;

        if(empty($data['first_deposit'])){
            $data['first_deposit'] = 1;
        }else{
            $data['first_deposit'] = $data['first_deposit'][0]['first_deposit'];
        }
        // echo'<pre>';print_r($data['first_deposit']);exit;
        return view('index',$data);
    }
}
