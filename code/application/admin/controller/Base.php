<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Admin as Model;

class Base extends Controller
{
    protected $currentAdmin = null;
    protected function initialize()
    {
        $this->__init();
    }
    public function __init()
    {
        
        // session读取
        $admin_id = session('user_id');
        if(!$admin_id) {
            return $this->error('Please Login Firstly!', 'user/index/login');
        }
        $this->currentAdmin = Model::get($admin_id);
    }   
}
