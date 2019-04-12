<?php

namespace app\student\controller;

use think\Controller;
use think\Request;
use app\common\model\Student as Model;

class Base extends Controller
{
    protected $currentStudent = null;
    protected function initialize()
    {
        $this->__init();
    }
    public function __init()
    {
        
        // session读取
        $student_id = session('user_id');
        if(!$student_id) {
            return $this->error('Please Login Firstly!', 'user/index/login');
        }
        $this->currentStudent = Model::get($student_id);
    }
}
