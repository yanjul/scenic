<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Scenic;
use Illuminate\Support\Facades\Storage;

class ScenicController extends Controller
{
    /**获取用户景区
     * @return $this
     */
    public function getUserScenic()
    {
        $user_id = Auth::user()->id;
        $list = Scenic::where('user_id', $user_id)->get()->toArray();
        return view('user.scenic')->with('list', $list);
    }

    /**景区添加
     * @param null $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add($id = null)
    {
        $data = null;
        if ($id) {
            $data = Scenic::find($id);
            if ($data) {
                $data = $data->toArray();
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
            'image' => 'required|image'
        ]);
        $data = $request->input();
        $data['user_id'] = $request->user()->id;
        if ($request->hasFile('image')) {
            $data['image'] = '/' . config('filesystems.disks.image.root') . '/' .
                $request->file('image')->store($request->user()->id . '/scenic', 'image');
        }
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
        $scenic = Scenic::find($request->input('id'));
        if ($scenic) {
            $scenic->name = $request->input('name');
            $scenic->info = $request->input('info');
            if ($request->hasFile('image')) {
                $img = $request->user()->id . '/scenic/' . basename($scenic->image);
                Storage::disk('image')->delete($img);
                $scenic->image = '/' . config('filesystems.disks.image.root') . '/' .
                    $request->file('image')->store($request->user()->id . '/scenic', 'image');
            }
            $scenic->save();
        }
        return redirect('user/scenic');
    }
}