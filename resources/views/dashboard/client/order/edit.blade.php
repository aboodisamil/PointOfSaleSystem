@extends('layout.dashboard')
@section('body')
    <br>
    <br>
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb">
                <i class="fa fa-user-plus">
                </i> UPDATE CLIENT </h4>

            <form enctype="multipart/form-data" class="form-horizontal style-form" action="{{ route('dashboard.client.update' , $client->id) }}" method="post">
                <input type="hidden" name="_token"  value="{{ Session::token() }}"  />
{{ method_field('PUT') }}
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">NAME :</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control"  value="{{$client->name }}">
                        <span style="color: red">{{ $errors->first('name') }} </span>
                    </div>
                </div>


                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-2 col-sm-2 control-label">PHONE :</label>--}}
                    {{--<div class="col-sm-10">--}}
                        {{--<input type="number" name="phone[]" class="form-control"  >--}}
                        {{--<span style="color: red">{{ $errors->first('phone.0') }} </span>--}}
                    {{--</div>--}}
                {{--</div>--}}


                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-2 col-sm-2 control-label">PHONE :</label>--}}
                    {{--<div class="col-sm-10">--}}
                        {{--<input type="number" name="phone[]" class="form-control"  >--}}
                        {{--<span style="color: red">{{ $errors->first('phone[]') }} </span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                @for($i=0; $i <2 ; $i++)

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">PHONE :</label>
                        <div class="col-sm-10">
                            <input type="number" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? ' '}}"  >
                            <span style="color: red">{{ $errors->first('phone[]') }} </span>
                        </div>
                    </div>

                @endfor


                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">ADDRESS :</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" class="form-control"  value="{{$client->address }}">
                        <span style="color: red">{{ $errors->first('address') }} </span>
                    </div>
                </div>


                <br>
                <button type="submit" style="margin-left: 50%" class="btn btn-round btn-primary right"><i class="fa fa-plus"></i>ADD</button>

            </form>
        </div>
    </div>

@endsection