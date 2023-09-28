<?php

namespace App\Controllers;

class Game extends BaseController
{
    public function roll()
    {
        $arr = array(
            'dice1' => '1',
            'dice2' => '2',
            'total' => '3',
        );
        $this->db->table('rolls')->insert($arr);
        // echo 'roll';exit;
        return view('index');
    }

    public function bet()
    {
        //check if amount is greater than user alance 
        $userid = $this->session->get('user_id');

        if(!isset($userid) && empty($userid)){
            $json['result'] = 500;
            return $this->response->setJSON($json);
        }

        $betamount = $_POST['amount'];
        $user_balance = $this->db->table('coin')->where('user_id', $userid)->get()->getResultArray();

        if ($betamount == 0 || $betamount == '') {
            $json['result'] = 300;
            return $this->response->setJSON($json);
        } else if ($betamount > $user_balance[0]['coins']) {
            $json['result'] = 400;
            return $this->response->setJSON($json);
        }

        //place bet
        $date = date('Y-m-d');
        $time = date('H');
        // $exist = $this->db->table('bets')->where('user_id', $userid)->where('date', $date)->where('time', $time)->countAllResults();

        $arr = array(
            'betoption' => $_POST['betoption'],
            'amount' => $_POST['amount'],
            'time' => $time,
            'user_id' => $userid,
        );

        if ($this->db->table('bets')->insert($arr)) {
            $json['result'] = 200;
        }

        //debit amount from user 
        $updated_user_balance = $user_balance[0]['coins'] - $betamount;
        $updated_balance['coins'] = $updated_user_balance;
        
        if($this->db->table('coin')->set($updated_balance)->where('user_id', $userid)->update()){
            $json['result'] = 200;
            $json['user_balance'] = $updated_user_balance;
        }

        return $this->response->setJSON($json);
    }

    public function withdraw(){
        $withdraw_amt = $_POST['amount'];
        $userid = $this->session->get('user_id');
        if(!isset($userid) && empty($userid)){
            $json['result'] = 500;
            return $this->response->setJSON($json);
        }

        if($withdraw_amt < 1000){
            $json['result'] = 300;
            return $this->response->setJSON($json);
        }

        $user_balance = $this->db->table('coin')->where('user_id', $userid)->get()->getResultArray();
        if ($withdraw_amt > $user_balance[0]['coins']) {
            $json['result'] = 400;
            return $this->response->setJSON($json);
        }

        $arr = array(
            'with_user_amount' => $_POST['amount'],
            'with_user_id' => $userid,
        );

        if ($this->db->table('withdraw')->insert($arr)) {

             //debit amount from user 
            $updated_user_balance = $user_balance[0]['coins'] - $withdraw_amt;
            $updated_balance['coins'] = $updated_user_balance;
            
            if($this->db->table('coin')->set($updated_balance)->where('user_id', $userid)->update()){
                $json['result'] = 200;
                $json['user_balance'] = $updated_user_balance;
            }

            $json['result'] = 200;
            return $this->response->setJSON($json);
        }
    }
}
