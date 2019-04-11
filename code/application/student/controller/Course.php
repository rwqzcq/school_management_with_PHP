<?php

namespace app\student\controller;

use think\Request;
use app\student\controller\Base;
use app\common\model\Course as Model;
use app\common\model\Grade;

class Course extends Base
{
    /**
     * 查看课程和成绩
     *
     * @return \think\Response
     */
    public function index()
    {
        if(request()->has('name') && trim(request()->param('name')) != '') {
            $name = request()->param('name');
            $courses = Model::where('name', 'like', '%'.$name.'%')->select(); // 所有课程
        } else {
            // 关联查询所有的课程以及成绩
            $courses = Model::all(); // 所有课程
        }       
        foreach ($courses as &$course) {
           // 已经提交的不能再提交
           $grades = $course->grades()->where('sid', $this->currentStudent->id)->find();
           if(!$grades) {
            $course->haveGrade = false;
           } else {
            $course->haveGrade = $grades->score;
            $course->currentStudentGrade = $grades;
            $course->comment = $grades->comment;
           }
           
        }
        $assign = [];
        $assign['courses'] = $courses;
        return $this->fetch('', $assign);
    }
    /**
     * 添加评价
     */
    public function feedback($grade_id, $feedback)
    {
        $grade = Grade::get($grade_id);
       // dump($grade);die;
        $grade->student_feedback = $feedback;
        $grade->save();
        return $this->success('OK!');
    }
   
}
