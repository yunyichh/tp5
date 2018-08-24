<?php 
namespace app\index\controller;
class  Preg{
	public function index()
	{

          $str = "php is the best language";
          $res[] = preg_match("/php/i", $str);
          dump($res);
          $res[] = preg_replace("/php/i", 'java', $str);
          dump($res);
          $res[] = preg_split('/\s/', $str);
          dump($res);
	}
}