@extends('layout.dashboard')
@section('body')
    <br>
    <br>
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb">
                <i class="fa fa-user-plus">
                </i> ADD CATEGORY </h4>

            <form enctype="multipart/form-data" class="form-horizontal style-form" action="{{ route('dashboard.category.store') }}" method="post">
                <input type="hidden" name="_token"  value="{{ Session::token() }}"  />

                @foreach(config('translatable.locales') as $locale)

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">{{ $locale.'-'.'NAME' }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[name]" class="form-control" required value="{{ old($locale.'.name') }}">
                            <span style="color: red">{{ $errors->first('name') }} </span>
                        </div>
                    </div>
                @endforeach


                {{--<div class="form-group last">--}}
                    {{--<label class="control-label col-md-3">Image Upload</label>--}}
                    {{--<div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">--}}

                        {{--<div>--}}
                        {{--<span class="btn btn-theme02 btn-file">--}}
                        {{--<input required type="file" name="image" class="default">--}}
                        {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}



                    <!-- /tab-content -->
                <!-- /panel-body -->
                <br>
                <button type="submit" style="margin-left: 50%" class="btn btn-round btn-primary right"><i class="fa fa-plus"></i>ADD</button>

            </form>
        </div>
    </div>

@endsection