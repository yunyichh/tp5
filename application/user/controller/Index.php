<?php 
namespace app\user\controller;
use think\Request;
use think\View;
use app\user\model\DisUser;
use app\user\model\Users;
class Index{

	public function index(){

          $user = new DisUser();
          $user1 = $user::get(63);
          dump($user1);
          dump($user1->getData());
          $user2 = $user->getUserById3(63);
          dump($user2);
          $user3 = $user->getUserById2(63);
          dump($user3);
          $user4 = $user->getUserById4(63);
          dump($user4);
          $user5 = $user->getUserById5(63);
          dump($user5);
	}
     public function addUser(){

          $request = Request::instance();
          if($request->isPost())
          {
               $user_name = $request->post('username');
               $password = $request->post('password');
               $email = $request->post('email');
               $user = new Users();
               $user->addUser(compact('user_name','password','email'));
          }
          else{
               echo "request error";
          }

     }
     public function user(){
         $view = new View();
         return $view->fetch();
     }
}
