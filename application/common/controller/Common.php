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

namespace app\common\controller;

use think\Controller;
use think\exception\HttpResponseException;
use think\helper\Time;
use think\Request;
use think\Response;

class Common extends Controller
{

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->initSystemConf();

        $this->assign('site', config('site'));
    }

    /**
     * 初始化配置信息
     *
     * 
     *
     *
     */
    private function initSystemConf()
    {

        $model = model('app\common\model\Config');

        $config_list = auto_cache('config_list', create_closure($model, 'all'));

        $config_array =[];
        foreach ($config_list as $info) {

            $config_array[$info['group']][$info['name']] = is_numeric($info['value'])
                ? parse_config_attr($info['extra'])[$info['value']] : $info['value'];
        }
        //写入配置  先这样吧  懒得写了
        config('site' ,$config_array[0]);
        config('email' ,$config_array[1]);

    }

    /**
     * 数据返回
     *
     * 
     *
     * @param int $code
     * @param string $msg
     * @param string $data
     * @param string $type
     * @param array $header
     */
    final protected function result($code = 0, $msg = '', $data ='', $type = 'json', array $header = [])
    {
        $result = is_array($code) ? $code : $this->parseResultArray([$code, $msg, $data]);

        $response = Response::create($result, $type)->header($header);

        throw new HttpResponseException($response);
    }

    /**
     * 解析数组
     *
     * 
     *
     * @param array $data
     * @return array
     */
    final protected function parseResultArray($data = [])
    {
        return ['code' => $data[0], 'msg' => $data[1],'data' => $data[2]];
    }

    /**
     * 解析查询请求日期
     *
     * 
     *
     * @return array
     */
    protected function parseRequestDate(){

        list($start,$end) = Time::month();
        return [
            'between',!empty($this->request->param('end'))
                ? [strtotime($this->request->param('start')), bcadd(strtotime($this->request->param('end')), 86400)]
                : [$start, $end]
        ];
    }

    /**
     * 获取逻辑层实例  --魔术方法
     *
     * 
     *
     * @param $logicName
     * @return \think\Model|\think\Validate
     */
    public function __get($logicName)
    {
        $layer = $this->getLayerPre($logicName);

        $model = sr($logicName, $layer);

        return VALIDATE_LAYER_NAME == $layer ? validate($model) : model($model, $layer);
    }

    /**
     * 获取层前缀
     *
     * 
     *
     * @param $name
     * @return bool|mixed
     */
    public function getLayerPre($name)
    {

        $layer = false;

        $layer_array = [MODEL_LAYER_NAME, LOGIC_LAYER_NAME, VALIDATE_LAYER_NAME, SERVICE_LAYER_NAME];

        foreach ($layer_array as $v)
        {
            if (str_prefix($name, $v)) {

                $layer = $v;

                break;
            }
        }

        return $layer;
    }
}