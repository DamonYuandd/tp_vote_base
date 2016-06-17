<?php    //登录页面
class IndexAction extends Action {
    public function index(){
	
	if(session('admin')!="admin"){
	
		if($this->_post("username")){ 
			$data=M("user");
			$user=$data->where('username="'.$this->_post("username").'"')->find();
			if(md5($this->_post("password"))==$user['password']&&$_SESSION['verify'] == md5($_POST['verify'])) {//
			session("admin","admin");
			redirect("/admin/index.php/login");
			}elseif(md5($this->_post("password"))!=$user['password']){
			$this->assign("errorinfo",	"用户名或密码错误！");
			$this->display();
			}
			}elseif($_SESSION['verify'] != md5($_POST['verify'])){
			$this->assign("errorinfo",	"验证码错误！");
			$this->display();
			
			}
		
    }else{
		$this->redirect('/login');
		}
		//$this->display();
}
public function logout(){
		session_destroy();
		redirect("/admin/");
}
}
