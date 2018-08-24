<?php
namespace app\index\controller;
class Arrays
{
	public function index()
	{
		 $array1 = array(0=>'a','1'=>'b',2=>'c');
		 $array2 = array(0=>'a','3'=>'b',2=>'d');
         //差集 交集 合集 替换 
		 dump(array_diff($array1, $array2));
		 dump(array_diff_key($array1, $array2));
		 dump(array_diff_assoc($array1, $array2));
		 dump(array_intersect($array1, $array2));
		 dump(array_intersect_key($array1, $array2));
		 dump(array_intersect_assoc($array1, $array2));
		

		 $array3 = array_merge($array1,$array2);
		 dump($array3);
		 $array4 = array_replace($array1, $array2);
		 dump($array4);		 
		 dump(array_combine(array_keys($array1), array_values($array2)));   

		 //排序   
         sort($array3);
		 dump($array3);
		 rsort($array3);
		 dump($array3);
		 $array5 = array_reverse($array4,true);
		 dump($array5);
		 shuffle($array4);
		 dump($array4);
         //数组指针
		 while ($r = each($array4)) {
		 	dump($r);
		 };
		 $x = end($array4);
		 dump($x);
		 //创建与填充
		$array[] = $array6 = array_fill(0, 10,'a');
		$array[] = $array7 = array_fill_keys(array_values($array6), 'a');
		$array[] = $array8 = range(0, 10, 2);
		$array[] = $array9 = array_pad($array8, 10, 'a');//用指定值填充到指定长度

		dump($array);
		dump(array_rand($array1));
		//未完待续。。。






	}
}