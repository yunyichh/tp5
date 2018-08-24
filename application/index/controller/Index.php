<?php
namespace app\index\controller;
use think\Config;
use think\Request;
use think\Db;
use think\View;
use think\Loader;
use util\Redis;
use app\user\model\DisUser;
use app\user\helper\UserHelper;
class Index
{
    public function index()
    {
        
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }
    public function config(){
    	$config = Config::get();
         dump($config);

    }
    public function request()
    {
    	$request = Request::instance();
    	$domain = $request->domain();
    	$pathinfo = $request->pathinfo();
    	$server = $request->server();
    	dump($request);
    	dump($server);
    	echo $domain;br();
    	echo $pathinfo;br();
    	echo $server['PATH'];br();
    	echo $server['DOCUMENT_ROOT'];br();
    	echo $server['REMOTE_ADDR'];br();
    	echo $server['HTTP_HOST'];br();


    }
    public function db()
    {
		 Db::listen(function($sql, $time, $explain){
	        // 记录SQL
			     echo $sql. ' ['.$time.'s]';
			     // 查看性能分析结果
			     dump($explain);
		 });
         $users = Db::query("select * from dsc_dis_user limit 1,10");
         dump($users);
         $user = Db::name('dis_user')->where(['id'=>62])->find();
         dump($user);
         $user2 = Db::name('dis_user')->where('id',62)->find();
         dump($user2);
         $user3 = Db::name('dis_user')->where(['id'=>62])->select();
         dump($user3);
         $user4 = Db::name('dis_user')->where('id',"eq",62)->find();
         dump($user4);
         $user5 = Db::name('dis_user')->field('is_vip')->where('id',62)->find();
         dump($user5);
         $user6 = Db::name('dis_user')->field('is_vip')->where('id',62)->select();
         dump($user6);
         //查询一个数据使用find()--一维
         //查询数据集使用select()--二维
         $users2 = Db::name("dis_user")->limit(10)->order('id desc')->select();
         dump($users2);
         //查询某个字段值value--字符串（参数多传无用）
         //查询列字段column--一维（参数多传无用）
                            //一个参数返回该列的值
                            //二个参数一列为键名,一列为键值
         $user7 = Db::name('dis_user')->limit(10)->value('is_vip');
         dump($user7);

         $user8 = Db::name('dis_user')->limit(10)->column('is_vip','become_vip_time','user_id');
         dump($user8);
    }
     public function transaction()
     {
     	Db::transaction(function(){
     		$user1 = Db::name('dis_user')->where('id','eq',62)->find();
     		dump($user1);
     		$users = Db::name('dis_user')->where('id','gt',62)->count();
     		dump($users);

     	});
     }
     public function json()
     {
     	$user1 = Db::name('dis_user')->where('id',62)->find();
     	$jsonUser = json_encode($user1);//$user1->toJson();

     	dump($jsonUser);
     }
     public function user()
     {
          $user = new DisUser();
          $user1 = $user->getUserById(63);
         foreach ($user1 as $key => $value) {
         	dump($value->getData());
         }
         $user2 = $user->getUserById2(63);
          foreach ($user2 as $key => $value) {
         	dump($value);
         }              

     }
     public function wxapp(){
     	$view = new View();
     	return $view->fetch();
     }
     public function validateStatic(){
        UserHelper::validateStatic();
     }
     public function phpinfo()
     {
     	phpinfo();
     }
     public function redis(){   

        $conf = ['host' =>Config::get('redis.host') ,'port'=>Config::get('redis.port')];
        $attr = ['db_id'=>0];//默认使用0号库
        //单例模式
        $redis = Redis::getInstance($conf,$attr);
        
        dump($redis->keys('*'));
        br();
        echo $redis->get('mykey');
        br();
        dump($redis->hGetAll('mykeyh'));
        br();
        echo $redis->hGet('mykeyh','h1');
        br();
        echo $redis->hGet('mykeyh','h2');   
        br();
        dump($redis->hKeys('mykeyh'));	 
        br();
        dump($redis->hVals('mykeyh'));
        br();
        dump($redis->hExists('mykeyh','h1'));
        br();
        dump($redis->lRange('mykeyl','0','5'));
        br();
        dump($redis->sMembers('mykeys'));
        br();
        dump($redis->zRange('mykeyz',0,5));

 	  
     }


}
