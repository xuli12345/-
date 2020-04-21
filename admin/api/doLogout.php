<?php 

    //打开session
    session_start();

    //删除session
    unset($_SESSION['userInfo']);

    //删除session后就跳转到登录页
    //注意要先出这个文件夹再到登录页
    header('location:../login.html');