<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scenic;
use App\Models\Category;
use App\Services\ScenicService;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->input();
        $query = Scenic::query();
        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }
        if (array_key_exists('keyword', $data) && $data['keyword']) {
            $query->where('name', 'like', '%' . $data['keyword'] . '%');
        }
        if (array_key_exists('type', $data) && $data['type']) {
            $query->where('category->type', $data['type']);
        }
        if (array_key_exists('time', $data) && $data['time']) {
            $query->where('category->time', $data['time']);
        }
        if (array_key_exists('season', $data) && $data['season']) {
            $query->where('category->season', $data['season']);
        }
        $scenic = $query->where('status', 1)->paginate(16)->toArray();
        $category = Category::with('child')->where('type', 1)->get();
        $scenic_service = new ScenicService();
        $cate = $scenic_service->getCategory($category);

        $scenic = $scenic_service->paginate($scenic);
        // return $scenic;
        return view('search', ['scenic' => $scenic, 'category' => $category, 'cate' => $cate, 'params' => $data]);
    }
}
