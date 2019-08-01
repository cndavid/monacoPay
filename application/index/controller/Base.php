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

namespace app\index\controller;

use app\common\controller\Common;
use think\helper\Time;

class Base extends Common
{

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

        //登录判断
        !is_login() && $this->redirect(url('index/Login/login'));

        // 登录信息
        $this->assign('user_info', $this->logicUser->getUserInfo(['uid' => is_login()]));

    }

    /**
     * 是否本人操作
     *
     * 
     *
     */
    public function checkAuth(){
        if($this->request->isPost()){
            if ($this->request->post('i/a')['uid'] != is_login()){
                $this->result(0,'非法操作，请重试！');
            }
        }
    }

    /**
     * 解析查询请求日期
     *
     * 
     *
     * @return array
     */
    protected function parseRequestDate(){

        $date = $this->request->param('d/a');
        list($start,$end) = !empty($date) ?: Time::month();
        return [
            'between',!empty($date) ? [strtotime($date['start']), strtotime($date['end'])]
                : [$start, $end]
        ];
    }

}