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
       echo "tp5";
    }
    public function form(){
        $view = new View();
        return $view->fetch();
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
        echo "server";br();
    	dump($server);
    	echo $domain;br();
    	echo $pathinfo;br();
    	echo $server['PATH'];br();//服务器环境变量
    	echo $server['DOCUMENT_ROOT'];br();//文档根节点
    	echo $server['REMOTE_ADDR'];br();//远程ip地址
    	echo $server['HTTP_HOST'];br();//请求主机域名
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
    public function db2(){
        Db::listen(function ($sql,$time,$explain){

        });
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
     public function transaction2(){
        Db::transaction(function(){

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
        $arr = ['wxapp'=>'wxapp'];
        // $view->assign('wxapp','wxapp');
        $array = range(0,10,1);
        $array = array_pad($array, 20, 'pad_value');
        $view->assign('array',$array);
     	return $view->fetch('wxapp',$arr);
     }

     public function validateStatic(){
        UserHelper::validateStatic();
     }

     public function phpinfo()
     {
     	phpinfo();
     }
     //redis
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
     
     //直接获取结果数据--失效
     public function kuaidi100(){
        // $typeCom = $_GET["com"];//快递公司
        // $typeNu = $_GET["nu"];  //快递单号
        $typeCom = 'yunda';
        $typeNu = '3101753884545';  //快递单号

        //echo $typeCom.'<br/>' ;
        //echo $typeNu ;

        $AppKey='';//请将XXXXXX替换成您在http://kuaidi100.com/app/reg.html申请到的KEY
        $url ='http://api.kuaidi100.com/api?id='.$AppKey.'&com='.$typeCom.'&nu='.$typeNu.'&show=0&muti=1&order=asc';

        //请勿删除变量$powered 的信息，否者本站将不再为你提供快递接口服务。
        $powered = '查询数据由：<a href="http://kuaidi100.com" target="_blank">KuaiDi100.Com （快递100）</a> 网站提供 ';


        //优先使用curl模式发送数据
        if (function_exists('curl_init') == 1){
          $curl = curl_init();
          curl_setopt ($curl, CURLOPT_URL, $url);
          curl_setopt ($curl, CURLOPT_HEADER,0);
          curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
          curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
          curl_setopt ($curl, CURLOPT_TIMEOUT,5);
          $get_content = curl_exec($curl);
          curl_close ($curl);
        }
        // else{
        //   include("snoopy.php");
        //   $snoopy = new snoopy();
        //   $snoopy->referer = 'http://www.google.com/';//伪装来源
        //   $snoopy->fetch($url);
        //   $get_content = $snoopy->results;
        // }
        echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";        
        print_r(($get_content . '<br/>' . $powered));
        exit();
     }
       
     //根据快递公司和订单号查询 --获取跳转按钮
     public function kuaidi100two(){

        $com="yunda";
        $nu="";
        $context="查询";
        $link="<a href='https://www.kuaidi100.com/chaxun?com=".$com."&nu=".$nu."'>".$context."</a >";
        echo $link;
              
     }
     
     //根据快递公司和订单号查询 --获取结果跳转链接
     public function kuaidi100thire(){
         // $typeCom = $_GET["com"];//快递公司
        // $typeNu = $_GET["nu"];  //快递单号
        $typeCom = 'yunda';
        $typeNu = '3101753884545';  //快递单号

        //echo $typeCom.'<br/>' ;
        //echo $typeNu ;

        $AppKey='';//请将XXXXXX替换成您在http://kuaidi100.com/app/reg.html申请到的KEY
        $url ='http://api.kuaidi100.com/applyurl?key='.$AppKey.'&com='.$typeCom.'&nu='.$typeNu.'&show=0&muti=1&order=asc';

        //优先使用curl模式发送数据
        if (function_exists('curl_init') == 1){
          $curl = curl_init();
          curl_setopt ($curl, CURLOPT_URL, $url);
          curl_setopt ($curl, CURLOPT_HEADER,0);
          curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
          curl_setopt ($curl, CURLOPT_TIMEOUT,5);
          $get_content = curl_exec($curl);         
          curl_close ($curl);
        }
        echo "<a href='$get_content'>click to return</a>";
     }
       
       //curl会话
     public function curl(){

        $url = "http://www.youtube.com";

        if(function_exists("curl_init")){
            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_TIMEOUT,25);
            curl_setopt($curl,CURLOPT_HEADER,false);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            //https请求不验证证书和主机
            curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
            $result = curl_exec($curl);
            dump(curl_error($curl));
            curl_close($curl);
            dump($result);
        }
     }
     //mysqli
     public function mysqli(){
        $con = mysqli_connect('localhost','root','root','bnld');
        if(mysqli_connect_error($con)){
            echo 'fail';
        }else{
            $result = mysqli_query($con,"select * from dsc_dis_user limit 5");
            while ($row = mysqli_fetch_assoc($result)) {
                dump($row);
            }
            mysqli_free_result($result);
            mysqli_close($con);

        }
     }

     //pdo
     public function pdo(){
         try{
            $dbh = new \PDO("mysql:host=localhost;dbname=bnld",'root','root',[\PDO::ATTR_PERSISTENT]);
            $result = $dbh->query("select * from dsc_dis_user limit 5");
            foreach ($result as $key => $value) {
                dump($value);
            }
         }catch(Expeciton $e){//Exception
            echo $e->getMessage();
         }
     }
     //pdo transaction
     public function pdoTransaction(){
           try{
            $dbh = new \PDO("mysql:host=localhost;dbname=bnld",'root','root',[\PDO::ATTR_PERSISTENT]);
            $dbh->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);//setAttribute
            $result = $dbh->query("select * from dsc_dis_user limit 5");            
            foreach ($result as $key => $value) {
               dump($value);
            }
           }catch(Exception $e){
            $dbh->rollback();
            echo $e->getMessage();
           }
           
     }
     //pdo prepare
     public function pdoPrepare(){        
        try{
                $dbh = new \PDO('mysql:host=localhost;dbname=bnld','root','root');
                $smtm = $dbh->prepare("select * from dsc_dis_user limit :num");
                $smtm->bindParam(":num",$num);
                $num = 5;
                $smtm->execute();
                $result = $smtm->fetchAll();
                dump($result);
            
            }catch(Expection $e){
                echo $e->getMessage();
            }
     }
     public function date(){
        $time = strtotime("2018-8-30 16:38");
        $now = time();
        $tomorrow = strtotime("+ 24 hour",time());

        $oneday = $tomorrow - $now;
        echo "1 day = ".($oneday)."s";br();
        echo "1 day = ".($oneday/60)."min";br();
        echo "1 day = ".($oneday/60/60)."h";br();
        $tomorrow = $now + 60*60*24;


        $date1 = date_create(date("Y-m-d H:i:s",$now));
        $date2 = date_create(date("Y-m-d H:i:s",$tomorrow));
        dump(date_diff($date2,$date1));
        echo date("Y-m-d H:i:s",$time);br();
        echo date("Y-m-d H:i:s",$now);br();
        echo date("Y-m-d H:i:s",$tomorrow);
     }


     public function file(){

         $relativepath = "./file.txt";

        //写
         file_put_contents($relativepath,"hello file\r\n");//将字符串写入文件
         //读1
         $content = file_get_contents($relativepath);//读入字符串
         dump($content);

         //写2
         $file = fopen($relativepath,'a+');//+读
         fwrite($file,"hello file\r\n");//注意使用双引号才会编译换行
         fwrite($file,"hello file\r\n");
         fputs($file,"hello file\r\n");
        //读2
         $content = file($relativepath);//读入数组
         dump($content);

         //读取
         rewind($file);//操作文件指针回到开始
         $content = fread($file,filesize($relativepath));//指针中取出，会改变文件指针
         dump($content);

        //读取2--文件指针操作
         fseek($file,0);//操作文件指针回到开始
         while(!feof($file)){
             echo fgetc($file).ftell($file);//文件中取出字符，会改变文件指针
         }
         fseek($file,0);
         while (!feof($file)){
             echo fgets($file).ftell($file);//文件中取出一行
         }
         fclose($file);
         br();
         echo realpath($relativepath);//不存在返回false
         br();
         $stat = stat($relativepath);
         dump($stat);
         unlink($relativepath);

    }
     //empty is_null is_set
     public function judge(){
        $a = '';
        $b = 0;
        $c = null;
        $d = false;
        $e = array();
        $f = '0';
        $array = compact('a','b','c','d','e','f');
        $array = array_values($array);
        while ($i = each($array)) {
            $i = $i[1];
            dump($i);
            echo 'empty';dump(empty($i));br();
            echo "is_null";dump( is_null($i));br();
            echo "isset";dump(isset($i));br();br();br();br();
        }
        unset($a);
        //echo "is_null";echo is_null($a);br();报错
        echo "isset";dump(isset($a));br();br();br();br();br();
        //结论  
        //1.变量为null才为null才未设置，为假则为空
        //2.unset(未设置)只能用isset判断,其余报错
     }

     public function out(){
        for ($i=0;$i<10;$i++){
            $a[] = $i;
        }
       echo  $a[0],$a[1];br();//是语句不是函数，没有返回值，可以输出一个或者多个变量
       print print $a[0];br();//有返回值，只能输出一个变量
       print_r($a);br();//打印变量或者变量数组等结构数据的值，不包含类型
       var_dump($a);//详细打印变量或者变量数组等结构数据的值，包含类型
     }

}
