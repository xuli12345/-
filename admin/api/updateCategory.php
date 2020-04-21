<?php 

    //拿到提交的数据
    $id = $_POST['id'];
    $slug = $_POST['slug'];
    $name = $_POST['name'];


    //准备sql语句
    $sql = "update categories set slug='$slug',name='$name' where id = $id";
    require_once "tools/doSql.php";
    $rows = my_zsg($sql);

    if($rows > 0){

        echo '{ "msg":"ok","code":0 }';
    }else{

        echo '{ "msg":"fail","code":1 }';
    }