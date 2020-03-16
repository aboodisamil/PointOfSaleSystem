@extends('layout.dashboard')
@section('body')
    <br>
    <form action="{{ route('dashboard.client.index') }}" method="get">
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
            <h4><i class="fa fa-eye"></i> VIEW CLIENT</h4><hr><table class="table table-striped table-advance table-hover">


                <thead>
                <tr>
                    <th><i ></i>#</th>

                    <th><i class="fa fa-bullhorn"></i>NAME</th>
                    <th><i class=" fa fa-edit"></i>PHONE</th>
                    <th><i class=" fa fa-edit"></i>ADDRESS</th>
                    <th><i class=" fa fa-edit"></i>ADD ORDER</th>
                    <th><i class=" fa fa-edit"></i>STATUS</th>
                    <th><i class=" fa fa-edit"></i>ACTION</th>
                    <th></th>
                </tr>
                </thead>


                <tbody>
                @foreach($clients as $index=>$client )

                    <tr>
                        <td>
                            {{ $index+1}}
                        </td>

                        <td>
                           {{ $client->name }}
                        </td>
                        <td>
                            {{--{{  implode($client->phone , '-') }}--}}{{--// convert array to str--}}
                           {{ implode(array_filter( $client->phone), '-') }}  {{--to remove null--}}
                        </td>
                        <td>
                            {{ $client->address }}

                        </td>

                        <td>
                            @if(auth()->user()->hasPermission('create_orders'))

                            <a href="{{route('dashboard.client.order.create' , $client->id)}}" class="btn-xs btn-primary">ADD ORDER</a>
                            @else
                                <a  href="#" disabled class="btn-xs btn-primary disabled">ADD ORDER</a>
                            @endif

                        </td>

                        <td><span class="label label-info label-mini">Due</span></td>
                        <td>
                            @if(auth()->user()->hasPermission('update_clients'))
                                <a class="btn btn-success btn-xs" href="{{ route('dashboard.client.edit' , $client->id) }}"><i class="fa fa-pencil"></i></a>
                            @else
                                <a disabled class="btn btn-success btn-xs" href="{{ route('dashboard.client.edit' , $client->id) }}"><i class="fa fa-pencil"></i></a>

                            @endif
                            @if(auth()->user()->hasPermission('delete_clients'))
                                <form style="display: inline-block" action="{{ route('dashboard.client.destroy' , $client->id) }}" method="post">
                                    <input  type="hidden" name="_token"  value="{{ Session::token() }}" />
                                    {{  method_field('delete') }}
                                    <button onclick="return confirm('Are you sure you want to delete this item')" type="submit"><i  class="fa fa-trash-o"></i></button>
                                </form>
                            @else
                                <a disabled class="btn btn-danger btn-xs" href="{{ route('dashboard.users.edit' , $client->id) }}"><i class="fa fa-trash-o"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>
            {{--{{  $clients->appends(request()->query())->links() }}--}}

        </div>
        <!-- /content-panel -->
    </div>
@endsection