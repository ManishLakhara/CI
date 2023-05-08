<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Stringable;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminBaseController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $data = $this->search();
        $class_name = Str::substr(Str::lower(class_basename($this)),0,-10);
        $pagination = $data->links()->render();
        if($data instanceof LengthAwarePaginator){
            $pagination = $data->appends(request()->all())->links('pagination.default');
        }
        return view('admin.'.$class_name.'.index', compact('data','pagination'));
    }
}
