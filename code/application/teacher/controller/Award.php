<?php

namespace app\teacher\controller;

use think\Controller;
use think\Request;
use app\teacher\controller\Base;
use app\common\model\Award as Model;
use app\common\model\AwardStudent;

class Award extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        Model::all();
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
        $data = [
            'name' => 'pretty girl',
            'introduction' => 'this is tha award that is for all of you!'
        ];
        $model = new Model();
        $model->data($data);
        $model->save();
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

    /**
     * 获奖记录
     */
    public function detail($aid)
    {
        $students = Model::get($aid)->students;
        foreach ($students as $student) {
            echo $student->username;
        }
        // assign
    }
    /**
     * 给某个学生颁奖
     */
    public function putStudent($aid, $sid)
    {
        // $aid = 1;
        // $sid = 2;
        $if = AwardStudent::get(function($query)use($aid, $sid){
            return $query->where(['aid' =>  $aid, 'sid' => $sid]);
        });
        if($if) {
            echo '已经存在';
        } else {
            AwardStudent::create(['aid' => $aid, 'sid' => $sid]);
        }
    }
    /**
     * 撤回颁奖 删除
     */
    public function deleteStudent($aid, $sid)
    {
        $if = AwardStudent::get(function($query)use($aid, $sid){
            return $query->where(['aid' =>  $aid, 'sid' => $sid]);
        });
        if(!$if) {
            echo '不存在';
        } else {
            $if->delete();
        }
    }

}
