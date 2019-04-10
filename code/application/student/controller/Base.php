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
        $student_id = 1;
        $this->currentStudent = Model::get($student_id);
    }    
}
