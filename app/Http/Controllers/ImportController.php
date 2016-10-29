<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\CertificateLevel;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Certificate(Request $request,$company = NULL)
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
                foreach ($datas as $data)
                {
                    if(Certificate::where('id_no',$data['id_card_no'])->get()->count() < 1)
                    {
                        $cert = CertificateLevel::where('name',$data['certificate'])
                            ->pluck('id')->first();
                        $import = new Certificate;
                        $import->name = $data['name'];
                        $import->gender = $data['gender'] == 'Male' ? true : false;
                        $import->dob = isset($data['bob']) ? $data['bob'] : $data['dob'];
                        $import->id_no = $data['id_card_no'];
                        $import->issue = $data['issue_date'];
                        $import->expiry = $data['expiry_date'];
                        $import->renewal = $data['renewal_date'];
                        $import->certificate_level_id = $cert;
                        $import->info = $data['info'];
                        $import->status = true;
                        $import->company_id = $company;
                        $import->saveOrFail();
                    }
                }
                return back()->with(['status' => 'Ok','msg' => 'Data Inserted']);

            }else return back()->with(['status' => 'Error','msg' => 'Invalid File Extension.']);
        }
    }

    public function ValidateFile($ext)
    {
        $exts = ['xls','csv','xlsx'];
        return in_array($ext,$exts);
    }
}
