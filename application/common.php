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

use app\common\logic\SmsLogic;

// 应用公共文件

//ajax 返回(以字符串形式)
function ajax_return($data)
{
    //json 对象转字符串
   header('Content-Type:application/json; charset=utf-8'); //json 只支持utf8 
   exit(json_encode($data));    //json_encode($data) //对汉字进行编码
}

//检测短信发送环境
function check_send_sms(){
    
}

function send_sms($number)
{
    $smsLogic = new SmsLogic;
    return $smsLogic->sendSms($number);
}

/*
//发送短信 逻辑 状态/场景/验证码
function send_sms($scene,$params,$code)
{
    $smsLogic = new SmsLogic;
    return $smsLogic->sendSms($scene, $params, $code);
}*/