编号					articleId

新闻分类  	typeId:		typeName

新闻标题				title:

提交用户	userId:		userName

发表时间				dateandtime:

		a			b			c
newsArticles\G  NewsTypes	manager		
select a.articleId,b.typeName,a.title,c.userName,a.dateandtime from
 newsArticles a, NewsTypes b, manager c where a.typeId=b.typeId and 
 a.userId=c.userId order by a.articleId;
 
 
 select a.articleId,b.typeName,a.title,c.userName,a.dateandtime from 
 (newsArticles a left join NewsTypes b on a.typeId=b.typeId) 
 left join manager c on a.userId=c.userId order by a.articleId;


 select a.articleId,b.typeName,a.title,c.userName,a.dateandtime from
 newsArticles a, NewsTypes b, manager c order by a.articleId;
 
 
 select * from newsArticles a, newsTypes b where b.typeId=1 or b.pid=1 and a.typeId=b.typeId
 select * from newsArticles where isDel=0 and typeId in (select typeId from newsTypes where pid=1)