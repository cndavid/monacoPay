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

/**
 * 登录验证器
 *
 * 
 *
 */
class Login extends BaseAdmin
{

    /**
     * 验证规则
     *
     * 
     *
     * @var array
     */
    protected $rule =   [

        'username'  => 'require',
        'password'  => 'require',
        'vercode'   => 'require|captcha',
    ];

    /**
     * 验证消息
     *
     * 
     *
     * @var array
     */
    protected $message  =   [

        'username.require'    => '用户名不能为空',
        'password.require'    => '密码不能为空',
        'vercode.require'     => '验证码不能为空',
        'vercode.captcha'     => '验证码不正确',
    ];
}
