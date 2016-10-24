@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(session('status'))
                <div class="alert alert-{{ session('status') == 'OK' ? 'success' : 'danger' }}">
                    {{ session('status') == 'OK' ? 'Certificate Edited' : 'Something Went Wrong' }}
                </div>
            @endif
            <div class="col-md-6 col-md-offset-2">
                <h2 class="text-center"><strong>Edit Certificate</strong></h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Certificate.update',$certificate->id) }}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" value="{{ $certificate->name }}" id="name" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cat" class="col-sm-4 control-label">Category</label>
                        <div class="col-sm-8">
                            <select name="category_id" class="form-control" id="cat">
                                @foreach(DB::table('certificate_categories')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-4 control-label">Role</label>
                        <div class="col-sm-8">
                            <select name="role" class="form-control" id="role">
                                @foreach(DB::table('certificate_names')->where('certificate_category_id',1)->get() as $name)
                                    <option value="{{ $name->id }}">{{ $name->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="level" class="col-sm-4 control-label">Certificate</label>
                        <div class="col-sm-8">
                            <select name="level" class="form-control" id="level">
                                @foreach(DB::table('certificate_levels')->where('certificate_name_id',1)->get() as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dob" class="col-sm-4 control-label">DOB: </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" value="{{ $certificate->dob->toDateString() }}" name="dob" id="dob" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="col-sm-4 control-label">Info</label>
                        <div class="col-sm-8">
                            <textarea id="info" name="info" cols="50" placeholder="Please enter info about the certificate here." required>{{ $certificate->info }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="issue" class="col-sm-4 control-label">Issue Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="issue" id="issue" required value="{{ $certificate->issue->toDateString() }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expiry" class="col-sm-4 control-label">Expiry Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="expiry" id="expiry" required value="{{ $certificate->expiry->toDateString() }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expiry" class="col-sm-4 control-label">Renewal Date</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="renew" id="expiry" value="{{ $certificate->renewal->toDateString() }}" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <input type="hidden" name="_method" value="update">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection