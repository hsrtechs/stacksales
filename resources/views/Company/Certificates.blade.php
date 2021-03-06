@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>
            {{ $company->name }}
        </h2>
        <div class="row">
            <p><strong>@lang('company.in')：</strong> {{ $company->in }}</p>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-offset-2">
                @include('partials.certificates-list',['certificates' => $company->Certificates])
            </div>
        </div>
    </div>
@endsection