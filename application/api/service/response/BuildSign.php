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

use app\common\library\HttpHeader;
use think\Log;

class BuildSign extends ApiSend
{

    /**
     * 数据签名
     *
     * 
     *
     * @param $payload
     *
     * @return mixed|void
     * @throws \app\common\library\exception\ParameterException
     */
    public function doBuild($payload)
    {
        $_to_sign_data = utf8_encode(self::get(HttpHeader::X_CA_NONCE_STR))
            ."\n" . utf8_encode(self::get(HttpHeader::X_CA_TIMESTAMP))
            ."\n" . utf8_encode(json_encode(static::get('ApiResposeData')));

        //生成签名并记录本次签名上下文
        self::set(HttpHeader::X_CA_SIGNATURE, self::sign(base64_encode($_to_sign_data)));
    }

}