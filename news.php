<?php
include_once "./dbio/newsArticles.php";
include_once "./dbio/reviews.php";
include_once "./dbio/newsHints.php";
$articleId = $_GET['articleId'];
//获取一个新闻纪录
$articlenews = NewsArticles::getOneNews($articleId);
//获取当前新闻的评论数
$reviewNum = Reviews::getViewNum($articleId);
//增加新闻的点击量
NewsArticles::addhints($articleId);
//newsHints表添加一条记录
newsHints::setHints($articleId);
//24小时排行
$top24 = NewsArticles::gettop24($articleId);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻视界_<?php echo $articlenews['typeName'] ?>_<?php echo $articlenews['title'] ?></title>
<link type="text/css" rel="stylesheet" media="all" href="styles/reset.css"/>
<link type="text/css" rel="stylesheet" media="all" href="styles/layout.css"/>
<link type="text/css" rel="stylesheet" media="all" href="styles/common.css"/>
<script src="./jquery/jquery.js"></script>
</head>
<body>
<!-- 网页的头 -->
<?php include_once 'header.php';?>
<!--导航结束-->
<div class="section">
    <h1 class="article-title"><?php echo $articlenews['title'] ?></h1>
    <div class="clear">
        <div class="side-left-680" id="article">
            <div class="article-info"><?php echo date("Y-m-d h:i:s",$articlenews['dateandtime']) ?><a href="#">评论(<?php echo $reviewNum ?>)</a></div>
            <div class="article-body">
            <?php
                echo $articlenews['content'];
            ?>
            </div>
            <div id="comment">
                <p class="comment-count"><a href="#">已有<span><?php echo $reviewNum ?></span>条评论，共<span><?php echo $articlenews['hints'] ?>人</span>参与</a></p>
                <form action="" method="post">
                    <textarea class="comment-content">请输入评论内容</textarea>
                <div class="comment-user-cont clear">
                <?php if(!isset($_COOKIE['xwsj_login'])&&$_COOKIE['xwsj_login']==false){ ?>
                    <div class="comment-user-username"><input type="text" name="username"     class="comment-input" value="请输入账号"/></div>
                    <div class="comment-user-password"><input type="password" name="password" class="comment-input" value="请输入密码"/></div>
                    <div class="comment-user-link">
                        <input type="checkbox" name="remember" checked="checked" value="1"/> 下次自动登录
                        <a href="register.php">注册</a><a href="#">忘记密码？</a>
                    </div>
                <?php } ?>
                    <div class="comment-user-logined">
                        <span><a href="#">淘气的松鼠</a></span>
                        <span><a href="#">退出</a></span>
                        <input type="submit" value="发布" class="comment-publishing-btn"/>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="side-right-300">
            <h3 class="hot-title">24小时排行榜</h3>
            <ol class="list-hot">
            <?php
                    foreach($top24 as $k => $v){
                        $title = $v['title'];
                        $len = mb_strlen($title,"utf-8");
                        if($len>23){
                            $title = mb_substr($title, 0, 21, "utf-8")."...";
                        }
             ?>
                <li class="<?php echo $k<3?"hot":"" ?>"><span class="top-num num1"><?php echo $k<9?0:"" ?><?php echo $k+1; ?></span><a href="news.php?articleId=<?php echo $v['articleId'] ?>" target="_blank"><?php echo $title ?></a></li>
        <?php
                    }
         ?>
            </ol>
        </div>
    </div>
</div>
<!--版权区 start-->
<?php include_once 'footer.php';?>
<!--版权区 end-->

</body>
</html>
