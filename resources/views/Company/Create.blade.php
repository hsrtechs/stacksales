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
                <h2 class="text-center"><strong>@lang('company.create.head')</strong></h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Company.store') }}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">@lang('company.create.name.label')</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" placeholder="@lang('company.create.name.pl')" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">@lang('company.create.notes.label')</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="notes" name="notes" cols="50" placeholder="@lang('company.create.notes.pl')" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cat" class="col-sm-4 control-label">@lang('company.create.category')</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="cat" id="cat">
                                @foreach(\App\QualificationCategory::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="qualification" class="col-sm-4 control-label">@lang('company.create.qualification')</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="qualification" name="qualification">
                                @foreach(\App\QualificationCategory::firstOrFail()->Qualifications as $qualification)
                                    <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="level" class="col-sm-4 control-label">@lang('company.create.levels')</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="level" name="levels" multiple>
                                @foreach(\App\QualificationLevel::all() as $levels)
                                    <option value="{{ $levels->id }}">{{ $levels->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">@lang('company.create.create')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('headcss')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">


@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>

    <script>
        $("#level").select2();
    </script>

    <script>
        $("#cat").change(function () {
            var id = $("#cat option:selected").val();
            $.post("{{ url('/Company/QualificationPost') }}/" + id, {
                '_token': '{{ csrf_token() }}',
            }, function (data, status) {
                $("#qualification option").remove();
                $.each(data, function (key, value) {
                    console.log(value);
                    $('#qualification').append($("<option></option>").attr("value", value.id).text(value.name));
                });
            });
        });

         $("#qualification").change(function () {
            var id = $("#qualification option:selected").val();
            $.post("{{ url('/Company/QualificationLevel') }}/"+id,{
                '_token' : '{{ csrf_token() }}',
            },function  (data, status){
                $("#level option").remove();
                $.each(data, function (key, value) {
                    $('#level').append($("<option></option>").attr("value", value.id).text(value.value));
                });
            });

        });

    </script>
@endsection