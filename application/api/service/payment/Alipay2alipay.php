<?php


namespace app\api\service\payment;


use app\api\service\ApiPayment;
use app\common\library\exception\OrderException;
use think\Log;
use Endroid\QrCode\QrCode;

class Alipay2alipay extends ApiPayment
{
    public function alipay2alipay($order){

        return $this->request($order);
    }

    public function request($order){
        $str = 'alipays://platformapi/startapp?appId=09999988&actionType=toAccount&goBack=NO&amount='.$order['amount'].'&userId=2088102622931941&memo='.$order['out_trade_no'];

        $savePath = APP_PATH . '../public/qrcode/qrcode.png';
        $qrCode = new QrCode($str);
        $qrCode->writeFile($savePath);
        $picurl = 'http://'.$_SERVER["HTTP_HOST"].'/qrcode/qrcode.png';

        return [
            'qrcode'  => $picurl
        ];
    }
}