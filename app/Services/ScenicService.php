<?php

namespace App\Services;

use App\Models\Scenic;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ScenicService{

    /**获取hot商品
     * @param int $limit
     * @return mixed
     */
    public function getHotScenic($limit = 8){
        $scenic = Scenic::query();
        if (Auth::check()) {
            $scenic->where('user_id', '!=', Auth::id());
        }
        return $scenic->orderBy('hot', 'desc')->offset(0)->limit($limit)->get();
    }

    /**获取特价商品
     * @param int $limit
     * @return array
     */
    public function getHasCustomPrice($limit = 8){
        $data = [];
        $max = Scenic::count();
        $i = 1;
        while($i){
            $time = time();
            $scenic = Scenic::query();
            if (Auth::check()) {
                $scenic->where('user_id', '!=', Auth::id());
            }
            $scenic = $scenic->with('ticket')->offset(($i-1) * $limit)->limit($i * $limit)->get()->toArray();
            foreach ($scenic as $key => $value) {
                foreach ($value['ticket'] as $ticket) {
                    foreach ($ticket['custom_price'] as $item) {
                        if (($time > $item['start_time']) && ($time < $item['end_time'])) {
                            $scenic[$key]['now_price'] = $item['price'];
                            $scenic[$key]['old_price'] = $ticket['price'];
                            break;
                        }
                    }
                }
                if(isset($scenic[$key]['now_price'])){
                    $data[] = $scenic[$key];
                }
                if(count($data) >= $limit){
                    break;
                }
            }
            if (count($data) >= $limit || $i * $limit >= $max) {
                break;
            }
            $i ++ ;
            echo $i.'\n';
        }
        return $data;
    }

    public function getCategory($category){
       
        $cate = [];
        foreach($category as $value){
            foreach($value->child as $item){
                 $cate[$item->id] = $item->name;     
            }
        }
        return $cate;
    }

}