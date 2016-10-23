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
                <h2 class="text-center"><strong>Edit:</strong> {{ $company->name }}</h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Company.store') }}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">@lang('company.create.name.label')</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" value="{{ $company->name }}" class="form-control" id="name" placeholder="@lang('company.create.name.pl')" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">@lang('company.create.notes.label')</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="notes" name="notes" cols="50" placeholder="@lang('company.create.notes.pl')" required>{{ $company->notes }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cat" class="col-sm-4 control-label">@lang('company.create.category')</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="cat" id="cat">
                                @foreach(\App\QualificationCategory::all() as $category)
                                    <option value="{{ $category->id }}"{{$company->qualification->cat == $category->id ? ' selected': ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="qualification" class="col-sm-4 control-label">@lang('company.create.qualification')</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="qualification" name="qualification">
                                @foreach(\App\QualificationCategory::firstOrFail()->Qualifications as $qualification)
                                    <option value="{{ $qualification->id }}"{{$company->qualification->name == $qualification->id ? ' selected': ''}}>{{ $qualification->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="level" class="col-sm-4 control-label">@lang('company.create.levels')</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="level" name="level">
                                @foreach(\App\QualificationLevel::all() as $levels)
                                    <option value="{{ $levels->id }}"{{$company->qualification->level == $levels->id ? ' selected': ''}}>{{ $levels->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default center-block">@lang('company.create.create')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection