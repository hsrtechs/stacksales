<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->get();
        return view('Company.Index',['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Company.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company;
        $company->name = $request->name;
        $company->internal_number = $request->in;
        $company->notes = $request->notes;

        if($company->saveOrFail())
        {
            return redirect()->route('Company.create')->with('status', 'OK');
        }
        return redirect()->route('Company.create')->with('status', 'Error');

    }

    /**
     * Display the specified resource.
     *
     * @param Company $Company
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Company $Company)
    {
        return view('Company.Certificates',['company' => $Company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $Company
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Company $Company)
    {
        return view('Company.Edit',['company' => $Company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
