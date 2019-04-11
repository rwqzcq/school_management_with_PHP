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
        $awards = Model::all();
        $assign = [];
        $assign['awards'] = $awards;
        return $this->fetch('', $assign);
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
        $data = [];
        $data = $request->param();
        $course = new Model();
        $course->data($data);
        $course->save();  
        return $this->success('OK', 'index'); 
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
        return $this->success('OK!', 'index');
    }

    /**
     * 获奖记录
     */
    public function detail($aid)
    {
        $award = Model::get($aid);
        $students = Model::get($aid)->students;
        // foreach ($students as $student) {
        //     echo $student->username;
        // }
        // assign
        $assign = [];
        $assign['award'] = $award;
        return $this->view->fetch('', $assign);
    }
    /**
     * 颁奖学生页面
     */
    public function putStudentPage($aid)
    {
        // 找到班级内的学生
        $class = $this->currentTeacher->classes;
        $students = $class->students;
        $student_ids = array_column($students->toArray(), 'id');
        // 找到针对这个奖项还没有颁奖的人
        $records = AwardStudent::where('aid', $aid)->select();
        //dump($records);
       // $final_ids = [];
        if(count($records) > 0) {
            $have_student_ids = array_column($records->toArray(), 'sid');
            //$final_ids = 
            $final_students = $class->students()->where('id', 'not in', $have_student_ids )->select();
            if(count($final_students) == 0) {
                return $this->error('there is no alternative students you can assign!');
            }
        } else {
            $final_students = $students;
        }
        // 找到奖项
        $award = Model::get($aid);

        $assign = [];
        $assign['students'] = $final_students;
        $assign['award'] = $award;
        return $this->fetch('assign_s', $assign);
    }

    /**
     * 给某个学生颁奖
     */
    public function putStudent(Request $request)
    {
        $aid = $request->param('aid');
        $sids = $request->param('sids/a');

        $if = AwardStudent::all(function($query)use($aid, $sids){
            return $query->where(['aid' =>  $aid])->whereIn('sid', [$sids]); // , 'sid' => ['in', $sids]
        });
        if(count($if) > 0) {
            //dump($if);
            return $this->error('there are some students that have been assigned');
        } else {
            $data = [];
            foreach ($sids as $sid) {
                $temp = [];
                $temp['aid'] = $aid;
                $temp['sid'] = $sid;
                $data[] = $temp;
            }
            $as = new AwardStudent;
            $as->saveAll($data);
            return $this->success('Ok!', 'index');
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
        if(count($if) == 0) {
            return $this->error('the student have not  been assigned');
        } else {
            $if->delete();
            return $this->success('OK!');
        }
    }

}
