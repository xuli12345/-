<?php 

    //拿到提交的数据
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    $id = $_POST['id'];

//拿到提交的图片
    $feature = $_FILES['feature'];
    //拿到图片名
    $name = $feature['name'];
    //拿到临时路径
    $tmp = $feature['tmp_name'];

    //图片名转成GBK的编码
    $gbkName = iconv('utf-8','gbk',$name);

    //准备路径,PHP中不支持根目录的写法
    $path = "../../uploads/$gbkName";
    
    //移动上传的临时路径上的文件到新的目录去
    move_uploaded_file($tmp,$path);

    //操作数据库之前先转成UTF-8的路径
    $path = "/uploads/$name";

    //导入sql工具文件
    require_once "tools/doSql.php";

    //准备sql语句
    if($name != ""){
        //如果图片名不为空，证明重新选择过图片，那么我们就要修改feature字段
        $sql = "update posts set
                title = '$title',
                slug = '$slug',
                content = '$content',
                category_id = '$category',
                created = '$created',
                status = '$status',
                feature = '$path'
                where id = '$id'";
    }else{
        
        //图片名为空，证明没改过图片，就不需要修改feature字段
        $sql = "update posts set
                title = '$title',
                slug = '$slug',
                content = '$content',
                category_id = '$category',
                created = '$created',
                status = '$status'
                where id = '$id'";
    }

    $rows = my_zsg($sql);

    if($rows > 0){

        echo '{"msg":"ok","code":0}';
    }else{

        echo '{"msg":"fail","code":1}';
    }
?>