<?php
class IndexAction extends Action {
    public function test(){
	echo "开始学习Thinkphp";
	$this->assign("content","测试内容");
	$this->display;
    }
}