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
                                                data-name="{{ $product->name  }}"
                                                data-id="{{ $product->id  }}"
                                                data-sale="{{ $product->sale_price  }}"
                                                type="submit"  class="btn btn-success btn-sm  add-product-btn"><i class="fa fa-plus"></i></button>
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>            </div>
    @endforeach
    <br>
    <br><br>
<div class="col-md-6">
    <div class="box-body">

        <form action="{{ route('dashboard.client.order.store', $client->id) }}" method="post">
            <table class="table order-list">
                <thead>

                <tr>
                    <th>NAME</th>
                    <th>STOCK</th>
                    <th>PRICE</th>
                    <th>ADD</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td>

                    </td>
                </tr>

                </tbody>
            </table>

            {{ csrf_field() }}
            <h4 STYLE="text-align: center; font-family: Andalus">TOTAL PRICE : <span class="total-price">0</span></h4>

            <button class="btn btn-primary btn-block" id="add-order-form-btn"><i class="fa fa-plus"></i>ADD ORDER</button>

        </form>

    </div><!-- end of box body -->

</div><!-- end of box -->




</div>
@endsection