@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-lg-8 col-md-offset-2">
            <h2>
                Certificates
            </h2>
            @include('partials.certificates-list')
        </div>
    </div>
@endsection