<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Kyslik\ColumnSortable\ColumnSortableServiceProvider;

class StoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data =Story::where([
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
                    //   ->orderByRaw("CASE status
                    //                 WHEN 'PENDING' THEN 1
                    //                 WHEN 'PUBLISHED' THEN 2
                    //                 WHEN 'DECLINED' THEN 3
                    //                 END")
                      ->where('status','!=','DRAFT')
                      ->paginate(10);
        $pagination = $data->links()->render();
        if($data instanceof LengthAwarePaginator){
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }
        return view('admin.story.index', compact('data','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $story= Story::find($id);
        return view('admin.story.edit', compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateToPublished(Request $request, string $id)
    {
            $story = Story::find($id);
            $story->status = 'PUBLISHED';
            $story->save();
            return redirect()->route('admin-story.index')->with('success', "Successfully status updated to PUBLISHED");
    }

    public function updateToDeclined(Request $request, string $id)
    {
        $story = Story::find($id);
        $story->status = 'DECLINED';
        $story->save();
        return redirect()->route('admin-story.index')->with('success', "Successfully status updated to DECLINED");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $story = new Story;
        $story->find($id)
              ->delete();
        return redirect()->route('admin-story.index')->with('success','Successfully Deleted');
    }
}
