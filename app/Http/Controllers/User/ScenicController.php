<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Scenic;
use Illuminate\Support\Facades\Storage;
use App\Models\SysPlace;
use App\Models\SysCountries;
use App\Models\Category;

class ScenicController extends Controller
{
    /**获取用户景区
     * @return $this
     */
    public function getUserScenic()
    {
        $user_id = Auth::user()->id;
        $list = Scenic::where('user_id', $user_id)->get()->toArray();
        $category = Category::with('child')->where('parent_id', 0)->get()->toArray();
        return view('user.scenic')->with('list', $list)->with('category', $category);
    }

    /**景区添加
     * @param null $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add($id = null)
    {
        $data['place'] = SysPlace::where('type', 1)->get()->toArray();
        $data['category'] = Category::with('child')->where('parent_id', 0)->get()->toArray();
        $data['countries'] = SysCountries::all()->toArray();
        if ($id) {
            $data['scenic'] = Scenic::find($id);
            if ($data['scenic']) {
                $data['scenic'] = $data['scenic']->toArray();
            } else {
                return redirect('user/scenic');
            }
        }
        return view('user.scenic-add')->with('data', $data);
    }

    /**删除景区
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteScenic($id)
    {
        $scenic = Scenic::find($id);
        $img = Auth::user()->id . '/scenic/' . basename($scenic->image);
        $scenic->delete();
        Storage::disk('image')->delete($img);
        return redirect('user/scenic');
    }

    /**创建景区
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createScenic(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:24',
            'image' => 'required|image',
            'category' => 'array',
        ]);
        $data = $request->input();
        $data['user_id'] = $request->user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = '/' . config('filesystems.disks.image.root') . '/' .
                $request->file('image')->store($request->user()->id . '/scenic', 'image');
        }
        $data['category'] = [
            'type' => $data['category'][0],
            'time' => $data['category'][1],
            'season' => $data['category'][2]
        ];
        Scenic::create($data);
        return redirect('user/scenic');
    }

    /**添加景区
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateScenic(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'max:24',
        ]);
        $data = $request->input();
        $scenic = Scenic::find($data['id']);
        if ($scenic) {
            $scenic->name = $data['name'];
            $scenic->info = $data['info'];
            $scenic->place_id = $data['place_id'];
            $scenic->country_id = $data['country_id'];
            if ($request->hasFile('image')) {
                $img = $request->user()->id . '/scenic/' . basename($scenic->image);
                Storage::disk('image')->delete($img);
                $scenic->image = '/' . config('filesystems.disks.image.root') . '/' .
                    $request->file('image')->store($request->user()->id . '/scenic', 'image');
            }
            $scenic->category = [
                'type' => $data['category'][0],
                'time' => $data['category'][1],
                'season' => $data['category'][2]
            ];
            $scenic->save();
        }
        return redirect('user/scenic');
    }
}