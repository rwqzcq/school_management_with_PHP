<?php

namespace app\common\model;

use think\Model;

class Classes extends Model
{   
    protected $table = 'class';
    
    public function students()
    {
        return $this->hasMany("app\common\model\Student", 'class_id');
    }
}
