<?php

    //获取传递过来的id和name
    $id = $_GET['id'];
    $name = $_GET['name'];

    //查出这个分类下的3篇最新文章
    $sql = "select p.title,u.nickname,p.created,p.content,p.views,p.likes,p.feature from posts p
              inner join users u
              on p.user_id = u.id
              where p.category_id=$id and p.status = 'published'
              order by p.id desc
              limit 3";

    require_once "admin/api/tools/doSql.php";
    $list = my_select($sql);

    // var_dump($list);
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
      <div class="panel new">
        <h3><?php echo $name; ?></h3>

      <?php foreach($list as $value): ?>
        <div class="entry">
          <div class="head">
            <a href="javascript:;"><?php echo $value['title'];?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $value['nickname'];?> 发表于 <?php echo $value['created'];?></p>
            <p class="brief"><?php echo $value['content'];?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $value['views'];?>)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $value['likes'];?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $name;?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?php echo $value['feature'];?>" alt="">
            </a>
          </div>
        </div>
<?php endforeach;?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
