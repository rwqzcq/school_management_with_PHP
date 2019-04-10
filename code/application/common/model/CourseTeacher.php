<?php

namespace app\common\model;
use think\model\Pivot;
/**
 * 中间表
 */
class CourseTeacher extends Pivot
{
    // public function course()
    // {
    //     return $this->hasOne('app\common\model\course', 'id', 'cid');
    // }
    // public function teacher()
    // {
    //     return $this->hasOne('app\common\model\teacher', 'tid', 'id');
    // }
}
