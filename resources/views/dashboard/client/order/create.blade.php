@extends('layout.dashboard')
@section('body')
    <br>
    <br>
    <div class="col-md-6">
        <h3 class="fa fa-inbox" style="font-size: 20px"> CATEGORY</h3>
        <p>
            <br>
            @foreach($categories as $category)
            <a  class="btn btn-primary btn-block" href="#{{ str_replace(' ' , '-' , $category->name)}}"  data-toggle="collapse">
                {{ $category->name }}
            </a>

        </p>
        <div class="collapse" id="{{ str_replace(' ' , '-' , $category->name)  }}">
                    <div class="content-panel">
                        <table class="table">
                            <thead>

                            <tr>
                                <th>NAME</th>
                                <th>STOCK</th>
                                <th>PRICE</th>
                                <th>ADD</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($category->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>
                                        <button
                                                id="product-{{ $product->id }}"
                                                data-name="{{$product->name  }}"
                                                data-id="{{$product->id  }}"
                                                data-sale_price="{{$product->sale_price  }}"
                                                type="submit" class="btn-xs btn-success add-product-btn"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>            </div>
    @endforeach

@endsection