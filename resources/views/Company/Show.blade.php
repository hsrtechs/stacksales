@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>
            {{ $company->name }}
        </h2>
        <div class="row">
            <div class="col-md-8">
                <p><strong>@lang('company.in')：</strong> {{ $company->in }}</p>
                <p><strong>@lang('company.notes')：</strong> {{ $company->notes }}</p>
            </div>
            <div class="col-md-4">
                <p class="pull-right"><a class="btn btn-primary" href="{{ route('Certificate.create.var',$company->id) }}">Add Certificate</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <ul class="list-group">
                    @foreach($company->Certificates->groupBy('category-id') as $cert)
                        @foreach($cert as $cer)
                            <li class="list-group-item list-group-item{{ !empty($Certificate) && $cer->category_id == $Certificate ? '-success' : '' }}">
                                <a href="{{ route('Company.show.var',[$company->id,$cer->category_id]) }}">{{ $cer->Category->name }}</a>
                                {{--<ul class="list-group">--}}
                                    {{--<li class="list-group-item">--}}
                                        {{--<a href="">{{ $cer->name }}</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
            <div class="col-md-10">
                @include('partials.certificates-list',['certificates' => !empty($Certificate) ? $company->Certificates()->where('category_id','=',$Certificate)->get() : $company->Certificates])
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <p class="text-center">
                    <!-- Small modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="">Import</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".import-model">Export</button>
                    <div class="modal fade import-model" tabindex="-1" role="dialog" aria-labelledby="Import">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Export Data
                                </div>
                                <div class="modal-body">
                                    <form class="form">
                                        <label for="pass">Password: </label>
                                        <input id="pass" type="password" class="form-control" name="pass">

                                    </form>
                                    <button class="btn btn-primary" href="">CSV</button>
                                    <button class="btn btn-primary">PDF</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </p>
            </div>
        </div>
    </div>
@endsection