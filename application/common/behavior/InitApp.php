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

namespace app\common\behavior;

use think\Request;

/**
 * 应用初始化基础信息行为
 *
 * 
 *
 */
class InitApp
{

    /**
     * 初始化行为入口
     *
     * 
     *
     */
    public function run()
    {
        // 初始化分层名称常量
        $this->initLayerConst();
    }

    /**
     * 初始化分层名称常量
     *
     * 
     *
     */
    private function initLayerConst()
    {

        define('LOGIC_LAYER_NAME'       , 'logic');
        define('MODEL_LAYER_NAME'       , 'model');
        define('SERVICE_LAYER_NAME'     , 'service');
        define('CONTROLLER_LAYER_NAME'  , 'controller');
        define('LIBRARY_LAYER_NAME'     , 'library');
        define('VALIDATE_LAYER_NAME'    , 'validate');
        define('VIEW_LAYER_NAME'        , 'view');

    }

}
