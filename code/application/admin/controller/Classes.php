<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Classes as Model;

class Classes extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $all = Model::all();
        $assign = [];
        $assign['classes'] = $all;
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
        $name = $request->param('name');
        //$name = "class01";
        $classes =  new Model();
        // 查询
        $r = $classes->where('name', $name)->find();
        if($r) {
            return $this->error('the class has been added!');
        } else {
            $classes->name = $name;
            $classes->save();
            return $this->redirect('index');
        }
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
        $student = Model::get($id);
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
        Model::destroy($id);
        return $this->redirect('index');
    }
}
