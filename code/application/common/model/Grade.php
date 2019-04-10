<?php

namespace app\common\model;

use think\Model;

class Grade extends Model
{
    public function Course()
    {
        return $this->belongsTo('app\common\model\Course', 'cid', 'id');
    }
}
