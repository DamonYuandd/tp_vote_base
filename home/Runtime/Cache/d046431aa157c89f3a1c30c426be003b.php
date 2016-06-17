<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title><?php echo ($vote_title); ?>投票系统</title><script type="text/javascript" src="/public/js/jquery.min.js"></script><script type="text/javascript">$(function(){
	$("#showresult").click(function(){
		$("#vote_result").toggle();
		})
	$("#submitbtn").click(function(){
		for (i=0;i< $(".vote_hide").length;i++){
		var votetype=$(".vote_hide").eq(i).val();
		
		if($("#"+votetype+" input[type=checkbox]:checked").size()>=10){
			alert("你勾选的选项个数超限制，无法投票！");
			return false;
			};
			
		};
	})
	})
</script><style type="text/css">body{
	text-align:center;}
a{
color:#000;
text-decoration:none;
}

#header
{
	width:1000px;
	height:auto;
	margin:0px auto;}
#header img{
width:1000px;}

.vote_tit{
	width:998px;
	height:30px;
	line-height:30px;
	border-bottom:1px solid #ccc;
	background-color:#EEE;
	text-align:center;
}
.vote_main
{
border:1px solid #ccc;
width:998px;
height:auto;
margin:10px auto;
overflow:hidden;
text-align:center;
}
.vote_main p{
text-align:left;
}
.votes
{
	width:960px;
	height:auto;
	margin:5px auto;
	text-align:center;
}	
.vote{
float:left;
margin:10px 21px;
text-align:center;
display:inline;
width:150px;}
.vote img{
width:150px;
border:none;
}
#vote_result{
	width:998px;
	height:auto;
	margin:10px auto;
	border:1px solid #ccc;
	display:none;}
.voteabout
{display:none;
position:absolute;
width:200px;
height:auto;
background-color:#eee;
border:1px solid #333;
padding:5px;
font-size:12px;}
</style></head><body><div id="header"><img src="/upload/<?php echo ($vote_pic); ?>" alt="<?php echo ($vote_title); ?>" /></div><div class="vote_main"><div class="vote_tit">投票说明</div><?php echo (stripslashes(htmlspecialchars_decode($vote_about))); ?></div></div><form method="post" action=""><?php echo ($votes_list); ?><label for="vote"></label><div class="votes"><input type="reset" name="reset" value="  清  空  " /><input type="submit" id="submitbtn" name="submit" value="  提  交  "  /></div></form><script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F5bc643f5ec9a203759eb8a9202436c2b' type='text/javascript'%3E%3C/script%3E"));
</script><div class="votes"><a href="http://www.yxxcb.com">锦绣洋县网</a></div></body></html>