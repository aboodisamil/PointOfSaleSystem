@extends('layout.dashboard')
@section('body')
    <br>
    <form action="{{ route('dashboard.category.index') }}" method="get">
        <div class="col-md-4">
            <input class="form-control" name="search" style="margin: auto" type="search" value="{{ request()->search }}">

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

    <div class="col-md-12">
        <div class="content-panel">
            <h4><i class="fa fa-eye"></i> VIEW CATEGORY</h4><hr><table class="table table-striped table-advance table-hover">


                <thead>
                <tr>
                    <th><i ></i>#</th>

                    <th><i class="fa fa-bullhorn"></i>NAME</th>
                    <th><i class=" fa fa-edit"></i>PRODUCT COUNT</th>
                    <th><i class=" fa fa-edit"></i>PRODUCT RELATED</th>
                    <th><i class=" fa fa-edit"></i>STATUS</th>
                    <th><i class=" fa fa-edit"></i>ACTION</th>
                    <th></th>
                </tr>
                </thead>


                <tbody>
                @foreach($categories as $index=>$category )

                    <tr>
                        <td>
                            {{ $index+1}}
                        </td>

                        <td>
                           {{ $category->name }}
                        </td>
                        <td>
                            {{ $category->products->count() }}
                        </td>
                        <td>
                            <a href="{{  route('dashboard.product.index' , ['category_id'=>$category->id]) }}" class="btn-xs btn-primary">PRODUCT RELATED</a>

                        </td>



                        <td><span class="label label-info label-mini">Due</span></td>
                        <td>
                            @if(auth()->user()->hasPermission('update_categories'))
                                <a class="btn btn-success btn-xs" href="{{ route('dashboard.category.edit' , $category->id) }}"><i class="fa fa-pencil"></i></a>
                            @else
                                <a disabled class="btn btn-success btn-xs" href="{{ route('dashboard.category.edit' , $category->id) }}"><i class="fa fa-pencil"></i></a>

                            @endif
                            @if(auth()->user()->hasPermission('delete_categories'))
                                <form style="display: inline-block" action="{{ route('dashboard.category.destroy' , $category->id) }}" method="post">
                                    <input  type="hidden" name="_token"  value="{{ Session::token() }}" />
                                    {{  method_field('delete') }}
                                    <button onclick="return confirm('Are you sure you want to delete this item')" type="submit"><i  class="fa fa-trash-o"></i></button>
                                </form>
                            @else
                                <a disabled class="btn btn-danger btn-xs" href="{{ route('dashboard.users.edit' , $category->id) }}"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
            {{  $categories->appends(request()->query())->links() }}

        </div>
        <!-- /content-panel -->
    </div>
@endsection