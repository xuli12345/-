<?php 

  $id = $_GET['id'];

  $sql = "select c.name,p.title,u.nickname,p.created,p.views,p.content  from posts p
            inner join categories c
            on p.category_id = c.id
            inner join users u
            on p.user_id = u.id
            where p.id = $id";

  require_once "admin/api/tools/doSql.php";

  //哪怕只查出1条，它也是个二维数组，所以取下标0
  $data = my_select($sql)[0];

  //在原来阅读量的基础上+1
  $views = $data['views'] + 1;
  //写入到数据库
  $sql = "update posts set views='$views' where id = '$id'";
  //执行
  my_zsg($sql);

  //查出这篇文章下所有的评论
  $sql = "select *from comments where post_id = $id and status = 'approved'";
  $count = count(my_select($sql));
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
    <?php 

$sql = "select *from categories";
$cateList = my_select($sql);

//先准备一个数组，数组里保存所有的字体图标的类名
$iconNameList = array( "fa-glass","fa-phone","fa-fire","fa-gift","fa-hotel","fa-book" );
?>
<ul>
<?php foreach($cateList as $key => $value): ?>
  <li><a href="list.php?id=<?php echo $value['id'];?>"><i class="fa <?php echo $iconNameList[$key] ?>"></i><?php echo $value['name'];?></a></li>
<?php endforeach; ?>
</ul>
</div>
<div class="header">
<h1 class="logo"><a href="index.html"><img src="assets/img/logo.png" alt=""></a></h1>
<ul class="nav">

<?php foreach($cateList as $key => $value): ?>
  <li><a href="list.php?id=<?php echo $value['id'];?>&name=<?php echo $value['name'];?>"><i class="fa <?php echo $iconNameList[$key] ?>"></i><?php echo $value['name'];?></a></li>
<?php endforeach; ?>
</ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
    
        <ul class="body random">
        
        <?php

          $sql = "select id,feature,title,views from posts where status = 'published'
                  order by rand()
                  limit 5";
          $randList = my_select($sql);
        
        foreach($randList as $value): ?>
          <li>
            <a href="detail.php?id=<?php echo $value['id'];?>">
              <p class="title"><?php echo $value['title'];?></p>
              <p class="reading">阅读(<?php echo $value['views'];?>)</p>
              <div class="pic">
                <img src="<?php echo $value['feature'];?>" alt="">
              </div>
            </a>
          </li>
<?php endforeach; ?>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_2.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <div class="avatar">
                <img src="uploads/avatar_1.jpg" alt="">
              </div>
              <div class="txt">
                <p>
                  <span>鲜活</span>9个月前(08-14)说:
                </p>
                <p>挺会玩的</p>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $data['name'];?></a></dd>
            <dd><?php echo $data['title'];?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $data['title'];?></a>
        </h2>
        <div class="meta">
          <span><?php echo $data['nickname'];?> 发布于 <?php echo $data['created'];?></span>
          <span>分类: <a href="javascript:;"><?php echo $data['name'];?></a></span>
          <span>阅读: (<?php echo $views;?>)</span>
          <span>评论: (<?php echo $count; ?>)</span>
        </div>

        <div>
          <?php echo $data['content'];?>
        </div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
