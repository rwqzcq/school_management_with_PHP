<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Student as Model;
use app\common\model\Classes;

class Student extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $all = [];
        $all = Model::all();
        //$one = Model::get(1);
        // # 找到班级
        // dump($one->classes->name);
        // //dump($all);
        // # 找到学生成绩
        // foreach($one->grades as $grade) {
        //     // 某门课程 某门成绩
        //     echo '课程名为:' . $grade->course->name . '分数为: '. $grade->score;
        // }
        return $this->fetch('index', ['students' => $all]);
    }
    /**
     * 查询某个学生某门课程的具体的数据
     */
    public function getScore($course_id)
    {
        $student = new Model();
        $student_id = 1;
        $score = $student->getCourseGrade(1, 1);
        dump($score);
    }
    /**
     * 获取所有课程的成绩
     */
    public function getAllSubjectsScore()
    {
        # 找到学生成绩
        foreach($one->grades as $grade) {
            // 某门课程 某门成绩
            echo '课程名为:' . $grade->course->name . '分数为: '. $grade->score;
        }
    }
    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $classes = Classes::all();
        return $this->fetch('', ['classes' => $classes]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = [];
        $data = $request->param();
        $data['photo'] = deal_upload('student', 'photo');
        $course = new Model();
        // $data = [
        //     'username' => 'Student_1',
        //     'password' => '123456',
        //     'student_number' => '2015214532',
        //     'date_of_birth' => '1997-05-05',
        //     'gender' => '1',
        //     'address' => 'London',
        //     'phone_number' => '15071392076',
        //     'photo' => '/student/Student_1.jpg',
        //     'class_id' => 1
        // ];
        $course->data($data);
        $course->save();  
        return $this->redirect('index');      
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
        $student = Model::get($id);
        if(!$student) {
            return $this->error('there is no such student!');
        }
        $classes = Classes::all();
        return $this->fetch('', ['student' => $student, 'classes' => $classes]);
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
        $student = Model::get($id);
        $data = [];
        $data = $request->param();
        $data['photo'] = deal_upload('student', 'photo');
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
        Model::destroy($id);
        return $this->redirect('index');
    }
}
