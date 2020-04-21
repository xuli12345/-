<?php 

    $id = $_GET['id'];

    //准备sql语句
    $sql = "select *from posts where id = $id";

    require_once "tools/doSql.php";

    $data = my_select($sql);

    // var_dump($data[0]);

    //注意：记得取下标0，因为哪怕你只查到一条数据，它也是一个二维数组
    echo json_encode($data[0]);