<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Symfony\Component\HttpFoundation\BinaryFileResponse as response;

class DownloadController extends Controller
{
    public function download($filename){

        $path = storage_path('app/public/missions_documents/'.$filename);
        $response = response()->download($path);
        return $response;
    }
}
