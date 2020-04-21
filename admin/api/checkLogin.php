<?php 

    //直接打开session
    session_start();

    //判断有没有session保存数据就行了
    if (isset($_SESSION['userInfo'])){

        echo '{ "msg":"ok","code":0 }';

    }else{

        echo '{ "msg":"fail","code":1 }';
    }