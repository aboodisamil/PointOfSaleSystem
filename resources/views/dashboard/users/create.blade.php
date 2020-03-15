@extends('layout.dashboard')
@section('body')
    <br>
    <br>
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb">
                <i class="fa fa-user-plus">
                </i> ADD USERS </h4>

            <form enctype="multipart/form-data" class="form-horizontal style-form" action="{{ route('dashboard.users.store') }}" method="post">
                <input type="hidden" name="_token"  value="{{ Session::token() }}"  />

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">FIRST NAME</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" class="form-control" required value="{{ old('first_name') }}">
                        <span style="color: red">{{ $errors->first('first_name') }} </span>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">LAST NAME</label>
                    <div class="col-sm-10">
                        <input type="text"  name="last_name" required class="form-control round-form" value="{{ old('last_name') }}">
                        <span style="color: red">{{ $errors->first('last_name') }} </span>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">E-MAIL</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" required name="email" value="{{ old('email') }}">
                        <span style="color: red">{{ $errors->first('email') }} </span>

                    </div>
                </div>
                <div class="form-group last">
                    <label class="control-label col-md-3">Image Upload</label>
                        <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">

                            <div>
                        <span class="btn btn-theme02 btn-file">
                        <input required type="file" name="image" class="default">
                        </span>
                            </div>
                        </div>

                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" required name="password">
                        <span style="color: red">{{ $errors->first('password') }} </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" required name="password_confirmation">
                        <span style="color: red">{{ $errors->first('password_confirmation') }} </span>

                    </div>
                </div>

                <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">THE PERSMESSION</label>
                </div>
                @php
                $models=['users','categories','products' , 'clients']
                @endphp

                    <div class="panel-heading">
                        <ul class="nav nav-tabs nav-justified">
                            @foreach($models as $index=>$model)
                                <li class="{{ $index==0?'active' : '' }}" >
                                    <a data-toggle="tab" href="#{{$model}}" aria-expanded="false">{{$model}}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <!-- /panel-heading -->
                    <div class="panel-body">
                        <div class="tab-content">
                            @foreach($models as $index=>$model)
                                <div id="{{$model}}" class="tab-pane">
                                    <div class="row">
                                        <div class="col-md-6" style="display: inline">

                                            <div class="form-check form-check-inline">
                                                <input name="permissions[]" class="form-check-input" type="checkbox" id="inlineCheckbox1" value="create_{{$model}}">
                                                <label class="form-check-label" for="inlineCheckbox1">ADD {{strtoupper($model)}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input name="permissions[]" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="update_{{$model}}">
                                                <label class="form-check-label" for="inlineCheckbox2">UPDATE {{strtoupper($model)}}</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input name="permissions[]" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="delete_{{$model}}">
                                                <label class="form-check-label" for="inlineCheckbox2">DELETE {{strtoupper($model)}}</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input name="permissions[]" class="form-check-input" type="checkbox" id="inlineCheckbox2" value="read_{{$model}}">
                                                <label class="form-check-label" for="inlineCheckbox2">VIEW {{strtoupper($model)}}</label>
                                            </div>                                  <!-- /detailed -->
                                        </div>
                                        <!-- /col-md-6 -->
                                        <!-- /col-md-6 -->
                                    </div>
                                    <!-- /OVERVIEW -->
                                </div>
                            @endforeach
                            <!-- /tab-pane -->


                            {{--<div id="contact" class="tab-pane">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-6">--}}
                                        {{--asasa1111--}}
                                    {{--</div>--}}
                                    {{--<!-- /col-md-6 -->--}}
                                    {{--<!-- /col-md-6 -->--}}
                                {{--</div>--}}
                                {{--<!-- /row -->--}}
                            {{--</div>--}}
                            <!-- /tab-pane -->


                            {{--<div id="edit" class="tab-pane active">--}}
                                {{--<div class="row">--}}
                                {{--asaa222--}}
                                    {{--<!-- /col-lg-8 -->--}}
                                {{--</div>--}}
                                {{--<!-- /row -->--}}
                            {{--</div>--}}
                            <!-- /tab-pane -->
                        </div>
                        <!-- /tab-content -->
                    </div>
                    <!-- /panel-body -->
                <br>
                <button type="submit" style="margin-left: 50%" class="btn btn-round btn-primary right"><i class="fa fa-plus"></i>ADD</button>

            </form>
        </div>
    </div>

@endsection