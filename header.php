<?php 
	include_once 'dbio/NewsTypes.php';
	session_start();
	//接收session里面存的user
	if(isset($_GET['action'])){//退出登录、删除session 
		$_SESSION['user']=null;
		setcookie('xwsj_login',false,time()+3600*24);
		header("location:index.php");
	}
	$user = "";
	if(isset($_COOKIE['xwsj_login'])&&$_COOKIE['xwsj_login']){
		// serialize、unserialize
		$_SESSION['user'] = unserialize($_COOKIE['xwsj_user']);	
		$user = $_SESSION['user']['userName'];
	}
	if(isset($_GET['codes'])){
		$codes = $_GET['codes'];
		$sessionCodes = isset($_SESSION['user']['codes'])?$_SESSION['user']['codes']:'';
		unset($_SESSION['user']['codes']);
	}
	//查询所有一级分类
	$newsTypes = NewsTypes::getNewsTypes1();
?>
<!-- 通用顶部导航开始-->
<div id="top-navi-wrap">
	<div class="clearfix" id="top-navi">
		<div class="side-left">
			<a href="#">巴西世界杯一再爆冷 卫冕冠军西班牙出局</a>
			<a href="#">瑞士人为啥最幸福</a>　
			<a href="#">中国病人庞麦郎</a>
		</div>
		<div class="side-right">
			<a href="login.php" target="_blank" class="top-nav-login-title">登录</a>
			<div class="top-nav-select-title">
				<a href="register.php" target="_blank">免费注册</a>
				<?php 	if($user){ ?>
				<span>您好，<a href="#" class="current-user"><?php echo $user; ?></a></span>
				<?php 
						}
				 ?>
				<a href="index.php?action=logout">退出</a>
			</div>
		</div>
	</div>
</div>
<!-- 通用顶部导航结束 -->
<!--header start-->
<div class="clear" id="header">
		<div id="logo"><a href="#" title="换一个角度看新闻"></a></div>
		<div id="search-bar">
			<form name="search-form" action="" method="get">
				<input type="text" name="keywords" id="keywords" value=""/>
				<input type="submit" value="" id="search-submit-button"/>
			</form>
		</div>
</div>
<!--header end-->
<!--导航开始-->
<div id="navigation">
	<ul class="clear">
		<li><a href="index.php" target="_blank">首页</a></li>
		<li><a href="roll.php" target="_blank">滚动</a></li>
<?php 
	foreach ($newsTypes as $v)
	{
?>
		<li><a href="newstype.php?typeId=<?php echo $v["typeId"]?>" target="_blank"><?php echo $v["typeName"]?></a></li>
<?php 
	}
?>
	</ul>
</div>