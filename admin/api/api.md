## 做登录的接口

type:post
url:api/doLogin.php
data:
    email：邮箱
    password:密码

响应体：
    json
    以后开发中，响应体一般回来的都是JSON

    { msg:"ok",code:0 }
    或
    { msg:"fail",code:1 }


## 判断是否登录的接口

type：get
url：api/checkLogin.php
data：无

响应体：
    json

    { msg:"ok",code:0 }
    或
    { msg:"fail",code:1 }


## 退出的接口
type:get
url: api/doLogout.php
data：无

响应体：没有响应体


## 获取登录用户信息的接口
type: get
url: api/getUserInfo.php
data：无
响应体：
    JSON
   {"id":"2","slug":"jack","email":"jack@heima.com","password":"123456","nickname":"\u6770\u514b","avatar":"\/uploads\/avatar_1.jpg","bio":null,"status":"activated"}


## 获取网站信息的接口
type: get
url: api/getWebInfo.php
data: 无
响应体：
    JSON

    { wenzhang:323, caogao:23,fenlei:4, pinglun:32,daishenhe:32 }


## 获取分页评论数据的接口
type: get
url:  api/getComments.php
data: 
     pageIndex:页码
     pageSize:页容量

响应体：
    JSON

    {
        data:[ {},{},{} ]
        totalPages:57
    }


## 修改评论的接口
type: post
url: api/updateComments.php
data:
    status: 要修改的状态
    ids： 要修改的数据的id，如果是单行操作就传一个id，如果是批量操作就传多个id，多个id之间逗号隔开

响应体：
    JSON

    { msg:"ok",code:0 }
    或者
    { msg:"fail",code:1 }



## 获取文章的接口
type:get
url: api/getPosts.php
data:   
    pageIndex:页码
    pageSize:页容量
    category:分类
    status:状态

响应体：
    JSON
    { 
        "data":[ {},{} ],
        "totalPages":76
    }


## 获取分类的接口
type: get
url: api/getCategory.php
data：无

响应体：
    JSON
   [
       {},
       {}
   ]


## 新增文章的接口
type:post
url: api/addPosts.php
data:
    title:标题
    content:内容
    slug:别名
    feature：图像
    category:所属分类
    created：发布时间
    status：状态

响应体：
    JSON
    { "msg":"ok",code:0 }
    或
    { "msg":"fail",code:1 }


## 根据id获取文章详情的接口
type:get
url: api/getPostById.php
data:
    id:要查询的文章id
响应体：
    JSON
    { "id":1,"slug":"haha","title" }


## 修改文章的接口
type:post
url:api/updatePosts.php
data: 
    id:要修改的文章的id
    title:标题
    content:内容
    slug:别名
    feature：图像
    category:所属分类
    created：发布时间
    status：状态

响应体：
    JSON
    { "msg":"ok",code:0 }
    或
    { "msg":"fail",code:1 }



## 修改登录用户信息的接口
type: post
url:  api/updateUser.php
data:
    avatar:头像
    slug:别名
    nickname:昵称
    bio:简介

响应体：
    JSON
    { "msg":"ok",code:0 }
    或
    { "msg":"fail",code:1 }


## 修改密码的接口
type:post
url: api/changePassword.php
data:
    oldPass：旧密码
    newPass:新密码

响应体：
    JSON

    { "msg":"修改成功",code:0 }

    或

    { "msg":"旧密码核对失败",code:1 }

    { "msg":"数据库执行错误",code:2 }



## 新增分类的接口
type: post
url: api/addCategory.php
data:
    slug:别名
    name:分类名

响应体：
    JSON
    { "msg":"ok","code":0 }
    或
    { "msg":"fail","code":1 }


## 修改分类的接口
type: post
url: api/updateCategory.php
data:
    id: 分类的id
    slug:别名
    name：分类名

响应体：
    JSON
    { "msg":"ok","code":0 }
    或
    { "msg":"fail","code":1 }


## 删除分类的接口
type: post
url: api/deleteCategory.php
data: 
        ids:要删除的id，如果是多行，就多个id，用逗号隔开
        
响应体：
    JSON
    { "msg":"ok","code":0 }
    或
    { "msg":"fail","code":1 }


## 获取所有轮播图的接口
type: get
url: api/getSliders.php
data:无
响应体：
    JSON
    [
        {},
        {}
    ]


## 新增轮播图的接口
type:post
url: api/addSliders.php
data:
    image:图片
    text:轮播图文字
    link：连接

响应体：
    JSON
    { "msg":"ok","code":0 }
    或
    { "msg":"fail","code":1 }


## 删除轮播图的接口
type:post
url: api/deleteSliders.php
data:
        ids: 要删除的id，多个id之间用逗号隔开
响应体：
    JSON
    { "msg":"ok","code":0 }
    或
    { "msg":"fail","code":1 }