@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-hover">
                    <caption> Companies</caption>
                    <thead>
                        <tr>
                            <th>#IN</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td><a href="{{ route('Company.show',$company->id) }}">#{{ $company->internal_number }}</a></td>
                                <td><a href="{{ route('Company.show',$company->id) }}">{{ $company->name }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection