<?php

namespace app\common\model;

use think\Model;
/**
 * course表映射
 */
class Course extends Model
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = false;

    public function teachers()
    {
        // 关联模型 中间表 关联的外键 本表的外键
        return $this->belongsToMany('app\common\model\Teacher', 'app\common\model\CourseTeacher', 'tid', 'cid');
    }

    public function grades()
    {
        return $this->hasMany('app\common\model\Grade', 'cid', 'id');
    }
}
