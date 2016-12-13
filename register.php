<?php
    header("content-type:text/html;charset=utf-8");
    session_start();
    include_once "./dbio/userInfo.php";
    include_once "./phpmailer/test.php";
    // $codes = isset($_GET['codes'])?$_GET['codes']:"";
    // if(isset($_SESSION['user'])&&$_SESSION['user']['codes']==$codes){
    //     header("location:./index.php");
    // }
    if($_POST){
        $userName = $_POST["username"];
        $password = $_POST['password'];
        $pass = $_POST['repass'];
        $code = $_POST['code'];
        $address = $_POST['email'];
        if($userName==""){
            $user = "用户名不能为空！";
        }elseif($password==""){
            $pass = "密码不能为空！";
        }elseif($pass==""){
            $repass = "再次输入验证码";
        }elseif($password!=$pass){
            $repass ="密码不一致";
        }elseif($address==""){
            $email = "验证邮箱不能为空！";
        }elseif($code=""){
            $codes = "验证码为空";
        }elseif($_SESSION['code']==$code){
            $codes = "验证码不一致";
        }else{
            $codes = mt_rand(1000,9999);
            if(sendMail($address, $codes)){
                $result = UserInfo::setUserinfo($userName,md5($password));
                if($result[0]){
                    $data['userId'] = $result[1]['userId'];
                    $data['userName'] = $result[1]['userName'];
                    setcookie('xwsj_login',true,time()+3600*24);
                    setcookie('xwsj_user',serialize($data),time()+3600*24);
                    $data['codes'] = $codes;
                    $_SESSION['user'] = $data;
                    // serialize、unserialize
                    echo "<script>";
                    echo "alert('已发邮件请查收，并激活');";
                    echo "window.location.href='index.php'";
                    echo "</script>";
                    die;
                }else{
                    echo "<script>";
                    echo "alert('注册失败')";
                    echo "</script>";
                }
            }else{
                echo $email = "邮箱重新输入！";
            }
        }
    }
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户注册_新闻视界</title>
<link href="styles/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/layout.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/common.css" rel="stylesheet" type="text/css" media="all" />
<script src="./jquery.js"></script>
<script>
        function check(){
            var check = document.getElementsByName('protocol')[0];
            var submit = document.getElementById("submit");
            if(check.checked==true){
                submit.style.display="";
            }else{
                submit.style.display="none";
            }
        }
</script>
</head>

<body>
<div id="header-wrapper">
    <div class="wrapper">
        <div id="header">
            <div class="side-left logo">
                <a href="#" title="换一个角度看新闻">新闻视界</a>
            </div>
            <div class="side-center page-title"><span>注册</span></div>
            <div class="side-right login-bar"><a href="login.php" target="_blank">快速登录</a><a href="index.html" target="_blank">返回首页</a></div>
        </div>
    </div>
</div>
<div id="register-wrapper">
    <div id="register-main">
        <div class="progress-bar-input" id="progress-bar"></div>
        <form id="register-form" method="post">
            <ul>
                <li class="clear">
                    <span class="register-title side-left">账号:</span>
                    <input type="text" name="username" class="register-input-username side-left" placeholder="请输入用户名1"/>
                    <span class="prompt side-left"><?php echo isset($user)?$user:""; ?></span>
                </li>
                <li class="clear">
                    <span class="register-title side-left">密码:</span>
                    <input type="password" name="password" class="register-input-password side-left" placeholder="请输入密码！"/>
                    <span class="prompt side_left"><?php echo isset($pass)?$pass:""; ?></span>
                </li>
                <li class="clear">
                    <span class="register-title side-left">密码:</span>
                    <input type="password" name="repass" class="register-input-password side-left" placeholder="请输入再密码！" />
                    <span class="prompt side_left"><?php echo isset($repass)?$repass:""; ?></span>
                </li>
                <li class="clear">
                    <span class="register-title side-left">邮箱:</span>
                    <input type="email" name="email" class="register-input-password side-left" placeholder="请输入验证邮箱！" />
                    <span class="prompt side_left"><?php echo isset($email)?$repass:""; ?></span>
                </li>
                <li class="clear">
                    <span class="register-title side-left">验证码:</span>
                    <input type="text" name="code" class="register-input-verify side-left" placeholder="请输入验证码！" />
                    <span class="prompt side-left"><img src="./ValidateCode/captcha.php" width="120" height="40" onclick="this.src='./ValidateCode/captcha.php?'+Math.random"/><?php echo isset($codes)?$codes:""; ?></span>
                </li>
                <li class="register-protocol">
                    <input type="checkbox" name="protocol" onclick="check();" />我已阅读并同意《新闻视界用户服务条款与隐私保护政策》
                </li>
                <li id="submit" style="display: none;" class="register-button"><input type="submit" value="注册新账号" class="register-submit-button"/></li>
            </ul>
        </form>
    </div>
</div>
</body>
</html>
