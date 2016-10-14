<?php

namespace App\Http\Controllers;

use App\Company;
use App\Qualification;
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
        $company->qualification = json_encode([
            'name' => $request->name,
            'cat' => $request->cat,
            'level' => $request->level,
        ]);

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
        return view('Company.Show',['company' => $Company]);
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
    public function update(Request $request, Company $Company)
    {
        $Company->name = $request->name;
        $Company->internal_number = $request->in;
        $Company->notes = $request->notes;

        if($Company->saveOrFail())
        {
            return redirect()->route('Company.edit',$Company->id)->with('status', 'OK');
        }
        return redirect()->route('Company.edit',$Company->id)->with('status', 'Error');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $Company
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function destroy(Company $Company)
    {
        $Company->delete();
        return redirect()->route('Company.index');
    }
}
