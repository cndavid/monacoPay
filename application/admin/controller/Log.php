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

class Log extends BaseAdmin
{

    /**
     * 管理行为日志
     *
     * 
     *
     * @return mixed
     */
    public function index(){


        return $this->fetch();
    }

    /**
     * 获取管理日志记录
     *
     * 
     *
     */
    public function getList(){

        $where = [];
        //组合搜索
        !empty($this->request->param('uid')) && $where['uid']
            = ['eq', $this->request->param('uid')];

        !empty($this->request->param('module')) && $where['module']
            = ['like', '%'.$this->request->param('module').'%'];

        //时间搜索  时间戳搜素
        $where['create_time'] = $this->parseRequestDate();

        $data = $this->logicLog->getLogList($where, true, 'create_time desc', false);

        $count = $this->logicLog->getLogCount($where);

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
     * 日志删除
     */
    public function logDel($id = 0)
    {
        $this->result($this->logicLog->logDel(['id' => $id]));
    }

    /**
     * 日志清空
     */
    public function logClean()
    {
        $this->result($this->logicLog->logDel(['status' => '1']));
    }

}