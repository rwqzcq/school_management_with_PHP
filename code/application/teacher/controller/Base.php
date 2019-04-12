<?php

namespace app\teacher\controller;

use think\Controller;
use think\Request;
use app\common\model\Teacher as Model;

class Base extends Controller
{
    protected $currentTeacher = null;
    protected function initialize()
    {
        $this->__init();
    }
    public function __init()
    {
        
        // session读取
        $teacher_id = session('user_id');
        if(!$teacher_id) {
            return $this->error('Please Login Firstly!', 'user/index/login');
        }
        $this->currentTeacher = Model::get($teacher_id);
    }
}
