<?php
namespace app\home\controller;

use think\Controller;
use think\helper;

class Api extends Controller
{
    //短信 公用
    public function send_validate_code()
    {
        if(input('param.')){
            $number = input('post.number');
            
            $Sms_code = new \SmsDemo();
            $flag = $Sms_code->sendSms($number);
            return $flag;
        }
        
        
       /*
       if(input('param.'))
       {
           //场景
           $scene = input('post.scene');
           $pc_reg = input('post.pc_reg');
           $number = input('post.number');
           
           if($scene !=1 || $pc_reg != "pc_reg"){
               ajax_return(array('static'=>-1,'msg'=>"不知名的错误"));
           }else{
               //检测发送环境 check_send_sms()
                
               //判断数据库是否存在验证码
               
               //120s内不可发送
               
               //随机一个验证码
               $code = rand(1111,9999);
               
               //发送短信   $scene $pc_reg $code
               //$resms = send_sms($scene,$pc_reg,$code);
                $resms = send_sms($number);
           }
               
       }
       */
    }
}