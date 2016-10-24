@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>
            {{ $company->name }} <a href="{{ route('Company.edit',$company->id) }}" class="btn btn-warning">Edit</a>
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
            <div class="col-md-3">
                <div id="tree"></div>
            </div>
            <div class="col-md-9">
                @include('partials.certificates-list',['certificates' => $certificates])
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
                                    <p>Please enter password to encrypt the data.</p>
                                    <form class="form" id="#export" method="get" action="{{ route('Certificate.download',csrf_token()) }}" target="_blank">
                                        <div class="form-group">
                                            <select name="type" class="form-control">
                                                <option value="xls">Excel/xls</option>
                                                <option value="csv">Excel/csv</option>
                                                <option value="pdf">PDF</option>
                                            </select>
                                        </div>
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{!! urlencode(json_encode($certificates)) !!}" name="data">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" form="#export">Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </p>
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
