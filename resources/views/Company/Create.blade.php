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
                <h2 class="text-center"><strong>添加新的公司</strong></h2>
                <div class="clearfix"></div>
                <form class="form-horizontal" method="post" action="{{ route('Company.store') }}">
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">名称</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name" placeholder="企业名称" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="in" class="col-sm-4 control-label">内部编码</label>
                        <div class="col-sm-8">
                            <input type="text" name="in" class="form-control" id="in" placeholder="内部编码" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes" class="col-sm-4 control-label">备注</label>
                        <div class="col-sm-8">
                            <textarea id="notes" name="notes" cols="50" placeholder="输入关于企业的备注信息" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cat" class="col-sm-4 control-label">分类</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="cat">
                                @foreach(\App\QualificationCategory::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="qualification" class="col-sm-4 control-label">资质信息</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="qualification" name="qualification">
                                @foreach(\App\QualificationCategory::firstOrFail()->Qualifications as $qualification)
                                    <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="level" class="col-sm-4 control-label">等级</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="level" name="qualification">
                                @foreach(\App\QualificationLevel::all() as $levels)
                                    <option value="{{ $levels->id }}">{{ $levels->value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-default">创建</button>
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