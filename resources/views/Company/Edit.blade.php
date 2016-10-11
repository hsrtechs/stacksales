@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(session('status'))
                <div class="alert alert-{{ session('status') == 'OK' ? 'success' : 'danger' }}">
                    {{ session('status') == 'OK' ? 'Company Edited' : 'Something Went Wrong' }}
                </div>
            @endif
            <div class="col-md-6 col-md-offset-2">
                <h2 class="text-center"><strong>Edit {{ $company->name }}</strong></h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Company.update',$company->id) }}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $company->name }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="in" class="col-sm-4 control-label">Internal Number</label>
                        <div class="col-sm-8">
                            <input type="text" name="in" class="form-control" id="in" placeholder="Internal Number" value="{{ $company->in }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">Notes</label>
                        <div class="col-sm-8">
                            <textarea id="notes" name="notes" cols="50" rows="6" placeholder="Please enter notes about the company here." required>{{ $company->notes }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PATCH">
                            <button type="submit" class="btn btn-default">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection