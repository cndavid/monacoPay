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
use app\common\library\exception\ForbiddenException;
use think\Cache;
use think\Log;
use think\Request;

/**
 * 检验接口访问频率
 *
 * 
 *
 */
class CheckFrequent extends ApiCheck
{
    /**
     * 限定时间段
     *
     * 单位：seconds
     *
     * 
     *
     * @var int
     */
    private $timeScope = 1;

    /**
     * 限定次数
     *
     * 
     *
     * @var int
     */
    private $times = 10;

    /**
     *
     * 
     *
     * @param Request $request
     * @return mixed|void
     * @throws ForbiddenException
     */
    public function doCheck(Request $request)
    {
        $key = 'ClientIp:' . $request->ip();
        $cache = Cache::store('redis');
        $value = $cache->get($key);
        if (!$value) {
            $cache->set($key, 0, $this->timeScope);
        }
        if ($value >= $this->times) {
            Log::error($key . '[ Trigger Restriction And Flow Control.]');
            throw new ForbiddenException([
                'msg' => "Invalid Request.[ Trigger Restriction And Flow Control.]",
                'errorCode' => 100003
            ]);
        }
        $cache->inc($key);
    }
}
