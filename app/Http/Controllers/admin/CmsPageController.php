<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CmsPage;
use App\Http\Requests\StoreCmsPageRequest;
use App\Http\Requests\UpdateCmsPageRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class CmsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = CmsPage::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($s = $request->s)) {
                    $query->orWhere('title', 'LIKE', '%' . $s . '%')
                        ->get();
                }
            }]
        ])->paginate(10);

        $pagination = $data->links()->render();
        if($data instanceof LengthAwarePaginator){
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }


        return view('admin.cmspage.index', compact('data','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cmspage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCmsPageRequest $request)
    {
        // $request->validated();

        CmsPage::create($request->post());

        return redirect()->route('cmspage.index')->with('success', 'field has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        return view('admin.cmspage.edit', compact('cmsPage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CmsPage $cmsPage, $cmsPageId)
    {
        $cmsPage = $cmsPage->find($cmsPageId);
        return view('admin.cmspage.edit', compact('cmsPage'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCmsPageRequest $request, CmsPage $cmsPage, $id)
    {
        $request->validated();
        $cmsPage->find($id)
            ->fill($request->post())
            ->save();
        return redirect()->route('cmspage.index')->with('success', 'field Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CmsPage $cmsPage, $id)
    {
        $cmsPage->find($id)
            ->delete();
        return back()->with('success', 'field has been deleted successfully');
    }
}
