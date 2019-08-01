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


class Password extends Base
{
    /**
     * 验证规则
     *
     * 
     *
     * @var array
     */
    protected $rule =   [
        'oldpassword'  => 'require',
        'password'   => 'require',
        'repassword' => 'require|confirm:password',
        'vercode'   => 'require|length:4,6|checkCode'
    ];

    /**
     * 验证消息
     *
     * 
     *
     * @var array
     */
    protected $message  =   [

        'oldpassword.require' => '旧密码不能为空',
        'password.require'    => '密码不能为空',
        'repassword.require'  => '重复密码不能为空',
        'repassword.confirm'  => '重复密码不正确',
        'vercode.checkCode'   => '验证码不正确',
        'vercode.require'     => '验证码不能为空',
        'vercode.length'      => '验证码位数不正确'
    ];

}