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

namespace app\api\logic;
use app\api\service\ApiPayment;
use app\common\library\exception\OrderException;
use think\Exception;
use think\Log;

/**
 * 支付处理类  （优化方案：提出单个支付类  抽象类对象处理方法 便于管理）
 *
 * 
 *
 */
class DoPay extends BaseApi
{
    /**
     *
     * 
     *
     * @param $orderNo
     *
     * @return mixed
     * @throws \Exception
     */
    public function pay($orderNo)
    {
        //检查支付状态
        $order = $this->modelOrders->checkOrderValid($orderNo);

        //创建支付预订单
        return $this->prePayOrder($order);
    }


    /**
     *
     * 
     *
     * @param $order
     *
     * @return mixed
     * @throws OrderException
     */
    private function prePayOrder($order){
        //渠道和参数获取
        $appChannel = $this->logicPay->getAllowedAccount($order);
        if (isset($appChannel['errorCode'])){
            Log::error($appChannel['msg']);
            throw new OrderException($appChannel);
        }

        //取出数据
        list($payment,$action,$config) = array_values($appChannel);

        //支付分发
        $result = ApiPayment::$payment($config)->$action($order);

        return $result;
    }
}