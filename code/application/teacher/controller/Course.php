<?php

namespace app\teacher\controller;

use app\teacher\controller\Base;
use think\Request;
use app\common\model\Course as Model;
use app\common\model\CourseTeacher as CT;
use app\common\model\Teacher;

class Course extends Base
{
    /**
     * 查看自己教的课程
     *
     * @return \think\Response
     */
    public function index()
    {

        $courses = $this->currentTeacher->courses;



    }
    /**
     * 给课程评分
     */
    public function putGrade()
    {
        
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
