<?php
namespace app\home\controller;

use think\Controller;
use think\captcha\Captcha;
use think\helper;

class User extends Controller
{
    //初始化工作
    public $user_id = 0;
    //注册
    public function reg()
    {
        $arr = [];
        $userarr = [];
        //如果用户已登陆需跳转
        /*
        if($this->user_id > 0)
        {
            
        }*/
        
          if(input('post.'))
          {
              $name = input('post.username');
              $email = input('post.email');
             
                     $username = db('t_user')->where('nickname',$name)->find();
                     if($username){
                          return false; //查到
                      }else{
                          return true;  //查不到
                      }
                
           }
           return $this->fetch();
         
    }
    
    //手机验证
    public function reg_phon()
    {
        if(input('post.phone_number'))
        {
            $phon = input('post.phone_number');
            $username = db('t_user')->where('mobile',$phon)->find();
            if($username){
                return false; //查到
            }else{
                return true;  //查不到
            }
        }
        return $this->fetch();
    }
    
    //验证码
    public function checkCode()
    {
        $arr = [];
        $code = input('post.code');
        if(captcha_check($code)){
            $arr['msg'] = true;
        }else{
            $arr['msg'] = false;
        }
        return $arr['msg'];
    }
    
    //验证码生成 
    public function img_code()
    {
        $captcha = new Captcha();
        return $captcha->entry();
    }

}