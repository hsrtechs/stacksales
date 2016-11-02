@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if(session('status'))
                <div class="alert alert-{{ session('status') == 'OK' ? 'success' : 'danger' }}">
                    {{ session('status') == 'OK' ? 'Certificate Added' : 'Something Went Wrong' }}
                </div>
            @endif
            <div class="col-md-6 col-md-offset-2">
                <h2 class="text-center"><strong>@lang('certificate.add)</strong></h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Certificate.store') }}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">@lang('certificate.head.name')</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">@lang('certificate.form.gender')</label>
                        <div class="col-sm-8 radio">
                            <label class="radio-inline">
                                <input type="radio" value="Male" name="gender" required>
                                Male
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="female" name="gender" required>
                                Female
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dob" class="col-sm-4 control-label">@lang('certificate.form.dob')</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="dob" id="dob" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_no" class="col-sm-4 control-label">@lang('certificate.form.identification')</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="idno" id="id_no" required />
                        </div>
                    </div>
                    <input type="hidden" value="{{ $cid }}" name="company_id">
                    <div class="form-group">
                        <label for="cat" class="col-sm-4 control-label">@lang('certificate.form.category')</label>
                        <div class="col-sm-8">
                            <select name="category_id" class="form-control" id="cat">
                                @foreach(DB::table('certificate_categories')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-sm-4 control-label">@lang('certificate.form.role')</label>
                        <div class="col-sm-8">
                            <select name="role" class="form-control" id="role">
                                @foreach(DB::table('certificate_names')->where('certificate_category_id',1)->get() as $name)
                                    <option value="{{ $name->id }}">{{ $name->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="level" class="col-sm-4 control-label">@lang('certificate.form.certificate')</label>
                        <div class="col-sm-8">
                            <select name="level" class="form-control" id="level">
                                @foreach(DB::table('certificate_levels')->where('certificate_name_id',1)->get() as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="info" class="col-sm-4 control-label">@lang('certificate.form.info')</label>
                        <div class="col-sm-8">
                            <textarea id="info" name="info" cols="50" placeholder="Please enter info about the certificate here." required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="issue" class="col-sm-4 control-label">@lang('certificate.date.issue')</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="issue" id="issue" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expiry" class="col-sm-4 control-label">@lang('certificate.date.expiry')</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="expiry" id="expiry" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="expiry" class="col-sm-4 control-label">@lang('certificate.date.renewal')</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="renew" id="expiry" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">@lang('certificate.create')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@section('js')
    <script>
        $("#cat").change(function () {
            var id = $("#cat option:selected").val();
            $.post("{{ url('/Certificate/Roles') }}/" + id, {
                '_token': '{{ csrf_token() }}',
            }, function (data, status) {
                $("#role option").remove();
                $.each(data, function (key, value) {
                    console.log(value);
                    $('#role').append($("<option></option>").attr("value", value.id).text(value.name));
                });
            });
        });

        $("#role").change(function () {
            var id = $("#role option:selected").val();
            $.post("{{ url('/Certificate/Level') }}/"+id,{
                '_token' : '{{ csrf_token() }}',
            },function  (data, status){
                $("#level option").remove();
                $.each(data, function (key, value) {
                    console.log(value);
                    $('#level').append($("<option></option>").attr("value", value.id).text(value.name));
                });
            });

        });
    </script>
@endsection