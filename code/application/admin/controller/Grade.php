<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
use app\common\model\Grade as Model;

class Grade extends Base
{
    /**
     * 查看某一门课程的成绩
     *
     * @return \think\Response
     */
    public function index($course_id)
    {
        $all = Model::where('cid', $course_id)->select();
        $assign = [];
        $assign['classes'] = $all;
        return $this->fetch('', $assign);
    }
}
