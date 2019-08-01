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
use think\Request;

class Menu extends BaseAdmin
{
    /**
     * 菜单列表
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
     * 获取菜单列表
     *
     * 
     *
     */
    public function getList(){

        $data = $this->logicMenu->getMenuList([],'id,pid,name,module,url');

        $this->result($data || !empty($data) ?
            [
                'code' => CodeEnum::ERROR,
                'msg'=> '',
                'data'=>$data
            ] : [
                'code' => CodeEnum::SUCCESS,
                'msg'=> '暂无数据',
                'data'=>$data
            ]
        );
    }

    /**
     * 添加菜单
     *
     * 
     *
     * @return mixed
     */
    public function menuAdd(){

        $this->request->isPost() && $this->result($this->logicMenu->seveMenuInfo($this->request->post()));

        //获取菜单Select结构数据
        $this->getMenuSelectData();

        return $this->fetch('menu_add');
    }

    /**
     * 编辑菜单
     *
     * 
     *
     * @return mixed
     */
    public function menuEdit(){

        $this->request->isPost() && $this->result($this->logicMenu->seveMenuInfo($this->request->post()));

        //获取菜单Select结构数据
        $this->getMenuSelectData();

        $this->assign('info',$this->logicMenu->getMenuInfo(['id' => $this->request->param('id')]));

        return $this->fetch('menu_edit');
    }

    /**
     * 删除菜单
     *
     * 
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function menuDel($id = 0)
    {

        $this->result($this->logicMenu->menuDel(['id' => $id]));
    }

    /**
     * 获取菜单Select结构数据
     *
     * 
     *
     */
    public function getMenuSelectData()
    {
        $menu_select = $this->logicMenu->menuToSelect($this->authMenuTree);

        $this->assign('menu_select', $menu_select);
    }
}