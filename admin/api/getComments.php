<?php 

    //先接收提交的数据
    $pageIndex = $_GET['pageIndex'];
    $pageSize = $_GET['pageSize'];

    //导入sql工具文件
    require_once "tools/doSql.php";

    //计算左边的起始索引
    /* 
        查出了前10条
        limit 0,10  查出第1页   (1 - 1) * 10 = 0
        limit 10,10 查出第2页   (2 - 1) * 10 = 10
        limit 20,10 第3页       (3 - 1) * 10 = 20
        limit 30,10 第4页      (4 - 1) * 10 = 30

        右边是页容量

        左边的起始索引 = ( 用页码 - 1 ) * 页容量
   */
    $start = ( $pageIndex - 1 ) * $pageSize;

    //准备查出分页数据的sql语句
    $sql = "select c.id,c.author,c.content,p.title,c.created,c.status from comments c
                inner join posts p
                on c.post_id = p.id
                where c.status != 'trashed'         
                limit $start,$pageSize";

    //这里是查出分页数据
    $data = my_select($sql);

    //查出数据总量
    $sql = "select c.id,c.author,c.content,p.title,c.created,c.status from comments c
            inner join posts p
            on c.post_id = p.id
            where c.status != 'trashed'";

    //得到了总数量
    $count = count(my_select($sql));

    //计算总页数 = ceil( 总数量 / 页容量 )
    $totalPages = ceil( $count / $pageSize );

    // echo json_encode($data);
    // echo $totalPages;

    //应该想办法把$data和$totalPages放在一起，而且放在一起后能转成JSON
    //放在对象里面，在PHP里就是关联型数组

    $array = array(
        "data" => $data,
        "totalPages" => $totalPages
    );

    //只要把关联型数组转成JSON，就可以了
    echo json_encode($array);