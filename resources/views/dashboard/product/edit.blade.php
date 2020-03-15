@extends('layout.dashboard')
@section('body')
    <br>
    <br>
    <div class="col-lg-12">
        <div class="form-panel">
            <h4 class="mb">
                <i class="fa fa-user-plus">
                </i> UPDATE PRODUCT </h4>

            <form enctype="multipart/form-data" class="form-horizontal style-form" action="{{ route('dashboard.product.update' , $product->id) }}" method="post">
                <input type="hidden" name="_token"  value="{{ Session::token() }}"  />
              {{method_field('PUT')  }}

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" >CATEGORY TYPE</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="category_id">
                            <option value="0"> Category</option>
                            @foreach($categories as $category)
                                <option {{ $product->category_id==$category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name  }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group last">
                    <label class="control-label col-md-3">Image Upload</label>
                    <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">

                        <div>
                        <span class="btn btn-theme02 btn-file">
                        <input  type="file" name="image" class="default">
                        </span>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">PURCHASE PRICE</label>
                    <div class="col-sm-10">
                        <input type="number" name="purchase_price" class="form-control"
                               value="{{ $product->purchase_price }}">
                        <span style="color: red">{{ $errors->first('purchase_price') }} </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">SALE PRICE</label>
                    <div class="col-sm-10">
                        <input type="number" name="sale_price" class="form-control"
                               value="{{ $product->sale_price }}">
                        <span style="color: red">{{ $errors->first('sale_price') }} </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">STOCK</label>
                    <div class="col-sm-10">
                        <input type="number" name="stock" class="form-control"
                               value="{{  $product->stock }}">
                        <span style="color: red">{{ $errors->first('stock') }} </span>
                    </div>
                </div>



                @foreach(config('translatable.locales') as $locale)

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">{{ $locale.'-'.'NAME' }}</label>
                        <div class="col-sm-10">
                            <input type="text" name="{{ $locale }}[name]" class="form-control"
                                   value="{{ $product->name  }}">
                            <span style="color: red">{{ $errors->first('name') }} </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">{{ $locale.'-'.'DESCRIPION' }}</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="{{ $locale }}[description]" class="form-control ckeditor"
                            >
                            {{ $product->description }}
                            </textarea>
                            <span style="color: red">{{ $errors->first('description') }} </span>
                        </div>
                    </div>
            @endforeach



            {{--<div class="form-group last">--}}
            {{--<label class="control-label col-md-3">Image Upload</label>--}}
            {{--<div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">--}}

            {{--<div>--}}
            {{--<span class="btn btn-theme02 btn-file">--}}
            {{--<input  type="file" name="image" class="default">--}}
            {{--</span>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--</div>--}}



                <!-- /panel-body -->
                <br>
                <button type="submit" style="margin-left: 50%" class="btn btn-round btn-primary right"><i class="fa fa-plus"></i>EDIT</button>

            </form>
        </div>
    </div>

@endsection