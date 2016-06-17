<?php

class LoginAction extends Action {

    public function index(){
	if(session('admin')=='admin'){
		$options=M("option");
		
		$opt_data=$options->where("id=1")->find();
		$this->assign("vote_title",$opt_data['vote_title']);
		$this->assign("vote_pic",$opt_data['vote_pic']);
		$this->assign("vote_about",$opt_data['vote_about']);
		$this->assign("vote_max",$opt_data['vote_max']);
		$vote=M("vote");
		$vote_data=$vote->select();
		$this->assign("vote_data",	$vote_data);
		$this->assign("admin",session('admin'));
		$type=M("type");
		$v_type=$type->select();
		$this->assign("v_type",$v_type);
		$user=M("user");
		$userinfo=$user->where("id=1")->find();
		$this->assign("username",$userinfo['username']);		
		$this->display();
    }else{
		redirect("/admin/");
		}
	}
	
	public function setoptions(){//修改设置操作
	if(session('admin')=="admin"){
		$options=M("option");
		$data['vote_title']=$this->_post("vote_title");
		$data['vote_about']=$this->_post("vote_about");
		$data['vote_max']=$this->_post("vote_max");
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  '../upload/';// 设置附件上传目录
		$upload->thumb = false;
		$upload->autoSub=false;
		$upload->thumbMaxWidth = '200';
		$upload->thumbMaxHeight = '200';

		if(!$upload->upload()) {// 上传错误提示错误信息
				if($upload->getErrorMsg()!="没有选择上传文件"){$this->error($upload->getErrorMsg());}
			}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			$data['vote_pic'] =$info[0]['savename']; // 保存上传的照片根据需要自行组装
			}

	$result=$options->where('id=1')->data($data)->save();
	 
		if($result){
		$this->success('操作成功！');
		echo '<script>alert("数据已保存！")</script>';
		}else{
		$this->error('写入错误！');
		}

	}else{
		$this->redirect('/login');
		}
	}
	
	public function setuser(){ //用户管理
	if(session('admin')=="admin"){
		$user=M("user");
		$userinfo=$user->where("ID=1")->find();
		//dump($userinfo);
		
		if($userinfo['password']==md5($this->_post("old_password"))){
			if($this->_post("new_password")){$data['password']=md5($this->_post("new_password"));}
			if($this->_post("new_username")){$data['username']=$this->_post("new_username");}
			$result=$user->where("ID=1")->save($data);
			 
			if($result){
			$this->success('操作成功！');
			echo '<script>alert("数据已保存！")</script>';
			}else{
			$this->error('写入错误！');
			}	
		}
	
	
	}else{
		$this->redirect('/login');
		}
	}
	
	public function addvotes(){//添加投票项操作
	if(session('admin')=="admin"){
		$addvote=M("vote");
		$data['v_name']=$this->_post("v_name");
		$data['v_about']=$this->_post("v_about");
		$data['v_type']=$this->_post("v_type");
		
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
		$upload->savePath =  '../upload/';// 设置附件上传目录
		$upload->thumb = false;
		$upload->autoSub = false;
		$upload->thumbMaxWidth = '800';
		$upload->thumbMaxHeight = '1000';
		
		
			if(!$upload->upload()) {// 上传错误提示错误信息
				if($upload->getErrorMsg()!="没有选择上传文件"){$this->error($upload->getErrorMsg());}
			}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
			$data['v_pic'] = $info[0]['savename'];
			}
		
		$result=$addvote->add($data);
		 
			if($result){
			$this->success('操作成功！');
			echo '<script>alert("数据已保存！")</script>';
			}else{
			$this->error('写入错误！');
			}
	}else{
		$this->redirect('/login');
		}
	}	
	public function settype(){//投票类型管理
		if(session('admin')=="admin"){
			$settype=M("type");
			if(($this->_post("type_name"))){
			$data['type_name']=$this->_post("type_name");
			$result=$settype->add($data);
					if($result){
				$this->success('写入操作成功！');
				echo '<script>alert("数据已保存！")</script>';
				}else{
				$this->error('写入错误！');
				}
			}
			if(($this->_post("delid"))){
			$id=$this->_post("delid");
			$result=$settype->where('type_id='.$id)->delete(); ;
				if($result){
				$this->success('写入操作成功！');
				echo '<script>alert("数据已保存！")</script>';
				}else{
				$this->error('写入错误！');
				}
			}
		}else{
		$this->redirect('/login');
		}
	}
	public function delvotes($id){//删除投票项操作
	if(session('admin')=="admin"){
		$deldata=M("vote");
		$result=$deldata->where("id=".$id)->delete();
		if($result){
				$this->success('删除操作成功！');
				echo '<script>alert("数据已删除！")</script>';
				}else{
				$this->error('删除错误！');
				}
	}else{
		$this->redirect('/login');
		}
	}

}