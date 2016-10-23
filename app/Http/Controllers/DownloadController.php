<?php

namespace App\Http\Controllers;

use App\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function certificates(Request $request, $token)
    {
        if($token == csrf_token())
        {
            $ext = 'csv';
            $data = $request->data;
            $name = trans('app.name').date('Y-m-d').'-company.'.$ext;
            Storage::put($name,$data);
            $path = storage_path($name);
            $file = new File;
            $file->path = $path;
            $file->expiry = Carbon::now()->addHours(12);
            $file->saveOrFail();
            return $file;
        }
    }
}
