@extends('layout.dashboard')
@section('body')
    <br>
    <form action="{{ route('dashboard.product.index') }}" method="get">
        <div class="col-md-4">
            <input class="form-control" name="search" style="margin: auto" type="search" value="{{ request()->search }}">

        </div>

        <div class="col-md-4">
            <div class="col-sm-10">
                <select class="form-control" name="category_id">
                    <option value="0"> Category</option>
                    @foreach($categories as $category)
                        <option {{ old('category_id')==$category->id?'selected':'' }} value="{{ $category->id }}">{{ $category->name  }}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="col-md-4">

            <button type="submit" style="margin:auto " class="btn btn-theme start">
                <i class="glyphicon glyphicon-search"></i>
                <span>Search</span>
            </button>
        </div>


    </form>
    <br>

    <br>
    <br>

    {{--<div class="col-md-12">--}}
        {{--<div class="content-panel">--}}
            {{--<h4><i class="fa fa-eye"></i> VIEW PORDUCT</h4><hr><table class="table table-striped table-advance table-hover">--}}


                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th><i ></i>#</th>--}}
                    {{--<th><i class="fa fa-bullhorn"></i>NAME</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>DISCRIPTION</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>IMAGE</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>PURCHASE PRICE</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>SALE PRICE</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>PROFIT PERCENT</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>STOCK</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>STATUS</th>--}}
                    {{--<th><i class=" fa fa-edit"></i>ACTION</th>--}}
                    {{--<th></th>--}}
                {{--</tr>--}}
                {{--</thead>--}}


                {{--<tbody>--}}
                {{--@foreach($products as $index=>$product )--}}

                    {{--<tr>--}}
                        {{--<td>--}}
                            {{--{{ $index+1}}--}}
                        {{--</td>--}}

                        {{--<td>--}}
                            {{--{{ $product->name }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{!!$product->description  !!}--}}
                        {{--</td>--}}

                        {{--<td>--}}
                            {{--<img src="{{ $product->image }}" style="width: 50px ; height: 50px" alt="">--}}
                        {{--</td>--}}

                        {{--<td>--}}
                            {{--{{ $product->purchase_price }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ $product->sale_price }}--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--{{ $product->profit_percent}}%--}}
                        {{--</td>--}}

                        {{--<td>--}}
                            {{--{{ $product->stock }}--}}
                        {{--</td>--}}

                        {{--<td><span class="label label-info label-mini">Due</span></td>--}}
                        {{--<td>--}}
                            {{--@if(auth()->user()->hasPermission('update_products'))--}}
                                {{--<a class="btn btn-success btn-xs" href="{{ route('dashboard.product.edit' , $product->id) }}"><i class="fa fa-pencil"></i></a>--}}
                            {{--@else--}}
                                {{--<a disabled class="btn btn-success btn-xs" href="{{ route('dashboard.product.edit' , $product->id) }}"><i class="fa fa-pencil"></i></a>--}}

                            {{--@endif--}}
                            {{--@if(auth()->user()->hasPermission('delete_products'))--}}
                                {{--<form style="display: inline-block" action="{{ route('dashboard.product.destroy' , $product->id) }}" method="post">--}}
                                    {{--<input  type="hidden" name="_token"  value="{{ Session::token() }}" />--}}
                                    {{--{{  method_field('delete') }}--}}
                                    {{--<button onclick="return confirm('Are you sure you want to delete this item')" type="submit"><i  class="fa fa-trash-o"></i></button>--}}
                                {{--</form>--}}
                            {{--@else--}}
                                {{--<a disabled class="btn btn-danger btn-xs" href="{{ route('dashboard.users.edit' , $product->id) }}"><i class="fa fa-trash-o"></i></a>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}

                {{--</tbody>--}}

            {{--</table>--}}
            {{--{{  $products->appends(request()->query())->links() }}--}}

        {{--</div>--}}
        {{--<!-- /content-panel -->--}}
    {{--</div>--}}


    <div class="col-lg-12">
@foreach($products as $index=>$product)

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="custom-box">
                    <div class="servicetitle">
                        <h4>{{ $product->name }}</h4>
                        <hr>
                    </div>
                    <div class="icn-main-container">
                        <span class="img-circle"><img src="{{ $product->image }}"  class="img-circle" style="width: 80px ; height: 80px" alt=""></span>
                    </div>
                    <p>{!!$product->description  !!}</p>
                    <ul class="pricing">
                        <li style="color: #1a1a1a">PURCHASE PRICE:{{  $product->purchase_price  }}</li>
                        <li>SALE PRICE: {{ $product->sale_price }}</li>
                        <li style="color: #1a1a1a">PROFIT: {{ $product->profit_percent}}%</li>
                        <li>STOCK: {{ $product->stock }}</li>
                        <li>CATEGORY TYPE: {{ $product->category->name }}</li>

                        <li> EDIT: @if(auth()->user()->hasPermission('update_products'))
                            <a class="btn btn-success btn-xs" href="{{ route('dashboard.product.edit' , $product->id) }}"><i class="fa fa-pencil"></i></a>
                            @else
                            <a disabled class="btn btn-success btn-xs" href="{{ route('dashboard.product.edit' , $product->id) }}"><i class="fa fa-pencil"></i></a>

                            @endif</li> DROP
                        @if(auth()->user()->hasPermission('delete_products'))
                            <form style="display: inline-block" action="{{ route('dashboard.product.destroy' , $product->id) }}" method="post">
                            <input  type="hidden" name="_token"  value="{{ Session::token() }}" />
                            {{  method_field('delete') }}
                            <button onclick="return confirm('Are you sure you want to delete this item')" type="submit"><i  class="fa fa-trash-o"></i></button>
                            </form>
                            @else
                            <a disabled class="btn btn-danger btn-xs" href="{{ route('dashboard.users.edit' , $product->id) }}"><i class="fa fa-trash-o"></i></a>
                            @endif

                        </li>
                    </ul>
                </div>
                <!-- end custombox -->
            </div>


 @endforeach

        <!-- end col-4 -->
        <!-- end col-4 -->
        <!-- end col-4 -->
    </div>




@endsection