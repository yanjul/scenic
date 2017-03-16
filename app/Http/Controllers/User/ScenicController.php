<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Scenic;
use Illuminate\Support\Facades\Storage;
use App\Models\SysPlace;
use App\Models\SysCountries;
use App\Models\Category;
use App\Models\Distribution;
use App\Models\DistributionDetails;
use Illuminate\Support\Facades\DB;

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

    public function getScenic(Request $request)
    {
        $data = $request->all();
        $query = Scenic::query();
        if (array_key_exists('ticket', $data) && $data['ticket']) {
            $query->with('ticket');
        }
        if (array_key_exists('id', $data) && $data['id']) {
            return $query->find($data['id']);
        }
        if (array_key_exists('user_id', $data) && $data['user_id']) {
            return $query->where('user_id', $data['user_id'])->get();
        }
        return null;
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

    public function changeStatus(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'status' => 'required'
        ]);
        $data = $request->input();
        Scenic::where('id', $data['id'])->update(['status' => $data['status']]);
        return redirect()->back();
    }

    public function distribution()
    {
        $distribution = Distribution::with(['detail', 'scenic'])->where('user_id', Auth::id())->get();
        $category = Category::with('child')->where('parent_id', 0)->get()->toArray();
        return view('user.distribution')->with(['list' => $distribution, 'category' => $category]);
    }

    public function distributionAdd($id = 0)
    {
        $list = Scenic::where('user_id', Auth::id())->get();
        $data['list'] = $list;
        if ($id) {
            $distribution = Distribution::with(['detail', 'scenic' => function ($query) {
                $query->with('ticket');
            }])->find($id);
            if ($distribution) {
                $data['distribution'] = $distribution;
            }
        }
        return view('user.add-distribution')->with($data);
    }

    public function createDistribution(Request $request)
    {
        $this->validate($request, [
            'scenic_id' => 'required',
            'ticket_id' => 'required|array',
            'name' => 'required|array',
            'price' => 'required|array',
            'number' => 'required|array',
        ]);
        $data = $request->input();
        $items = array();
        $scenic = Scenic::find($data['scenic_id']);
        if (!$scenic) {
            return redirect()->back();
        }
        foreach ($data['ticket_id'] as $key => $value)
            $items[$key] = [
                'ticket_id' => $value,
                'ticket_name' => $data['name'][$key],
                'ticket_price' => $data['price'][$key],
                'ticket_number' => $data['number'][$key],
            ];
        try {
            DB::beginTransaction();
            if (array_key_exists('distribution_id', $data) && $data['distribution_id']) {
                $distribution_id = $data['distribution_id'];
                DistributionDetails::where('distribution_id', $distribution_id)->delete();
            }else{
                $distribution = [
                    'user_id' => Auth::id(),
                    'scenic_id' => $data['scenic_id'],
                    'scenic_name' => $scenic->name,
                ];
                $distribution_id = Distribution::create($distribution)->id;
            }
            foreach ($items as $item) {
                DistributionDetails::create(array_merge($item, ['distribution_id' => $distribution_id]));
            }
            DB::commit();
            return redirect('/user/scenic/distribution');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function deleteDistribution($id = 0){
        if(!$id) {
            return redirect()->back();
        }
        try {
            DB::beginTransaction();
            $distribution = Distribution::find($id);
            if($distribution) {
                DistributionDetails::where('distribution_id', $distribution->id)->delete();
                Distribution::where('id', $id)->delete();
            }
            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}