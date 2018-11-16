<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/15 0015
 * Time: 上午 11:10
 */
namespace app\payment\contolller;
use think\request;
class WxPay{
    public function index(){
        $request =  Request::instance();
        $payment = $request->get('payment');
        $input = $request->input();
        if($payment=='way'){
            $this->wapPay($input);
        }else{

        }

    }
    public function wapPay($input){
        vendor(EXTEND_PATH."wxpay/lib/WxPay.api.php");
        vendor(EXTEND_PATH."wxpay/example/WxPay.config.php");
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no("sdkphp".date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url(url('payment/wxpay/notify_url'));
        $input->SetTrade_type("MWAB");

        $config = new WxPayConfig();
        $result = WxPayApi::unifiedOrder($config, $input);//返回结果数组
        //查询订单是否存在
        //订单是否已支付
        //验证订单号
        if($result['return_code'] == 'SUCCESS'){
            if($result['result_code'] == 'SUCCESS'){
                exit(json_encode(array('status'=>'0','msg'=>'下单成功，请支付！','result'=>$result['mweb_url'])));
            }elseif($result['result_code'] == 'FAIL'){
                exit(json_encode(array('status'=>'-201','msg'=>$result['err_code_des'])));
            }
        }else{
            exit(json_encode(array('status'=>'-1','msg'=>'未知错误，请稍后重试！')));
        }
        //报错:数据不存在
        exit(json_encode(array('status'=>'-200','msg'=>'订单不存在，请核实后再提交！')));
    }
   public function pagePay(){

   }
   public function notify_url(){

   }
   public function return_url(){

   }
}