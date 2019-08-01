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


class UnifiedOrder extends BaseValidate
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
        'subject'       => 'require|isNotEmpty',
        'amount'        => 'require|isNotEmpty',
        'body'          => 'require|isNotEmpty',
        'currency'      => 'require|isNotEmpty',
        'channel'       => 'require|isNotEmpty',
        'out_trade_no'  => 'require|isNotEmpty|unique:orders',
        'return_url'    => 'require|isNotEmpty',
        'notify_url'    => 'require|isNotEmpty'
    ];

    protected $message = [
        //重复订单号检验
        'out_trade_no.unique'  =>  'Create Order Error:[Repeat Order Number]'
    ];
}