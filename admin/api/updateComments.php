<?php 

    //先接收提交过来的数据
    $status = $_POST['status'];
    $ids = $_POST['ids'];

    //1.连接数据库
    $link = mysqli_connect('127.0.0.1','root','root','baixiu');

    //2.操作数据库
    $sql = "update comments set status = '$status' where id in ($ids)";
    $result = mysqli_query($link,$sql);

    //获取到受影响的行数
    $rows = mysqli_affected_rows($link);

    //3.关闭数据库
    mysqli_close($link);

    if($rows > 0){
        //成功
        echo '{"msg":"ok","code":0}';
    }else{

        //失败
        echo '{"msg":"fail","code":1}';
    }
