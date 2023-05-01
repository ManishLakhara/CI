<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->search();

        $pagination = $data->links()->render();
        if($data instanceof LengthAwarePaginator){
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }
        return view('admin.banner.index', compact('data','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {

        $banner = new Banner;
        $banner->text = $request->text;
        $banner->sort_order = $request->sort_order;
             //This is photo storing code
        $photo = $request->file('photo');
        $imageName = $photo->getClientOriginalName().'.'.uniqid().'.'.$photo->getClientOriginalExtension();
        $imagePath = $photo->storeAs('banner',$imageName, 'public');
        $banner->image = $imagePath;
        $banner->save();
        return redirect()->route('banner.index')->with('success',"New Banner Have been successfully Added");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, string $id)
    {
        $banner = Banner::find($id);
        $banner->text = $request->text;
        $banner->sort_order = $request->sort_order;
        if($request->photo!=null){
            $photo = $request->file('photo');
            $imageName = $photo->getClientOriginalName().'.'.uniqid().'.'.$photo->getClientOriginalExtension();
            $imagePath = $photo->storeAs('banner',$imageName, 'public');
            $banner->image = $imagePath;
        }
        $banner->update();
        return redirect()->route('banner.index')->with('success',"Successfully Updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('banner.index')->with('success',"Selected Images is removed from banner");
    }

    public function search(){
        $request = request();
        return Banner::where([
                    [function ($query) use ($request){
                        if(($s = $request->s)) {
                            $query->where('image','LIKE','%'.$s.'%')
                                ->orWhere('sort_order','LIKE','%'.$s.'%')
                            ->get();
                        }
                    }]
                ])->orderBy('sort_order','asc')
                ->paginate(10);
    }
}
