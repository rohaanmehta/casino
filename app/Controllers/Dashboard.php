<?php

namespace App\Controllers;

use CodeIgniter\Model;

class Dashboard extends BaseController
{
    public function view()
    {
        $current_date = date('Y-m');
        $data['total_users'] = $this->db->table('user')->countAllResults();
        $data['total_deposit'] = $this->db->table('deposit')->select('SUM(depo_user_amount) as total_deposit')->get()->getResultArray();
        $data['total_withdraw'] = $this->db->table('withdraw')->select('SUM(with_user_amount) as total_withdraw')->get()->getResultArray();
        $data['total_msgs'] = $this->db->table('messages')->countAllResults();

        $data['month_total_users'] = $this->db->table('user')->like('created_date', $current_date)->countAllResults();
        $data['month_total_deposit'] = $this->db->table('deposit')->select('SUM(depo_user_amount) as total_deposit')->like('created_date', $current_date)->get()->getResultArray();
        $data['month_total_withdraw'] = $this->db->table('withdraw')->select('SUM(with_user_amount) as total_withdraw')->like('created_date', $current_date)->get()->getResultArray();
        $data['month_total_msgs'] = $this->db->table('messages')->like('created_date', $current_date)->countAllResults();

        return view('Admin/dashboard', $data);
    }

    public function users()
    {
        $perPage = 20;
        if (isset($_GET['count'])) {
            $perPage = $_GET['count'];
        }
        $pager = service('pager');
        $page = (@$_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;
        if (isset($_GET['column'])) {
            $data['users'] = $this->db->table('user')->orderBy($_GET['column'], 'ASC')->get($perPage, $offset)->getResultArray();
        } else {
            $data['users'] = $this->db->table('user')->get($perPage, $offset)->getResultArray();
        }

        $i = 0;
        foreach ($data['users'] as $row) {
            $deposit_total = $this->db->table('deposit')->select('SUM(depo_user_amount) as total_deposit')->where('depo_user_id', $row['user_id'])->get()->getResultArray();
            $total_withdraw = $this->db->table('withdraw')->select('SUM(with_user_amount) as total_withdraw')->where('with_user_id', $row['user_id'])->get()->getResultArray();
            if (isset($deposit_total[0]['total_deposit'])) {
                $data['users'][$i]['total_depo'] = $deposit_total[0]['total_deposit'];
            } else {
                $data['users'][$i]['total_depo'] = 0;
            }
            if (isset($total_withdraw[0]['total_withdraw'])) {
                $data['users'][$i]['total_withdraw'] = $total_withdraw[0]['total_withdraw'];
            } else {
                $data['users'][$i]['total_withdraw'] = 0;
            }
            $i++;
        }
        $data['total'] = $this->db->table('user')->countAllResults();
        $data['links'] = $pager->makeLinks($page, $perPage, $data['total']);

        return view('Admin/user', $data);
    }

    public function deposit()
    {
        $perPage = 20;
        if (isset($_GET['count'])) {
            $perPage = $_GET['count'];
        }
        $pager = service('pager');
        $page = (@$_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;
        if (isset($_GET['column'])) {
            $data['deposit'] = $this->db->table('deposit')->select('user_name,depo_user_amount,depo_transaction_id,deposit.created_at')->join('user', 'user.user_id = deposit.depo_user_id')->orderBy($_GET['column'], 'ASC')->get($perPage, $offset)->getResultArray();
        } else {
            $data['deposit'] = $this->db->table('deposit')->select('user_name,depo_user_amount,depo_transaction_id,deposit.created_at')->join('user', 'user.user_id = deposit.depo_user_id')->get($perPage, $offset)->getResultArray();
        }
        $data['total'] = $this->db->table('deposit')->countAllResults();
        $data['links'] = $pager->makeLinks($page, $perPage, $data['total']);

        return view('Admin/deposit', $data);
    }

    public function withdraw()
    {
        $perPage = 20;
        if (isset($_GET['count'])) {
            $perPage = $_GET['count'];
        }
        $pager = service('pager');
        $page = (@$_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;
        if (isset($_GET['column'])) {
            $data['withdraw'] = $this->db->table('withdraw')->select('with_user_id,id,with_status,user_name,with_user_amount,withdraw.created_at')->join('user', 'user.user_id = withdraw.with_user_id')->orderBy($_GET['column'], 'ASC')->get($perPage, $offset)->getResultArray();
        } else {
            $data['withdraw'] = $this->db->table('withdraw')->select('with_user_id,id,with_status,user_name,with_user_amount,withdraw.created_at')->join('user', 'user.user_id = withdraw.with_user_id')->get($perPage, $offset)->getResultArray();
        }
        $data['total'] = $this->db->table('withdraw')->countAllResults();
        $data['links'] = $pager->makeLinks($page, $perPage, $data['total']);

        return view('Admin/withdraw', $data);
    }

    public function msgs()
    {
        $perPage = 20;
        if (isset($_GET['count'])) {
            $perPage = $_GET['count'];
        }
        $pager = service('pager');
        $page = (@$_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;
        if (isset($_GET['column'])) {
            $data['messages'] = $this->db->table('messages')->where('replied','0')->where('msg_from','USER')->select('messages.id,user_name,msg_user_id,msg,messages.created_at')->join('user', 'user.user_id = messages.msg_user_id')->orderBy($_GET['column'], 'ASC')->get($perPage, $offset)->getResultArray();
        } else {
            $data['messages'] = $this->db->table('messages')->where('replied','0')->where('msg_from','USER')->select('messages.id,user_name,msg_user_id,msg,messages.created_at')->join('user', 'user.user_id = messages.msg_user_id')->get($perPage, $offset)->getResultArray();
        }
        $data['total'] = $this->db->table('messages')->countAllResults();
        $data['links'] = $pager->makeLinks($page, $perPage, $data['total']);

        return view('Admin/msg', $data);
    }

    public function withdraw_status()
    {
        $data = array(
            'with_status' => $_POST['status']
        );

        if($_POST['status'] == 'COMPLETED'){
            $msg = 'Your withdrawal is completed';
        }else{
            $msg = 'Your withdrawal is rejected';
        }

        $data2 = array(
            'msg_from' => 'ADMIN',
            'msg_user_id' => $_POST['userid'],
            'msg' => $msg,
        );
        
        $this->db->table('messages')->set($data2)->insert();

        if ($this->db->table('withdraw')->set($data)->where('id', $_POST['id'])->update()) {
            $json['result'] = 200;
        }else{
            $json['result'] = 400;
        }
        return $this->response->setJSON($json);
    }

    public function reply_to_user(){
        $data = array(
            'msg_user_id' => $_POST['userid'],
            'msg_from' => 'ADMIN',
            'replied' => '0',
            'msg' => $_POST['msg']
        );

        if ($this->db->table('messages')->insert($data)) {
            $json['result'] = 200;
        }else{
            $json['result'] = 400;
        }

        $this->db->table('messages')->set(['replied' => '1'])->where('id',$_POST['msgid'])->update();
        return $this->response->setJSON($json);
    }
}
