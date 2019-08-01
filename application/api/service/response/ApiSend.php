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

namespace app\api\service\response;
use app\api\service\ApiRespose;

/**
 * 报文通知抽象类
 *
 * @author 勇敢的小笨羊
 * @package app\logic\gateway
 */
abstract class ApiSend extends ApiRespose
{

    /**
     * 通知报文
     *
     * 
     *
     * @var
     */
    protected $payload;

    /**
     * 下一个check实体
     *
     * 
     *
     * @var
     */
    private $nextCheckInstance;

    /**
     * 构建方法
     *
     * 
     *
     * @param $chargeRespose
     * @return mixed
     */
    abstract public function doBuild($chargeRespose);

    /**
     * 设置责任链上的下一个对象
     *
     * 
     *
     * @param ApiSend $check
     * @return ApiSend
     */
    public function setNext(ApiSend $check)
    {
        $this->nextCheckInstance = $check;
        return $check;
    }

    /**
     * 启动
     *
     * 
     *
     * @param $chargeRespose
     */
    public function start($chargeRespose)
    {
        $this->doBuild($chargeRespose);
        // 调用下一个对象
        if (! empty($this->nextCheckInstance)) {
            $this->nextCheckInstance->start($chargeRespose);
        }
    }
}