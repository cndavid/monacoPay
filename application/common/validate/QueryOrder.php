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

namespace app\common\validate;


class QueryOrder extends BaseValidate
{
    /**
     * API数据规则
     *
     * 
     *
     * @var array
     */
    protected $rule = [
        'mchid'         => 'require|isNotEmpty|checkId|isPositiveInteger',
        'channel'       => 'require|isNotEmpty',
        'out_trade_no'  => 'require|isNotEmpty',
    ];
}