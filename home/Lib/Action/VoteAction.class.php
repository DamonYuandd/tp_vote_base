<?php
class VoteAction extends Action {
public function index($id){
	$type=M("type");
	$vote=M("vote");
	$options=M("option");
	$opt_data=$options->where("id=1")->find();
	$this->assign("vote_title",$opt_data['vote_title']);
	$this->assign("vote_pic",$opt_data['vote_pic']);
	$this->assign("vote_about",$opt_data['vote_about']);
	$data=$vote->where("id=$id")->find();
	if($data["v_pic"]){$photo="<img src='/upload/".$data["v_pic"]."' alt='".$data["v_name"]."'  />";}
	$this->assign("v_name",$data['v_name']);
	$this->assign("v_about",$data['v_about']);
	$this->assign("photo",$photo);
	$this->display();
	}
}