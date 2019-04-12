<?php

namespace app\user\controller;

use think\Controller;
use think\Request;
use app\common\model\Student;
use app\common\model\Teacher;
use app\common\model\Admin;
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
                'object' => 'admin',
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
    public function logout()
    {
        session(null);
        $this->success('Logout Success!', 'user/index/login');
    }
}
