<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use app\common\model\Student;
use app\common\model\Teacher;
use app\common\model\Admin;
use app\common\model\Classes;
use think\Db;
use think\facade\Session;

class Index extends Controller
{
    public function login() 
    {
        return $this->view->fetch();
    }
    public function doLogin(Request $request)
    {
        $role = $request->param('role');
       // $model = new $role;
        $config = [
            'Student' => [
                'id' => 'student_number',
                'object' => 'student',
                'redirect_url' => 'student/course/index',
                ],
            'Teacher' => [
                'id' => 'teacher_number',
                'object' => 'teacher',
                'redirect_url' => 'teacher/course/index',
            ],
            'Admin' => [
                'id' => 'username',
                'object' => 'manager',
                'redirect_url' => 'admin/course/index',
            ]
        ];
        $single_config = $config[$role];
        $data = [];
        $data[$single_config['id']] = $request->param('id');
        $data['password'] = $request->param('password');
        $user = DB::table($single_config['object'])->where($data)->find();
        if(!$user) {
            return $this->error('Please input the right data!');
        } else {
            // 存入session
            $prefix = $single_config['object'];
            Session::set('user_id', $user['id']); // 单个元组返回数组
            Session::set('user_object', $user); // $prefix . 
            Session::set('role', $role);
            //session('user_id', $user->id); //$prefix . 
            // 跳转
            return $this->success('Login Success!', $single_config['redirect_url']);
        }
    }
    /**
     * 注销
     */
    public function logout()
    {
        Session::clear();
        $this->success('Logout Success!', 'user/index/login');
    }
    /**
     * 个人信息
     */
    public function profile()
    {
        $role = Session::get('role');
        //$user_id = Session::get('user_id');
        return $this->redirect($role . 'Profile');

    }
    public function adminProfile()
    {
        $admin = Admin::get(Session::get('user_id'));
        $assign = [];
        $assign['vo'] = $admin;
        return $this->view->fetch('admin', $assign);
    }
    public function teacherProfile()
    {
        $admin = Teacher::get(Session::get('user_id'));
        $assign = [];
        $assign['vo'] = $admin;
        return $this->view->fetch('teacher', $assign);
    }
    public function studentProfile()
    {
        $admin = Student::get(Session::get('user_id'));
        $assign = [];
        $assign['vo'] = $admin;
        return $this->view->fetch('student', $assign);
    }
    public function updateAdmin(Request $request, $id)
    {
        $student = Admin::get($id);
        $data = [];
        $data = $request->param();
        //$data['photo'] = deal_upload('student', 'photo');
        $student->save($data,['id' => $id]);
        return $this->success('update OK!');
    }
    public function editStudent($id)
    {
        $student = Student::get($id);
        if(!$student) {
            return $this->error('there is no such student!');
        }
        $classes = Classes::all();
        return $this->fetch('edit_student', ['student' => $student, 'classes' => $classes]);        
    }
    public function editTeacher($id) 
    {
        $student = Teacher::get($id);
        if(!$student) {
            return $this->error('there is no such teacher!');
        }
        $classes = Classes::all();

        // // 只能调整没有的
        // $classed = Db::table('teacher')->where('id', '<>', $id)->field('class_id')->select();
        // $classed = array_column($classed, 'class_id');
        // $classed = array_unique($classed);
        // $classes = Classes::where('id', 'not in', $classed)->select();

        return $this->fetch('edit_teacher', ['student' => $student, 'classes' => $classes]);       
    }


    public function updateStudent(Request $request, $id)
    {
        $student = Student::get($id);
        $data = [];
        $data = $request->param();
        $photo = deal_upload('student', 'photo');
        if($photo) {
            $data['photo'] = $photo;
        }       
        $student->save($data,['id' => $id]);
        return $this->success('update OK!', 'profile');
    }
    public function updateTeacher(Request $request, $id)
    {
        $teacher = Teacher::get($id);
        $data = [];
        $data = $request->param();
        $photo = deal_upload('teacher', 'photo');
        if($photo) {
            $data['photo'] = $photo;
        }
        $teacher->save($data,['id' => $id]);
        return $this->success('update OK!', 'profile');
    }
}
