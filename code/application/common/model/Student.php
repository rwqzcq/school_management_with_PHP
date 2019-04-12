<?php

namespace app\common\model;

use think\Model;

class Student extends Model
{
    public function getGenderAttr($value)
    {
        return ['1' => 'male', '2' => 'female'][$value];
    }
    public function classes()
    {
        return $this->belongsTo('app\common\model\Classes', 'class_id');
    }
    public function grades()
    {
        return $this->hasMany('app\common\model\Grade', 'sid');
    }
    public function awards()
    {
        return $this->belongsToMany('app\common\model\Award', 'app\common\model\AwardStudent', 'aid', 'sid');
        // return $this->hasMany('app\common\model\Award', 'sid');
    }
    /**
     * 查询某一个学生某个课程的成绩
     */
    public function getCourseGrade($sid, $cid)
    {
        $course = self::get($sid);
        return $course->grades()->where('cid', $cid)->find();
    }
    
}
