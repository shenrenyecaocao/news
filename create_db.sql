create database news character set=utf8;

use news;

#角色表
create table roleInfo
(
    roleId               int                  auto_increment primary key,
    roleName             varchar(100)         not null
);
insert into roleInfo(roleName)values('超级管理员');
insert into roleInfo(roleName)values('普通管理员');

#管理员表
create table manager
(
    userId               int                  auto_increment primary key,
    userName             varchar(20)          unique not null,
    password             varchar(20)          not null,
    roleId               int                  not null,
    mailBox              varchar(100)         not null,
    remark               varchar(1000)            null,
    dateandtime          timestamp            default current_timestamp,
    foreign key (roleId) references roleInfo(roleId)
);
insert into manager(userName,password,roleId,mailBox)values('admin','123',1,'123@sina.com');
insert into manager(userName,password,roleId,mailBox)values('tom','123',2,'123@sina.com');

#会员表
create table userInfo
(
    userId               int                  auto_increment primary key,
    userName             varchar(20)          unique not null,
    password             varchar(20)          not null,
    dateandtime          timestamp            default current_timestamp
);

#分类表
create table newsTypes
(
    typeId               int                  auto_increment primary key,
    typeName             varchar(20)          not null,
    pid                  int                  not null,
    level                int                  not null,#菜单级别  1一级  2二级
    isDel                int                  default 0 #是否回收站  0未  1己
);
insert into newsTypes(typeName,pid,level)values('国内',0,1);
insert into newsTypes(typeName,pid,level)values('国际',0,1);
insert into newsTypes(typeName,pid,level)values('社会',0,1);
insert into newsTypes(typeName,pid,level)values('娱乐',0,1);
insert into newsTypes(typeName,pid,level)values('军事',0,1);
insert into newsTypes(typeName,pid,level)values('历史',0,1);
insert into newsTypes(typeName,pid,level)values('百科',0,1);
insert into newsTypes(typeName,pid,level)values('公益',0,1);

insert into newsTypes(typeName,pid,level)values('内地新闻',1,2);
insert into newsTypes(typeName,pid,level)values('港澳台新闻',1,2);

insert into newsTypes(typeName,pid,level)values('环球视野',2,2);
insert into newsTypes(typeName,pid,level)values('海外查看',2,2);

#新闻表
create table newsArticles
(
   articleId             int                 auto_increment primary key,
   typeId                int                 not null,   #
   title                 varchar(100)        not null,   #
   content               text                not null,   #
   userId                int                 not null,   #
   hints                 int                 default 0,#点击量
   imagepath             varchar(1000)           null,#新闻图片的路径
   dateandtime           varchar(20)         not null,#发表时间    #
   isHd                  int                 default 0,#精选  0未  1精
   isStories             int                 default 0,#图片故事  0未 1故事
   isNature              int                 default 0,#图片自然  0未 1自然
   isDel                 int                 default 0,#是否存入回收站  0未  1己
   foreign key (typeId) references newsTypes(typeId),
   foreign key (userId) references manager(userId)
);

#新闻点击量表
create table newsHints
(
   id                    int                 auto_increment primary key,
   articleId             int                 not null,
   dateandtime           varchar(20)         not null,
   foreign key (articleId) references newsArticles(articleId)
);

#评论表
create table reviews
(
   reviewId             int                 auto_increment primary key,
   userId               int                 not null,
   articleId            int                 not null,
   content              varchar(1000)       not null,
   dateandtime          timestamp           default current_timestamp,
   foreign key (articleId) references newsArticles(articleId),
   foreign key (userId) references userInfo(userId)
);

#友情链接表
create table friendLink
(
   linkId              int                  auto_increment primary key,
   linkName            varchar(100)         not null,
   linkUrl             varchar(1000)        not null
);
insert into friendLink(linkName,linkUrl)values('中国政府网','http://www.gov.cn');
insert into friendLink(linkName,linkUrl)values('中国网','http://www.china.com.cn');
insert into friendLink(linkName,linkUrl)values('人民网','http://www.people.com.cn');
insert into friendLink(linkName,linkUrl)values('新华网','http://www.xinhuanet.com');
insert into friendLink(linkName,linkUrl)values('中新网','http://www.chinanews.com');
insert into friendLink(linkName,linkUrl)values('央视网','http://www.cctv.com/default.shtml');
insert into friendLink(linkName,linkUrl)values('中广网','http://www.cnr.cn');
insert into friendLink(linkName,linkUrl)values('中国日报','http://www.chinadaily.com.cn');
insert into friendLink(linkName,linkUrl)values('中青在线','http://www.cyol.net/node/index.htm');
insert into friendLink(linkName,linkUrl)values('光明网','http://www.gmw.cn');
insert into friendLink(linkName,linkUrl)values('解放军报','http://www.chinamil.com.cn');
insert into friendLink(linkName,linkUrl)values('法制日报','http://www.legaldaily.com.cn');
insert into friendLink(linkName,linkUrl)values('中国台湾网','http://www.taiwan.cn');
insert into friendLink(linkName,linkUrl)values('中经网','http://www.ce.cn');
insert into friendLink(linkName,linkUrl)values('南风窗','http://www.nfcmag.com');

insert into friendLink(linkName,linkUrl)values('中国周刊','http://www.chinaweekly.cn');
insert into friendLink(linkName,linkUrl)values('三联生活周刊','http://www.lifeweek.com.cn');
insert into friendLink(linkName,linkUrl)values('北青网','http://www.ynet.com');
insert into friendLink(linkName,linkUrl)values('大洋网','http://www.dayoo.com');
insert into friendLink(linkName,linkUrl)values('南方报业','http://www.nanfangdaily.com.cn');
insert into friendLink(linkName,linkUrl)values('金羊网','http://www.ycwb.com');
insert into friendLink(linkName,linkUrl)values('南方网','http://www.southcn.com');
insert into friendLink(linkName,linkUrl)values('东方网','http://www.eastday.com');
insert into friendLink(linkName,linkUrl)values('千龙网','http://www.21dnn.com');
insert into friendLink(linkName,linkUrl)values('新京报','http://www.thebeijingnews.com');
insert into friendLink(linkName,linkUrl)values('京华时报','http://epaper.jinghua.cn');
insert into friendLink(linkName,linkUrl)values('红网','http://www.rednet.com.cn');
insert into friendLink(linkName,linkUrl)values('工人日报','http://workercn.cn');
insert into friendLink(linkName,linkUrl)values('中国新闻周刊','http://www.inewsweek.cn');
insert into friendLink(linkName,linkUrl)values('参考消息','http://www.cankaoxiaoxi.com');

insert into friendLink(linkName,linkUrl)values('新周刊','http://www.neweekly.com.cn');
insert into friendLink(linkName,linkUrl)values('大河网','http://www.dahe.cn');
insert into friendLink(linkName,linkUrl)values('中国长安网','http://www.chinapeace.org.cn');
insert into friendLink(linkName,linkUrl)values('环球网','http://www.huanqiu.com');
insert into friendLink(linkName,linkUrl)values('四川新闻网','http://www.newssc.org');
insert into friendLink(linkName,linkUrl)values('北晨网','http://www.morningpost.com.cn');
insert into friendLink(linkName,linkUrl)values('浙江在线','http://www.zjol.com.cn');
insert into friendLink(linkName,linkUrl)values('国际在线','http://gb.cri.cn');
insert into friendLink(linkName,linkUrl)values('舜网','http://www.e23.cn');
insert into friendLink(linkName,linkUrl)values('新快网','http://www.xkb.com.cn./index.php');
insert into friendLink(linkName,linkUrl)values('中国江西网','http://www.jxcn.cn');
insert into friendLink(linkName,linkUrl)values('云南网','http://www.yunnan.cn');
insert into friendLink(linkName,linkUrl)values('深圳新闻网','http://www.szed.com');
insert into friendLink(linkName,linkUrl)values('中安在线','http://www.anhuinews.com');
insert into friendLink(linkName,linkUrl)values('新文化网','http://www.xwh.cn');

insert into friendLink(linkName,linkUrl)values('天山网','http://www.ts.cn');
insert into friendLink(linkName,linkUrl)values('亚心网','http://www.iyaxin.com');
insert into friendLink(linkName,linkUrl)values('大众网','http://www.dzwww.com');
insert into friendLink(linkName,linkUrl)values('大江网','http://www.jxnews.com.cn');
insert into friendLink(linkName,linkUrl)values('华商网','http://www.hsw.cn');
insert into friendLink(linkName,linkUrl)values('中国小康网','http://www.chinaxiaokang.com');
insert into friendLink(linkName,linkUrl)values('江西晨报网','http://www.jxcbw.cn');
insert into friendLink(linkName,linkUrl)values('新民周刊','http://xmzk.xinminweekly.com.cn');
insert into friendLink(linkName,linkUrl)values('东南网','http://www.fjsen.com');
insert into friendLink(linkName,linkUrl)values('山东新闻网','http://www.sdnews.com.cn');
insert into friendLink(linkName,linkUrl)values('新疆网','http://www.xinjiangnet.com.cn');
insert into friendLink(linkName,linkUrl)values('华龙网','http://www.cqnews.net');
insert into friendLink(linkName,linkUrl)values('荆楚网','http://news.cnhubei.com');
insert into friendLink(linkName,linkUrl)values('安徽网','http://www.ahwang.cn');
insert into friendLink(linkName,linkUrl)values('媒体大全','http://news.sina.com.cn/media.html');
