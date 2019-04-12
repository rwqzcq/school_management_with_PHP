<?php
namespace app\teacher\controller;

use think\Controller;
use think\Request;
use app\common\model\Classes;
use app\common\model\Student as S;
use app\teacher\controller\Base;

class Student extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $class_id = session('user_object')['class_id'];
        $class = Classes::get($class_id);
        $students = $class->students;

        $assign = [];
        $assign['students'] = $students;
        return $this->fetch('', $assign);
    }
    /**
     * 根据学生找到他的所有课程的成绩
     */
    public function grades($sid)
    {
        $student = S::get($sid);
        $grades = $student->grades;
        $assign = [];
        //$assign['grades'] = $grades;
        $assign['student'] = $student;
        return $this->fetch('', $assign);

    }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
