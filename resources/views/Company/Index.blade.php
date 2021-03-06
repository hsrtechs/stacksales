@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-hover">
                    <caption>@lang('company.list.company')</caption>
                    <thead>
                    <tr>
                        <th>#@lang('company.id')</th>
                        <th>@lang('company.list.name')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td><a href="{{ route('Company.show',$company->id) }}">#{{ $company->id }}</a></td>
                            <td><a href="{{ route('Company.show',$company->id) }}">{{ $company->name }}</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('headcss')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" type="text/css">
@endsection


@section('js')
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        } );
    </script>
@endsection