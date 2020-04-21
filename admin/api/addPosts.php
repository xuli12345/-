<?php 

//拿到提交的数据
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];

//拿到提交的图片
    $feature = $_FILES['feature'];
    //拿到图片名
    $name = $feature['name'];
    //拿到临时路径
    $tmp = $feature['tmp_name'];

    //图片名转成GBK的编码
    $gbkName = iconv('utf-8','gbk',$name);

    //准备路径,PHP中不支持根目录的写法
    $path = "../../uploads/$gbkName";
    
    //移动上传的临时路径上的文件到新的目录去
    move_uploaded_file($tmp,$path);


    //打开session
    session_start();
    $userID = $_SESSION['userInfo']['id'];


    //在操作数据库之前把路径改回UTF-8编码的路径
    // $path = "../../uploads/$name";
    //数据库是可以保存根目录的，只是说PHP的函数用不了根目录，但是我保存到数据库又不是为了给PHP用的
    //是为了显示在网页上的，网页是支持根目录的，所以我们也可以写根目录，本来uploads文件夹就是在根目录上面
    $path = "/uploads/$name";

   
    //导入工具文件
    require_once "tools/doSql.php";

    $sql = "insert into posts(title,content,slug,category_id,created,status,user_id,feature) 
    values('$title','$content','$slug','$category','$created','$status','$userID','$path')";

    //执行sql语句
    my_zsg($sql);

    if($rows > 0){

        echo '{"msg":"ok","code":0}';
    }else{

        echo '{"msg":"fail","code":1}';
    }