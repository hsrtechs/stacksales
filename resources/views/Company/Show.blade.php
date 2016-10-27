@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>
            {{ $company->name }} <a href="{{ route('Company.edit',$company->id) }}" class="btn btn-warning">Edit</a>
        </h2>
        @if(session('msg'))
            <div class="alert alert-{{ session('status') == 'Ok' ? 'success' : 'danger' }}">
                <p class="text-center">{{ session('msg') }}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <p><strong>@lang('company.in')：</strong> {{ $company->in }}</p>
                <p><strong>@lang('company.create.category')：</strong> {!! $company->category !!}</p>
                <p><strong>@lang('company.create.levels')：</strong> {!! $company->level !!}</p>
                <p><strong>@lang('company.notes')：</strong> {{ $company->notes }}</p>
            </div>
            <div class="col-md-4">
                <p class="pull-right"><a class="btn btn-primary" href="{{ route('Certificate.create.var',$company->id) }}">Add Certificate</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div id="tree"></div>
            </div>
            <div class="col-md-9">
                @include('partials.certificates-list',['certificates' => $certificates])
                @include('partials.certificates-import')
            </div>
        </div>
    </div>
@endsection

@section('headcss')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="/css/treeview.css" />
@endsection
@section('js')
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        } );
    </script>

    <script src="/js/treeview.js"></script>
    <script>
        var tree = {!! $data !!};
        $('#tree').treeview({data: tree});
    </script>
@endsection
