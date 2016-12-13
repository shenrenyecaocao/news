<?php 
	header("content-type:text/html;charset=utf-8");
	include_once "./dbio/newsArticles.php";
	include_once "./dbio/friendlink.php";
	//获取有图片的刚发表的
	$imghotnews = NewsArticles::imghotnews();
	//获取点击量最高的新闻
	$hotnews = NewsArticles::hotnews();
	//查取内地新闻
	$ndxw = NewsArticles::queryNew($typeName="内地新闻");
	//查取港澳台新闻
	$gatxw = NewsArticles::queryNew($typeName="港澳台新闻");
	//环球视野新闻
	$hqsy = NewsArticles::queryNew($typeName="环球视野");
	//海外查看
	$hwck = NewsArticles::hwck();
	//国际新闻
	$gjxw = NewsArticles::gjxw();
	//热点评论
	$hotReview = NewsArticles::hotReview();
	//查取点击量最高的新闻
	$hints = NewsArticles::hints();
	//最新消息的新闻
	$timeNews = Newsarticles::timeNews();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页_新闻视界</title>
<link href="styles/reset.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/layout.css" rel="stylesheet" type="text/css" media="all" />
<link href="styles/common.css" rel="stylesheet" type="text/css" media="all" />
<script>
	function show(id)
	{
		if(id==1){
			document.getElementById("reviews").style.display="none";
			document.getElementById("hints").style.display="";
			document.getElementById("div1").style.borderBottom="2px solid #990000";
			document.getElementById("div2").style.borderBottom="0px solid #990000";
		}
		if(id==2){
			document.getElementById("reviews").style.display="";
			document.getElementById("hints").style.display="none";
			document.getElementById("div1").style.borderBottom="0px solid #990000";
			document.getElementById("div2").style.borderBottom="2px solid #990000";	
		} 
	}

	 function changeImg(id)
  {
	  for(var i=0;i<=2;i++)
	  {
		  document.getElementById("imgLi"+i).style.display = "none";
		  document.getElementById("titleLi"+i).style.display = "none";
		  document.getElementById("btn"+i).className = "";
	  }
	  document.getElementById("imgLi"+id).style.display = "";
	  document.getElementById("titleLi"+id).style.display = "";
	  document.getElementById("btn"+id).className = "current";
  }

</script>
</head>
<body>
<!-- 网页的头 -->
<?php include_once 'header.php';?>

<!--头条新闻开始-->
<div class="section clear">
	<div class="side-left" id="focus-wrapper">
		<ul id="focus-image">
		<?php 
			foreach($imghotnews as $v){
		 ?>
			<li><a href="news.php?articleId=<?php echo $v["articleId"] ?>"><img src="<?php echo $v["imagepath"] ?>" alt=""/></a></li>
		<?php 
			}
		 ?>
		</ul>
		<div id="focus-mask"></div>
		<ul id="focus-text">
		<?php 
			foreach($imghotnews as $v){
		 ?>
			<li><a href="news.php?articleId=<?php echo $v["articleId"] ?>"><?php echo $v["title"] ?></a></li>
		<?php 
			}
		 ?>
		</ul>
		<ol class="clear" id="focus-num">
			<li>1</li>
			<li class="current">2</li>
			<li>3</li>
		</ol>
	</div>
	<div class="side-right" id="recommend">
		<?php
			foreach($hotnews as $v){
				$title = $v["title"];
				if(mb_strlen($title,"utf-8")>20){
					$title = mb_substr($title, 0, 20,"utf-8")."...";
				}
				$content = mb_substr($v["content"], 0, 80,"utf-8");
		 ?>
		<h1 class="headline"><a target="_blank" href="news.php?articleId=<?php echo $v["articleId"] ?>"><?php echo $title ?></a></h1>
		<p class="throw">[ <a target="_blank" href="news.php?articleId=<?php echo $v["articleId"] ?>"><?php echo $content; ?></a>]</p>
		<?php 
			}
		 ?>
	</div>
</div>
<!--头条新闻结束-->
<!--国内新闻 start-->
<div class="section clear">
	<div class="section-title-wrapper">
		<a href="#" class="section-title-name section-title-china">国内新闻</a>
	</div>
	<div class="side-left">
		<div class="part-title">
			<div class="title-name">
				<a href="#">内地新闻</a>
			</div>
		</div>
		<ul class="section-part-list">
		<?php 
			foreach ($ndxw as $v){ 
		?>
			<li><a href="./news.php?articleId=<?php echo $v['articleId']; ?>" target="_blank"><?php echo $v['title']; ?></a></li>
		<?php 
			}
		 ?>
        </ul>
	</div>
	<div class="side-center">
		<div class="part-title">
			<div class="title-name">
				<a href="#">港澳台新闻</a>
			</div>
		</div>
		<ul class="section-part-list">
		<?php 
			foreach ($gatxw as $v){ 
		?> 
			<li><a href="./news.php?articleId=<?php echo $v['articleId']; ?>" target="_blank"><?php echo $v["title"]; ?></a></li>
			
		<?php 
			}
		?>
        </ul>
	</div>
	<div class="side-right">
		<div class="part-title">
			<div id="div1" 	class="title-name title-name-hover">
				<a href="#" onmouseover="show(1)">点击量排行</a>
			</div>
			<div id="div2" class="title-name title-name-no-border">
				<a href="#" onmouseover="show(2)">评论数排行</a>
			</div>
		</div>
		<ol id="reviews" style="display: none;" class="section-part-list-with-num">
		<?php 
						foreach($hotReview as $k => $v){
							$title=$v["title"];
							$len = mb_strlen($title,"utf-8");
							if($len>21){
								$title = mb_substr($title,0,20,"utf-8")."...";
							}
			 ?>
				<li><span class="top-num num<?php echo $k+1; ?>"><?php echo $k>8?"":0; ?><?php echo $k+1; ?></span><a href="./news.php?articleId=<?php echo $v['articleId']; ?>" target="_blank"><?php echo $title;?></a></li>
				<?php 	
						} 
				?>
		</ol>
		<ol id="hints" class="section-part-list-with-num">
		<?php 
					foreach($hints as $k => $v){
						$title=$v["title"];
						$len = mb_strlen($title,"utf-8");
						if($len>21){
							$title = mb_substr($title,0,20,"utf-8")."...";
						}
		 ?>
			<li><span class="top-num num<?php echo $k+1; ?>"><?php echo $k>8?"":0; ?><?php echo $k+1; ?></span><a href="./news.php?articleId=<?php echo $v['articleId']; ?>" target="_blank"><?php echo $title;?></a></li>
			<?php 	
					} 
			?>
        </ol>
	</div>
</div>
<!--国内新闻 end-->
<!--国际新闻 start-->
<div class="section clear">
	<div class="section-title-wrapper">
		<a href="#" class="section-title-name section-title-world">国内新闻</a>
	</div>
	<div class="side-left">
		<div class="part-title">
			<div class="title-name">
				<a href="#">最新消息</a>
			</div>
		</div>
		<ul class="section-part-list">
		<?php  
			foreach($timeNews as $v){
		?>
			<li><a href="./news.php?articleId=<?php echo $v['articleId']; ?>" target="_blank"><?php echo $v["title"]; ?></a></li>

		<?php  
			}
		?>
        </ul>
	</div>
	<div class="side-center">
		<div class="part-title">
			<div class="title-name">
				<a href="#">环球视野</a>
			</div>
		</div>
		<ul class="section-part-list">
		<?php  
			foreach($hqsy as $v){
		?>
			<li><a href="./news.php?articleId=<?php echo $v['articleId']; ?>" target="_blank"><?php echo $v["title"]; ?></a></li>
		<?php  
			}
		?>	
        </ul>
	</div>
	<div class="side-right">
		<div class="part-title">
			<div class="title-name">
				<a href="#"><em class="icon1">海</em>外查看</a>
			</div>
		</div>
		<?php 
			//海外查看
			foreach($hwck as $v){
		 ?>
		<div class="pic-info clear">
			<div class="pic"><img src="<?php echo $v["imagepath"]; ?>" alt=""/></div>
			<div class="txt"><?php echo $v["title"]; ?></div>
		</div>
		<?php			
			}
 		?>
	</div>
</div>

<!--国际新闻 end-->
<!--娱乐新闻 start-->
<div class="section">
	<div class="section-title-wrapper">
		<a href="#" class="section-title-name section-title-world">国际新闻</a>
	</div>
	<div class="clear" id="ent-image-lists">
	<?php
			foreach($gjxw as $v){
		 ?>
		<div class="ent-image-item">
			<a href="./news.php?articleId=<?php echo $v["articleId"] ?>"><img src="<?php echo $v["imagepath"]; ?>" width="224" height="144" alt=""/></a>
			<p><a href="./news.php?articleId=<?php echo $v["articleId"] ?>"><?php echo $v["title"]; ?></a></p>
		</div>
		<?php		
			}
 		?>
	</div>
</div>
<!--娱乐新闻 end-->
<!--友情链接 start-->
<div class="section">
	<h4 class="friendlink-hr"><span class="friendlink">友情链接</span></h4>
	<div class="friendlink-cont">
	<?php 
		$friendlink = Friendlink::getAllLink();
		foreach($friendlink as $k => $v){
			if($k%15==0){
				echo "<p>";
			}
	 ?>
		<a href="<?php echo $v["linkUrl"]; ?>" target="_blank"><?php echo $v["linkName"] ?></a><?php echo $k%15==14?"":"|"; ?>
	<?php 
			if($k%15==14){
				echo "</p>";
			}
		}
	 ?>	 
	</div>
</div>
<!--友情链接 end-->

<!-- 网页的脚注 -->
<?php include_once 'footer.php';?>
</body>
</html>
