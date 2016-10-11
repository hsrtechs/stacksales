@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>#IN</th>
                            <th>Name</th>
                            <th>Certification</th>
                            <th>Notes</th>
                            <th class="col-md-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>#{{ $company->id }}</td>
                                <td>#{{ $company->internal_number }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->certification }}</td>
                                <td>{{ $company->notes }}</td>
                                <td>
                                    <a href="{{ route('Company.show',$company->id) }}"><i class="glyphicon glyphicon-alert"></i></a>
                                    <a href="{{ route('Company.edit',$company->id) }}"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{ route('Company.destroy',$company->id) }}" data-confirm="Are you sure?" data-method="delete"><i class="glyphicon glyphicon-open"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection