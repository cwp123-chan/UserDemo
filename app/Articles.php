<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class articles extends Model
{
    //
    CONST ARTPAGE = 1;
    CONST ARTBARS = 5;
    CONST DELSTA = 4;
    protected $fillable =  ["title","user_id"];
    public function user(){
        return $this->belongsTo(User::class);
    }
    // 查询所有文章及对应用户文章
    public function articles($data){
        $userTokenExist = User::where("remember_token","=",$data["token"])->where("id","=",$data["user_id"])->where("status","<",self::DELSTA)->get();
        if(count($userTokenExist) !== 0){
            if(!empty($data["id"])){
                $data = articles::where("id","=",$data["id"])->where("status","<",self::DELSTA)->get();
                return $data;
            }else{
                if(!empty($data["page"]) || !empty($data["bars"])){
                    if(empty($data["page"])){
                        $count = $data["bars"];
                        $num = self::ARTPAGE;
                    }else if(empty($data["bars"])){
                        $num = $data["page"];
                        $count = self::ARTBARS;
                    }else{
                        $num = $data["page"];
                        $count = $data["bars"];
                    }
                    $data = articles::where("status","<",self::DELSTA)->paginate($perPage =$count , $columns = ['*'], $pageName = '', $page = $num);
                    return $data;
                }else{
                    $data = articles::all()->where("status","<",self::DELSTA);
                    return $data;
                }
            }
        }else{
            return [
                "status" => false,
                "message" => "用户token不正确与用户ID不匹配"
            ];
        }
    }

    public function create($data){
        $userTokenExist = User::where("remember_token","=",$data["token"])->where("status","<",self::DELSTA)->where("id","=",$data["user_id"])->get();
        if(count($userTokenExist) !== 0){
            $userIdExist = User::where("id","=",$data["user_id"])->where("status","<",self::DELSTA)->get();
            if(count($userIdExist) !== 0){
                if($data["status"]<1 || $data["status"] >= self::DELSTA){
                    return [
                        "status" => false,
                        "message" => "文章状态不合法"
                    ];
                }
                $articles = new articles;
                $articles->title = $data["title"];
                $articles->user_id = $data["user_id"];
                $articles->save();
                return [
                    "status" => true,
                    "data" => $articles
                ];
            }else{
                return [
                    "status" => false,
                    "message" => "所属用户ID不存在"
                ];
            }
        }else{
            return [
                "status" => false,
                "message" => "用户token不正确与用户ID不匹配"
            ];
        }

    }

    public function up($data){
        $userTokenExist = User::where("remember_token","=",$data["token"])->where("id","=",$data["user_id"])->where("status","<",self::DELSTA)->get();
        if(count($userTokenExist) !== 0){
            $articles = articles::where("status","<",self::DELSTA)->find($data["id"]);
            if(!empty($articles)){
                if($data["status"]<1 || $data["status"] >= self::DELSTA){
                    return [
                        "status" => false,
                        "message" => "文章状态不合法"
                    ];
                }
                $articles->title = $data["title"];
                $articles->status = $data["status"];
                $articles->user_id = $data["user_id"];
                $articles->save();
                return [
                    "status" => true,
                    "data" => $articles
                ];
            }else{
                return [
                    "status" => false,
                    "message" => "文章ID不正确"
                ];
            }
        }else{
            return [
                "status" => false,
                "message" => "用户token不正确与用户ID不匹配"
            ];
        }
    }

    // 默认状态为4则为删除
    public function del($data){
        $userTokenExist = User::where("remember_token","=",$data["token"])->where("id","=",$data["user_id"])->where("status","<",self::DELSTA)->get();
        if(count($userTokenExist) !== 0){
            $articles = articles::where("status","<",self::DELSTA)->find($data["id"]);
            if(!empty($articles)){
                $articles->status = self::DELSTA;
                $articles->save();
                return [
                        "status" => true,
                        "data" => $articles
                    ];
            }else{
                return [
                    "status" => false,
                    "message" => "文章ID不正确"
                ];
            }
        }else{
            return [
                "status" => false,
                "message" => "用户token不正确与用户ID不匹配"
            ];
        }
    }

}
