<?php

    //接收提交的数据
    $slug = $_POST['slug'];
    $nickname = $_POST['nickname'];
    $bio = $_POST['bio'];

    //打开session
    session_start();
    $id = $_SESSION['userInfo']['id'];

    //传头像
    $avatar = $_FILES['avatar'];
    //获取到图片名
    $name = $avatar['name'];
    //获取到临时路径
    $tmp = $avatar['tmp_name'];
    //转成GBK的图片名
    $gbkName = iconv('utf-8','gbk',$name);
    //再准备目标路径
    $path = "../../uploads/$gbkName";
    //移动到目标路径
    move_uploaded_file($tmp,$path);

    //把路径换回UTF-8
    $path = "/uploads/$name";

    //准备sql语句
    if($name != ""){
        //如果不为空，代表修改过图片
        $sql = "update users set slug='$slug',nickname='$nickname',bio='$bio',avatar='$path' where id = '$id'";
    }else{
        //没有改过图片，所以不需要修改avatar
        $sql = "update users set slug='$slug',nickname='$nickname',bio='$bio'  where id = '$id'";
    }

    require_once "tools/doSql.php";
    $rows = my_zsg($sql);

    if($rows > 0){
        //如果成功，代表数据库里的数据已经改了
        //session里存的数据也要修改
        $_SESSION['userInfo']['slug'] = $slug;
        $_SESSION['userInfo']['nickname'] = $nickname;
        $_SESSION['userInfo']['bio'] = $bio;
        if($name != ""){
            $_SESSION['userInfo']['avatar'] = $path;
        }

        echo '{ "msg":"ok","code":0 }';

    }else{

        echo '{ "msg":"fail","code":1 }';
    }
?>