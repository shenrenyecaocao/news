<?php
        include_once "./dbio/newsArticles.php";
        include_once "./dbio/newsTypes.php";
        $typeId = $_GET['typeId'];
        $currentPage = isset($_GET["currentPage"])?$_GET["currentPage"]:1;
        $result = NewsArticles::getTypeNews($typeId,$currentPage);
        $totalPage = $result[0];//总页数
        $getTypeNews = $result['1'];//当前页面的记录
        $newsType = NewsTypes::getNewsType($typeId);//当前的新闻类名
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻视界_<?php echo $newsType['typeName']; ?>新闻</title>
<link type="text/css" rel="stylesheet" media="all" href="styles/reset.css"/>
<link type="text/css" rel="stylesheet" media="all" href="styles/layout.css"/>
<link type="text/css" rel="stylesheet" media="all" href="styles/common.css"/>
<script src="./jquery.js" charset="utf-8"></script>
<!-- goto-page-num -->
<script type="text/javascript">
    $(function(){
        $("#goto-page-num").focus(function(){
            this.value="";
        });
        $("#goto-page-num").blur(function(){
            var Page = this.value;
            Page = Math.ceil(Page);
            if(Page<=<?php echo $totalPage ?> && Page>=1){
                window.location.href="newstype.php?typeId=<?php echo $typeId ?>&currentPage="+Page;
            }
        });
    });
</script>
</head>
<body>
<!-- 网页的头 -->
<?php include_once 'header.php';?>

<!--导航结束-->
<div class="section clear">
    <div class="side-left-680">
        <div id="focus-wrapper2">
            <ul id="focus-image">
                <li><a href="#"><img src="photoview/2015031912515039743.jpg" alt="" style="width:680px;"/></a></li>
                <li><a href="#"><img src="ad/12493512_1342949594483.jpg" alt=""/></a></li>
                <li><a href="#"><img src="ad/12493512_1342949594489.jpg" alt=""/></a></li>
            </ul>
            <div id="focus-mask"></div>
            <ul id="focus-text">
                <li><a href="#">一周图片精选：艺考生隧道里排长队</a></li>
                <li><a href="#">画师五彩缤纷的世界2</a></li>
                <li><a href="#">画师五彩缤纷的世界3</a></li>
            </ul>
            <ol class="clear" id="focus-num">
                <li>1</li>
                <li class="current">2</li>
                <li>3</li>
            </ol>
        </div>
        <div>
           <?php
                $imagepath = "./photoview/14405-63289.jpg";
                foreach($getTypeNews as $v){
                    $content = strip_tags($v['content']);
                    $len = mb_strlen($content,"utf-8");
                    if($len>100){
                        $content = mb_substr($content, 0, 100, "utf-8");
                    }
            ?>
            <div class="news-list-item clear">
                <div class="news-list-item-pic"><a href="#"><img src="<?php echo $v['imagepath']?$v['imagepath']:$imagepath; ?>" alt=""/></a></div>
                <div class="news-list-item-txt">
                    <h1><a href="news.php?articleId=<?php echo $v['articleId'] ?>"><?php echo $v['title'] ?></a></h1>
                    <p><?php echo $content ?></p>
                </div>
            </div>
            <?php
                }
             ?>
            <!-- 分页 -->
            <div class="page-list clear">
            <?php
                if ($currentPage!=1){
            ?>
                <a href="newstype.php?typeId=<?php echo $typeId ?>&currentPage=<?php echo $currentPage>1?$currentPage-1:1; ?>" class="pre">&lt;</a>
            <?php  } ?>
            <?php
                for($i=1;$i<=$totalPage;$i++){
                    if($i==$currentPage){
                        echo "<span>".$i."</span>";
                    }else{
             ?>
                <a href="newstype.php?typeId=<?php echo $typeId ?>&currentPage=<?php echo $i ?>"><?php echo $i; ?></a>
               <?php
                    }
                }
                ?>
                <?php
                    if($currentPage!=$totalPage){
                 ?>
                <a href="newstype.php?typeId=<?php echo $typeId ?>&currentPage=<?php echo $currentPage<$totalPage?$currentPage+1:$currentPage; ?>" class="next">&gt;</a>
            <?php   } ?>
                <input type="text" name="goto-page-num" id="goto-page-num" value="go"/>
            </div>
      </div>
    </div>
    <div class="side-right-300">
        <h3 class="hot-title">24小时排行榜</h3>
        <ol class="list-hot">
            <li class="hot"><span class="top-num num1">01</span><a href="http://news.sina.com.cn/c/2015-03-01/021731553483.shtml" target="_blank">广东:遇台风黄色预警等四种信号即可自行停课</a></li>
            <li class="hot"><span class="top-num num2">02</span><a href="http://news.sina.com.cn/c/2015-03-01/020931553472.shtml" target="_blank">上海迪斯尼回应单日票价500元:仍在研究</a></li>
            <li class="hot"><span class="top-num num3">03</span><a href="http://news.sina.com.cn/c/2015-03-01/020431553512.shtml" target="_blank">西安市环保局原局长等5人涉嫌受贿被捕</a></li>
            <li><span class="top-num">04</span><a href="http://news.sina.com.cn/c/2015-03-01/005931553346.shtml" target="_blank">北京国土局:暂不发放新版房产证 </a></li>
            <li><span class="top-num">05</span><a href="http://news.sina.com.cn/c/2015-02-28/233331553297.shtml" target="_blank">江西为3.36万名农民工追讨工资及赔偿金4.79亿</a></li>
            <li><span class="top-num">06</span><a href="http://news.sina.com.cn/c/2015-02-28/230931553282.shtml" target="_blank">江西乐平煤矿煤与瓦斯突出事故已确认4矿工被</a></li>
            <li><span class="top-num">07</span><a href="http://news.sina.com.cn/c/2015-02-28/225631553279.shtml" target="_blank">南昌符合标准校车仅1辆获标牌 安全隐患巨大</a></li>
            <li><span class="top-num">08</span><a href="http://news.sina.com.cn/c/2015-02-28/211631553192.shtml" target="_blank">广东化州政协副主席李沛涉嫌严重违纪被调查</a></li>
            <li><span class="top-num">09</span><a href="http://news.sina.com.cn/c/2015-02-28/202131553113.shtml" target="_blank">青海狱警违规为17名罪犯办理减刑一审获刑18年</a></li>
            <li><span class="top-num">10</span><a href="http://news.sina.com.cn/c/2015-02-28/200431553106.shtml" target="_blank">湖北黄冈人大常委会主任龙福清等2人被调查</a></li>
        </ol>

    </div>
</div>
<!--版权区 start-->
<?php include_once 'footer.php';?>
<!--版权区 end-->

</body>
</html>
