<?php
namespace Test;
use Container\Container;

require_once __DIR__."/../vendor/autoload.php";

class SendSms
{
    public $email;

    public function __construct(SendEmail $email)
    {
        $this->email = $email;
    }

    public function send()
    {
        echo "sms send";
    }
}

$container = new Container();

//绑定邮件发送
$container->bind("Email",function (){
    return new SendEmail();
});

//绑定短信发送
//$sms = new SendSms();

$container->bind("SMS",function (){
    return new SendSms(new SendEmail());
});

//实例化
$handle = $container->make("SMS");
//$ref = new \ReflectionClass($handle);
//
//$construct = $ref->getConstructor();
//
//print_r($construct);
//
//print_r($construct->getParameters());

$handle->email->send();


