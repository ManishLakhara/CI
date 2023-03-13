<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CmsPage;

class CmsPagesController extends Controller
{
    public function index(Request $request)
    {
        $data = CmsPage::orderBy('cms_page_id', 'asc')->paginate(10);


        return view('cms', compact('data'));
    }
}
