<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Course as Model;
use app\common\model\Teacher;
use app\common\model\CourseTeacher as CT;
use think\Db;

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
        // 教师分配
        $assigned_teachers = CT::all()->toArray();
        if(!$assigned_teachers) { // 没有老师
            $assign['choices'] = Teacher::all();
        } else {
            // 排除已经分配的
            $assigned_tids = array_unique(array_column($assigned_teachers, 'tid'));
            $assign['choices'] = Teacher::where('id', 'not in', $assigned_tids)->select();
        }
        return $this->fetch('', $assign);
        /**
         * 因为一个老师只能教1门课程 
         */
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
        // array_walk($arr, function (&$v, $k, $p) {$v = array_merge($v, $p);}, array('sex' => '女'));
        // dump($teacher_ids);
        $add = [];
        foreach ($teacher_ids as $tid) {
            $temp = [];
            $temp['tid'] = $tid;
            $temp['cid'] = $course_id;
            $add[] = $temp;
        }
        $ct = new CT();
        $ct->saveAll($add);
        return $this->success('OK!', 'index');
    }
    /**
     * 查看是否已经有老师被分配了课程
     */
    // public function beforeAssign($course_id)
    // {
    //     //Teacher::get();
        

    // }
    public function getAssignedTeachers($id) 
    {
        $course = Model::get($id);
        // // 找到课程所叫的老师
        $teachers = $course->teachers;
        // foreach($teachers as $teacher) {
        //     echo $teacher->username;
        //     //dump($teacher);
        // }
        if($teachers) {
            return $teachers->toJson();
        } else {
            return [];
        }
        
    }
    public function updateAssignTeachers(Request $request, $course_id) 
    {
        // $course = Model::get(1);
        // // // 找到课程所叫的老师
        // $teachers = $course->teachers;
        // // foreach($teachers as $teacher) {
        // //     echo $teacher->username;
        // //     //dump($teacher);
        // // }
        // return $course->toJson();
        $teacher_ids = $request->param('teacher_ids/a');
        // if(!$teacher_ids) {
        //     return $this->error('no teachers!');
        // } 
        // 删除原来 [1, 2] [1, 2, 3] [1,2] [1]
        //CT::where(['cid' => $course_id, 'tid' => ['in', $teacher_ids]])->delete();
        DB::table('course_teacher')->where('cid', $course_id)->delete(); // ->where('tid', 'not in', $teacher_ids)
        if(!$teacher_ids) {
            return $this->success('OK!', 'index');
        }
        // // 增加现有
        // dump($teacher_ids);
        $course = Model::get($course_id);
        $course->teachers()->attach($teacher_ids);
        // $course->teachers()->detach([10,11]);
        return $this->success('OK!', 'index');
    }
}
