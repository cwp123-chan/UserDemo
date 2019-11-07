# Api

## Laravel 5.7

## PHP >7.0

### 1.说明:

* 该curd demo 基于laravel 的ORM 

* 配置 env 

* ```
  DB_DATABASE=demo
  ```

* 更新migration

* ```
  php artisan migrate
  ```

* 插入模拟数据

* ```
  php artisan tinker
  namespace App
  factory(User::class,10)->create()
  factory(articles::class,10)->create()
  有问题 退出 tinker 重新进入即可
  ```

* token数据以及 user_id 可以直接从数据库获取即可 

* 使用postman测试



### 1. 查询用户的所有article数据

api	

```
http://127.0.0.1:8002/api/articles
```

method

```
get
```

params

```
token 		用户的token	String
user_id 	用户的id		int
page		当前页数(选填)		int		默认为1
bars		当前页总条数(选填)	  int		默认为5
```

response

```json
{
    "0": {
        "id": 1,
        "title": "Quaerat hic sed magni quia consequatur et.",
        "user_id": 12,
        "status": 2,
        "created_at": "2019-11-07 14:18:36",
        "updated_at": "2019-11-07 14:18:36"
    },
    "1": {
        "id": 2,
        "title": "Amet id reprehenderit molestiae accusamus ipsam animi.",
        "user_id": 30,
        "status": 2,
        "created_at": "2019-11-07 14:18:36",
        "updated_at": "2019-11-07 14:18:36"
    },
}
```

### 2.查询用户的单个article数据

api

```
http://127.0.0.1:8002/api/articles
```

method

```
get

```

params

```
token 		用户的token	 String
user_id 	用户的id		 int
id			article的ID	  int

```

response

```json
[
    {
        "id": 4,
        "title": "Voluptate veritatis quas cupiditate similique.",
        "user_id": 8,
        "status": 1,
        "created_at": "2019-11-07 14:18:36",
        "updated_at": "2019-11-07 14:18:36"
    }
]

```

### 3. 添加一条用户的article数据

api

```
http://127.0.0.1:8002/api/articles/create

```

method

```
post

```

params

```
token 		用户的token	 		String
user_id 	用户的id		 		int
title 		article中title内容 	string
status		article数据状态			int 	(1~3)之间

```

response

```json
{
    "title": "xiaoyj",
    "user_id": "1",
    "updated_at": "2019-11-07 14:29:10",
    "created_at": "2019-11-07 14:29:10",
    "id": 11
}

```

### 4. 更新一条用户的article数据

api

```
http://127.0.0.1:8002/api/articles/update

```

method

```
post

```

params

```
token 		用户的token	 		String
user_id 	用户的id		 		int
id			article的ID			 int
title 		article中title内容 	string
status		article数据状态			int 	(1~3)之间

```

response

```json
[
    {
        "id": 11,
        "title": "12312ww1",
        "user_id": "1",
        "status": 1,
        "created_at": "2019-11-07 14:29:10",
        "updated_at": "2019-11-07 14:39:58"
    }
]

```

### 5. 删除用户的一条article数据 

api

```
http://127.0.0.1:8002/api/articles/delete

```

method

```
post

```

params

```
token 		用户的token	 		String
user_id 	用户的id		 		int
id			article的ID			 int

```

response

```
[
    {
        "status": true,
        "data": {
            "id": 11,
            "title": "12312ww1",
            "user_id": 1,
            "status": 4,
            "created_at": "2019-11-07 14:29:10",
            "updated_at": "2019-11-07 14:44:39"
        }
    }
]

```

备注

```
该方法不删除实际数据 ,默认状态为4为删除状态

```

​																																	

#### 贵公司如果满意,可以回复信息,如果其中有不当之处,可以联系我改正,谢谢;