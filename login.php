<?php
    header("content-type:text/html;charset=utf-8");
    session_start();
    include_once "./dbio/userInfo.php";
    if($_POST){
        $userName = $_POST["username"];
        $password = $_POST['password'];
        if($userName==""){
            $user = "用户名不能为空！";
        }elseif($password==""){
            $pass = "密码不能为空！";
        }else{
            $result = UserInfo::getUserinfo($userName,md5($password));
            if($result){
                $_SESSION['user'] = $result;
                setcookie('xwsj_login',true,time()+3600*24);
                // serialize、unserialize
                setcookie('xwsj_user',serialize($result),time()+3600*24);
                header("location:index.php");die;
            }else {
                $userPass = "用户名或密码错误！";
            }
        }
    }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户登录_新闻视界</title>
<link href="styles/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/layout.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/common.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="header-wrapper">
    <div class="wrapper">
        <div id="header">
            <div class="side-left logo">
                <a href="#" title="换一个角度看新闻">新闻视界</a>
            </div>
            <div class="side-center page-title"><span>登录</span></div>
            <div class="side-right login-bar"><a href="register.php" target="_blank">免费注册</a><a href="index.php" target="_blank">返回首页</a></div>
        </div>
    </div>
</div>
<div id="login-wrapper">
    <div id="login-main">
        <form action="login.php" method="post" id="login-form">
        <h1 class="login-title">用户登录</h1>
        <input type="text" class="login-input-username" name="username" value="" placeholder="请输入账号" /><span style="color: red;"><?php echo isset($user)?$user:""; ?></span>
        <input type="password" class="login-input-password" name="password" placeholder="请输入密码" /><span style="color: red;"><?php echo isset($pass)?$pass:""; ?></span>
        <div class="login-remmber-me"><span><input type="checkbox" name="remember" checked="checked" value="1"/>&nbsp;下次自动登录</span><a href="#">忘记密码</a></div>
        <input type="submit" value="登 录" class="login-submit-button"/>
        <div class="other-login">
            <p>可以使用以下方式登录：</p>
            <ul class="other-login-list clear">
                <li><a href="#" class="qq" title="QQ登录">QQ登录</a></li>
            </ul>
        </div>
        </form>
    </div>
</div>
</body>
</html>
