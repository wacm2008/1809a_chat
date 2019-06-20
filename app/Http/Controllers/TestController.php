<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\UsersModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
class TestController extends Controller
{
    public function index()
    {
        return view('chat/index');
    }
    //慢查询
    public function slowlog()
    {
        for($i=0;$i<500000;$i++){
            $name = Str::random(10);
            $email = Str::random(10) . '@' .'qq.com';
            $age = mt_rand(1111,9999);
            $data = [
                'name'=> $name,
                'email'=> $email,
                'age' => $age
            ];
            $res = UsersModel::insert($data);
            var_dump($res);
        }
    }
    //水平分割 取模运算
    public function cutlist()
    {
        $uid = redis::incr('p_user_uid');
        echo $uid.'<br>';
        $table_id = $uid % 3;
        $data = [
            'uid'   => $uid,
            'name'  => Str::random(4),
            'email' => Str::random(6).'@qq.com',
            'pwd'   => Str::random(6),
            'add_time' => time()
        ];
        $table = 'p_user'.$table_id;
        echo $table.'<br>';
        $res = DB::table($table)->insertGetId($data);
        var_dump($res);
    }
    //分区 range
    public function range()
    {
        $data = [
            'bid'      => mt_rand(1,999),
            'bname'    => Str::random(6),
            'bprice'   => mt_rand(1,999),
            'store_id' => mt_rand(1,200)
        ];
        $res = DB::table('books')->insertGetId($data);
        var_dump($res);
    }
}
