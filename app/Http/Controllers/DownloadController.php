<?php

namespace App\Http\Controllers;

use App\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function certificates(Request $request, $token)
    {
        $ext = $request->type;
        $name = trans('app.name').date('Y-m-d');
        if($token == csrf_token() && $this->isAllowedExt($ext))
        {
            return Excel::create($name,function ($excel) use ($request,$name){
                $excel->setTitle($name);
                $excel->setCreator($request->user()->username)
                    ->setCompany(trans('app.name'))
                    ->sheet('Certificates',function ($sheet) use ($request){
                        $data = json_decode(urldecode($request->data),true);
                        $d = [array_keys($data[0])];
                        foreach ($data as $da)
                        {
                            $array = array_values($da);
                            array_push($d,$array);
                        }
                        $sheet->fromArray($d);
                    });
            })->export($ext);
        }else
            return abort(403);
    }

    public function AllowedExt()
    {
        return [
            'csv','xls'
        ];
    }

    public function isAllowedExt($ext)
    {
        return in_array($ext,$this->AllowedExt());
    }
}
