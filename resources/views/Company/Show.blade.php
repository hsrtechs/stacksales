@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>
            {{ $company->name }}
        </h2>
        <div class="row">
            <div class="col-md-8">
                <p><strong>Internal Number:</strong> {{ $company->in }}</p>
                <p><strong>Notes:</strong> {{ $company->notes }}</p>
            </div>
            <div class="col-md-2">
                <a href="{{ route("Company.edit",$company->id) }}" class="btn btn-primary">Edit</a>
                <form method="post" action="{{ route('Company.destroy',$company->id) }}">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-offset-2">
                @include('partials.certificates-list',['certificates' => $company->Certificates])
            </div>
        </div>
    </div>
@endsection