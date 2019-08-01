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

class Admin extends BaseAdmin
{
    /**
     * 管理员列表
     *
     * 
     *
     * @return mixed
     */
    public function index(){
        $this->userCommon();
        return $this->fetch();
    }

    /**
     * 获取管理员列表
     *
     * 
     *
     */
    public function userList(){
        $where = [];

        //组合搜索
        !empty($this->request->param('id')) && $where['id']
            = ['eq', $this->request->param('id')];

        !empty($this->request->param('username')) && $where['username']
            = ['like', '%'.$this->request->param('username').'%'];

        !empty($this->request->param('email')) && $where['email']
            = ['like', '%'.$this->request->param('email').'%'];

        !empty($this->request->param('role')) && $where['id']
            = ['eq', $this->request->param('role')];

        $data = $this->logicAdmin->getAdminList($where,true,'id asc',false);

        $count = $this->logicAdmin->getAdminCount($where);

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
     * 管理员添加
     *
     * 
     *
     * @return mixed
     */
    public function userAdd()
    {
        $this->userCommon();
        $this->request->isPost() && $this->result($this->logicAdmin->seveAdminInfo($this->request->post()));

        return $this->fetch('user_add');
    }

    /**
     *
     * 
     *
     * @return mixed
     */
    public function userEdit()
    {

        $this->request->isPost() && $this->result($this->logicAdmin->seveAdminInfo($this->request->post()));

        $this->assign('info',$this->logicAdmin->getAdminInfo(['id' => $this->request->param('id')]));

        return $this->fetch('user_edit');
    }

    /**
     * 管理授权
     *
     * 
     *
     * @return mixed
     */
    public function userAuth()
    {
        $this->userCommon();

        $this->request->isPost() && $this->result($this->logicAdmin->userAuth($this->request->post()));

        $this->assign('id', $this->request->param('id'));


        return $this->fetch();
    }

    /**
     * 管理员删除
     *
     * 
     *
     * @param int $id
     */
    public function userDel($id = 0)
    {
        $this->result($this->logicAdmin->userDel(['id' => $id]));
    }

    /**
     * 权限组列表
     *
     * 
     *
     * @return mixed
     */
    public function group()
    {
        return $this->fetch();
    }

    /**
     * 获取权限组列表
     *
     * 
     *
     */
    public function groupList()
    {
        $where = [];

        $data = $this->logicAuthGroup->getAuthGroupList($where);

        $count = $this->logicAuthGroup->getAuthGroupCount($where);

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
     * 权限组添加
     *
     * 
     *
     * @return mixed
     */
    public function groupAdd()
    {

        $this->groupCommon();

        return $this->fetch('group_add');
    }

    /**
     * 权限组编辑
     */
    public function groupEdit()
    {
        $this->groupCommon();

        $this->assign('info', $this->logicAuthGroup->getGroupInfo(['id' => $this->request->param('id')]));

        return $this->fetch('group_edit');
    }

    /**
     * 权限组删除
     *
     * 
     *
     * @param int $id
     */
    public function groupDel($id = 0)
    {

        $this->result($this->logicAuthGroup->groupDel(['id' => $id]));
    }


    /**
     * 菜单授权
     *
     * 
     *
     * @return mixed
     */
    public function menuAuth()
    {

        $this->request->isPost() && $this->result($this->logicAuthGroup->setGroupRules($this->request->post()));

        $this->assign('id', $this->request->param('id'));

        return $this->fetch();
    }

    /**
     * 获取权限菜单
     *
     * 
     *
     */
    public function getAuthMenu(){

        $data = [
            'list' =>  $this->logicMenu->getMenuList([],'id,pid,name'),
            'checked' => str2arr($this->logicAuthGroup->getGroupRules(['id'=>$this->request->param('id')],'rules')),
        ];

        $this->result($data || !empty($data) ?
            [
                'code' => CodeEnum::SUCCESS,
                'msg'=> '',
                'data'=>$data
            ] : [
                'code' => CodeEnum::ERROR,
                'msg'=> '暂无数据',
                'data'=>$data
            ]
        );
    }

    /**
     * 管理员
     *
     * 
     *
     */
    private function userCommon(){
        $this->assign('auth',$this->logicAuthGroup->getAuthGroupList());
    }


    /**
     * 权限组
     *
     * 
     *
     */
    private function groupCommon(){
        $this->request->isPost() && $this->result($this->logicAuthGroup->saveGroupInfo($this->request->post()));
    }
}