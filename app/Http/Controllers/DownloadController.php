<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Symfony\Component\HttpFoundation\BinaryFileResponse as response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends Controller
{
    /**
     * @param mixed $filename
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($filename): BinaryFileResponse
    {
        $path = storage_path('app/public/missions_documents/'.$filename);
        $response = response()->download($path);
        return $response;
    }
}
