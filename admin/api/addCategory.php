<?php 

    //拿提交的数据
    $slug = $_POST['slug'];
    $name = $_POST['name'];

    //准备sql语句
    $sql = "insert into categories(slug,name) values('$slug','$name')";
    //导入文件
    require_once "tools/doSql.php";

    $rows = my_zsg($sql);

    if($rows > 0){

        echo '{ "msg":"ok","code":0 }';
    }else{

        echo '{ "msg":"fail","code":1 }';
    }