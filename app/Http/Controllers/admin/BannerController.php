<?php

namespace App\Http\Controllers\admin;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class BannerController extends AdminBaseController
{
    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create(): View{
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreBannerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBannerRequest $request): RedirectResponse{

        $banner = new Banner;
        $banner->text = $request->text;
        $banner->sort_order = $request->sort_order;
        $photo = $request->file('photo');
        $imageName = $photo->getClientOriginalName().'.'.uniqid().'.'.$photo->getClientOriginalExtension();
        $imagePath = $photo->storeAs('banner',$imageName, 'public');
        $banner->image = $imagePath;
        $banner->save();
        return redirect()->route('banner.index')->with('success',"New Banner Have been successfully Added");
    }

    /**
     * Show the form for editing the specified resource.
     * @param Banner $banner
     *
     * @return View
     */
    public function edit(Banner $banner): View
    {
        return view('admin.banner.edit',compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateBannerRequest $request
     * @param Banner $banner
     *
     * @return RedirectResponse
     */
    public function update(UpdateBannerRequest $request, Banner $banner): RedirectResponse
    {
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
     * @param Banner $banner
     *
     * @return RedirectResponse
     */
    public function destroy(Banner $banner): RedirectResponse
    {
        $banner->delete();
        return redirect()->route('banner.index')->with('success',"Selected Images is removed from banner");
    }

    /**
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator{
        $request = request();
        return(Banner::where([
                    [function ($query) use ($request){
                        if(($s = $request->s)) {
                            $query->where('image','LIKE','%'.$s.'%')
                                ->orWhere('sort_order','LIKE','%'.$s.'%')
                            ->get();
                        }
                    }]
                ])->orderBy('sort_order','asc')
                ->paginate(10));
    }
}
