<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SysPlace extends Model
{
    protected $table = 'sys_place';

    protected $fillable = [
        'parent_id',
        'name',
        'type',
    ];

    public function place(){
        return $this->hasMany('App\Models\SysPlace', 'parent_id', 'id');
    }

    /**
     * 获取省级市区县详细地址信息
     */
//    public function getPlacePath($data = [], $pid = -1){
//        static $place;
//        $data = $data?:['id'=>$this->id];
//        if($pid == -1){
//            $temp = $this->where($data)->first();
//            $pid = $temp['parent_id'];
//            $place = $temp['name'];
//        }
//        if($pid){
//            $temp = $this->where('id', $pid)->first();
//            $place = $temp['name'].'>'.$place;
//            $this->getPlacePath('', $temp['parent_id']);
//        }
//        return $place;
//    }

}