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


namespace app\admin\validate;

class PayCode extends BaseAdmin
{
    // 验证规则
    protected $rule = [
        'name'  => 'require',
        'code'  => 'require',
        'remarks' => 'require'
    ];

    // 验证提示
    protected $message = [
        'name.require'    => '方式名不能为空',
        'code.require'    => '方式代码不能为空',
        'remarks.require'     => '方式备注不能为空'
    ];
}