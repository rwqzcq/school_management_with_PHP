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
        $teacher_id = 2;
        $this->currentTeacher = Model::get($teacher_id);
    }
}
