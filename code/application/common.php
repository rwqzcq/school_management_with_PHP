<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function deal_upload($model_name, $key = 'photo') {
    $file = request()->file($key);
    $info = $file->move( '../public/uploads/' . $model_name);
    if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
        // echo $info->getExtension();
        // // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        // echo $info->getSaveName();
        // // 输出 42a79759f284b767dfcb2a0197904287.jpg
        // echo $info->getFilename(); 
        return $model_name . '/'.$info->getSaveName();
    }else{
        // 上传失败获取错误信息
        echo $file->getError();
        die;
    }
}