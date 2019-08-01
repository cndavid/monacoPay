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

namespace app\admin\controller;

use app\common\controller\Common;

class Login extends Common
{
    /**
     * 登录首页
     *
     * 
     *
     * @return mixed
     */
    public function index()
    {
        //登录检测
        is_admin_login() && $this->redirect(url('index/index'));

        return $this->fetch();
    }

    /**
     * 登录处理
     *
     * 
     *
     * @param string $username
     * @param string $password
     * @param string $vercode
     */
    public function login($username = '', $password = '', $vercode = '')
    {
        $this->result($this->logicLogin->dologin($username, $password, $vercode));

    }

    /**
     * 注销登录
     *
     * 
     *
     */
    public function logout()
    {
        $this->result($this->logicLogin->logout());
    }

    /**
     * 清理缓存
     *
     * 
     *
     */
    public function clearCache()
    {
        $this->result($this->logicLogin->clearCache());
    }
}
