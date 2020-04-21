<?php 

    //导入我们的工具文件
    require_once "tools/doSql.php";

    //查出文章数量
    $sql = "select *from posts where status != 'trashed'";
    $data = my_select($sql);
    $wenzhang = count($data);

    //查出草稿数量
    $sql = "select *from posts where status = 'drafted'";
    $data = my_select($sql);
    $caogao = count($data);

    //查出分类数量
    $sql = "select *from categories";
    $data = my_select($sql);
    $fenlei = count($data);

    //查出所有没被删除的评论数量
    $sql = "select *from comments where status != 'trashed'";
    $data = my_select($sql);
    $pinglun = count($data);


    //查出所有待审核的评论数量
    $sql = "select *from comments where status ='held'";
    $data = my_select($sql);
    $daishenhe = count($data);

    //先做成PHP的关联型数组
    $array = array(

        "wenzhang" => $wenzhang,
        "caogao" => $caogao,
        "fenlei" => $fenlei,
        "pinglun" => $pinglun,
        "daishenhe" => $daishenhe,
    );

    //再把关联型数组转换成JSON
    echo json_encode($array);
?>
