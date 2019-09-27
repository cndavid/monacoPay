<?phpnamespace app\index\controller;use app\common\controller\Common;use app\common\library\enum\OrderStatusEnum;use app\common\logic\Orders;use app\common\model\Qrcode;use think\Db;class UserOrder extends Common{    public function index(){        $where = ['qrcode_username' => $this->request->get('username')];        $where['status'] = ['eq', $this->request->get('status',OrderStatusEnum::UNPAID)];        $data['list_count'] = $this->logicOrders->where($where)->count();        $data['amount'] = $this->logicOrders->where(['status'=>2,'qrcode_username' => $this->request->get('username')])->sum('amount');        $sql = 'SELECT count(*) as count FROM cm_qrcode_user WHERE parent_id = (select user_id from cm_qrcode_user where uname="'.$this->request->get('username').'")';        //将配置字符串做为connect()的参数传入        $result=Db::query($sql);        //获取结果集        if($result['0']["count"]){            $data['child_num'] = $result['0']["count"] ;        }else{            $data['child_num'] = 0 ;        }        $qrcodeC = new Qrcode();        $status = $qrcodeC->where(['uname'=>$this->request->get('username')])->value('status');        if($status == 1){            $data['status'] = '开';        }else{            $data['status'] = '关';        }        return json_encode($data);    }    public function switch(){        $qrcodeC = new Qrcode();        $status = $qrcodeC->where(['uname'=>$this->request->get('username')])->value('status');        if($status >0){            $qrcodeC->update(['status'=>-1], ['uname'=>$this->request->get('username')]);        }else{            $qrcodeC->update(['status'=>1], ['uname'=>$this->request->get('username')]);        }        return json_encode(true);    }    /**     * 学员收款交易订单     * @return mixed     */    public function list(){        $where = ['qrcode_username' => $this->request->get('username')];        //组合搜索        !empty($this->request->get('trade_no')) && $where['trade_no']            = ['like', '%'.$this->request->get('trade_no').'%'];        !empty($this->request->get('channel')) && $where['channel']            = ['eq', $this->request->get('channel')];        //时间搜索  时间戳搜素//        $where['create_time'] = $this->parseRequestDate();        //状态        $where['status'] = ['in', [1,2]];        $list = $this->logicOrders->getOrderList($where,true, 'status asc,create_time desc', 20)->toArray();        foreach ($list['data'] as $k =>$v){            if($v['status'] ==1 ){                $s = '<a class="table-actions done" onclick="done('.$v['id'].')" href="javascript:void(0)" id="'.$v['id'].'">确认到账</a>';            }else{                $s = '已到账';            }            $str = '<tr>                      <td class="check hidden-xs">                        <label><input name="optionsRadios1" type="checkbox" value="option1"><span></span></label>                      </td>                      <td>                        '.date('Y-m-d H:i', $v['create_time']). '                      </td>                      <td>                        ￥'.$v['amount'].'                      </td>                      <td class="actions">                        <div class="action-buttons">                          '.$s.'                        </div>                      </td>                    </tr>';            $list['data'][$k] = $str;        }        $code = $this->logicPay->getCodeList([])->toArray();        return json_encode($list);    }    /**     * 标记订单完成     */    public function done_order(){        $order_id =  $this->request->get('id');        $orders = new Orders();        $ordersInfo = $orders->find($order_id);        //todo 事务        if($ordersInfo){            $orders->update(['status'=>2],['id'=>$order_id]);            $qrcodeC = new Qrcode();            $qrcodeInfo = $qrcodeC->where('uname',$ordersInfo['qrcode_username'])->find();            $qrcodeC->update(['today_amount'=>$qrcodeInfo['today_amount']+$ordersInfo['amount']],['uname'=>$ordersInfo['qrcode_username']]);            $orders->pushOrderNotify($order_id);            return json_encode('ok');        }        return json_encode('error');    }    public function submit(){        $where = ['uid' => is_login()];        $this->assign('list', $this->logicOrders->getOrderList($where,true, 'create_time desc', 10));        return $this->fetch();    }}