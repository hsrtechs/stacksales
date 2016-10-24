<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\CertificateCategory;
use App\CertificateLevel;
use App\CertificateName;
use App\Company;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $company->notes = $request->notes;
        $company->qualification = json_encode([
            'name' => $request->qualification,
            'cat' => $request->cat,
            'level' => $request->levels,
        ]);

        if($company->saveOrFail())
        {
            return redirect()->route('Company.show',$company->id)->with('status', 'OK');
        }
        return redirect()->route('Company.create')->with('status', 'Error');

    }

    /**
     * Display the specified resource.
     *
     * @param Company $Company
     * @param null $Category
     * @param null $CertificateName
     * @param null $Level
     * @return \Illuminate\Http\Response
     * @internal param CertificateCategory $Certificate
     * @internal param int $id
     */
    public function show(Company $Company, $Category = NULL, $CertificateName = NULL , $Level = NULL)
    {
        if(!empty($Category) && !CertificateCategory::where('id',$Category)->count())
            return abort(404);
        if(!empty($CertificateName) && !CertificateName::where('id','=',$CertificateName)->count())
            return abort(404);
        if(!empty($Level) && !CertificateLevel::where('id','=',$Level)->count())
            return abort(404);
        $data = [];

        foreach (DB::table('certificate_categories')->get() as $cc)
        {
            $cca = [
                'text' => $cc->name,
                'href' => route('Company.show.var',[$Company->id,$cc->id]),
                'state' => [
                    'selected' => ($cc->id == $Category && empty($CertificateName)) ? true : false,
                ],
                'nodes' => [],
            ];

            foreach (DB::table('certificate_names')->where('certificate_category_id','=',$cc->id)->get() as $c)
            {
                $ca = [
                    'text' => $c->name,
                    'href' => route('Company.show.var',[$Company->id,$cc->id,$c->id]),
                    'state' => [
                        'selected' => ($c->id == $CertificateName && empty($Level)) ? true : false,
                    ],
                    'nodes' => [],
                ];
                foreach (DB::table('certificate_levels')->where('certificate_name_id','=',$c->id)->get() as $cl)
                {
                    $cla = [
                        'text' => $cl->name,
                        'href' => route('Company.show.var',[$Company->id,$cc->id,$c->id,$cl->id]),
                        'state' => [
                            'selected' => ($cl->id == $Level) ? true : false,
                            'expanded' => ($cl->id == $Level) ? true : false,
                        ],
                    ];
                    array_push($ca['nodes'],$cla);
                }
                array_push($cca['nodes'],$ca);
            }
            array_push($data,$cca);
        }

        $certificates = Certificate::getAll();

        if(!empty($Level))
        {
            $certificates = $certificates->where('certificate_categories.id',$Category)
                ->where('certificate_levels.id','=',$Level)
                ->where('certificate_names.id','=',$CertificateName)
                ->where('company_id','=',$Company->id)
                ->getCertData();
        }else if(!empty($CertificateName))
        {
            $certificates = $certificates->where('certificate_categories.id',$Category)
                ->where('certificate_names.id', $CertificateName)
                ->where('company_id','=',$Company->id)
                ->getCertData();
        }else if(!empty($Category))
        {
            $certificates = $certificates->where('certificate_categories.id',$Category)
                ->where('company_id','=',$Company->id)
                ->getCertData();
        }else {
            $certificates = $Company->certificates()->IncludeRole();
        }

        return view('Company.Show',['company' => $Company, 'certificates' => $certificates->get(), 'data' => json_encode($data)]);
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
     * @param  \Illuminate\Http\Request $request
     * @param Company $Company
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Company $Company)
    {
        $company = new Company;
        $company->name = $request->name;
        $company->notes = $request->notes;
        $company->qualification = json_encode([
            'name' => $request->qualification,
            'cat' => $request->cat,
            'level' => $request->level,
        ]);

        if($company->saveOrFail())
        {
            return redirect()->route('Company.show',$company->id)->with('status', 'OK');
        }
        return redirect()->route('Company.create')->with('status', 'Error');


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
