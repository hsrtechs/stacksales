<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\CertificateName;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Certificate(Request $request)
    {
        if($request->hasFile('uploadFile'))
            $file = $request->file('uploadFile');
        else
            return response('Invalid Request');

        if($file->isValid())
        {
            if($this->ValidateFile($file->getClientOriginalExtension()))
            {
                $path = $file->getRealPath();
                $datas = Excel::load($path,function ($render){})->get()->toArray();
                unset($datas[0]);
                foreach ($datas as $data)
                {
                    $cert = CertificateName::join('certificate_levels','certificate_levels.id','certificate_names.id')->where('certificate_names.name',$data[7])->pluck('certificate_levels.id')->first();
                    $import = Certificate::firstOrNew(['id_no' => $data[3]]);
                    $import->name = $data[0];
                    $import->gender = $data[1] == 'Male' ? true : false;
                    $import->dob = $data[2];
                    $import->issue = $data[4];
                    $import->expiry = $data[5];
                    $import->renewal = $data[6];
                    $import->certificate_level_id = $cert;
                    $import->info = $data[8];
                    $import->saveOrFail();
                }
                return back()->with(['status' => 'Ok','msg' => 'Data Inserted']);

            }else return back()->with(['status' => 'Error','msg' => 'Invalid File Extension.']);
        }
    }

    public function ValidateFile($ext)
    {
        $exts = ['xls','csv'];
        return in_array($ext,$exts);
    }
}
