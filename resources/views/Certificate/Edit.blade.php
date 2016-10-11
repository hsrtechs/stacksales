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
                <h2 class="text-center"><strong>Edit Certificate</strong></h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Certificate.store') }}">
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
                        <label for="in" class="col-sm-4 control-label">Company</label>
                        <div class="col-sm-8">
                            <select name="category_id" class="form-control">
                                @foreach(\App\Company::all() as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="in" class="col-sm-4 control-label">Category</label>
                        <div class="col-sm-8">
                            <select name="id" class="form-control">
                                @foreach(\App\CertificateCategory::all() as $certificate_category)
                                    <option value="{{ $certificate_category->id }}">{{ $certificate_category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-sm-4 control-label">Role</label>
                        <div class="col-sm-8">
                            <input type="text" name="role" class="form-control" id="role" placeholder="Role" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="col-sm-4 control-label">Info</label>
                        <div class="col-sm-8">
                            <textarea id="info" name="info" cols="50" placeholder="Please enter info about the company here." required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="issue" class="col-sm-4 control-label">Issue Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="issue" id="issue" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expiry" class="col-sm-4 control-label">Expiry Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="expiry" id="expiry" required />
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