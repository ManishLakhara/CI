<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\RedirectResponse;
use App\Models\CmsPage;
use App\Http\Requests\StoreCmsPageRequest;
use App\Http\Requests\UpdateCmsPageRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class CmsPageController extends AdminBaseController
{
    /**
     * Show the form for creating a new resource.
     */
    /**
     * @return Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.cmspage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @param StoreCmsPageRequest $request
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(StoreCmsPageRequest $request): RedirectResponse
    {
        CmsPage::create($request->post());
        return redirect()->route('cmspage.index')->with('success', 'field has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    /**
     * @param App\Models\CmsPage $cmspage
     *
     * @return Illuminate\View\View
     */
    public function show(CmsPage $cmspage): View
    {
        return view('admin.cmspage.edit', compact('cmspage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * @param App\Models\CmsPage $cmspage
     *
     * @return Illuminate\View\View
     */
    public function edit(CmsPage $cmspage): View
    {
        return view('admin.cmspage.edit', compact('cmspage'));
    }
    /**
     * Update the specified resource in storage.
     */
    /**
     * @param UpdateCmsPageRequest $request
     * @param App\Models\CmsPage $cmspage
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCmsPageRequest $request, CmsPage $cmspage): RedirectResponse
    {
        $request->validated();
        $cmspage->fill($request->post())
            ->save();
        return redirect()->route('cmspage.index')->with('success', 'field Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * @param App\Models\CmsPage $cmspage
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(CmsPage $cmspage): RedirectResponse
    {
        $cmspage->delete();
        return back()->with('success', 'field has been deleted successfully');
    }

    /**
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator{
        $request = request();
        return CmsPage::where([
                    ['title', '!=', Null],
                    [function ($query) use ($request) {
                        if (($s = $request->s)) {
                            $query->orWhere('title', 'LIKE', '%' . $s . '%')
                                ->get();
                        }
                    }]
                ])->paginate(10);
    }
}
