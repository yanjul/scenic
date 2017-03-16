<?php

namespace App\Services;

use App\Models\Scenic;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ScenicService
{

    /**获取hot商品
     * @param int $limit
     * @return mixed
     */
    public function getHotScenic($limit = 8)
    {
        $scenic = Scenic::query();
        if (Auth::check()) {
            $scenic->where('user_id', '!=', Auth::id());
        }
        $scenic->where('status', 1);
        return $scenic->orderBy('hot', 'desc')->offset(0)->limit($limit)->get();
    }

    /**获取特价商品
     * @param int $limit
     * @return array
     */
    public function getHasCustomPrice($limit = 8)
    {
        $data = [];
        $max = Scenic::where('status', 1)->count();
        $i = 1;
        while ($i) {
            $time = time();
            $scenic = Scenic::query();
            if (Auth::check()) {
                $scenic->where('user_id', '!=', Auth::id());
            }
            $scenic->where('status', 1);
            $scenic = $scenic->with(['ticket' => function ($query) {
                $query->where('status', 1);
            }])->offset(($i - 1) * $limit)->limit($i * $limit)->get()->toArray();
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
                if (isset($scenic[$key]['now_price'])) {
                    $data[] = $scenic[$key];
                }
                if (count($data) >= $limit) {
                    break;
                }
            }
            if (count($data) >= $limit || $i * $limit >= $max) {
                break;
            }
            $i++;
            echo $i . '\n';
        }
        return $data;
    }

    public function getCategory($category)
    {

        $cate = [];
        foreach ($category as $value) {
            foreach ($value->child as $item) {
                $cate[$item->id] = $item->name;
            }
        }
        return $cate;
    }

    public function paginate(array $data, $range = 2)
    {
        $min = 1;
        $max = $data['last_page'];
        $url = URL::full();
        $current = $data['current_page'];
        if ($current > $range + 1) {
            $min = $current - $range > 1 ? $current - $range : 1;
            $max = $current + $range < $max ? $current + $range : $max;
            $min = $max - $current < $range ? $min + $max - $range - $current : $min;
            $max = $current - $min < $range ? $max + $min + $range - $current : $max;
        }
        $base_url = preg_replace('/page=([^\\&]+)/i', '', URL::full());
        $str = (substr($base_url, -1, 1) == '?') ? '&page=' : '?page=';
        $data['prev_page_url'] = ($min == $current ? '' : $base_url . $str . ($current - 1));
        $data['prev_page_url'] = preg_replace('/\\?&/', '?', $data['prev_page_url']);
        $data['next_page_url'] = ($max == $current ? '' : $base_url . $str . ($current + 1));
        $data['next_page_url'] = preg_replace('/\\?&/', '?', $data['next_page_url']);
        $data['urls'] = [];
        if ($url) {
            for ($i = $min; $i < $max; $i++) {
//                $data['urls'][$i] = preg_replace('/page=([^\\&]+)/i', 'page='.$i, $url);
                $data['urls'][$i] = $base_url . $str . $i;
                $data['urls'][$i] = preg_replace('/\\?&/', '?', $data['urls'][$i]);
            }
        }
        return $data;
    }

}