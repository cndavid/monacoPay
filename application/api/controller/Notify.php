<?php

/**
 *  +----------------------------------------------------------------------
 *  |  [ WE CAN DO IT JUST THINK ]
 *  +----------------------------------------------------------------------
 *  | Copyright (c) 2018 http://www.monapay.com All rights reserved.
 *  +----------------------------------------------------------------------
 *  | Licensed ( https://www.apache.org/licenses/LICENSE-2.0 )
 *  +----------------------------------------------------------------------
 *  | 
 *  +----------------------------------------------------------------------
 */

namespace app\api\controller;;

use app\api\service\ApiPayment;
use app\common\controller\BaseApi;
use app\common\library\exception\ForbiddenException;
use app\common\library\exception\OrderException;
use app\common\model\Orders;
use think\Log;

class Notify extends BaseApi
{

    /**
     * 个人收款配置 【等待开发】
     *
     * 
     *
     */
    public function person($channel = 'wxpay'){

        $apiurl = $this->request->request("apiurl");
        $sign = $this->request->request("sign");

        //验证签名
        if ($sign != md5(md5($apiurl))) {
            $this->result("签名密钥不正确");
        }
        $this->result("配置成功");
        echo $channel;
    }

    /**
     * 同步回调 【不做数据处理 获取商户回调地址返回就行了】
     *
     * 
     *
     * @param string $channel
     *
     */
    public function callback($channel = 'wxpay'){
        //默认跳转
        $result['return_url'] = "https://www.monapay.com";
        //支付分发
        $result = ApiPayment::$channel()->callback();

        $this->redirect($result['return_url']);
    }

    /**
     * 统一异步通知
     *
     * 
     *
     * @param string $channel
     *
     */
    public function notify($channel = 'wxpay'){

         //支付分发
        $result = ApiPayment::$channel()->notify();

        $this->logicNotify->handle($result);

    }
}