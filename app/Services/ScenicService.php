<?php

namespace App\Services;

use App\Models\Scenic;

class ScenicService{

    public function getHotScenic($limit = 8){
        return Scenic::orderBy('hot', 'desc')->offset(0)->limit($limit)->get();
    }


    public function getHasCustomPrice($limit = 8){
        $data = [];
        $max = Scenic::count();
        $i = 1;
        while($i){
            $time = time();
            $scenic = Scenic::with('ticket')->offset(($i-1) * 50)->limit($i * 50)->get()->toArray();
            foreach ($scenic as $key => $value) {
                foreach ($value['custom_price'] as $item){
                    if (($time > $item['start_time']) && ($time < $item['end_time'])) {
                        $scenic[$key]['now_price'] = $item['price'];
                    }
                }
                if(isset($scenic[$key]['now_price'])){
                    $data[] = $scenic[$key];
                }
                if(count($data) >= $limit){
                    break;
                }
            }
            if (count($data) >= $limit && $i * 50 >= $max) {
                break;
            }
            $i ++ ;
        }
        return $data;
    }

}