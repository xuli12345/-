<?php

    //拿到提交的数据
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];

    //查出数据库中的旧密码，但是没必要从数据库取出来，因为你能到修改密码的界面
    //肯定有登录过，而一旦登录，你的所有信息都存在session里，直接从session里取出来就行了
    session_start();
    if ($oldPass !=  $_SESSION['userInfo']['password']){

        //代表旧密码输入错误，核验失败！
        echo  '{ "msg":"旧密码核对失败","code":1 }';
        return;
    }


    //能来到这证明旧密码输入正确，就可以操作数据库了
    $id = $_SESSION['userInfo']['id'];
    $sql = "update users set password='$newPass' where id = $id";
    require_once "tools/doSql.php";
    $rows =  my_zsg($sql);

    if($rows > 0){

        //成功
        echo '{ "msg":"修改成功","code":0 }';
    }else{

        echo '{ "msg":"数据库执行错误","code":2 }';
    }