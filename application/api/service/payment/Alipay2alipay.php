<?php


namespace app\api\service\payment;


use app\api\service\ApiPayment;
use app\common\library\exception\OrderException;
use app\common\logic\Qrcode;
use think\Log;
//use Endroid\QrCode\QrCode;
use app\common\logic\Orders;
//use app\common\model\Qrcode ;

class Alipay2alipay extends ApiPayment
{
    public function alipay2alipay($order){
        return $this->request($order);
    }

    public function request($order){
        $qrcodeC = new Qrcode();
        $qrcode = $qrcodeC->getOneQrcode();

        $orders = new Orders();
        $data['qrcode_username'] = $qrcode['uname'] ;
        $orders->update($data,['id' => $order['id']]);

        $host = 'http://'. $_SERVER["HTTP_HOST"] ;

//
//        $str = 'alipays://platformapi/startapp?appId=09999988&actionType=toAccount&goBack=NO&amount='.$order['amount'].'&userId=2088102622931941&memo='.$order['out_trade_no'];
//
//        $savePath = APP_PATH . '../public/qrcode/qrcode.png';
//        $qrCode = new QrCode($str);
//        $qrCode->writeFile($savePath);
//        $picurl = 'http://'.$_SERVER["HTTP_HOST"].'/qrcode/qrcode.png';

        return [
            'qrcode'  => $qrcode['qrcode_url']
        ];
    }
}