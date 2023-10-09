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
        echo 'rolled succesfully';
        // echo 'roll';exit;
        // return view('index');
    }

    public function bet()
    {
        //check if amount is greater than user alance 
        $userid = $this->session->get('user_id');

        //check user 
        if (!isset($userid) && empty($userid)) {
            $json['result'] = 500;
            return $this->response->setJSON($json);
        }

        //check balance
        $betamount = $_POST['amount'];
        $user_balance = $this->db->table('coin')->where('user_id', $userid)->get()->getResultArray();

        if ($betamount == 0 || $betamount == '') {
            $json['result'] = 300;
            return $this->response->setJSON($json);
        } else if ($betamount > $user_balance[0]['coins']) {
            $json['result'] = 400;
            return $this->response->setJSON($json);
        }


        //check if already bet for next bet
        $hour = date('H');
        $date = date('Y-m-d');
        // echo $hour;

        if ($hour > 19) { //7 pm
            $date = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 day'));
        }

        $check_bet_exist = $this->db->table('bets')->where('user_id', $userid)->where('date', $date)->get()->getResultArray();

        if (isset($check_bet_exist) && !empty($check_bet_exist)) {
            $json['result'] = 100;
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

        if ($this->db->table('coin')->set($updated_balance)->where('user_id', $userid)->update()) {
            $json['result'] = 200;
            $json['user_balance'] = $updated_user_balance;
        }

        return $this->response->setJSON($json);
    }

    public function withdraw()
    {
        $withdraw_amt = $_POST['amount'];
        $userid = $this->session->get('user_id');
        if (!isset($userid) && empty($userid)) {
            $json['result'] = 500;
            return $this->response->setJSON($json);
        }

        if ($withdraw_amt < 1000) {
            $json['result'] = 300;
            return $this->response->setJSON($json);
        }

        $user_balance = $this->db->table('coin')->where('user_id', $userid)->get()->getResultArray();
        $user_info = $this->db->table('user')->where('user_id', $userid)->get()->getResultArray();
        if ($withdraw_amt > $user_balance[0]['coins']) {
            $json['result'] = 400;
            return $this->response->setJSON($json);
        }

        if($user_info[0]['user_upi'] == '' && $user_info[0]['user_account_no'] == '' && $user_info[0]['user_account_name'] == '' && $user_info[0]['user_account_ifsc'] == ''){
            $json['result'] = 600;
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

            if ($this->db->table('coin')->set($updated_balance)->where('user_id', $userid)->update()) {
                $json['result'] = 200;
                $json['user_balance'] = $updated_user_balance;
            }

            $json['result'] = 200;
            return $this->response->setJSON($json);
        }
    }

    public function update_user_balance()
    {
        // echo'<pre>';print_r($_POST);exit;
        $amount = $_POST['amount'];
        $payment_id = $_POST['payment_id'];
        $userid = $this->session->get('user_id');
        $first_deposit = 0;

        $array = array(
            'depo_user_id' => $userid ,
            'depo_user_amount' => $amount,
            'depo_transaction_id' => $payment_id
        );

        $this->db->table('deposit')->insert($array);

        $user_balance = $this->db->table('coin')->where('user_id', $userid)->get()->getResultArray();
        $json['result'] = 400;

        if (isset($user_balance) && !empty($user_balance)) {
            //debit amount from user 
            if($user_balance[0]['first_deposit'] == '1'){
                $first_deposit = 300;
            }

            $updated_user_balance = $user_balance[0]['coins'] + number_format($amount) + number_format($first_deposit);
            $updated_balance['coins'] = $updated_user_balance;
            $updated_balance['coins'] = $updated_user_balance;
            $updated_balance['first_deposit'] = 0;

            if ($this->db->table('coin')->set($updated_balance)->where('user_id', $userid)->update()) {
                $json['user_balance'] = $updated_user_balance;
                $json['result'] = 200;
            }
        }
        return $this->response->setJSON($json);
    }
}
