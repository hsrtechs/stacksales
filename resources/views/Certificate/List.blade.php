@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h2>
                证书
            </h2>
            @include('partials.certificates-list',['certificates' => $certificates])
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