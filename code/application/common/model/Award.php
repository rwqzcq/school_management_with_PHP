<?php

namespace app\common\model;

use think\Model;

class Award extends Model
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = false;

    public function students()
    {
        return $this->belongsToMany('app\common\model\Student', 'app\common\model\AwardStudent', 'sid', 'aid');
    }
}
