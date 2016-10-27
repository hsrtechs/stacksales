<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Company;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class CertificateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $data
     * @return \Illuminate\Http\Response
     */
    public function index($data = NULL)
    {
        if(!empty($data))
        {
            switch($data)
            {
                case 'all' : $certificates = Certificate::active();break;
                case 'renewal': $certificates = Certificate::active()->where('renewal','<=',Carbon::now()->addDays(90));break;
                case 'expired': $certificates = Certificate::where('expiry','<=',Carbon::now()->addDays(90));break;
                default: return abort(404);
            }
        }else{
            $certificates = Certificate::active();
        }
        $certificates = $certificates->IncludeRole()->get();
        return view('Certificate.List',['certificates' => $certificates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Company $company
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        return view("Certificate.Create",['cid' => $company->id ?: NULL]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cert = new Certificate;
        $cert->name = $request->name;
        $cert->certificate_level_id = $request->level;
        $cert->id_no = $request->idno;
        $cert->info = $request->info;
        $cert->issue = $request->issue;
        $cert->expiry = $request->expiry;
        $cert->dob = $request->dob;
        $cert->status = true;
        $cert->status = $request->gender == 'Male' ? true : false;
        $cert->company_id = $request->company_id;
        $cert->renewal = $request->renew;

        if($cert->saveOrFail())
        {
            return redirect()->route('Company.show',$request->company_id)->with('status', 'OK');
        }
        return redirect()->route('Certificate.create')->with('status', 'Error');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->to('/Company');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Certificate $Certificate
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Certificate $Certificate)
    {
        return view("Certificate.Edit",['certificate' => $Certificate ?: NULL]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Certificate $Certificate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificate $Certificate)
    {
        $Certificate->name = $request->name;
        $Certificate->certificate_level_id = $request->level;
        $Certificate->info = $request->info;
        $Certificate->issue = $request->issue;
        $Certificate->expiry = $request->expiry;
        $Certificate->dob = $request->dob;
        $Certificate->status = true;
        $Certificate->renewal = $request->renew;

        if($Certificate->saveOrFail())
        {
            return redirect()->route('Company.show',$request->company_id)->with('status', 'OK');
        }
        return redirect()->route('Certificate.create')->with('status', 'Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Certificate $Certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $Certificate)
    {
        $id = $Certificate->company_id;
        $Certificate->delete();
        return redirect()->route('Company.index',$id)->with('status', 'OK');
    }
}
