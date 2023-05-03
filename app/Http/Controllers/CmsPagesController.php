<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CmsPage;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class CmsPagesController extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $user=Auth::user();
        $policies = CmsPage::orderBy('cms_page_id', 'asc')->paginate(10);


        return view('cms', compact('policies','user'));
    }
}
