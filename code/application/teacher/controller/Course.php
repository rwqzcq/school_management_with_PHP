<?php

namespace app\teacher\controller;

use app\teacher\controller\Base;
use think\Request;
use app\common\model\Course as Model;
use app\common\model\CourseTeacher as CT;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\Grade;

class Course extends Base
{
    /**
     * 查看自己教的课程
     *
     * @return \think\Response
     */
    public function index()
    {
        // 自己的课程
        $course = $this->currentTeacher->courses[0];
        // 自己所在的班级
        $class = $this->currentTeacher->classes->name;
        // 成绩列表 站在课程的角度找成绩 姓名 分数 评价 反馈 action 
        $grades = $course->grades;
        $has_socred = [];
        foreach ($grades as $grade) {
            $has_socred[] = $grade->sid;
        }
        // 学生列表
        $students = Student::where('id', 'not in', $has_socred)->select();        
        $assign = [];
        $assign['course'] = $course;
        $assign['classes'] = $class;
        $assign['grades'] = $grades;
        $assign['students'] = $students;
        return $this->fetch('', $assign);
    }
    /**
     * 给课程评分
     */
    public function putScore(Request $request)
    {
        Grade::create($request->param());
        return $this->success('OK', 'index');
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
        $student = Grade::get($id);
        //dump($student);die;
        if(!$student) {
            return $this->error('there is no such grade!');
        }
        return $this->fetch('', ['student' => $student]);
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
        $student = Grade::get($id);
        $data = [];
        $data = $request->param();
        $student->save($data,['id' => $id]);
        return $this->success('update OK!', 'index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        Grade::destroy($id);
        return $this->success('OK!', 'index');
    }
}
