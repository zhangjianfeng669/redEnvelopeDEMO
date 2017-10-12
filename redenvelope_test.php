<?php 
header('Content-type:text/html;charset=utf8;');
error_reporting(0);
function split_redenvelope($amount,$count){
	$total=$amount;
	$min=1;
	$rarr=array();
	for ($i=1;$i<$count;$i++)
	{
		if($total<1)break;//个数小于1退出
		$safe_total=($total-($count-$i)*$min)/($count-$i);//随机安全上限
		if($safe_total<$min)$safe_total=$min;
		$money=mt_rand($min,$safe_total);
		$total=$total-$money;
		$rarr[]=$money;
	}
	if($total>0)$rarr[]=$total;//剩下的钱分给最后一个红包
	return $rarr;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>红包简单分解</title>
<link type="text/css" href="http://www.xingongyi.org/Public/Css/zjf.css?id=1" rel="stylesheet" />
</head>
<body>
<div class="center bgf4 p10" style="width:500px;">
<?php
if(isset($_POST['count'])&&isset($_POST['num'])){
	$count=$_POST['count'];
	$num=$_POST['num'];
	if(is_numeric($count)&&$count>0&&is_numeric($num)&&$num>0&&$count*100>=$num){
		$arr=split_redenvelope($count*100,$num);
		echo '<div class="c999 lh2 fs20">红包分解结果</div>';
		for($i=0;$i<$num;$i++){
			echo '第'.($i+1).'个红包金额：'.($arr[$i]/100).'元<br/>';
		}
	}else{
		echo '<div class="c999 lh2 fs20">请输入正确的金额和数量</div>';
	}
	exit('<br/><a href="redenvelope_test.php" class="btn btnblue">重新输入</a>');
}else{
?>
<form method="post">
	<div class="c999 lh2 fs20">红包简单分解</div>
	<div class="c999">请输入总金额</div>
	<input type="text" name="count" class="input w90" value="5" placeholder="请输入金额" />元
	<div class="sepdiv"></div>
	<div class="c999">请输入要分解的红包个数</div>
	<input type="text" name="num" class="input w90" value="5" placeholder="请输入红包个数" />个
	<div class="sepdiv"></div>
	<input type="submit" value="计算" class="btn btnblue" />
</form>
<?php } ?>
</div>
</body>
</html>