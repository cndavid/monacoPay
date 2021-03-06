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

namespace app\index\validate;


class Login extends Base
{
    /**
     * 验证规则
     *
     * 
     *
     * @var array
     */
    protected $rule =   [

        'username'  => 'require|email',
        'password'  => 'require|length:6,12'
    ];

    /**
     * 验证消息
     *
     * 
     *
     * @var array
     */
    protected $message  =   [

        'username.require'    => '登录名不能为空',
        'username.email'      => '登录名必须是邮箱',
        'password.require'    => '登录密码不能为空',
        'password.length'     => '登陆密码长度6-12'
    ];

}