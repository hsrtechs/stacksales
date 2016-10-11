@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(session('status'))
                <div class="alert alert-{{ session('status') == 'OK' ? 'success' : 'danger' }}">
                    {{ session('status') == 'OK' ? 'Company Adder' : 'Something Went Wrong' }}
                </div>
            @endif
            <div class="col-md-6 col-md-offset-2">
                <h2 class="text-center"><strong>Add a new Company</strong></h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Company.store') }}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="in" class="col-sm-4 control-label">Internal Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="in" class="form-control" id="in" placeholder="Internal Number" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">Notes</label>
                        <div class="col-sm-8">
                            <textarea id="notes" name="notes" cols="50" placeholder="Please enter notes about the company here." required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection