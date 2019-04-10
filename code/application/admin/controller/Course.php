<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Course as Model;
use app\common\model\Teacher;

class Course extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // $course = Model::get(1);
        // // 找到课程所叫的老师
        // $teachers = $course->teachers;
        // foreach($teachers as $teacher) {
        //     echo $teacher->username;
        //     //dump($teacher);
        // }
        // die;

        $all = Model::all();
        $assign = [];
        $assign['teachers'] = $all;

        $assign['choices'] = Teacher::all();
        return $this->fetch('', $assign);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return $this->fetch('');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        // $input = $request->param();
        // $course = new Model();
        // $course->data([
        //     'name' => 'PHP',
        //     'introduction' => 'Learn PHP',
        //     'picture' => '/course/php.jpg'
        // ]);
        // $course->save();
        $data = [];
        $data = $request->param();
        $data['picture'] = deal_upload('course', 'picture');
        $course = new Model();
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
            return $this->error('there is no such course!');
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
        $student = Model::get($id);
        $data = [];
        $data = $request->param();
        $photo = deal_upload('course', 'picture');
        if($photo) {
            $data['picture'] = $photo;
        }
       // $data['photo'] = deal_upload('teacher', 'photo');
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

    /**
     * 分配教师
     */
    public function assignTeacher(Request $request, $course_id)
    {
        $teacher_ids = $request->param('teacher_ids/a');
        
    }
}
