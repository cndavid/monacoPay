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

namespace app\api\service\request;

use app\api\service\ApiRequest;
use think\Request;

/**
 * 网关检验抽象类
 *
 * 
 *
 * @package app\api\logic\gateway
 */
abstract class ApiCheck extends ApiRequest
{
    /**
     * 下一个check实体
     *
     * 
     *
     * @var
     */
    private $nextCheckInstance;

    /**
     * 校验方法
     *
     * 
     *
     * @param Request $request
     * @return mixed
     */
    abstract public function doCheck(Request $request);

    /**
     * 设置责任链上的下一个对象
     *
     * 
     *
     * @param ApiCheck $check
     * @return ApiCheck
     */
    public function setNext(ApiCheck $check)
    {
        $this->nextCheckInstance = $check;
        return $check;
    }

    /**
     * 启动
     *
     * 
     *
     * @param Request $request
     */
    public function start(Request $request)
    {
        $this->doCheck($request);
        // 调用下一个对象
        if (! empty($this->nextCheckInstance)) {
            $this->nextCheckInstance->start($request);
        }
    }
}
