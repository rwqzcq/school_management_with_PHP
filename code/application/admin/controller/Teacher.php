<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Teacher as Model;
use app\common\model\Classes;
use think\Db;

class Teacher extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // $all = [];
        // $all = Model::all();
        // $one = Model::get(2);
        // dump($one->classes->name);
        // echo '所教课程';
        // // 找到所教授的课程
        // $courses = $one->courses;
        // foreach($courses as $course) {
        //     echo $course->name;
        // }
        //dump($all);
        $all = Model::all();
        $assign = [];
        $assign['teachers'] = $all;
        return $this->fetch('', $assign);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        // 选择班级不能选择已经被选择的班级
        $classed = Db::table('teacher')->field('class_id')->select();
        $classed = array_column($classed, 'class_id');
        $classed = array_unique($classed);
        $classes = Classes::where('id', 'not in', $classed)->select();
        if(count($classes) == 0) { // 判断集合是否为空
            return $this->error('there is no alternative classes you can choose! Please add extra classes!');
        }
        $assign = [];
        $assign['classes'] = $classes;
        //$assign['teachers'] = $all;
        return $this->fetch('', $assign);
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
        $data['photo'] = deal_upload('teacher', 'photo');
        $course = new Model();
        $course->data($data);
        $course->save();  
        return $this->redirect('index');    

        // $data = [];
        // $input = $request->param();
        // $course = new Model();
        // $data = [
        //     'username' => 'Curry',
        //     'password' => '123456',
        //     'teacher_number' => '2000214532',
        //     'date_of_birth' => '1997-05-05',
        //     'phone_number' => '19876543092',
        //     'gender' => '1',
        //     'photo' => '/student/curry.jpg',
        //     'class_id' => 2
        // ];
        // $course->data($data);
        // $course->save();  
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
