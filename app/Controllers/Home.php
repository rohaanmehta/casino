<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function view()
    {
        $data['last_roll'] = $this->db->table('rolls')->select('dice1,dice2')->orderBy('id','desc')->limit(1)->get()->getResultArray();
        // echo'<pre>';print_r($last_roll);exit;
        return view('index',$data);
    }
}
