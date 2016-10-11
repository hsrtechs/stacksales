@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-10 col-md-offset-1">
            <h2>
                Certificates
            </h2>
            @include('partials.certificates-list')
        </div>
    </div>
@endsection