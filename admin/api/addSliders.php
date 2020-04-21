<?php

    //接收提交的数据
    $text = $_POST['text'];
    $link = $_POST['link'];

    //拿到图片
    $image = $_FILES['image'];
    //拿到图片名
    $name = $image['name'];
    //拿到临时路径
    $tmp = $image['tmp_name'];
    //转成GBK的图片名
    $gbkName = iconv('utf-8','gbk',$name);
    //准备新的路径
    $path = "../../uploads/$gbkName";
    //移动图片到新路径
    move_uploaded_file($tmp,$path);

    //转回UTF-8的路径
    $path = "/uploads/$name";
    //准备写入到数据库
    require_once "tools/doSql.php";
    //准备sql语句
    $sql = "insert into sliders(image,text,link) 
                        values('$path','$text','$link')";


    $rows = my_zsg($sql);
    

    if($rows > 0){
        echo '{ "msg":"ok","code":0 }';
    }else{
        echo '{ "msg":"fail","code":1 }';
    }