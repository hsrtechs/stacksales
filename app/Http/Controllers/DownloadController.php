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
                        $sheet->row(1,[
                            'Name','Gender','DoB','ID Card No','Issue Date','Expiry Date','Renewal Date','Certificate','Info'
                        ]);
                        foreach ($data as $da)
                        {
                            $array = [
                                $da['name'],
                                $da['gender'] == true ? 'Male' : 'Female',
                                $da['dob'],
                                $da['id_no'],
                                $da['issue'],
                                $da['expiry'],
                                $da['renewal'],
                                $da['level'],
                                $da['info'],
                            ];
                            $sheet->appendRow($array);
                        }

                    });
            })->export($ext);
        }else
            return abort(403);
    }

    public function AllowedExt()
    {
        return [
            'csv','xls','xlsx'
        ];
    }

    public function isAllowedExt($ext)
    {
        return in_array($ext,$this->AllowedExt());
    }
}
