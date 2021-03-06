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

use app\common\library\enum\CodeEnum;

class Api extends BaseAdmin
{
    /**
     * 账户API
     *
     * 
     *
     * @return mixed
     */
    public function index(){
        return $this->fetch();
    }

    /**
     * API列表
     *
     * 
     *
     */
    public function getList(){
        $where = [];
        //组合搜索
        !empty($this->request->param('uid')) && $where['uid']
            = ['eq', $this->request->param('uid')];

        $data = $this->logicApi->getApiList($where, '*', 'create_time desc', false);

        $count = $this->logicApi->getApiCount($where);

        $this->result($data || !empty($data) ?
            [
                'code' => CodeEnum::SUCCESS,
                'msg'=> '',
                'count'=>$count,
                'data'=>$data
            ] : [
                'code' => CodeEnum::ERROR,
                'msg'=> '暂无数据',
                'count'=>$count,
                'data'=>$data
            ]
        );
    }

    /**
     * 编辑商户API信息
     *
     * 
     *
     * @return mixed
     */
    public function edit(){
        // post 是提交数据
        $this->request->isPost() && $this->result($this->logicApi->editApi($this->request->post()));
        //获取商户API信息
        $this->assign('api',$this->logicApi->getApiInfo(['id' =>$this->request->param('id')]));

        return $this->fetch();
    }

}