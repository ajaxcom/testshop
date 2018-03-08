<?php
namespace app\common\logic;

class SmsLogic
{
    /* 发送短信逻辑  */
    private function sendSms($sene,$params,$code)
    {
        /*后台要设置的发送类型(模板)
         $smsParams = array(
         1 => "{\"code\":\"$code\"}",                                                                          //1. 用户注册 (验证码类型短信只能有一个变量)
         2 => "{\"code\":\"$code\"}",                                                                          //2. 用户找回密码 (验证码类型短信只能有一个变量)
         3 => "{\"consignee\":\"$consignee\",\"phone\":\"$mobile\"}",                                          //3. 客户下单
         4 => "{\"orderId\":\"$order_id\"}",                                                                   //4. 客户支付
         5 => "{\"userName\":\"$user_name\",\"consignee\":\"$consignee\"}",                                    //5. 商家发货
         6 => "{\"code\":\"$code\"}",
         );
         */
        
        /* 提取短信内容  */
        
        /* 发送  */
        //return sendSmsByAlidayu();
    }
    
    /* 发送短信(阿里大鱼) */
    private function sendSmsByAlidayu($mobil,$smsSign,$smsParam,$templateCode)
    {
        include_once './vendor/aliyun-php-sdk-core/Config.php';
        include_once './vendor/Dysmsapi/Request/V20170525/SendSmsRequest.php';
        
        $accessKeyId     = 'LTAI7jRDKFopjK8n';                   //$this->config['sms_appkey'];
        $accessKeySecret = 'KbejuGzONzpg4N4fSS6tMA2QXT5vAW';     //$this->config['sms_secretKey'];
        
        //短信API产品名
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-hangzhou";

        //初始化访问的acsCleint
        $profile = \DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        \DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", $product, $domain);
        $acsClient= new \DefaultAcsClient($profile);

        $request = new \Dysmsapi\Request\V20170525\SendSmsRequest;
        //必填-短信接收号码
        $request->setPhoneNumbers($mobile);
        //必填-短信签名
        $request->setSignName($smsSign);
        //必填-短信模板Code
        $request->setTemplateCode($templateCode);
        //选填-假如模板中存在变量需要替换则为必填(JSON格式)
        $request->setTemplateParam($smsParam);
        //选填-发送短信流水号
        //$request->setOutId("1234");

        //发起访问请求
        $resp = $acsClient->getAcsResponse($request);
        
        //短信发送成功返回True，失败返回false
        if ($resp && $resp->Code == 'OK') {
            return array('status' => 1, 'msg' => $resp->Code);
        } else {
            return array('status' => -1, 'msg' => $resp->Message . '. Code: ' . $resp->Code);
        }
    }
}