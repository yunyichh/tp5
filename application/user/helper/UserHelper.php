<?php
namespace app\user\helper;
use think\Db;
use think\Validate;
class UserHelper{

	function isEmailExist($email){
		$count = Db::name('users')->where('email',$email)->count();
		return ($count>0)?true:false;

	}

	function isPhoneExist($phone){
		$count = Db::name('users')->where('user_name',$phone)->where('mobile_phone',$phone)->count();
		return ($count>0)?true:false;
	}

	function isUserExits($username){
		$count = Db::name('users')->where('user_name',$username)->count();
		return ($count>0)?true:false;
     }
    static function  validateStatic(){
    	dump(Validate::is("2018-06-29",'date'));
    	dump(Validate::is("dshjj@qq.com",'email'));
    	dump(Validate::in('5',['a','b']));
    	// echo Validate::gt(10,8); // true
    	dump(Validate::regex(100,'\d+'));
    }

 }