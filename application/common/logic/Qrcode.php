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

namespace app\common\logic;
use app\common\library\exception\OrderException;
use think\Db;
use think\Log;

class Qrcode extends BaseLogic
{

    /**
     * 获取所有支持Qrcode
     *
     * 
     *
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int $paginate
     * @return mixed
     */
    public function getQrcodeList($where = [], $field = true, $order = 'create_time desc',$paginate = 15){
        return $this->modelQrcode->getList($where,$field, $order, $paginate);
    }
    /**
     * 所有支持Qrcode总数
     *
     * 
     *
     * @param $where
     * @return mixed
     */
    public function getQrcodeCount($where = []){
        return $this->modelQrcode->getCount($where);
    }



    /**
     * 获取所有支持Qrcode
     *
     * 
     *
     * @param array $where
     * @param bool $field
     * @return mixed
     */
    public function getQrcodeInfo($where = [], $field = true){
        return $this->modelQrcode->getInfo($where,$field);
    }

    public function saveQrcodeInfo($qrcodeData)
    {

        try {
        $qrcode = new Qrcode();
        $qrcode->uname = $qrcodeData['name']; //商户ID
        $qrcode->qrcode_url = $qrcodeData['qrcode_url'];//支付项目
        $qrcode->status = $qrcodeData['status'];//支付具体内容

        $qrcode->save();

        return [ 'code' => 1, 'msg' => '添加成功','data' => $qrcode];

        }catch (\Exception $e){
            //记录日志
            Log::error("Create Order Error:[{$e->getMessage()}]");
        }
    }

}