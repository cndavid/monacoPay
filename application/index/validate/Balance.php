<?php/** *  +---------------------------------------------------------------------- *  |  [ WE CAN DO IT JUST THINK ] *  +---------------------------------------------------------------------- *  | Copyright (c) 2018 http://www.monapay.com All rights reserved. *  +---------------------------------------------------------------------- *  | Licensed ( https://www.apache.org/licenses/LICENSE-2.0 ) *  +---------------------------------------------------------------------- *  |  *  +---------------------------------------------------------------------- *//** * *  * * Time: 0:39 */namespace app\index\validate;class Balance extends Base{    /**     * 验证规则     *     *      *     * @var array     */    protected $rule =   [        'amount'  => 'require|between:10,1000',        'account'  => 'require',//        'vercode'  => 'require|checkCode'    ];    /**     * 验证消息     *     *      *     * @var array     */    protected $message  =   [        'amount.require'    => '输入提现金额不能为空',        'amount.between'    => '提现金额需大于10小于1000',        'account.require'     => '请选择收款账号',        'vercode.require'     => '请输入验证码',        'vercode.checkCode'     => '验证码不正确'    ];}