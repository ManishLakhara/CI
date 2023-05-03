<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\StoryMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Kyslik\ColumnSortable\ColumnSortableServiceProvider;

class StoryController extends AdminBaseController
{
    /**
     * Display the specified resource.
     * @param Story $story
     *
     * @return View
     */
    public function show(Story $story): View
    {
        return view('admin.story.edit', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Story $story
     *
     * @return RedirectResponse
     */
    public function updateToPublished(Request $request, Story $story): RedirectResponse | string
    {
            $story->status = 'PUBLISHED';
            $story->save();
            if($request->ajax()){
                return "Successfully Published";
            }
            return redirect()->route('story.index')->with('success', "Successfully status updated to PUBLISHED");
    }

    /**
     * @param Request $request
     * @param Story $story
     *
     * @return RedirectResponse
     */
    public function updateToDeclined(Request $request, Story $story): RedirectResponse|string
    {
        $story->status = 'DECLINED';
        $story->save();
        return redirect()->route('story.index')->with('success', "Successfully status updated to DECLINED");
    }

    /**
     * Remove the specified resource from storage.
     * @param Story $story
     *
     * @return RedirectResponse
     */
    public function destroy(Story $story): RedirectResponse
    {
        $story->delete();
        return redirect()->route('story.index')->with('success','Successfully Deleted');
    }

    /**
     * @return LengthAwarePaginator
     */
    public function search(): LengthAwarePaginator{
        $request = request();
        return Story::where([
                    ['title', '!=', Null],
                    [function ($query) use ($request) {
                        if (($s = $request->s)) {
                            $query->where('title', 'LIKE', '%' . $s . '%')
                                ->get();
                        }
                    }]
                ])
                ->orWhereHas('user', function ($query) use ($request) {
                    if ($s = $request->s) {
                        $query->where('first_name', 'like', '%' . $s . '%')
                            ->orWhere('last_name', 'like', '%' . $s . '%');
                    }
                })
                ->orWhereHas('mission',function ($query) use ($request) {
                    if ($s = $request->s) {
                        $query->where('title', 'like', '%' . $s . '%');
                    }
                })
                ->where('status','!=','DRAFT')
                ->paginate(10);
    }
}
