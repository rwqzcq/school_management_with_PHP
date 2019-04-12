<?php

namespace app\common\model;

use think\Model;

class Teacher extends Model
{
    public function getGenderAttr($value)
    {
        return ['1' => 'male', '2' => 'female'][$value];
    }
    public function classes()
    {
        return $this->belongsTo('app\common\model\Classes', 'class_id');
    }
    // 定义多对多关联
    public function courses()
    {
        //return $this->hasOne('app\common\model\CourseTeacher', 'tid', 'id');
        return $this->belongsToMany('app\common\model\Course', 'app\common\model\CourseTeacher', 'cid', 'tid');
    }
}
