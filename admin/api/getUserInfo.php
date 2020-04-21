<?php 

    //取到session
    session_start();

    //把获取到的用户信息转成JSON字符串再输出
    echo json_encode($_SESSION['userInfo']);