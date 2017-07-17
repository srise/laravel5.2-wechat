<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Log;

class WechatController extends Controller
{
    /**
     * 处理微信请求的信息
     * @return mixed
     */
    public function serve()
    {
        Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注 overtrue！";
        });

        Log::info('return response.');

        return $wechat->server->serve();
    }

    /**
     * 添加菜单
     *
     */
    public function addMenu()
    {
        $app = app('wechat');
        $menu = $app->menu;
        $buttons = [
            [
                "type" => "click",
                "name" => "我的博客",
                "key"  => "V1001_TODAY_MUSIC",
                "url"  => "http://119.23.60.21/blog"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                ],
            ],
        ];
        $menu->add($buttons);
    }

    /**
     * 查看微信公众号当前的菜单
     */
    public  function  showMenu(){
        $app = app('wechat');
        $menu = $app->menu;
        $menus = $menu->all();
        var_dump($menus);
    }
}
