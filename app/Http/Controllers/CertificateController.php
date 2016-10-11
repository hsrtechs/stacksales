<?php

namespace App\Http\Controllers;

use App\Certificate;
use Illuminate\Http\Request;

use App\Http\Requests;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::orderBy('expiry')->get();
        return view('Certificate.List',['certificates' => $certificates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Certificate.Create");
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
        $cert->internal_number = $request->in;
        $cert->role = $request->role;
        $cert->info = $request->info;
        $cert->issue = $request->issue;
        $cert->expiry = $request->expiry;
        $cert->status = true;
        $cert->company_id = $request->id;
        $cert->certificate_categories_id = $request->category_id;

        if($cert->saveOrFail())
        {
            return redirect()->route('Certificate.create')->with('status', 'OK');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
