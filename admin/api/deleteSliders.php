<?php

    $ids = $_POST['ids'];

    $sql = "delete from sliders where id in($ids)";

    require_once "tools/doSql.php";

    $rows = my_zsg($sql);

    if($rows > 0){

        echo '{"msg":"ok","code":0 }';
    }else{

        echo '{"msg":"fail","code":1 }';
    }