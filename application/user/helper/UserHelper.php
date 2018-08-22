<?php
namespace app\user\helper;
use think\Db;
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
 }