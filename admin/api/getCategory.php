<?php

    require_once "tools/doSql.php";

    $sql = "select *from categories";

    $data = my_select($sql);

    //转成JSON输出
    echo json_encode($data);