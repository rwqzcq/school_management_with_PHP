<?php

namespace app\common\model;

use think\Model;

class Grade extends Model
{
    public function course()
    {
        return $this->belongsTo('app\common\model\Course', 'cid', 'id');
    }
    public function student()
    {
        return $this->belongsTo('app\common\model\Student', 'sid', 'id');
    }
}
