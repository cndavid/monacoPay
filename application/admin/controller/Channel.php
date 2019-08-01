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

class Channel extends BaseAdmin
{
    /**
     * 支付渠道
     *
     * 
     *
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 支付渠道列表
     * @url getList?page=1&limit=10
     * 
     *
     */
    public function getList(){

        $where = [];
        //组合搜索
        !empty($this->request->param('keywords')) && $where['id|name']
            = ['like', '%'.$this->request->param('keywords').'%'];
        $this->result($this->logicChannel->getChannelAll($where,true, 'create_time desc',false));
    }
    /**
     * 新增支付渠道
     *
     * 
     *
     * @return mixed
     */
    public function add()
    {
        // post 是提交数据
        $this->request->isPost() && $this->result($this->logicChannel->addChannel($this->request->post()));

        return $this->fetch();
    }

    /**
     * 编辑支付渠道
     *
     * 
     *
     * @return mixed
     */
    public function edit(){
        // post 是提交数据
        $this->request->isPost() && $this->result($this->logicChannel->editChannel($this->request->post()));

        //获取渠道详细信息
        $this->assign('channel',$this->logicChannel->getChannelInfo(['id' =>$this->request->param('id')]));

        return $this->fetch();
    }

    /**
     * 删除渠道
     *
     * 
     *
     */
    public function del(){
        // post 是提交数据
        $this->request->isPost() && $this->result(
            $this->logicChannel->delChannel(
                [
                    'id' => $this->request->param('id')
                ])
        );

        // get 直接报错
        $this->error('未知错误');
    }

}
