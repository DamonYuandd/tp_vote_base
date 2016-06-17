<?php
class IndexAction extends Action {
	public function index(){
	$type=M("type");
	$vote=M("vote");
	$ipcheck=M("ip");
	$options=M("option");
	$opt_data=$options->where("id=1")->find();
	$typedata=$type->select();
	$ip=get_client_ip();

	
	if($_SERVER['CONTENT_LENGTH']!=null){
		foreach($typedata as $typelist)//按投票类型提交数据
		{
			foreach($this->_post("votes".$typelist["type_id"]) as $id){
					$ip_count=$ipcheck->where("ip='".$ip."' AND vote_type=".$typelist["type_id"])->find();//检查某IP投票次数

					if($ip_count["ip_count"]<$opt_data['vote_max']){//每个类型限制投票10次
					
						$vote->where("id=$id")->setInc("v_count");//投票项对应次数加1
						if($ip_count==null){//如果未发现投票IP，则新建记录
						$ipdata["ip"]=$ip;
						$ipdata["ip_count"]=1;
						$ipdata["vote_type"]=$typelist["type_id"];
						$ipcheck->data($ipdata)->add();}
						else{
						$ipcheck->where("ip='".$ip."' AND vote_type=".$typelist["type_id"])->setInc("ip_count");
						}
				}else{
					echo "<script>alert('该IP投票已经超过10次，不能投票！');</script>";
				}
				
				
			};

			}
	redirect("/");
	}
	
	
	
	$this->assign("vote_title",$opt_data['vote_title']);
	$this->assign("vote_pic",$opt_data['vote_pic']);
	$this->assign("vote_about",$opt_data['vote_about']);
	
	$vote_data=$vote->select();
	//$this->assign("vote_data",	$vote_data);
	$typedata=$type->select();
	//print_r($typedata);
	foreach($typedata as $typelist)
	{
	$votes_list.="<div class='vote_main'><div class='vote_tit'>". $typelist['type_name']."</div><div class='votes' id='votes".$typelist['type_id']."'>";
		$vote=M("vote");
		$votedata=$vote->where("v_type=".$typelist['type_id'])->select();
		foreach($votedata as $data){
		$votes_list.="<div class='vote'>";
		if(!empty($data['v_pic'])){$photo="<a href='/index.php/vote/index/id/".$data['id']."' target='_blank'><img src='/upload/".$data['v_pic']."' alt='".$data['v_name']."' /></a>";}else{$photo="";}
		/*if(!empty($data['v_about'])){$about="<div class='voteabout'>".$data['v_about']."</div>";}else{$about="";}
		$votes_list.=$about;*/
		$votes_list.=$photo;
		$votes_list.="<input type='checkbox' name='votes".$typelist['type_id']."[]' id='checkbox' value='".$data['id'] ."'/><a href='/index.php/vote/index/id/".$data['id']."' target='_blank'>".$data['v_name']."</a></div>";
		}
	$votes_list.="<input class='vote_hide' name='vote_hide' value='votes".$typelist['type_id']."' type='hidden'/></div></div>";	
	$this->assign("votes_list",$votes_list);
	}
	$this->display();
    }
	
	
}