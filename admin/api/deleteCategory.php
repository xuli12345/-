<?php 

    //拿到提交的数据
    $ids = $_POST['ids'];

    //导入文件
    require_once "tools/doSql.php";
    $sql = "delete from categories where id in ( $ids )";

    $rows = my_zsg($sql);

    if($rows > 0){

        echo '{ "msg":"ok","code":0 }';
    }else{

        echo '{ "msg":"fail","code":1 }';
    }