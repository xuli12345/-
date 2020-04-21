<?php
    //拿到邮箱和密码
    $email =  $_POST['email'];
    $password =  $_POST['password'];


    //去数据库查询结果
    
    //1. 连接数据库
    $link = mysqli_connect('127.0.0.1','root','root','baixiu');

    //2. 操作数据库
    $sql = "select *from users where email='$email' and password = '$password'";
    $result = mysqli_query($link,$sql);
    //转成数组，哪怕只查到一条数据，得到的也是一个二维数组
    $data = mysqli_fetch_all($result,1);

    //关闭数据库
    mysqli_close($link);

    //判断结果
    if( count($data) > 0){

        //登录成功,如果登录成功,$data有数据的,存到session
        //打开session
        session_start();

        //我们要的只是真正的数据，而$data是一个二维数组，下标0就是我们真正要的关联型数组
        $_SESSION['userInfo'] = $data[0];

        echo '{ "msg":"ok","code":0}';
    }else{

        //登录失败，$data里是没有数据的
        echo '{ "msg":"fail","code":1}';
    }