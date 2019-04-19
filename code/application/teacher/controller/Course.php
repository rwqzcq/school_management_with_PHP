<?php

namespace app\teacher\controller;

use app\teacher\controller\Base;
use think\Request;
use app\common\model\Course as Model;
use app\common\model\CourseTeacher as CT;
use app\common\model\Teacher;
use app\common\model\Student;
use app\common\model\Grade;
use think\Db;

class Course extends Base
{
    /**
     * 查看自己教的课程
     *
     * @return \think\Response
     */
    public function index()
    {
        // 自己的课程
        $course = $this->currentTeacher->courses;
        if(count($course) == 0) {
            die('You do not have course! Please concact the manager to assign a course to you!');
        } else {
            $course = $course[0];
        }
        // $course = $this->currentTeacher->courses[0];
        // dump($this->currentTeacher->courses);
        // die;
        // 自己所在的班级
        $class = $this->currentTeacher->classes->name;
        // 成绩列表 站在课程的角度找成绩 姓名 分数 评价 反馈 action 
        $grades = $course->grades;
        $if_has_score = false;
        //if(count($grades) > 0) {
            $if_has_score = true;
            $has_socred = [];
            $total = 0;
    
            foreach ($grades as $grade) {
                $has_socred[] = $grade->sid;
                $total = $total + $grade->score;
            }
            if(count($grades) > 0) {
                $average = $total / count($grades);
            } else {
                $average = 0;
            }
            
            // 学生列表
            $students = Student::where('id', 'not in', $has_socred)->select();    
            // 查看分数段图表
            $dir_sql = 'select count(case `score` when 100 then 1 end) as `full`,
            count(case when `score` between 90 and 99 then 1 end) as `90-99`,
            count(case when `score` between 80 and 89 then 1 end) as `80-89`,
            count(case when `score` between 70 and 79 then 1 end) as `70-79`,
            count(case when `score` between 60 and 69 then 1 end) as `70-79`,
            count(case when `score`< 60 then 1 end) as `fail`
            from `grade` where cid = ' . $course->id; 
            $r = Db::query($dir_sql);
            $score_pie_data = $r[0];
            // dump($score_pie_data);
            // die;
            $json_score_pie_data = [];
            foreach ($score_pie_data as $key => $value) {
                $temp = [];
                $temp['value'] = $value;
                $temp['name'] = $key;
                $json_score_pie_data[] = $temp;
    
            }
            $json_score_pie_data = json_encode($json_score_pie_data); // 不编码中文            
        // } else {
        //     $if_has_score = false;
        // }

        // echo $json_score_pie_data;
        // die;
        $assign = [];
        $assign['course'] = $course;
        $assign['classes'] = $class;
        if($if_has_score) {
            $assign['grades'] = $grades;
            $assign['students'] = $students;
            $assign['average'] = $average;
            $assign['json_score_pie_data'] = $json_score_pie_data;
        }
        $assign['if_has_score'] = $if_has_score;
        return $this->fetch('', $assign);
    }
    /**
     * 给课程评分
     */
    public function putScore(Request $request)
    {
        Grade::create($request->param());
        return $this->success('OK', 'index');
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
        $student = Grade::get($id);
        //dump($student);die;
        if(!$student) {
            return $this->error('there is no such grade!');
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
        $student = Grade::get($id);
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
        Grade::destroy($id);
        return $this->success('OK!', 'index');
    }
}
