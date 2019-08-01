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

namespace app\common\library\enum;

/**
 * Class OrderStatusEnum
 *
 * 
 *
 */
class OrderStatusEnum
{
    // 删除
    const DELETE = -1;

    // 关闭
    const CLOSE = 0;

    // 待支付
    const UNPAID = 1;

    // 已支付
    const PAID  = 2;

}