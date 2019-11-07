<?php

namespace App\Http\Controllers;

use App\articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //
    public function articles(Request $request)
    {
        if ($request->isMethod("get")) {
            if (!empty($request->input("token"))) {
                $data = (new articles)->articles($request->all());
                return response()->json($data, 200);
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "用户token不得为空"
                ], 303);
            }
        } else {
            return response()->json(
                [
                    "status" => false,
                    "message" => "请求方式不正确"
                ]
                , 405);
        }
    }

    // 检测并新增数据
    public function create(Request $request)
    {
        if ($request->isMethod("post")) {
            if (!empty($request->input("token"))) {
                if (!empty($request->input("title")) && !empty($request->input("user_id"))) {
                    $data = (new articles)->create($request->all());
                    return response()->json($data, 201);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "请求数据不得为空"
                    ], 303);
                }
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "用户token不得为空"
                ], 303);
            }
        } else {
            return response()->json(
                [
                    "status" => false,
                    "message" => "请求方式不正确"
                ]
                , 405);
        }
    }

    //更新数据
    public function up(Request $request)
    {
        if ($request->isMethod("post")) {
            if (!empty($request->input("token"))) {
                if (!empty($request->input("id"))) {
                    $data = (new articles)->up($request->all());
                    return response()->json([$data],200);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "请求ID不得为空"
                    ], 303);
                }
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "用户token不得为空"
                ], 303);
            }
        } else {
            return response()->json(
                [
                    "status" => false,
                    "message" => "请求方式不正确"
                ]
                , 405);
        }
    }

    //数据删除(不做真正删除)
    public function delete(Request $request)
    {
        if ($request->isMethod("post")) {
            if (!empty($request->input("token"))) {
                if (!empty($request->input("id"))) {
                    $data = (new articles)->del($request->all());
                    return response()->json([$data],200);
                } else {
                    return response()->json([
                        "status" => false,
                        "message" => "请求内容不得为空"
                    ], 303);
                }
            }else{
                return response()->json([
                    "status" => false,
                    "message" => "用户token不得为空"
                ], 303);
            }
        } else {
            return response()->json(
                [
                    "status" => false,
                    "message" => "请求方式不正确"
                ]
                , 405);
        }
    }

}
