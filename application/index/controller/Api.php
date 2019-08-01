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


use app\common\library\RsaUtils;

class Api extends Base
{

    /**
     * 接口基本
     *
     * 
     *
     * @return mixed
     */
    public function index(){
        $this->apiCommon();
        return $this->fetch();
    }

    /**
     * 可用渠道
     *
     * 
     *
     * @return mixed
     */
    public function channel(){
        $channel = $this->logicPay->getCodeList(['status' => '1'], true, 'create_time desc', 10);
        $this->assign('list',$channel);
        return $this->fetch();
    }


    /**
     * API公共
     *
     * 
     *
     */
    public function apiCommon(){
        if($this->request->isPost()){
            if ($this->request->post('u/a')['uid'] == is_login()){
                $this->result($this->logicApi->editApi($this->request->post('u/a')));
            }else{
                $this->result(0,'非法操作，请重试！');
            }
        }
        $this->assign('api',$this->logicApi->getApiInfo(['uid' => is_login()]));

        $this->assign('rsa',$this->logicConfig->getConfigInfo(['name' => 'rsa_public_key'],'value'));
    }
}