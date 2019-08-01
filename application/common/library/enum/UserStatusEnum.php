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
 * Class UserStatusEnum
 *
 * 
 *
 */
class UserStatusEnum
{
    // 删除
    const DELETE = -1;

    // 等待激活
    const WAIT = 0;

    // 可用
    const ENABLE = 1;

    // 禁用
    const DISABLE = 2;
}