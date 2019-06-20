<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Client;
use Illuminate\Support\Str;
class MongoDbController extends Controller
{
    public $host = "mongodb://127.0.0.1:27017";
    public $client;
    //构造方法
    public function __construct()
    {
        $this->client = new Client($this->host);
    }
    //添加
    public function mongoCreate()
    {
        //$data = [
        //    'name'  => 'isco',
        //    'age'   => 27,
        //    'email' => 'isco@isco.com'
        //];
        $collection = $this->client->bruno12->isco22;//库名和表名
        //$res = $collection->insertOne($data);
        //print_r($res);
        $many = [
            [
                'name'  => 'isco',
                'age'   => 27,
                'email' => 'isco@qq.com',
                'sex'   => "男"
            ],
            [
                'name'    => 'luca',
                'age'     => 15,
                'email'   => 'luca@qq.com',
                'addtime' => time()
            ],
            [
                'name'  => Str::random(6),
                'age'   => mt_rand(1,100),
                'email' => Str::random(6).'@qq.com'
            ],
        ];
        $re = $collection->insertMany($many);
        var_dump($re);
    }
    //查询
    public function mongoSearch()
    {
        $collection = $this->client->bruno12->isco22;
        //$res = $collection->findOne(['name'=>'ssKmah']);
        //print_r($res);
        $re = $collection->find(['name'=>'isco'])->toArray();
        foreach ($re as $k) {
            print_r((array)$k);
        }
    }
    //改
    public function mongoUpdate()
    {
        $collection = $this->client->bruno12->isco22;
        //$updateResult = $collection->updateOne(
        //    [ 'name' => 'ssKmah' ],
        //    [ '$set' => [ 'age' => '100' ]]
        //);
        //print_r($updateResult);
        $updateAllResult = $collection->updateMany(
            [ 'name' => 'isco' ],//条件
            [ '$set' => [ 'email' => 'isco22@qq.com' ]]//修改参数
        );
        print_r($updateAllResult);
    }
    //删
    public function mongoDelete()
    {
        $collection = $this->client->bruno12->isco22;
        //$deleteResult = $collection->deleteOne(['name' => 'ssKmah']);
        //print_r($deleteResult);
        $deleteAllResult = $collection->deleteMany(['name' => 'isco']);
        print_r($deleteAllResult);
    }
    //查一条并删除
    public function mongoFindDelete()
    {
        $collection = $this->client->bruno12->isco22;
        $deletedRestaurant = $collection->findOneAndDelete(
            [ 'name' => 'Xqj58m' ],
            [
                'projection' => [
                    'age' => 72,
                    'email' => 'LW6ors@qq.com',
                ],
            ]
        );
        print_r($deletedRestaurant);
    }
    public function mongoFindUpdate()
    {
        $collection = $this->client->bruno12->isco22;
        $updatedRestaurant = $collection->findOneAndUpdate(
            [ 'name' => 'v5ud7a' ],
            [ '$set' => [ 'age' => 48 ]],
            [
                'projection' => [ 'email' => '666@qq.com' ],
                'returnDocument' => MongoDB\Operation\FindOneAndUpdate::RETURN_DOCUMENT_AFTER,
            ]
        );
        print_r($updatedRestaurant);
    }
}
