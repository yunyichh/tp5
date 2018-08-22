<?php
namespace app\user\model;
use think\Model;
use think\Validate;
use app\user\helper\UserHelper;
class Users extends Model{

	public function addUser($data)
	{
        
		$rule = [
			['user_name','require|chsDash|length:3,15','用户名不能为空|用户名不包含特殊字符|用户名长度3-15'],
			['password','require|alphaDash|length:3,15','密码不能为空|密码不包含特殊字符|密码长度3-15'],
			['email','require|email','邮箱不能为空|邮箱出错']
		];

		$validate = new Validate($rule);
		$res = $validate->check($data);
		if(!$res)
		{
			return $validate->getError();
		}
		$userHelper = new UserHelper();
		if($isExist = $userHelper->isEmailExist($data['email']))
		{
			return "邮箱已存在";
		}
		if($isExist = $userHelper->isUserExits($data['user_name']))
		{
			return "用户名已存在";
		}
		$data['password'] = md5(md5($data['password']));
		$sex = (empty($_POST['sex']) ? 0 : intval($_POST['sex']));
	    $sex = (in_array($sex, array(0, 1, 2)) ? $sex : 0);
	    $birthday = $_POST['birthdayYear'] . '-' . $_POST['birthdayMonth'] . '-' . $_POST['birthdayDay'];
		$other['sex'] = $sex;
		$other['birthday'] = $birthday;
		$other['reg_time'] = local_strtotime(local_date('Y-m-d H:i:s'));
		$other['msn'] = isset($_POST['extend_field1']) ? htmlspecialchars(trim($_POST['extend_field1'])) : '';
		$other['qq'] = isset($_POST['extend_field2']) ? htmlspecialchars(trim($_POST['extend_field2'])) : '';
		$other['office_phone'] = isset($_POST['extend_field3']) ? htmlspecialchars(trim($_POST['extend_field3'])) : '';
		$other['home_phone'] = isset($_POST['extend_field4']) ? htmlspecialchars(trim($_POST['extend_field4'])) : '';
		$other['mobile_phone'] = isset($_POST['extend_field5']) ? htmlspecialchars(trim($_POST['extend_field5'])) : '';
		$sel_question = (empty($_POST['sel_question']) ? '' : compile_str($_POST['sel_question']));
	    $passwd_answer = (isset($_POST['passwd_answer']) ? compile_str(trim($_POST['passwd_answer'])) : '');
		$other['passwd_question'] = $sel_question;
		$other['passwd_answer'] = $passwd_answer;

		$data = array_merge($data,$other);
        $count = $this->save($data);
        if($count>0)
        {
        	return "添加用户成功";
        }
       
	}
}