<?php 

    //获取数据
    $pageIndex = $_GET['pageIndex'];
    $pageSize = $_GET['pageSize'];
    $category = $_GET['category'];
    $status = $_GET['status'];

    //导入工具文件
    require_once "tools/doSql.php";

    //计算起始索引 (页码 - 1) * 页容量
    $start = ( $pageIndex - 1 ) * $pageSize;
    $sql = "select  p.id,p.title,u.nickname,c.name,p.created,p.status from posts p
                inner join users u
                on p.user_id = u.id
                inner join categories c
                on p.category_id = c.id
                where p.status != 'trashed'";

    if($category != '所有分类'){
        $sql .= "and c.name = '$category'";
    }

    if($status != '所有状态'){
        $sql .= "and p.status = '$status'";
    }

    //先保存一下不加limit的sql语句，方便后面计算总数量
    $sql2 = $sql;

    $sql .="order by p.id desc limit $start,$pageSize";

    //执行数据库
    $data = my_select($sql);


    //先查出总数量，不加limit就是总数量
    $count = count(my_select($sql2));

    //总页数 = ceil( 总数量 / 页容量 )
    $totalPages = ceil( $count / $pageSize);

    //拼成关联型数组
    $arr = array(
        "data" => $data,
        "totalPages" => $totalPages
    );

    //转成JSON输出
    echo json_encode($arr);